<?php

namespace LaravelEnso\People\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\RoutesNotifications;
use Illuminate\Support\Collection;
use LaravelEnso\Addresses\Traits\Addressable;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Helpers\Traits\AvoidsDeletionConflicts;
use LaravelEnso\Helpers\Traits\CascadesMorphMap;
use LaravelEnso\Rememberable\Traits\Rememberable;
use LaravelEnso\Tables\Traits\TableCache;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\TrackWho\Traits\UpdatedBy;
use LaravelEnso\Users\Models\User;

class Person extends Model
{
    use Addressable,
        AvoidsDeletionConflicts,
        CascadesMorphMap,
        CreatedBy,
        HasFactory,
        Rememberable,
        RoutesNotifications,
        TableCache,
        UpdatedBy;

    protected $guarded = ['id'];

    protected $dates = ['birthday'];

    protected $touches = ['user'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)
            ->withPivot(['position', 'is_main']);
    }

    public function hasUser()
    {
        return $this->user()->exists();
    }

    public function company()
    {
        return $this->companies->where('pivot.is_main', true)->first();
    }

    public function appellative()
    {
        return $this->appellative ?? $this->name;
    }

    public function position(Company $company)
    {
        return $this->companies()
            ->wherePivot('company_id', $company->id)
            ->first()->pivot->position;
    }

    public function syncCompanies($companyIds, $mainCompanyId)
    {
        $pivotIds = Collection::wrap($companyIds)
            ->reduce(fn ($pivot, $value) => $pivot->put($value, [
                'is_main' => $value === $mainCompanyId,
                'is_mandatary' => false,
            ]), new Collection());

        $this->companies()->sync($pivotIds->toArray());
    }
}

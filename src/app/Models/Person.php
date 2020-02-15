<?php

namespace LaravelEnso\People\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use LaravelEnso\Addresses\App\Traits\Addressable;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\DynamicMethods\App\Traits\Relations;
use LaravelEnso\Helpers\App\Traits\AvoidsDeletionConflicts;
use LaravelEnso\People\App\Enums\Genders;
use LaravelEnso\People\App\Enums\Titles;
use LaravelEnso\Rememberable\App\Traits\Rememberable;
use LaravelEnso\Tables\App\Traits\TableCache;
use LaravelEnso\TrackWho\App\Traits\CreatedBy;
use LaravelEnso\TrackWho\App\Traits\UpdatedBy;

class Person extends Model
{
    use Addressable,
        AvoidsDeletionConflicts,
        CreatedBy,
        Relations,
        Rememberable,
        TableCache,
        UpdatedBy;

    protected $fillable = [
        'title', 'name', 'appellative', 'uid', 'email', 'phone', 'birthday',
        'bank', 'bank_account', 'obs',
    ];

    protected $dates = ['birthday'];

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
        return $this->companies
            ->first(fn ($company) => $company->pivot->is_main);
    }

    public function appellative()
    {
        return $this->appellative ?? $this->name;
    }

    public function gender()
    {
        if (!$this->title) {
            return;
        }

        return $this->title === Titles::Mr
            ? Genders::Male
            : Genders::Female;
    }

    public function position(Company $company)
    {
        return $this->companies()
            ->wherePivot('company_id', $company->id)
            ->first()->pivot->position;
    }

    public function syncCompanies($companyIds, $mainCompanyId)
    {
        $pivotIds = (new Collection($companyIds))
            ->reduce(fn ($pivot, $value) => $pivot->put($value, [
                'is_main' => $value === $mainCompanyId,
                'is_mandatary' => false,
            ]), new Collection());

        $this->companies()->sync($pivotIds->toArray());
    }
}

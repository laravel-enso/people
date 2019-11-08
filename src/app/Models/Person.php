<?php

namespace LaravelEnso\People\app\Models;

use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Enums\Genders;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Tables\app\Traits\TableCache;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\Addresses\app\Traits\Addressable;
use LaravelEnso\DynamicMethods\app\Traits\Relations;
use LaravelEnso\Rememberable\app\Traits\Rememberable;
use LaravelEnso\Helpers\app\Traits\AvoidsDeletionConflicts;

class Person extends Model
{
    use Addressable, AvoidsDeletionConflicts, CreatedBy, Relations,
        Rememberable, TableCache, UpdatedBy;

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
        return $this->companies->first(function ($company) {
            return $company->pivot->is_main;
        });
    }

    public function gender()
    {
        if (! $this->title) {
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
        $pivotIds = collect($companyIds)
            ->reduce(function ($pivot, $value) use ($mainCompanyId) {
                return $pivot->put($value, [
                    'is_main' => $value === $mainCompanyId,
                    'is_mandatary' => false,
                ]);
            }, collect())->toArray();

        $this->companies()->sync($pivotIds);
    }
}

<?php

namespace LaravelEnso\People\app\Models;

use Carbon\Carbon;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Enums\Genders;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Tables\app\Traits\TableCache;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\Addresses\app\Traits\Addressable;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Person extends Model
{
    use Addressable, CreatedBy, UpdatedBy, TableCache;

    protected $fillable = [
        'title', 'name', 'appellative', 'uid', 'email', 'phone', 'birthday', 'obs',
    ];

    protected $dates = ['birthday'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function hasUser()
    {
        return $this->user()->count() === 1;
    }

    public function company()
    {
        return $this->companies()
            ->wherePivot('is_main', true)
            ->first();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)
            ->withPivot('position');
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

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = isset($value)
            ? Carbon::parse($value)
            : null;
    }

    public function attachCompanies($companyIds)
    {
        $this->companies()->attach($companyIds, [
            'is_main' => false,
            'is_mandatary' => false,
        ]);
    }

    public function syncCompanies($companyIds)
    {
        $existing = $this->companies()->pluck('id');

        tap($this)->attachCompanies(
                collect($companyIds)->diff($existing)
            )->companies()->detach(
                $existing->diff($companyIds)
            );
    }

    public function setMainCompany(int $companyId)
    {
        $this->companies()
            ->updateExistingPivot($companyId, [
                'is_main' => true,
            ]);
    }

    public function removeMainCompany(int $companyId)
    {
        $this->companies()
            ->updateExistingPivot($companyId, [
                'is_main' => false,
            ]);
    }

    public function delete()
    {
        try {
            parent::delete();
        } catch (\Exception $e) {
            throw new ConflictHttpException(__(
                'The person is assigned to resources in the system and cannot be deleted'
            ));
        }

        return ['message' => __('The person was successfully deleted')];
    }
}

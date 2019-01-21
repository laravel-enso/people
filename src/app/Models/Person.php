<?php

namespace LaravelEnso\People\app\Models;

use Carbon\Carbon;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Enums\Genders;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use LaravelEnso\AddressesManager\app\Traits\Addressable;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Person extends Model
{
    use Addressable, CreatedBy, UpdatedBy, LogsActivity;

    protected $guarded = [];

    protected $dates = ['birthday'];

    protected $loggableLabel = 'name';

    protected $loggable = ['name', 'appelative', 'phone'];

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
        return $this->belongsTo(Company::class);
    }

    public function gender()
    {
        if (! $this->title) {
            return null;
        }

        return $this->title === Titles::Mr
            ? Genders::Male
            : Genders::Female;
    }

    public function isMandatary()
    {
        return $this->id === optional($this->company)->mandatary_id;
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = isset($value)
            ? Carbon::parse($value)
            : null;
    }

    public function dissociateCompany()
    {
        if ($this->isMandatary()) {
            throw new ConflictHttpException(__(
                'The selected contact is the company\'s mandatary and cannot be deleted'
            ));
        }

        $this->company()->dissociate();
        $this->save();
    }

    public function delete()
    {
        try {
            parent::delete();
        } catch (\Exception $e) {
            throw new ConflictHttpException(__(
                'The person has assigned resources in the system and cannot be deleted'
            ));
        }
    }
}

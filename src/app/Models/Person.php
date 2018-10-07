<?php

namespace LaravelEnso\People\app\Models;

use Carbon\Carbon;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use LaravelEnso\AddressesManager\app\Traits\Addresses;

class Person extends Model
{
    use Addresses, CreatedBy, UpdatedBy, LogsActivity;

    protected $guarded = [];

    protected $loggableLabel = 'name';

    protected $loggable = ['name', 'appelative', 'phone']; //add gender to loggable

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function hasUser()
    {
        return $this->user()->count() === 1;
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = isset($value)
            ? Carbon::parse($value)
            : null;
    }

    public function delete()
    {
        try {
            parent::delete();
        } catch (\Exception $e) {
            throw new ConflictHttpException(__(
                'The person has activity in the system and cannot be deleted'
            ));
        }

        return ['message' => 'The person was successfully deleted'];
    }
}

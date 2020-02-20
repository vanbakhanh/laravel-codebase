<?php

namespace App\Models;

use App\Notifications\Api\VerifyEmailNotification;
use App\Notifications\Api\SendMailNewPasswordNotification;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 *
 * @package namespace App\Models;
 */
class User extends Authenticatable implements Transformable, MustVerifyEmail
{
    use Notifiable, TransformableTrait, HasApiTokens, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'social_id',
        'social_name',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be in date format.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Hash the user'password before save.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Relationship with profile table.
     *
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        if (request()->is('api/*')) {
            $this->notify(new VerifyEmailNotification);
        } else {
            parent::sendEmailVerificationNotification();
        }
    }

    public function sendEmailGeneratePasswordNotification($password)
    {
        $this->notify(new SendMailNewPasswordNotification($password));
    }
}

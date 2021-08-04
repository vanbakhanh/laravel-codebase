<?php

namespace App\Models;

use App\Notifications\SendMailNewPasswordNotification;
use App\Notifications\VerifyEmailNotification;
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
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User.
 *
 * @package namespace App\Models;
 */
class User extends Authenticatable implements Transformable, MustVerifyEmail
{
    use Notifiable, TransformableTrait, HasApiTokens, HasRoles, Billable, HasFactory;

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

    /**
     * Send email new password.
     *
     * @param string $password
     * @return void
     */
    public function sendEmailGeneratePasswordNotification($password)
    {
        $this->notify(new SendMailNewPasswordNotification($password));
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
        return $this->fcmUsers()->pluck('token')->toArray();
    }

    /**
     * Relationship with profile table.
     *
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Relationship with user.
     *
     * @return void
     */
    public function fcmUsers()
    {
        return $this->hasMany(FcmUser::class, 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Profile.
 *
 * @package namespace App\Models;
 */
class Profile extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'address',
        'phone',
        'birthday',
        'gender',
        'height_ft',
        'height_in',
        'weight',
        'street',
        'city',
        'state',
        'zip_code',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'gender_text'];

    /**
     * Get the user's gender to text.
     *
     * @return int
     */
    public function getGenderTextAttribute()
    {
        if (array_key_exists($this->gender, config('model.profile.gender.text'))) {
            return config('model.profile.gender.text.' . $this->gender);
        }
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if ($this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        return "{$this->first_name}";
    }

    /**
     * Get the avatar path.
     *
     * @param string $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        if (!$value) {
            $value = config('model.profile.avatar_default');
        }

        $path = config('model.profile.avatar_path');

        return asset(Storage::url($path . $value));
    }

    /**
     * Relationship with user table.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

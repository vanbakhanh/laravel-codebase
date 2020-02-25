<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FcmUser.
 *
 * @package namespace App\Models;
 */
class FcmUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'token',
    ];

}

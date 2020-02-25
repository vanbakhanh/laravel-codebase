<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FcmNotification.
 *
 * @package namespace App\Models;
 */
class FcmNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'data',
        'type',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type_icon', 'type_text'];

    public function userReceiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function userSender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiverProfile()
    {
        return $this->belongsTo(Profile::class, 'receiver_id', 'user_id');
    }

    public function senderProfile()
    {
        return $this->belongsTo(Profile::class, 'sender_id', 'user_id');
    }
}

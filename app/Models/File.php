<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

/**
 * Class File.
 *
 * @package namespace App\Models;
 */
class File extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'path',
        'extension',
        'mime',
        'processed',
        'data',
        'type',
        'job_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'processed' => 'int',
        'type' => 'int',
    ];

    /**
     * Get the user
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the direct link of s3
     */
    public function getUrlAttribute() 
    {
        if (!empty($this->path)) {
            return Storage::disk('s3')->temporaryUrl(
                $this->path, now()->addSeconds(config('constants.expire_link_duration'))
            );
        }
        return null;
    }
}

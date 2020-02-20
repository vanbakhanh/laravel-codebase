<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

/**
 * Class Video.
 *
 * @package namespace App\Models;
 */
class Video extends File
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * Get the direct link of s3
     */
    public function getDataAttribute()
    {
        return json_decode($this->attributes['data'], true);
    }
}

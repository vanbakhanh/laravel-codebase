<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * Class Image.
 *
 * @package namespace App\Models;
 */
class Image extends File
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

    /**
     * Get the direct link of s3 for thumbnail
     */
    public function getThumbnailUrlAttribute()
    {
        if (!empty($this->data) && !empty($this->data['thumbnail'])) {
            return Storage::disk('s3')->temporaryUrl(
                $this->data['thumbnail']['path'], now()->addSeconds(config('constants.expire_link_duration'))
            );
        }
        return null;
    }

    /**
     * Get the direct link of s3 for mobile
     */
    public function getMobileUrlAttribute()
    {
        if (!empty($this->data) && !empty($this->data['mobile'])) {
            return Storage::disk('s3')->temporaryUrl(
                $this->data['mobile']['path'], now()->addSeconds(config('constants.expire_link_duration'))
            );
        }
        return null;
    }
}

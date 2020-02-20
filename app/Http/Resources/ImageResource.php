<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'path' => $this->path,
            'extension' => $this->extension,
            'mime' => $this->mime,
            'processed' => $this->processed,
            'url' => $this->url,
            'origin_url' => $this->url,
            'thumbnail_url' => $this->thumbnail_url,
            'mobile_url' => $this->mobile_url,
        ];
    }
}

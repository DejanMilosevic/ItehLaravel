<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'review';

    public function toArray($request)
    {
        return [
            'user' => $this->resource->user,
            'application' => $this->resource->application,
            'rating' => $this->resource->rating,
            'comment' => $this->resource->comment
        ];
    }
}

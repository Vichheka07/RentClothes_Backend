<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'images' => ImagesResource::collection($this->getMedia('images')),
            'title'   => $this->title,
            'describe' => $this->describe,
            'price' => $this->price,
            'orgprice' => $this->orgprice,
            'day' => $this->day,
            'category' => $this->category,
            'codition' => $this->codition,
            'size' => $this-> size,
            'delivery' => $this->delivery,
            'user_id' => $this->user_id
        ];

    }
}

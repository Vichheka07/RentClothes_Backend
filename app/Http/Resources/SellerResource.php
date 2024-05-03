<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            'price' => $this->price,
            'day' => $this->day,
            'size' => $this-> size,
            'delivery' => $this->delivery,
            'orderdate' => $this->orderdate,
        ];

    }
}

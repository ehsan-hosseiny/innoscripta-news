<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {

        return [
            'id'=>$this->id,
            'reference'=>$this->reference,
            'title'=>$this->title,
            'category'=>$this->category,
            'author'=>$this->author,
            'image'=>$this->image
        ];
    }
}

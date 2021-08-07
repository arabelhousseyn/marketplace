<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ListingResource;
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_fr' => $this->title_fr,
            'title_en' => $this->title_en,
            'icon' => $this->icon,
            'listings' => ListingResource::collection($this->listings)
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ListingResource;
class UserResource extends JsonResource
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
            'fname' => $this->fname,
            'lname' => $this->lname,
            'username' => $this->username,
            'email' => $this->email,
            'online' => $this->online,
            'statu' => $this->statu,
            'listings' => ListingResource::collection($this->listings),
            'listings_count' => $this->listings_count
        ];
    }
}

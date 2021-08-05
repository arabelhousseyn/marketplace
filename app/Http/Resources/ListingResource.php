<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Geocoder\Facades\Geocoder;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public function toArray($request)
    {
        $client = new \GuzzleHttp\Client();
       $geocoder = new \Spatie\Geocoder\Geocoder($client);
       $geocoder->setApiKey(config('geocoder.key'));
        return [
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'images' => $this->images,
            'location' => $geocoder->getAddressForCoordinates(doubleval(explode(',',$this->location)[0]),
            doubleval(explode(',',$this->location)[1])),
            'created_at' => $this->created_at,
        ];
    }
}

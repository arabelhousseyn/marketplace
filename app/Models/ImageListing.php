<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageListing extends Model
{
    use HasFactory;
    protected $table = 'image_listing';
    protected $fillable = ['image_id','listing_id'];

}

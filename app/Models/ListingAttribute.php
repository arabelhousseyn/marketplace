<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingAttribute extends Model
{
    use HasFactory;
    protected $fillable = ['attribute','value','listing_id'];
    protected $hidden = ['id','listing_id'];
}

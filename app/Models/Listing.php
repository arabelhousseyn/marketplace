<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListingAttribute;
use App\Models\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
class Listing extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','price','description','location','available'];
    protected $hidden = ['id','created_at','updated_at','deleted_at'];


    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function attributes()
    {
        return $this->hasMany(ListingAttribute::class,'listing_id');
    }
}

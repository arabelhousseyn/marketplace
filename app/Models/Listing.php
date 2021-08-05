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
    protected $fillable = ['title','price','description','location','available','category_id'];
    protected $hidden = ['id','updated_at','deleted_at','category_id','available'];


    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function attributes()
    {
        return $this->hasMany(ListingAttribute::class);
    }
}

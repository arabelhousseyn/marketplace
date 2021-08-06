<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListingAttribute;
use App\Models\Image;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
class Listing extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','price','description','location','available','category_id','user_id'];
    protected $hidden = ['updated_at','deleted_at','category_id','available'];

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function attributes()
    {
        return $this->hasMany(ListingAttribute::class);
    }

    public function scopeAvailableAndArrang($builder,$available,$order)
    {
        return $builder->where('available',$available)->orderBy('id',$order);
    }
}

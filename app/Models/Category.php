<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = ['name_fr','name_ar','name_en','icon'];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}

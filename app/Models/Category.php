<?php

namespace App\Models;

use App\Models\Brand;
use App\Enum\CommonStatus;
use App\Lib\Resource\Image;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_by',      
        'brand_id',
        'description_en',
        'image',
        'status'
    ];
    protected $casts = [
        'status' => CommonStatus::class
    ];
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function subcategory() {
        return $this->hasMany(Subcategory::class);
    }
    public function products() {
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function getImageAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
}

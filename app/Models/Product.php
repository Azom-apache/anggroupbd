<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Category;
use App\Enum\ProductStatus;
use App\Lib\Resource\Image;
use App\Models\Subcategory;
use App\Traits\DeletesImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, DeletesImage,Notifiable;
    protected $fillable = [
        'name_en',
        'name_bn',
        'category_id',
        'subcategory_id',
        'brand_id',
        'unit_id',
        'short_text',
        'buy_price',
        'sale_price',
        'alert_quantity',
        'discount_type',
        'discount_price',
        'min_purchase_quantity',
        'stock_quantity',
        'point',
        'code',
        'description_en',
        'description_bn',
        'image',
        'created_by',
        'status',
        'sister_id'
    ];
    protected $casts = [
        'status' => ProductStatus::class, 
           
    ];


    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function subcategory() {
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function unit() {
        return $this->belongsTo(Unit::class);
    }
    public function productImages() {
        return $this->hasMany(ProductImage::class);
    }
    public function attribute() {
        return $this->hasMany(ProductAttribute::class);
    }
    
    public function getImageAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
}

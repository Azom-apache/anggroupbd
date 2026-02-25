<?php

namespace App\Models;

use App\Models\Admin;
use App\Lib\Resource\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_name',
        'vendor_id',
        'image',
        'trade_licence',
        'status',
        
    ];
    public function admin() {
        return $this->hasOne(Admin::class,'id','admin_id');
    }
    public function getImageAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
}

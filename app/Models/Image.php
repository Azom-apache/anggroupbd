<?php

namespace App\Models;

use App\Casts\ImageField;
use App\Enum\CommonStatus;
use App\Traits\DeletesImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
   
    use DeletesImage, HasFactory;
    protected $guarded = [];
   
    protected $casts = [
        'status' => CommonStatus::class,
     
       
    ];
    public function getImageAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
    
}

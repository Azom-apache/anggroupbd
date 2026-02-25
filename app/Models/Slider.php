<?php

namespace App\Models;


use App\Lib\Resource\Image;
use App\Casts\ImageField;
use App\Enum\CommonStatus;
use App\Traits\DeletesImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory, DeletesImage,Notifiable;
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];
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

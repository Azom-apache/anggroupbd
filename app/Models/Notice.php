<?php

namespace App\Models;

use App\Lib\Resource\Image;
use App\Traits\DeletesImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory, DeletesImage;
    protected $fillable = [
        'notice',
        'designation',
        'description',
        'image',
        'status'
    ];
    public function getImageAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
}

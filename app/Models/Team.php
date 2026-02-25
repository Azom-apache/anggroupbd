<?php

namespace App\Models;

use App\Enum\CommonStatus;
use App\Lib\Resource\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'designation',
        'description',
        'fb_link' ,
        'linking_link',
        'instagram_link',
        'image',
        'status',
    ];
    protected $casts = [
        'status' => CommonStatus::class
    ];
    public function getImageAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
}

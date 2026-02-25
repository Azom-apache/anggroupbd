<?php

namespace App\Models;

use App\Enum\CommonStatus;
use App\Lib\Resource\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_by',
        'designation',
        'description',
        'image',
        'pdf',
        'status'
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
    public function getPdfAttribute($model){

        if (isset($model)){
            return Image::url($model);
        }else{
            return asset('images/avatar.png');
        }
    }
}

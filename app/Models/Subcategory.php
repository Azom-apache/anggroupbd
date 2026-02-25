<?php

namespace App\Models;

use App\Models\Product;
use App\Enum\CommonStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'created_by',
        'status'
    ];
    public function products() {
        return $this->hasMany(Product::class,'subcategory_id','id');
    }
    protected $casts = [
        'status' => CommonStatus::class
    ];
}

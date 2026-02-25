<?php

namespace App\Models;

use App\Enum\CommonStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_by',
        'status'
    ];
    protected $casts = [
        'status' => CommonStatus::class
    ];
}

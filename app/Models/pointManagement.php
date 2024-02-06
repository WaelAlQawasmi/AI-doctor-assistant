<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pointManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'points',
        'point_type'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloatingImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'floatingimage';
}

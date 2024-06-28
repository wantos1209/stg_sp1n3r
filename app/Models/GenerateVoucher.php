<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateVoucher extends Model
{
    use HasFactory;

    protected $table = 'spinner_generatevoucher';
    protected $guarded = [];
}

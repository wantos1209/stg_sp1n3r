<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlSpin extends Model
{
    use HasFactory;

    protected $table = 'url_spin';
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'website';

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search'])) {
            return $query->where('nama', 'like', '%' . $filters['search'] .  '%');
        }
    }
}

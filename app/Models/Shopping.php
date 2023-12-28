<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'shopping_list_user', 'shopping_list_id', 'user_id')->withTimestamps();
    
    }
}

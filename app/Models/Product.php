<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function shoppingLists()
    {
    return $this->belongsToMany(ShoppingList::class, 'list_product')->withPivot('quantity', 'user_id');
    }
}
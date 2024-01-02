<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\QuantityResource;

class Shopping extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function quantities()
    {
        return QuantityResource::collection(DB::table('product_shopping')->where('shopping_id', $this->id)->get());
    }
}

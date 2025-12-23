<?php
namespace App\Models;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['category_id', 'name', 'price', 'stock', 'description', 'image'];

    public function category(){
        return $this->belongsTo(Category::class);

    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }   
    public function avgRating(){
        return $this->reviews()->avg('rating');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
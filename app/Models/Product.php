<?php
namespace App\Models;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [ 
    'admin_id',
    'name',
    'price',
    'stock',
    'category_id',
    'description',
    'image',];

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
    public function articles(){
        return $this->belongsToMany(Article::class);
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
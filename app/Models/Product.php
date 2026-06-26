<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order;

class Product extends Model
{
    protected $fillable=['name','image','price','description','category_id','stock'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders()
{
    return $this->belongsToMany(Order::class)
                ->withPivot('quantity','price')
                ->withTimestamps();
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    protected $fillable = [
        'customer_name','customer_phone','customer_address','status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity','price')
                    ->withTimestamps();
    }
}

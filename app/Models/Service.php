<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceOrder;


class Service extends Model
{
    protected $fillable=['name','description','details','image'];

   public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class ServiceOrder extends Model
{

    protected $fillable=['service_id','customer_name','customer_phone','customer_address','status'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

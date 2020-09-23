<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderIten extends Model
{
    protected $table = 'order_item';
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

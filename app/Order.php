<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public function orderItem()
    {
        return $this->hasMany(OrderIten::class);
    }
}

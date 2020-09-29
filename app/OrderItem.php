<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use UuidTraits;
    protected $table = 'order_item';
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

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
    public function items()
    {
        return $this->hasOne(Items::class,'id','item_id');
    }
}

<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UuidTraits;
    protected $table = 'order';
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}

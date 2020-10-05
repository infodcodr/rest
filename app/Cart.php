<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use UuidTraits;
    protected $fillable = ['table_id','branch_id','item_id','qty','amount'];

    public function table()
    {
        return $this->hasMany(Table::class);
    }
    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
    public function items()
    {
        return $this->hasOne(Items::class,'id','item_id');
    }
}

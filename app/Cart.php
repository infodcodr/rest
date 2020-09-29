<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use UuidTraits;
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
        return $this->hasMany(items::class);
    }
}

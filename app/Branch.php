<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use UuidTraits;
    protected $table = 'branch';
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function table()
    {
        return $this->hasMany(Table::class);
    }
    public function menu()
    {
        return $this->hasMany(Menu::class)->with('items');
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

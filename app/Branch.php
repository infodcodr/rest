<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
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

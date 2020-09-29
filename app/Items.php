<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function submenu()
    {
        return $this->belongsTo(SubMenu::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

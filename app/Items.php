<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use UuidTraits;
    public function submenu()
    {
        return $this->belongsTo(SubMenu::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

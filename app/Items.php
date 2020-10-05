<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use UuidTraits;
     protected $fillable = [ 'uuid', 'name', 'branch_id', 'menu_id', 'title', 'description', 'amount', 'is_veg', 'is_active'];
    public function submenu()
    {
        return $this->belongsTo(SubMenu::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use UuidTraits;
     protected $fillable = [ 'uuid', 'name', 'branch_id', 'menu_id', 'title', 'description', 'amount', 'is_veg', 'is_active'];

    protected $casts = [
        'is_veg' => 'integer',
        'branch_id' => 'integer',
        'menu_id' => 'integer',
        'is_active' => 'integer',
    ];

    public function submenu()
    {
        return $this->belongsTo(SubMenu::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class,'image_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['branch_id','description','is_active','name','title'];
    public function submenu()
    {
        return $this->hasMany(SubMenu::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function items()
    {
        return $this->hasMany(Items::class);
    }

    public function childMenu()
    {
        return Menu::where('parent_id',$this->id)->get();
    }

    public function parentMenu()
    {
        return Menu::where('id',$this->parent_id)->first();
    }
}

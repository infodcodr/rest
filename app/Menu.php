<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use UuidTraits;
    protected $table = 'menu';
    protected $fillable = ['branch_id','description','is_active','name','title'];

     protected $casts = [
        'restaurant_id' => 'integer',
        'branch_id' => 'integer',
        'parent_id' => 'integer',
        'is_active' => 'integer',
    ];
    public function submenu()
    {
        return $this->hasMany(SubMenu::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class,'image_id','id');
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
    public function category()
    {
        return $this->belongsToMany(Category::class,'category_menu');
    }
}

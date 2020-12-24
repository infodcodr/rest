<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UuidTraits;
    protected $table = 'categories';
    protected $fillable = [ 'uuid', 'name', 'is_active'];

     protected $casts = [
        'restaurant_id' => 'integer',
        'branch_id' => 'integer',

        'is_active' => 'integer',
    ];

    public function menu()
    {
        return $this->belongsToMany(Menu::class,'category_menu');
    }
}

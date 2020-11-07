<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use UuidTraits;
    protected $table = 'branch';
      protected $fillable = ['uuid', 'restaurant_id', 'branch_name', 'contact_name', 'contact_email', 'contact_no', 'phone', 'email', 'address', 'city', 'state', 'is_active', 'is_suspended'];

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
        return $this->hasMany(Menu::class)->with('items','items.images');
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

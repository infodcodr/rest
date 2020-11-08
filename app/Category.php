<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UuidTraits;
    protected $table = 'categories';
    protected $fillable = [ 'uuid', 'name', 'is_active'];

    public function menu()
    {
        return $this->hasManyThrough(CategoryMenu::class);
    }
}

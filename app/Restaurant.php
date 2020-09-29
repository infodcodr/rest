<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use UuidTraits;
    protected $table = 'restaurant';

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

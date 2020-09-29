<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
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

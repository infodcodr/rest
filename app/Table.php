<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'table';

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}

<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use UuidTraits;
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

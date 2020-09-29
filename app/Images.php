<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use UuidTraits;

    public function parent()
    {
        return $this->morphTo('image','image','image_id');
    }
}

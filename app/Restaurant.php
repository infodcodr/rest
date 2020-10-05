<?php

namespace App;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use UuidTraits;
    protected $table = 'restaurant';
    protected $fillable = ['uuid', 'name', 'contact_name', 'contact_email', 'contact_no', 'phone', 'email', 'address', 'city', 'state', 'pincode', 'is_active', 'is_suspended'];

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}

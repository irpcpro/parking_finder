<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location', // Assuming 'location' is the polygon field
    ];

    // Accessor for latitude
//    public function getLatAttribute()
//    {
//        return $this->location ? $this->location->get() : null;
//    }
//
//    // Accessor for longitude
//    public function getLongAttribute()
//    {
//        return $this->location ? $this->location->getY() : null;
//    }


    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LocationInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'title',
        'description',
    ];

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

}

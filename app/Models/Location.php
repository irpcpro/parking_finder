<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location', // Assuming 'location' is the polygon field
    ];


    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserLoginLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_ip',
        'login_timestamp',
    ];

    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }

}

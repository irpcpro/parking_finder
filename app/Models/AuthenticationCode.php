<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AuthenticationCode extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'expired',
    ];

    public function scopeNotExpired(Builder $query): void
    {
        $query->where('expired', false);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    use HasFactory;
}

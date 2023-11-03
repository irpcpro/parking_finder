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
        'location',
    ];

    protected $appends = [
        'lat',
        'long'
    ];

    protected $geometry = ['location'];

    protected $geometryAsText = true;

    public function newQuery(bool $excludeDeleted = true): \Illuminate\Database\Eloquent\Builder
    {
        if (!empty($this->geometry) && $this->geometryAsText === true) {
            $raw = '';
            foreach ($this->geometry as $column) {
                $raw .= "CONCAT('POINT(', ST_X(`" . $this->table . "`.`" . $column . "`), ', ', ST_Y(`" . $this->table . "`.`" . $column . "`), ')') as `" . $column . "`, ";
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }
        return parent::newQuery($excludeDeleted);
    }


    public function getLatAttribute(): string | null
    {
        $location = (gettype($this->location) != "string")? $this->location->getValue(DB::getQueryGrammar()) : $this->location;
        $getLat = getLatLongFromPoint($location);
        if(!empty($getLat))
            return $getLat[1];
        return null;
    }

    public function getLongAttribute(): string | null
    {
        $location = (gettype($this->location) != "string")? $this->location->getValue(DB::getQueryGrammar()) : $this->location;
        $getLat = getLatLongFromPoint($location);
        if(!empty($getLat))
            return $getLat[2];
        return null;
    }


    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }

}

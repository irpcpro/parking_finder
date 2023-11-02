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

    /**
     * Select geometrical attributes as text from database.
     * @var bool
     */
    protected $geometryAsText = true;

    /**
     * Get a new query builder for the model's table.
     * Manipulate in case we need to convert geometrical fields to text.
     *
     * @param bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery(bool $excludeDeleted = true): \Illuminate\Database\Eloquent\Builder
    {
        if (!empty($this->geometry) && $this->geometryAsText === true)
        {
            $raw = '';
            foreach ($this->geometry as $column)
            {
                $raw .= 'AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }
        return parent::newQuery($excludeDeleted);
    }


    public function getLatAttribute(): string | null
    {
        $location = $this->location->getValue(DB::getQueryGrammar());
        $getLat = getLatLongFromPoint($location);
        if(!empty($getLat))
            return $getLat[1];
        return null;
    }

    public function getLongAttribute(): string | null
    {
        $location = $this->location->getValue(DB::getQueryGrammar());
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

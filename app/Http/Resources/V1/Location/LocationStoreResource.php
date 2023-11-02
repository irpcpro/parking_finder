<?php

namespace App\Http\Resources\V1\Location;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationStoreResource extends JsonResource
{
    public function __construct(Location $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'lat' => $this->lat,
            'long' => $this->long
        ];
    }
}

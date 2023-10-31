<?php

namespace App\Http\Controllers\API\V1\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\LocationStoreRequest;
use App\Http\Resources\V1\Location\LocationStoreResource;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class LocationController extends Controller
{

    // save location
    public function store(LocationStoreRequest $request)
    {
        // get the current user
        $current_user = auth()->user();

        // insert data
        $location = Location::create([
            'location' => DB::raw("Point('$request->lat', '$request->long')"),
            'user_id' => $current_user->id,
        ]);


        $data = new LocationStoreResource($location);
        $data = $data->toArray($request);

        // send response
        $response = APIResponse(Lang::get('msg.location.store.success'), 200, true);
        $response = $response->setData($data);
        $response->send();
    }

}

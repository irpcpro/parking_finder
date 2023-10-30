<?php

namespace App\Http\Controllers\API\V1\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\LocationStoreRequest;
use App\Models\Location;

class LocationController extends Controller
{

    // save location
    public function store(LocationStoreRequest $request)
    {
        // get the current user
        $current_user = auth()->user();

        // insert data
        $location = Location::create([
            'coordinate' => DB::raw("POINT($request->lat, $request->long)"),
            'user_id' => $current_user->id_user,
        ]);


//        $data = new LocationStoreResource($final_attachment);
//        $data = $data->toArray($request);

        // send response
//        $response = APIResponse('لوکیشن ثبت شد', 200, true);
//        $response = $response->setData($data);
//        $response->send();
    }

}

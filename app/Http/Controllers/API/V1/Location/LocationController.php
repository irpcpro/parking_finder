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

        DB::beginTransaction();
        try {

            // insert data
            $location = Location::create([
                'location' => DB::raw("POINT($request->lat, $request->long)"),
                'user_id' => $current_user->id,
            ])->locationinfo()->create([
                'title' => $request->title,
                'description' => $request->description,
            ]);


            $data = new LocationStoreResource($location);
            $data = $data->toArray($request);

            DB::commit();

            // send response
            $response = APIResponse(Lang::get('msg.location.store.success'), 200, true);
            $response = $response->setData($data);
            $response->send();
        } catch (\Exception $exception){
            DB::rollBack();
            // send response
            $response = APIResponse(Lang::get('msg.request.error_crash'), 500, false);
            $response->send();
        }
    }

}

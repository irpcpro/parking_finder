<?php

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $location = Location::create([
        'location' => DB::raw("Point('35.00074', '51.00035')"),
        'user_id' => 1,
    ]);
    dd($location->lat);
    dd(getLatLongFromPoint($location->location));



    dd(



    );

    return view('welcome');
});

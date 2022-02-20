<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::all();
        return response($locations)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!Location::find($request['id'])) {
            return response(array(
                "error" => "Location Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $location = Location::find($request['id']);
        return response($location)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!Location::find($request['id'])) {
            return response(array(
                "error" => "Location Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $location = Location::find($request['id']);
        $location->label = $request['label'];
        $location->save();

        $location = Location::all();

        return response($location, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $location = new Location();
        $location->label = $request['label'];
        $location->save();

        $locations = Location::all();

        return response($locations, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!Location::find($request['id'])) {
            return response(array(
                "error" => "Location Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        Location::find($request['id'])->delete();

        $locations = Location::all();
        return response($locations, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        Location::whereIn('id', $request['ids'])->delete();

        $locations = Location::all();
        return response($locations, 202)->header('Content-Type', 'application/json');
    }
}

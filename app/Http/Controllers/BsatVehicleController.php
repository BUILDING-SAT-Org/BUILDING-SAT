<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatVehicle;

class BsatVehicleController extends Controller
{

    public function index(Request $request)
    {
        $bsatVehicles = BsatVehicle::all();
        return response($bsatVehicles)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatVehicle::where("id", $request['id'])) {
            return response(array(
                "error" => "Vehicle Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatVehicle = BsatVehicle::where("id", $request['id'])->first();
        return response($bsatVehicle)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatVehicle::where("id", $request['id'])) {
            return response(array(
                "error" => "Vehicle Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatVehicle = BsatVehicle::where("id", $request['id'])->first();
        $bsatVehicle->countries = $request['countries'];
        $bsatVehicle->label = $request['label'];
        $bsatVehicle->year = $request['year'];
        $bsatVehicle->standard = $request['standard'];
        $bsatVehicle->data_source = $request['data_source'];
        $bsatVehicle->loading_capacity = $request['loading_capacity'];
        $bsatVehicle->technical_specification = $request['technical_specification'];
        $bsatVehicle->gwp = $request['gwp'];
        $bsatVehicle->unit = $request['unit'];
        $bsatVehicle->save();

        $bsatVehicles = BsatVehicle::all();

        return response($bsatVehicles, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatVehicle = new BsatVehicle();
        $bsatVehicle->countries = $request['countries'];
        $bsatVehicle->label = $request['label'];
        $bsatVehicle->year = $request['year'];
        $bsatVehicle->standard = $request['standard'];
        $bsatVehicle->data_source = $request['data_source'];
        $bsatVehicle->loading_capacity = $request['loading_capacity'];
        $bsatVehicle->technical_specification = $request['technical_specification'];
        $bsatVehicle->gwp = $request['gwp'];
        $bsatVehicle->unit = $request['unit'];
        $bsatVehicle->save();

        $bsatVehicles = BsatVehicle::all();

        return response($bsatVehicles, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatVehicle::where("id", $request['id'])) {
            return response(array(
                "error" => "Vehicle Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatVehicle::where("id", $request['id'])->delete();

        $bsatVehicles = BsatVehicle::all();
        return response($bsatVehicles, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatVehicle::whereIn('id', $request['ids'])->delete();

        $bsatVehicles = BsatVehicle::all();
        return response($bsatVehicles, 202)->header('Content-Type', 'application/json');
    }

}

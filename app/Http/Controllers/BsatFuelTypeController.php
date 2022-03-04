<?php

namespace App\Http\Controllers;

use App\Models\BsatFuelType;
use Illuminate\Http\Request;

class BsatFuelTypeController extends Controller
{
    public function index(Request $request)
    {
        $bsatFuelTypes = BsatFuelType::all();
        return response($bsatFuelTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatFuelType::where("id", $request['id'])) {
            return response(array(
                "error" => "Fuel Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatFuelType = BsatFuelType::where("id", $request['id'])->first();
        return response($bsatFuelType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatFuelType::where("id", $request['id'])) {
            return response(array(
                "error" => "Fuel Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatFuelType = BsatFuelType::where("id", $request['id'])->first();
        $bsatFuelType->countries = $request['countries'];
        $bsatFuelType->label = $request['label'];
        $bsatFuelType->year = $request['year'];
        $bsatFuelType->standard = $request['standard'];
        $bsatFuelType->data_source = $request['data_source'];
        $bsatFuelType->technical_specification = $request['technical_specification'];
        $bsatFuelType->gwp = $request['gwp'];
        $bsatFuelType->unit = $request['unit'];
        $bsatFuelType->save();

        $bsatFuelTypes = BsatFuelType::all();

        return response($bsatFuelTypes, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatFuelType = new BsatFuelType();
        $bsatFuelType->countries = $request['countries'];
        $bsatFuelType->label = $request['label'];
        $bsatFuelType->year = $request['year'];
        $bsatFuelType->standard = $request['standard'];
        $bsatFuelType->data_source = $request['data_source'];
        $bsatFuelType->technical_specification = $request['technical_specification'];
        $bsatFuelType->gwp = $request['gwp'];
        $bsatFuelType->unit = $request['unit'];
        $bsatFuelType->save();

        $bsatFuelTypes = BsatFuelType::all();

        return response($bsatFuelTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatFuelType::where("id", $request['id'])) {
            return response(array(
                "error" => "Fuel Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatFuelType::where("id", $request['id'])->delete();

        $bsatFuelTypes = BsatFuelType::all();
        return response($bsatFuelTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatFuelType::whereIn('id', $request['ids'])->delete();

        $bsatFuelTypes = BsatFuelType::all();
        return response($bsatFuelTypes, 202)->header('Content-Type', 'application/json');
    }
}

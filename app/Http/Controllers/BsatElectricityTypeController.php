<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatElectricityType;

class BsatElectricityTypeController extends Controller
{

    public function index(Request $request)
    {
        $bsatElectricityTypes = BsatElectricityType::all();
        return response($bsatElectricityTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatElectricityType::where("id", $request['id'])) {
            return response(array(
                "error" => "Electricity Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatElectricityType = BsatElectricityType::where("id", $request['id'])->first();
        return response($bsatElectricityType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatElectricityType::where("id", $request['id'])) {
            return response(array(
                "error" => "Electricity Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatElectricityType = BsatElectricityType::where("id", $request['id'])->first();
        $bsatElectricityType->countries = $request['countries'];
        $bsatElectricityType->label = $request['label'];
        $bsatElectricityType->year = $request['year'];
        $bsatElectricityType->standard = $request['standard'];
        $bsatElectricityType->data_source = $request['data_source'];
        $bsatElectricityType->technical_specification = $request['technical_specification'];
        $bsatElectricityType->gwp = $request['gwp'];
        $bsatElectricityType->unit = $request['unit'];
        $bsatElectricityType->save();

        $bsatElectricityTypes = BsatElectricityType::all();

        return response($bsatElectricityTypes, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatElectricityType = new BsatElectricityType();
        $bsatElectricityType->countries = $request['countries'];
        $bsatElectricityType->label = $request['label'];
        $bsatElectricityType->year = $request['year'];
        $bsatElectricityType->standard = $request['standard'];
        $bsatElectricityType->data_source = $request['data_source'];
        $bsatElectricityType->technical_specification = $request['technical_specification'];
        $bsatElectricityType->gwp = $request['gwp'];
        $bsatElectricityType->unit = $request['unit'];
        $bsatElectricityType->save();

        $bsatElectricityTypes = BsatElectricityType::all();

        return response($bsatElectricityTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatElectricityType::where("id", $request['id'])) {
            return response(array(
                "error" => "Electricity Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatElectricityType::where("id", $request['id'])->delete();

        $bsatElectricityTypes = BsatElectricityType::all();
        return response($bsatElectricityTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatElectricityType::whereIn('id', $request['ids'])->delete();

        $bsatElectricityTypes = BsatElectricityType::all();
        return response($bsatElectricityTypes, 202)->header('Content-Type', 'application/json');
    }
}

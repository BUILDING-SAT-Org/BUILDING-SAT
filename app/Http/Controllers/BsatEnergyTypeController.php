<?php

namespace App\Http\Controllers;

use App\Models\BsatEnergyType;
use Illuminate\Http\Request;

class BsatEnergyTypeController extends Controller
{

    public function index(Request $request)
    {
        $bsatEnergyTypes = BsatEnergyType::all();
        return response($bsatEnergyTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatEnergyType::where("id", $request['id'])) {
            return response(array(
                "error" => "Energy Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatEnergyType = BsatEnergyType::where("id", $request['id'])->first();
        return response($bsatEnergyType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatEnergyType::where("id", $request['id'])) {
            return response(array(
                "error" => "Energy Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatEnergyType = BsatEnergyType::where("id", $request['id'])->first();
        $bsatEnergyType->countries = $request['countries'];
        $bsatEnergyType->label = $request['label'];
        $bsatEnergyType->year = $request['year'];
        $bsatEnergyType->standard = $request['standard'];
        $bsatEnergyType->data_source = $request['data_source'];
        $bsatEnergyType->technical_specification = $request['technical_specification'];
        $bsatEnergyType->gwp = $request['gwp'];
        $bsatEnergyType->unit = $request['unit'];
        $bsatEnergyType->save();

        $bsatEnergyTypes = BsatEnergyType::all();

        return response($bsatEnergyTypes, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatEnergyType = new BsatEnergyType();
        $bsatEnergyType->countries = $request['countries'];
        $bsatEnergyType->label = $request['label'];
        $bsatEnergyType->year = $request['year'];
        $bsatEnergyType->standard = $request['standard'];
        $bsatEnergyType->data_source = $request['data_source'];
        $bsatEnergyType->technical_specification = $request['technical_specification'];
        $bsatEnergyType->gwp = $request['gwp'];
        $bsatEnergyType->unit = $request['unit'];
        $bsatEnergyType->save();

        $bsatEnergyTypes = BsatEnergyType::all();

        return response($bsatEnergyTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatEnergyType::where("id", $request['id'])) {
            return response(array(
                "error" => "Energy Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatEnergyType::where("id", $request['id'])->delete();

        $bsatEnergyTypes = BsatEnergyType::all();
        return response($bsatEnergyTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatEnergyType::whereIn('id', $request['ids'])->delete();

        $bsatEnergyTypes = BsatEnergyType::all();
        return response($bsatEnergyTypes, 202)->header('Content-Type', 'application/json');
    }
}

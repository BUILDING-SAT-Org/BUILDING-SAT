<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatWaterType;

class BsatWaterTypeController extends Controller
{

    public function index(Request $request)
    {
        $bsatWaterTypes = BsatWaterType::all();
        return response($bsatWaterTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatWaterType::where("id", $request['id'])) {
            return response(array(
                "error" => "Water Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatWaterType = BsatWaterType::where("id", $request['id'])->first();
        return response($bsatWaterType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatWaterType::where("id", $request['id'])) {
            return response(array(
                "error" => "Water Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatWaterType = BsatWaterType::where("id", $request['id'])->first();
        $bsatWaterType->countries = $request['countries'];
        $bsatWaterType->label = $request['label'];
        $bsatWaterType->year = $request['year'];
        $bsatWaterType->standard = $request['standard'];
        $bsatWaterType->data_source = $request['data_source'];
        $bsatWaterType->technical_specification = $request['technical_specification'];
        $bsatWaterType->gwp = $request['gwp'];
        $bsatWaterType->unit = $request['unit'];
        $bsatWaterType->save();

        $bsatWaterTypes = BsatWaterType::all();

        return response($bsatWaterTypes, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatWaterType = new BsatWaterType();
        $bsatWaterType->countries = $request['countries'];
        $bsatWaterType->label = $request['label'];
        $bsatWaterType->year = $request['year'];
        $bsatWaterType->standard = $request['standard'];
        $bsatWaterType->data_source = $request['data_source'];
        $bsatWaterType->technical_specification = $request['technical_specification'];
        $bsatWaterType->gwp = $request['gwp'];
        $bsatWaterType->unit = $request['unit'];
        $bsatWaterType->save();

        $bsatWaterTypes = BsatWaterType::all();

        return response($bsatWaterTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatWaterType::where("id", $request['id'])) {
            return response(array(
                "error" => "Water Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatWaterType::where("id", $request['id'])->delete();

        $bsatWaterTypes = BsatWaterType::all();
        return response($bsatWaterTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatWaterType::whereIn('id', $request['ids'])->delete();

        $bsatWaterTypes = BsatWaterType::all();
        return response($bsatWaterTypes, 202)->header('Content-Type', 'application/json');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatWasteType;

class BsatWasteTypeController extends Controller
{
    public function index(Request $request)
    {
        $bsatWasteTypes = BsatWasteType::all();
        return response($bsatWasteTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatWasteType::where("id", $request['id'])) {
            return response(array(
                "error" => "Machine Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatWasteType = BsatWasteType::where("id", $request['id'])->first();
        return response($bsatWasteType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatWasteType::where("id", $request['id'])) {
            return response(array(
                "error" => "Machine Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatWasteType = BsatWasteType::where("id", $request['id'])->first();
        $bsatWasteType->countries = $request['countries'];
        $bsatWasteType->label = $request['label'];
        $bsatWasteType->year = $request['year'];
        $bsatWasteType->standard = $request['standard'];
        $bsatWasteType->data_source = $request['data_source'];
        $bsatWasteType->technical_specification = $request['technical_specification'];
        $bsatWasteType->bulking_density = $request['bulking_density'];
        $bsatWasteType->conversion_unit = $request['conversion_unit'];
        $bsatWasteType->bulking_factor = $request['bulking_factor'];
        $bsatWasteType->gwp = $request['gwp'];
        $bsatWasteType->unit = $request['unit'];
        $bsatWasteType->save();

        $bsatWasteTypes = BsatWasteType::all();

        return response($bsatWasteTypes, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatWasteType = new BsatWasteType();
        $bsatWasteType->countries = $request['countries'];
        $bsatWasteType->label = $request['label'];
        $bsatWasteType->year = $request['year'];
        $bsatWasteType->standard = $request['standard'];
        $bsatWasteType->data_source = $request['data_source'];
        $bsatWasteType->technical_specification = $request['technical_specification'];
        $bsatWasteType->bulking_density = $request['bulking_density'];
        $bsatWasteType->conversion_unit = $request['conversion_unit'];
        $bsatWasteType->bulking_factor = $request['bulking_factor'];
        $bsatWasteType->gwp = $request['gwp'];
        $bsatWasteType->unit = $request['unit'];
        $bsatWasteType->save();

        $bsatWasteTypes = BsatWasteType::all();

        return response($bsatWasteTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatWasteType::where("id", $request['id'])) {
            return response(array(
                "error" => "Machine Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatWasteType::where("id", $request['id'])->delete();

        $bsatWasteTypes = BsatWasteType::all();
        return response($bsatWasteTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatWasteType::whereIn('id', $request['ids'])->delete();

        $bsatWasteTypes = BsatWasteType::all();
        return response($bsatWasteTypes, 202)->header('Content-Type', 'application/json');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BsatMortar;
use Illuminate\Http\Request;

class BsatMortarController extends Controller
{
    public function index(Request $request)
    {
        $bsatMortars = BsatMortar::all();
        return response($bsatMortars)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatMortar::where("id", $request['id'])) {
            return response(array(
                "error" => "Material Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMortar = BsatMortar::where("id", $request['id'])->first();
        return response($bsatMortar)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatMortar::where("id", $request['id'])) {
            return response(array(
                "error" => "Material Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatMortar = BsatMortar::where("id", $request['id'])->first();
        $bsatMortar->label = $request['label'];
        $bsatMortar->mortar_percentage = $request['mortar_percentage'];
        $bsatMortar->sand_bulking_factor = $request['sand_bulking_factor'];
        $bsatMortar->sand_bulking_density = $request['sand_bulking_density'];
        $bsatMortar->cement_bulking_factor = $request['cement_bulking_factor'];
        $bsatMortar->cement_bulking_density = $request['cement_bulking_density'];
        $bsatMortar->wastage = $request['wastage'];
        $bsatMortar->service_life = $request['service_life'];
        $bsatMortar->is_salvage = $request['is_salvage'];
        $bsatMortar->is_replaceable = $request['is_replaceable'];
        $bsatMortar->save();

        $bsatMortars = BsatMortar::all();

        return response($bsatMortars, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $bsatMortar = new BsatMortar();
        $bsatMortar->label = $request['label'];
        $bsatMortar->mortar_percentage = $request['mortar_percentage'];
        $bsatMortar->sand_bulking_factor = $request['sand_bulking_factor'];
        $bsatMortar->sand_bulking_density = $request['sand_bulking_density'];
        $bsatMortar->cement_bulking_factor = $request['cement_bulking_factor'];
        $bsatMortar->cement_bulking_density = $request['cement_bulking_density'];
        $bsatMortar->wastage = $request['wastage'];
        $bsatMortar->service_life = $request['service_life'];
        $bsatMortar->is_salvage = $request['is_salvage'];
        $bsatMortar->is_replaceable = $request['is_replaceable'];
        $bsatMortar->save();

        $bsatMortars = BsatMortar::all();

        return response($bsatMortars, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatMortar::where("id", $request['id'])) {
            return response(array(
                "error" => "Material Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatMortar::where("id", $request['id'])->delete();

        $bsatMortars = BsatMortar::all();
        return response($bsatMortars, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatMortar::whereIn('id', $request['ids'])->delete();

        $bsatMortars = BsatMortar::all();
        return response($bsatMortars, 202)->header('Content-Type', 'application/json');
    }
}

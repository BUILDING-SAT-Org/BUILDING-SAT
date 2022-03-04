<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatBuildingType;

class BuildingTypeController extends Controller
{
    public function index(Request $request)
    {
        $bsatBuildingTypes = BsatBuildingType::all();
        return response($bsatBuildingTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatBuildingType::find($request['id'])) {
            return response(array(
                "error" => "Building Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatBuildingType = BsatBuildingType::find($request['id']);
        return response($bsatBuildingType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatBuildingType::find($request['id'])) {
            return response(array(
                "error" => "Building Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatBuildingType = BsatBuildingType::find($request['id']);
        $bsatBuildingType->name = $request['name'];
        $bsatBuildingType->save();

        $bsatBuildingType = BsatBuildingType::all();

        return response($bsatBuildingType, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $bsatBuildingType = new BsatBuildingType();
        $bsatBuildingType->name = $request['name'];
        $bsatBuildingType->save();

        $bsatBuildingTypes = BsatBuildingType::all();

        return response($bsatBuildingTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatBuildingType::find($request['id'])) {
            return response(array(
                "error" => "Building Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatBuildingType::find($request['id'])->delete();

        $bsatBuildingTypes = BsatBuildingType::all();
        return response($bsatBuildingTypes, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatBuildingType::whereIn('id', $request['ids'])->delete();

        $bsatBuildingTypes = BsatBuildingType::all();
        return response($bsatBuildingTypes, 202)->header('Content-Type', 'application/json');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatBuildingForm;

class BuildingFormController extends Controller
{
    public function index(Request $request)
    {
        $bsatBuildingForm = BsatBuildingForm::all();
        return response($bsatBuildingForm)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatBuildingForm::find($request['id'])) {
            return response(array(
                "error" => "Building Form Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatBuildingForm = BsatBuildingForm::find($request['id']);
        return response($bsatBuildingForm)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatBuildingForm::find($request['id'])) {
            return response(array(
                "error" => "Building Form Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatBuildingForm = BsatBuildingForm::find($request['id']);
        $bsatBuildingForm->name = $request['name'];
        $bsatBuildingForm->save();

        $bsatBuildingForm = BsatBuildingForm::all();

        return response($bsatBuildingForm, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $bsatBuildingForm = new BsatBuildingForm();
        $bsatBuildingForm->name = $request['name'];
        $bsatBuildingForm->save();

        $bsatBuildingForm = BsatBuildingForm::all();

        return response($bsatBuildingForm, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatBuildingForm::find($request['id'])) {
            return response(array(
                "error" => "Building Form Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatBuildingForm::find($request['id'])->delete();

        $bsatBuildingForm = BsatBuildingForm::all();
        return response($bsatBuildingForm, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatBuildingForm::whereIn('id', $request['ids'])->delete();

        $bsatBuildingForm = BsatBuildingForm::all();
        return response($bsatBuildingForm, 202)->header('Content-Type', 'application/json');
    }
}

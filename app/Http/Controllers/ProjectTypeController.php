<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatProjectType;

class ProjectTypeController extends Controller
{

    public function index(Request $request)
    {
        $projectsTypes = BsatProjectType::all();
        return response($projectsTypes)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatProjectType::find($request['id'])) {
            return response(array(
                "error" => "Project Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $projectsType = BsatProjectType::find($request['id']);
        return response($projectsType)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatProjectType::find($request['id'])) {
            return response(array(
                "error" => "Project Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatProjectType = BsatProjectType::find($request['id']);
        $bsatProjectType->name = $request['name'];
        $bsatProjectType->save();

        $bsatProjectType = BsatProjectType::all();

        return response($bsatProjectType, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatProjectType = new BsatProjectType();
        $bsatProjectType->name = $request['name'];
        $bsatProjectType->save();

        $bsatProjectType = BsatProjectType::all();

        return response($bsatProjectType, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatProjectType::find($request['id'])) {
            return response(array(
                "error" => "Project Type Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatProjectType::find($request['id'])->delete();

        $bsatProjectType = BsatProjectType::all();
        return response($bsatProjectType, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatProjectType::whereIn('id', $request['ids'])->delete();

        $bsatProjectType = BsatProjectType::all();
        return response($bsatProjectType, 202)->header('Content-Type', 'application/json');
    }


}

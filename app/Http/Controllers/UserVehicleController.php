<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVehicle;
use App\Traits\ProjectTrait;

class UserVehicleController extends Controller
{

    use ProjectTrait;

    public function index(Request $request)
    {
        $userVehicles = $this->GetProjectVehicles($request['project_id']);
        return response()->json($userVehicles, 202);
    }

    public function show(Request $request)
    {
        $userVehicle = $this->GetProjectVehicleByID($request['project_id'], $request['id']);
        return response()->json($userVehicle, 202);
    }

    public function update(Request $request)
    {

        $userVehicle = $this->GetProjectVehicleByID($request['project_id'], $request['id']);

        $userVehicle->project_id = $request['project_id'];
        $userVehicle->countries = $request['countries'];
        $userVehicle->label = $request['label'];
        $userVehicle->year = $request['year'];
        $userVehicle->standard = $request['standard'];
        $userVehicle->data_source = $request['data_source'];
        $userVehicle->loading_capacity = $request['loading_capacity'];
        $userVehicle->technical_specification = $request['technical_specification'];
        $userVehicle->gwp = $request['gwp'];
        $userVehicle->unit = $request['unit'];
        $userVehicle->save();

        $userVehicles = $this->GetProjectVehicles($request['project_id']);
        return response()->json($userVehicles, 202);
    }

    public function store(Request $request)
    {

        $userVehicle = new UserVehicle();
        $userVehicle->project_id = $request['project_id'];
        $userVehicle->countries = $request['countries'];
        $userVehicle->label = $request['label'];
        $userVehicle->year = $request['year'];
        $userVehicle->standard = $request['standard'];
        $userVehicle->data_source = $request['data_source'];
        $userVehicle->loading_capacity = $request['loading_capacity'];
        $userVehicle->technical_specification = $request['technical_specification'];
        $userVehicle->gwp = $request['gwp'];
        $userVehicle->unit = $request['unit'];
        $userVehicle->save();

        $userVehicles = $this->GetProjectVehicles($request['project_id']);
        return response()->json($userVehicles, 202);
    }

    public function destroy(Request $request)
    {
        $userVehicle = $this->GetProjectVehicleByID($request['project_id'], $request['id']);
        $userVehicle->delete();
        $userVehicles = $this->GetProjectVehicles($request['project_id']);
        return response()->json($userVehicles, 202);
    }

    public function destroyBulk(Request $request)
    {
        $userProject = $this->GetProjectByID($request['project_id']);
        $userProject->userVehicles()->whereIn('id', $request['ids'])->delete();
        $userVehicles = $this->GetProjectVehicles($request['project_id']);
        return response()->json($userVehicles, 202);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMachine;
use App\Traits\ProjectTrait;

class UserMachineController extends Controller
{
    use ProjectTrait;

    public function index(Request $request)
    {
        $userMachines = $this->GetProjectMachines($request['project_id']);
        return response()->json($userMachines, 202);
    }

    public function show(Request $request)
    {
        $userMachine = $this->GetProjectMachineByID($request['project_id'], $request['id']);
        return response()->json($userMachine, 202);
    }

    public function update(Request $request)
    {

        $userMachine = $this->GetProjectMachineByID($request['project_id'], $request['id']);

        $userMachine->project_id = $request['project_id'];
        $userMachine->countries = $request['countries'];
        $userMachine->label = $request['label'];
        $userMachine->year = $request['year'];
        $userMachine->standard = $request['standard'];
        $userMachine->data_source = $request['data_source'];
        $userMachine->technical_specification = $request['technical_specification'];
        $userMachine->gwp = $request['gwp'];
        $userMachine->unit = $request['unit'];
        $userMachine->save();

        $userMachines = $this->GetProjectMachines($request['project_id']);
        return response()->json($userMachines, 202);
    }

    public function store(Request $request)
    {

        $userMachine = new UserMachine();
        $userMachine->project_id = $request['project_id'];
        $userMachine->countries = $request['countries'];
        $userMachine->label = $request['label'];
        $userMachine->year = $request['year'];
        $userMachine->standard = $request['standard'];
        $userMachine->data_source = $request['data_source'];
        $userMachine->technical_specification = $request['technical_specification'];
        $userMachine->gwp = $request['gwp'];
        $userMachine->unit = $request['unit'];
        $userMachine->save();

        $userMachines = $this->GetProjectMachines($request['project_id']);
        return response()->json($userMachines, 202);
    }

    public function destroy(Request $request)
    {
        $userMachine = $this->GetProjectMachineByID($request['project_id'], $request['id']);
        $userMachine->delete();
        $userMachines = $this->GetProjectMachines($request['project_id']);
        return response()->json($userMachines, 202);
    }

    public function destroyBulk(Request $request)
    {
        $userProject = $this->GetProjectByID($request['project_id']);
        $userProject->userMachines()->whereIn('id', $request['ids'])->delete();
        $userMachines = $this->GetProjectMachines($request['project_id']);
        return response()->json($userMachines, 202);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Countries;
use App\Models\UserMachine;
use DB;
class ManageResources extends Controller
{
    public function get_resources(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);

            if ($project != null && $project->user_id == $request['user_id']) {
                $request->session()->put('project_id', $project->id);
                return view('pages.manageResources');
            } else {
                return redirect('/dashboard');
            }
        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function get_countries(Request $request)
    {
        try {
            // $project = Projects::find($request['project_id']);
    
            // if ($project != null && $project->user_id == $request['user_id']) {
                // $request->session()->put('project_id', $project->id);
                $countries = Countries::all();
                return response($countries, 200)
                ->header('Content-Type', 'application/json');
            // } else {
                // return redirect('/dashboard');
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_machine(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);

            if ($project != null && $project->user_id == $request['user_id']) {

                $machine = new UserMachine();
                $machine->project_id = $request['project_id'];
                $machine->countries = $request['countries'];
                $machine->label = $request['label'];
                $machine->year = $request['year'];
                $machine->standard = $request['standard'];
                $machine->data_source = $request['data_source'];
                $machine->technical_specification = $request['technical_specification'];
                $machine->gwp = $request['gwp'];
                $machine->units = $request['units'];

                $machine->save();

                $machines = UserMachine::select('key', 'countries', 'label', 'year', 'standard', 'data_source', 'technical_specification', 'gwp', 'units')
                ->get();
            // $machines = $project->machines()->get(); 

                return response($machines, 200)
                ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update_machine(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);

            if ($project != null && $project->user_id == $request['user_id']) {

                $machine = UserMachine::where('key', $request['key'])->first();
                $machine->project_id = $request['project_id'];
                $machine->countries = $request['countries'];
                $machine->label = $request['label'];
                $machine->year = $request['year'];
                $machine->standard = $request['standard'];
                $machine->data_source = $request['data_source'];
                $machine->technical_specification = $request['technical_specification'];
                $machine->gwp = $request['gwp'];
                $machine->units = $request['units'];

                $machine->save();
                $machines = UserMachine::select('key', 'countries', 'label', 'year', 'standard', 'data_source', 'technical_specification', 'gwp', 'units')
                ->get();
            // $machines = $project->machines()->get(); 

                return response($machines, 200)
                ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete_machine(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);

            if ($project != null && $project->user_id == $request['user_id']) {

                UserMachine::where('key', $request['machine_id'])->delete();


                return response(200)
                ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function get_machines(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);

            if ($project != null && $project->user_id == $request['user_id']) {

                $machines = UserMachine::select('key', 'countries', 'label', 'year', 'standard', 'data_source', 'technical_specification', 'gwp', 'units')
                    ->get();
                // $machines = $project->machines()->get(); 

                return response($machines, 200)
                ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function delete_machine_list(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);

            if ($project != null && $project->user_id == $request['user_id']) {

                UserMachine::whereIn('key', $request['data'])->delete();


                return response(200)
                ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\BsatDifficultyLevels;
use App\Models\Locations;
use App\Models\BsatMachines;
use App\Models\BsatVehicles;
use App\Models\BsatDistances;
use App\Models\UserEarthworkEntry;
use DB;

class EarthWorksController extends Controller
{

    public function get_earthworks(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);
    
            if ($project != null && $project->user_id == $request['user_id']) {
                $request->session()->put('project_id', $project->id);
                return view('pages.earthWorks');
            } else {
                return redirect('/dashboard');
            }
        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function get_difficulty_levels(Request $request)
    {
        try {

            $site_clearence = BsatDifficultyLevels::where('bsat_subphase_id',1)->get();
            $soil_excavation = BsatDifficultyLevels::where('bsat_subphase_id',2)->get();

            $difficulty_levels_data = array(
                'site_clearence' => $site_clearence,
                'soil_excavation' => $soil_excavation
            );
            return response($difficulty_levels_data, 200)
            ->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function get_difficulty_level_site_clearence(Request $request)
    {
        try {

            $site_clearence = BsatDifficultyLevels::where('bsat_subphase_id',1)->get();

            return response($site_clearence, 200)
            ->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function get_resources(Request $request)
    {
        // try {

            $site_clearence_difficulty = BsatDifficultyLevels::where('bsat_subphase_id',1)->get();
            $soil_excavation_difficulty = BsatDifficultyLevels::where('bsat_subphase_id',2)->get();
            $destinations = Locations::all();
            // $machinery = BsatMachines::all();
            $vehicles = BsatVehicles::all();

            $project = Projects::find($request['project_id']);

            $distances = BsatDistances::where('origin_id',$project->location_id)->get();

            $machines = DB::table('bsat_machines')
                    ->select('key as id', 'countries', 'label', 'year', 'standard', 'data_source', 'technical_specification', 'gwp', 'units')
                    ->get()->all();

            $user_machines = DB::table('user_machines')
                    ->select('key as id', 'countries', 'label', 'year', 'standard', 'data_source', 'technical_specification', 'gwp', 'units')
                    ->get()->all();

            $arr =  array(
                "id"=>2,
                "label"=>"Custom",
                "children" => $user_machines
            );

            array_push($machines, $arr);

            $resp = array(
                'site_clearence_difficulty'=>$site_clearence_difficulty,
                'soil_excavation_difficulty'=>$soil_excavation_difficulty,
                'destinations'=>$destinations,
                'machinery'=>$machines,
                'vehicles'=>$vehicles,
                'distances'=>$distances
            );

            return response($resp, 200)
            ->header('Content-Type', 'application/json');
        // } catch (\Throwable $th) {
        //     return redirect('/dashboard');
        // }
    }


    public function save_entries(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);
    
            if ($project != null && $project->user_id == $request['user_id']) {
                // $request->session()->put('project_id', $project->id);

                $new_entries = $request['new_entries'];
                $updated_entries = $request['updated_entries'];

                foreach ($new_entries as $key => $new_entry) {

                    $entry = new UserEarthworkEntry();
                    $entry->project_id = $request['project_id'];
                    $entry->subphase_id = $request["sub_phase"];
                    $entry->quantity = $new_entry["quantity"];
                    $entry->difficulty_level_id = $new_entry["difficulty_level_id"];
                    $entry->machinery_id = $new_entry["machinery_id"];
                    $entry->machine_hours = $new_entry["machine_hours"];
                    $entry->machinery_co2e = $new_entry["machinery_co2e"];
                    $entry->machinery_co2e_label = $new_entry["machinery_co2e_label"];
                    $entry->spoil_transported_outside = $new_entry["spoil_transported_outside"];
                    $entry->total_quantity = $new_entry["total_quantity"];
                    $entry->spoil_transport_vehicle_id = $new_entry["spoil_transport_vehicle_id"];
                    $entry->location_id = $new_entry["location_id"];
                    $entry->other_location = $new_entry["other_location"];
                    $entry->other_location_distance = $new_entry["other_location_distance"];
                    $entry->total_distance = $new_entry["total_distance"];
                    $entry->transport_co2e = $new_entry["transport_co2e"];
                    $entry->transport_co2e_label = $new_entry["transport_co2e_label"];
                    $entry->total_co2e = $new_entry["total_co2e"];
                    $entry->data = $new_entry["data"];

                    $entry->save();

                }

                foreach ($updated_entries as $key => $updated_entry) {

                    $entry = UserEarthworkEntry::find($updated_entry["id"]);
                    $entry->quantity = $updated_entry["quantity"];
                    $entry->difficulty_level_id = $updated_entry["difficulty_level_id"];
                    $entry->machinery_id = $updated_entry["machinery_id"];
                    $entry->machine_hours = $updated_entry["machine_hours"];
                    $entry->machinery_co2e = $updated_entry["machinery_co2e"];
                    $entry->machinery_co2e_label = $updated_entry["machinery_co2e_label"];
                    $entry->spoil_transported_outside = $updated_entry["spoil_transported_outside"];
                    $entry->total_quantity = $updated_entry["total_quantity"];
                    $entry->spoil_transport_vehicle_id = $updated_entry["spoil_transport_vehicle_id"];
                    $entry->location_id = $updated_entry["location_id"];
                    $entry->other_location = $updated_entry["other_location"];
                    $entry->other_location_distance = $updated_entry["other_location_distance"];
                    $entry->total_distance = $updated_entry["total_distance"];
                    $entry->transport_co2e = $updated_entry["transport_co2e"];
                    $entry->transport_co2e_label = $updated_entry["transport_co2e_label"];
                    $entry->total_co2e = $updated_entry["total_co2e"];
                    $entry->data = $updated_entry["data"];

                    $entry->save();

                }

                return response(200)
                ->header('Content-Type', 'application/json');

            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function get_entries(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);
    
            if ($project != null && $project->user_id == $request['user_id']) {

                $entries = UserEarthworkEntry::where('project_id',$request['project_id'])->get();
                return response($entries, 200)

            ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function delete_entry(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);
    
            if ($project != null && $project->user_id == $request['user_id']) {

                UserEarthworkEntry::where('id',$request['entry_id'])->delete();
                return response(200)
                ->header('Content-Type', 'application/json');
            } else {
                return response(401)
                ->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}

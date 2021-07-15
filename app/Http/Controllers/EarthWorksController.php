<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\BsatDifficultyLevels;
use App\Models\Locations;
use App\Models\BsatMachines;
use App\Models\BsatVehicles;

class EarthWorksController extends Controller
{

    public function get_earthworks(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);
    
            if ($project != null && $project->user_id == $request['user_id']) {
                $request->session()->put('project', $project);
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
            $machinery = BsatMachines::all();
            $vehicles = BsatVehicles::all();

            $resp = array(
                'site_clearence_difficulty'=>$site_clearence_difficulty,
                'soil_excavation_difficulty'=>$soil_excavation_difficulty,
                'destinations'=>$destinations,
                'machinery'=>$machinery,
                'vehicles'=>$vehicles,
            );

            return response($resp, 200)
            ->header('Content-Type', 'application/json');
        // } catch (\Throwable $th) {
        //     return redirect('/dashboard');
        // }
    }
}

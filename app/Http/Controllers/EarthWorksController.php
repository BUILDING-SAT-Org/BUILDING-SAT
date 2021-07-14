<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\BsatSubphases;

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
            $site_clearence = BsatSubphases::where('id',1)->get();
$ss=0;


        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

}

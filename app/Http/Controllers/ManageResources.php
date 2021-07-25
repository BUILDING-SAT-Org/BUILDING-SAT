<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Countries;

class ManageResources extends Controller
{
    public function get_resources(Request $request)
    {
        try {
            $project = Projects::find($request['project_id']);
    
            if ($project != null && $project->user_id == $request['user_id']) {
                // $request->session()->put('project_id', $project->id);
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
}

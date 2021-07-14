<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use File;
use Illuminate\Support\Facades\Storage;
use Session;
use Redirect;

class ProjectController extends Controller
{
    public function create_project(Request $request)
    {
        $request->replace($request->all()); 
        $project = new Projects();
        $project->user_id = 1;//$request['id'];
        $project->name = $request['name'];
        $project->location_id = 1;//$request['location'];
        $project->country_id = 1;//$request['country'];
        $project->building_type_id = 1;//$request['building_type'];
        $project->project_type_id = 1;//$request['project_type'];
        $project->building_life_expectancy = $request['building_life_expectancy'];
        $project->building_height = $request['building_height'];
        $project->no_floors = $request['no_floors'];
        $project->floors_above_ground = $request['floors_above_ground'];
        $project->floors_below_ground = $request['floors_below_ground'];
        $project->ground_floor_area = $request['ground_floor_area'];

        $project->building_foot_print = $request['building_foot_print'];
        $project->building_form_id = 1;//$request['building_form'];
        $project->description = $request['description'];

        $project->save();
        $url ="";
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'name' => 'string|max:40',
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);

                if (Storage::disk('local')->exists($project->url)) {
                    Storage::disk('local')->delete($project->url);
                }
                

                $filenamewithextension = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();

                $filenametostore = '/public/user/' . $project->user_id . '/projects/' . $project->id .'/'. $filename . '.' . $extension;

                try {
                    Storage::disk('local')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
                    $url = Storage::disk('local')->url($filenametostore);

                    Projects::where('id', $project->id)->update(['image' => $url]);

                } catch (\Exception $ex) {
                }

                Session::flash('success', "Success!");
                return Redirect::back();
            }
        }

        return response('Success', 200);
    }

    public function get_projects(Request $request)
    {
        $projects = Projects::where('user_id', $request['user_id'])->get();

        return response($projects)
            ->header('Content-Type', 'application/json');
    }

    public function delete_project(Request $request)
    {
        $project = Projects::find($request['project_id']);

        if ($project != null && $project->user_id == $request['user_id']) {
            $project->delete();
            return response('Success', 200);
        } else {
            return response(404);
        }
    }
}

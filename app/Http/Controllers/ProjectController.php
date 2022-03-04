<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use File;
use Illuminate\Support\Facades\Storage;
use Session;
use Redirect;
use Auth;
use App\Traits\ProjectTrait;

class ProjectController extends Controller
{
    use ProjectTrait;

    public function index(Request $request)
    {
        $projects = Auth::user()->projects()->get();
        return response($projects)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        $userProject = $this->GetProjectByID($request['project_id']);
        return response()->json($userProject, 202);
    }

    public function update(Request $request)
    {
        $project = $this->GetProjectByID($request['project_id']);

        $project->name = $request['name'];
        if ($request['location_id'] != "null") {
            $project->location_id = $request['location_id'];
        }
        $project->other_location = $request['other_location'];
        $project->country_id = $request['country_id'];
        $project->building_type_id = $request['building_type_id'];
        $project->project_type_id = $request['project_type_id'];
        $project->building_life_expectancy = $request['building_life_expectancy'];
        $project->building_height = $request['building_height'];
        $project->no_floors = $request['no_floors'];
        $project->floors_above_ground = $request['floors_above_ground'];
        $project->floors_below_ground = $request['floors_below_ground'];
        $project->ground_floor_area = $request['ground_floor_area'];

        $project->building_foot_print = $request['building_foot_print'];
        $project->building_form_id = $request['building_form_id'];
        $project->description = $request['description'];
        $project->save();

        if ($files = $request->file('image')) {

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            if (Storage::disk('local')->exists($project->url)) {
                Storage::disk('local')->delete($project->url);
            }

            $filenameWithExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = 'public/user/' . $project->user_id . '/projects/' . $project->id . '/' . $fileName . '.' .
                $extension;

            try {
                Storage::disk('local')->put($fileNameToStore, fopen($request->file('image'), 'r+'), 'public');
                $url = Storage::disk('local')->url($fileNameToStore);

                Project::where('id', $project->id)->update(['image' => $url]);
            } catch (\Exception $ex) {
                return response(array(
                    "error" => "Image upload failed"
                , 500))->header('Content-Type', 'application/json');
            }
        }

        $projects = Auth::user()->projects()->get();
        return response()->json($projects, 202);
    }

    public function store(Request $request)
    {

        $userProjectCount = Auth::user()->projects()->count();

        if (!($userProjectCount < env("MAX_PROJECT_COUNT", 10))) {
            return response(array(
                "error" => "Only a maximum of 10 projects allowed. To add a new project, delete an old project and add new project."
            ), 500)->header('Content-Type', 'application/json');
        }

        $request->replace($request->all());
        $project = new Project();
        $project->user_id = Auth::user()->id;
        $project->name = $request['name'];
        if ($request['location_id'] != "null") {
            $project->location_id = $request['location_id'];
        }
        $project->other_location = $request['other_location'];
        $project->country_id = $request['country_id'];
        $project->building_type_id = $request['building_type_id'];
        $project->project_type_id = $request['project_type_id'];
        $project->building_life_expectancy = $request['building_life_expectancy'];
        $project->building_height = $request['building_height'];
        $project->no_floors = $request['no_floors'];
        $project->floors_above_ground = $request['floors_above_ground'];
        $project->floors_below_ground = $request['floors_below_ground'];
        $project->ground_floor_area = $request['ground_floor_area'];

        $project->building_foot_print = $request['building_foot_print'];
        $project->building_form_id = $request['building_form_id'];
        $project->description = $request['description'];
        $project->save();

        if ($files = $request->file('image')) {

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            if (Storage::disk('local')->exists($project->url)) {
                Storage::disk('local')->delete($project->url);
            }

            $filenameWithExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = 'public/user/' . $project->user_id . '/projects/' . $project->id . '/' . $fileName . '.' .
                $extension;

            try {
                Storage::disk('local')->put($fileNameToStore, fopen($request->file('image'), 'r+'), 'public');
                $url = Storage::disk('local')->url($fileNameToStore);

                Project::where('id', $project->id)->update(['image' => $url]);
            } catch (\Exception $ex) {
                $project->delete();
                return response(array(
                    "error" => "Image upload failed"
                ), 500)->header('Content-Type', 'application/json');
            }
        }

        $projects = Auth::user()->projects()->get();
        return response()->json($projects, 202);
    }

    public function destroy(Request $request)
    {
        $userProject = $this->GetProjectByID($request['project_id']);
        $userProject->delete();

        $userProjects = Auth::user()->projects()->get();
        return response()->json($userProjects, 202);
    }

    public function destroyBulk(Request $request)
    {
        Auth::user()->projects()->whereIn('id', $request['ids'])->delete();

        $userProjects = Auth::user()->projects()->get();
        return response()->json($userProjects, 202);
    }
}

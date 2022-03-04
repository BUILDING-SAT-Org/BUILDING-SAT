<?php

namespace App\Http\Controllers;

use App\Models\ProjectSubPhaseEmission;
use App\Traits\ProjectTrait;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use App\Models\UserEarthworkEntry;
use App\Models\BsatMainPhase;
use App\Models\BsatSubPhase;
use DB;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EarthWorkController extends Controller
{
    use ProjectTrait;
    use UtilTrait;

    public function view(Request $request)
    {
        try {
            $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
            if (null == $userProject) {
                return redirect('/dashboard');
            }

            return view('pages.earthWorks', ['project_id' => $userProject->id, 'project_life' =>
                $userProject->building_life_expectancy,
                'project_name' => $userProject->name]);

        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function index(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }
        $mainPhase = BsatMainPhase::where('slug', 'earth_works')->first();
        $earthworkSubPhases = $mainPhase->subPhases()->get();

        $earthworkEntries = array();

        foreach ($earthworkSubPhases as $key => $subPhase) {
            $entries = $subPhase->earthWorkEntries()->where('project_id', $request['project_id'])->get();
            $earthworkEntries[$subPhase->slug] = $entries;

            $result = $subPhase->emissionResults()->where('project_id', $request['project_id'])->get();
            $earthworkResults[$subPhase->slug] = $result;

        }


        return response()->json($earthworkEntries, 202);
    }

    public function show(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        if (!UserEarthworkEntry::find($request['id'])) {
            return response(array(
                "error" => "Entry Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $entry = UserEarthworkEntry::find($request['id']);
        return response()->json($entry, 202);
    }

    public function showSubPhase(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }
        $main_phase = BsatMainPhase::where('slug', 'earth_works')->first();
        $subPhaseSlug = str_replace("-", "_", strtolower($request['sub_phase_slug']));
        $subPhase = BsatSubPhase::where([
            ["main_phase_id", "=", $main_phase->id],
            ["slug", "=", $subPhaseSlug],
        ])->first();
        if (null == $subPhase) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        $entries = $subPhase->earthWorkEntries()->where('project_id', $request['project_id'])->get();

        return response()->json($entries, 202);
    }

    public function store(Request $request)
    {
        $main_phase = BsatMainPhase::where('slug', 'earth_works')->first();
        $main_phaseId = $main_phase->id;
        $site_clearance = $request['site_clearance'];
        $soil_excavation = $request['soil_excavation'];
        $rock_excavation = $request['rock_excavation'];
        $back_filling = $request['back_filling'];

        $site_clearance_sub_phase_id = BsatSubPhase::where([
            ["main_phase_id", "=", $main_phaseId],
            ["slug", "=", "site_clearance"],
        ])->first()->id;

        $soil_excavation_sub_phase_id = BsatSubPhase::where([
            ["main_phase_id", "=", $main_phaseId],
            ["slug", "=", "soil_excavation"],
        ])->first()->id;

        $rock_excavation_sub_phase_id = BsatSubPhase::where([
            ["main_phase_id", "=", $main_phaseId],
            ["slug", "=", "rock_excavation"],
        ])->first()->id;

        $back_filling_sub_phase_id = BsatSubPhase::where([
            ["main_phase_id", "=", $main_phaseId],
            ["slug", "=", "back_filling"],
        ])->first()->id;

        $this->storeEarthworkEntries($request['project_id'], $main_phase->id, $site_clearance_sub_phase_id,
            $site_clearance, false);
        $this->updateEarthworkEntries($request['project_id'], $main_phase->id, $site_clearance_sub_phase_id, $site_clearance, false);

        $this->storeEarthworkEntries($request['project_id'], $main_phase->id, $soil_excavation_sub_phase_id,
            $soil_excavation, false);
        $this->updateEarthworkEntries($request['project_id'], $main_phase->id, $soil_excavation_sub_phase_id, $soil_excavation, false);

        $this->storeEarthworkEntries($request['project_id'], $main_phase->id, $rock_excavation_sub_phase_id,
            $rock_excavation, false);
        $this->updateEarthworkEntries($request['project_id'], $main_phase->id, $rock_excavation_sub_phase_id, $rock_excavation, false);

        $this->storeEarthworkEntries($request['project_id'], $main_phase->id, $back_filling_sub_phase_id,
            $back_filling, true);

        $this->updateEarthworkEntries($request['project_id'], $main_phase->id, $back_filling_sub_phase_id,
            $back_filling, true);


        $project = $this->GetProjectByID($request['project_id']);

        $userEarthworkEntries = $project->earthWorkEntries()->get();

        $site_clearance_entries = $this->filterCollectionBySubphase($userEarthworkEntries,
            $site_clearance_sub_phase_id)->values()->toArray();
        $soil_excavation_entries = $this->filterCollectionBySubphase($userEarthworkEntries,
            $soil_excavation_sub_phase_id)->values()->toArray();
        $rock_excavation_entries = $this->filterCollectionBySubphase($userEarthworkEntries,
            $rock_excavation_sub_phase_id)->values()->toArray();
        $back_filling_entries = $this->filterCollectionBySubphase($userEarthworkEntries, $back_filling_sub_phase_id)
            ->values()->toArray();

        $resp = array(
            "site_clearance" => $site_clearance_entries,
            "soil_excavation" => $soil_excavation_entries,
            "rock_excavation" => $rock_excavation_entries,
            "back_filling" => $back_filling_entries,
        );

        return response()->json($resp, 202);
    }

    public function storeEarthworkEntries($project_id, $main_phase_id, $sub_phase_id, $data, $is_back_filling)
    {
        $new_entries = $data['new_entries'];
        foreach ($new_entries as $key => $new_entry) {
            $entry = new UserEarthworkEntry();
            $entry->project_id = $project_id;
            $entry->sub_phase_id = $sub_phase_id;
            $entry->quantity = $new_entry["quantity"];
            $entry->machinery_id = $new_entry["machinery_id"];
            $entry->machine_hours = $new_entry["machine_hours"];
            $entry->machinery_co2e = $new_entry["machinery_co2e"];
            $entry->machinery_co2e_label = $new_entry["machinery_co2e_label"];
            $entry->spoil_transported_outside = $new_entry["spoil_transported_outside"];
            $entry->total_quantity = $new_entry["total_quantity"];
            $entry->total_bulking_quantity = $new_entry["total_bulking_quantity"];
            $entry->spoil_transport_vehicle_id = $new_entry["spoil_transport_vehicle_id"];
            $entry->location_id = $new_entry["location_id"];
            $entry->other_location = $new_entry["other_location"];
            $entry->other_location_distance = $new_entry["other_location_distance"];
            $entry->total_distance = $new_entry["total_distance"];
            $entry->transport_co2e = $new_entry["transport_co2e"];
            $entry->transport_co2e_label = $new_entry["transport_co2e_label"];
            $entry->total_co2e = $new_entry["total_co2e"];
            $entry->data = $new_entry["data"];

            if ($is_back_filling) {
                $entry->material_id = $new_entry["material_id"];
                $entry->material_co2e = $new_entry["material_co2e"];
                $entry->wastage = $new_entry["wastage"];
                $entry->is_replaceable = $new_entry["is_replaceable"];
                $entry->is_salvage = $new_entry["is_salvage"];
            } else {
                $entry->difficulty_level_id = $new_entry["difficulty_level_id"];
            }

            $entry->save();
        }

        $site_clearance_emission_result = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $site_clearance_emission_result) {
            $site_clearance_emission_result = new ProjectSubPhaseEmission();
            $site_clearance_emission_result->project_id = $project_id;
            $site_clearance_emission_result->main_phase_id = $main_phase_id;
            $site_clearance_emission_result->sub_phase_id = $sub_phase_id;
        }

        $site_clearance_emission_result->machinery_co2_emission = $data['total_machinery_co2e'];
        $site_clearance_emission_result->material_co2_emission = $data['total_material_co2e'];
        $site_clearance_emission_result->transport_co2_emission = $data['total_transport_co2e'];
        $site_clearance_emission_result->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $site_clearance_emission_result->save();

    }

    public function updateEarthworkEntries($project_id, $main_phase_id, $sub_phase_id, $data, $is_back_filling)
    {
        $updated_entries = $data['updated_entries'];
        foreach ($updated_entries as $key => $updated_entry) {
            if (!UserEarthworkEntry::find($updated_entry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $entry = UserEarthworkEntry::find($updated_entry['id']);
            $entry->quantity = $updated_entry["quantity"];
            $entry->machinery_id = $updated_entry["machinery_id"];
            $entry->machine_hours = $updated_entry["machine_hours"];
            $entry->machinery_co2e = $updated_entry["machinery_co2e"];
            $entry->machinery_co2e_label = $updated_entry["machinery_co2e_label"];
            $entry->spoil_transported_outside = $updated_entry["spoil_transported_outside"];
            $entry->total_quantity = $updated_entry["total_quantity"];
            $entry->total_bulking_quantity = $updated_entry["total_bulking_quantity"];
            $entry->spoil_transport_vehicle_id = $updated_entry["spoil_transport_vehicle_id"];
            $entry->location_id = $updated_entry["location_id"];
            $entry->other_location = $updated_entry["other_location"];
            $entry->other_location_distance = $updated_entry["other_location_distance"];
            $entry->total_distance = $updated_entry["total_distance"];
            $entry->transport_co2e = $updated_entry["transport_co2e"];
            $entry->transport_co2e_label = $updated_entry["transport_co2e_label"];
            $entry->total_co2e = $updated_entry["total_co2e"];
            $entry->data = $updated_entry["data"];

            if ($is_back_filling) {
                $entry->material_id = $updated_entry["material_id"];
                $entry->material_co2e = $updated_entry["material_co2e"];
                $entry->wastage = $updated_entry["wastage"];
                $entry->is_replaceable = $updated_entry["is_replaceable"];
                $entry->is_salvage = $updated_entry["is_salvage"];
            } else {
                $entry->difficulty_level_id = $updated_entry["difficulty_level_id"];
            }

            $site_clearance_emission_result = ProjectSubPhaseEmission::where('project_id', $project_id)
                ->where('main_phase_id', $main_phase_id)
                ->where('sub_phase_id', $sub_phase_id)
                ->first();

            $site_clearance_emission_result->machinery_co2_emission = $data['total_machinery_co2e'];
            $site_clearance_emission_result->material_co2_emission = $data['total_material_co2e'];
            $site_clearance_emission_result->transport_co2_emission = $data['total_transport_co2e'];
            $site_clearance_emission_result->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
            $site_clearance_emission_result->save();

            $entry->save();
        }

    }

    public function destroy(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        if (!UserEarthworkEntry::find($request['id'])) {
            return response(array(
                "error" => "Entry Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $userEarthworkEntry = UserEarthworkEntry::find($request['id']);

        $userEarthworkEntry->delete();
        $entries = $userProject->earthWorkEntries()->get();
        return response()->json($entries, 202);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BsatMainPhase;
use App\Models\BsatSubPhase;
use App\Models\ProjectSubPhaseEmission;
use App\Models\UserMaterialEntry;
use App\Traits\ProjectTrait;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use Auth;
use PharIo\Version\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MaintenanceReplacementController extends Controller
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

            return view('pages.maintenanceAndReplacement', ['project_id' => $userProject->id, 'building_service_life' =>
                $userProject->building_life_expectancy,
                'project_name' => $userProject->name]);

        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function index(Request $request)
    {
        $userProject = $this->GetProjectByID($request['project_id']);

        $userMaterialEntries = $userProject->materialEntries()->get();
        $sub_phases = BsatSubPhase::where('contains_materials', 1)->get();

        $resp = array();

        $main_phases = BsatMainPhase::all();

        $maintenance_phases = ["sub_structure", "super_structure", "internal_and_external_finishes"];

        $resp = array();
        foreach ($maintenance_phases as $key => $maintenance_phase) {

            $main_phase = $this->filterCollectionMainPhase($main_phases, $maintenance_phase);
            $sub_phases = $main_phase->values()[0]->subPhases()->where('contains_materials', 1)->get();


            $sub_phase_entries = array();
            foreach ($sub_phases as $key => $sub_phase) {
                $entries = $this->filterCollectionForReplacements($userMaterialEntries, $sub_phase->id)->values()->toArray();
                $sub_phase_entries = array_merge($sub_phase_entries, [$sub_phase->slug => [
                    "label" => $sub_phase->name,
                    "entries" => $entries
                ]]);
            }

            $maintenance_entries = [
                $main_phase->values()[0]->slug => [
                    "label" => $main_phase->values()[0]->name,
                    "entries" => $sub_phase_entries
                ]
            ];

            $resp = array_merge($resp, $maintenance_entries);
        }


        return response($resp)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        {
            $main_phase = BsatMainPhase::where('slug', 'maintenance_and_replacement')->first();
            $main_phase_id = $main_phase->id;
            $data = $request['data'];

            $project = $this->GetProjectByID($request['project_id']);

            try {

                foreach ($data as $key => $main_phase_data) {
                    foreach ($main_phase_data["entries"] as $key => $sub_phase_data) {
                        $sub_phase_entries = $sub_phase_data["entries"];
                        $sub_phase_id = 0;
                        $sub_phase = BsatSubPhase::where([
                            ["main_phase_id", "=", $main_phase_id],
                            ["slug", "=", $key],
                        ])->first();

                        if (null == $sub_phase) {
                            $maintenance_sub_pahse = new BsatSubPhase();
                            $maintenance_sub_pahse->name = str_replace("_", " ", strtolower($key));
                            $maintenance_sub_pahse->slug = $key;
                            $maintenance_sub_pahse->main_phase_id = $main_phase_id;
                            $maintenance_sub_pahse->save();
                            $sub_phase_id = $maintenance_sub_pahse->id;

                            $sub_phase = $maintenance_sub_pahse;
                        } else {
                            $sub_phase_id = $sub_phase->id;
                        }

                        $this->updateMaterialEntries($sub_phase_entries);

                        $subphase_emission_result = ProjectSubPhaseEmission::where('project_id', $project->id)
                            ->where('main_phase_id', $main_phase->id)
                            ->where('sub_phase_id', $sub_phase_id)
                            ->first();

                        if (null == $subphase_emission_result) {
                            $subphase_emission_result = new ProjectSubPhaseEmission();
                            $subphase_emission_result->project_id = $project->id;
                            $subphase_emission_result->main_phase_id = $main_phase->id;
                            $subphase_emission_result->sub_phase_id = $sub_phase_id;
                        }

                        $subphase_emission_result->material_co2_emission = $sub_phase_data['maintenance_material_co2e'];
                        $subphase_emission_result->total_co2_emission = $sub_phase_data['maintenance_material_co2e'];
                        $subphase_emission_result->save();
                    }
                }

                $userMaterialEntries = $project->materialEntries()->get();
                $sub_phases = BsatSubPhase::where('contains_materials', 1)->get();

                $resp = array();
                foreach ($sub_phases as $key => $sub_phase) {
                    $entries = $this->filterCollectionForReplacements($userMaterialEntries, $sub_phase->id)->values()->toArray();
                    $resp = array_merge($resp, [$sub_phase->slug => $entries]);
                }

                return response($resp)->header('Content-Type', 'application/json');

            } catch (Exception $exception) {
                return throw new NotFoundHttpException("An Error Occurred");
            }
        }
    }


    public function updateMaterialEntries($data)
    {
        $entries = $data;
        foreach ($entries as $key => $updated_entry) {
            if (!UserMaterialEntry::find($updated_entry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }

            $entry = UserMaterialEntry::find($updated_entry['id']);
            $entry->no_replacements = $updated_entry["no_replacements"];
            $entry->maintenance_material_co2e = $updated_entry["maintenance_material_co2e"];

            $entry->save();
        }
    }
}

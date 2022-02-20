<?php

namespace App\Http\Controllers;

use App\Models\BsatMainPhase;
use App\Models\BsatSubPhase;
use App\Models\ProjectSubPhaseEmission;
use App\Models\UserMaterialEntry;
use App\Models\UserMortarEntry;
use App\Traits\ProjectTrait;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use PharIo\Version\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Auth;

class SuperStructureController extends Controller
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

            return view('pages.superStructure', ['project_id' => $userProject->id, 'project_life' =>
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
        $mainPhase = BsatMainPhase::where('slug', 'super_structure')->first();
        $superStructureSubPhases = $mainPhase->subPhases()->get();

        $superStructureEntries = array();

        foreach ($superStructureSubPhases as $key => $subPhase) {
            if ($subPhase->slug === "mortar_superstructure") {
                $entries = $subPhase->mortarEntries()->where('project_id', $request['project_id'])->get();
            } else {
                $entries = $subPhase->materialEntries()->where('project_id', $request['project_id'])->get();
            }
            $superStructureEntries[$subPhase->slug] = [
                "label" => $subPhase->name,
                "description" => $subPhase->description,
                "entries" => $entries
            ];
        }

        return response()->json($superStructureEntries, 202);
    }

    public function store(Request $request)
    {
        $main_phase = BsatMainPhase::where('slug', 'super_structure')->first();
        $data = $request['data'];

        $project = $this->GetProjectByID($request['project_id']);

        $main_phase_id = $main_phase->id;
        try {

            foreach ($data as $key => $value) {
                $sub_phase_data = $value;
                $sub_phase_id = BsatSubPhase::where([
                    ["main_phase_id", "=", $main_phase_id],
                    ["slug", "=", $key],
                ])->first()->id;

                if ($key === "mortar_superstructure") {
                    $this->storeMortarEntries($request['project_id'], $main_phase->id, $sub_phase_id,
                        $sub_phase_data);
                    $this->updateMortarEntries($request['project_id'], $main_phase->id, $sub_phase_id, $sub_phase_data);
                } else {
                    $this->storeMaterialEntries($request['project_id'], $main_phase->id, $sub_phase_id, $sub_phase_data);
                    $this->updateMaterialEntries($request['project_id'], $main_phase->id, $sub_phase_id, $sub_phase_data);
                }
            }

            $superStructureSubPhases = $main_phase->subPhases()->get();

            $superStructureEntries = array();

            foreach ($superStructureSubPhases as $key => $subPhase) {

                if ($subPhase->slug === "mortar_superstructure") {
                    $entries = $subPhase->mortarEntries()->where('project_id', $request['project_id'])->get();
                } else {
                    $entries = $subPhase->materialEntries()->where('project_id', $request['project_id'])->get();
                }

                $superStructureEntries[$subPhase->slug] = [
                    "label" => $subPhase->name,
                    "description" => $subPhase->description,
                    "entries" => $entries
                ];
            }

            return response()->json($superStructureEntries, 202);

        } catch (Exception $exception) {
            return throw new NotFoundHttpException("An Error Occurred");
        }
    }

    public function destroy(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        if ($request["sub_phase_slug"] === "mortar-superstructure") {
            if (!UserMortarEntry::find($request['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $userMortarEntry = UserMortarEntry::find($request['id']);
            $userMortarEntry->delete();
        } else {
            if (!UserMaterialEntry::find($request['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $userMaterialEntry = UserMaterialEntry::find($request['id']);
            $userMaterialEntry->delete();
        }

        return response()->json("Success", 202);
    }

}

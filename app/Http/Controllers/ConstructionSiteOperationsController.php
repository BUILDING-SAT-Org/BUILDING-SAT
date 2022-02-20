<?php

namespace App\Http\Controllers;

use App\Models\BsatMainPhase;
use App\Models\BsatSubPhase;
use App\Models\UserOperationEntry;
use App\Models\UserWasteGeneratedEntry;
use App\Traits\ProjectTrait;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use PharIo\Version\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Auth;


class ConstructionSiteOperationsController extends Controller
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

            return view('pages.constructionSiteOperations', ['project_id' => $userProject->id, 'project_life' =>
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
        $mainPhase = BsatMainPhase::where('slug', 'construction_site_operations')->first();
        $subPhases = $mainPhase->subPhases()->get();

        $constructionOperationEntries = array();

        foreach ($subPhases as $key => $subPhase) {
            if ($subPhase->slug === "waste_generated") {
                $entries = $subPhase->wasteEntries()->where('project_id', $request['project_id'])->get();
            } else {
                $entries = $subPhase->operationEntries()->where('project_id', $request['project_id'])->get();
            }
            $constructionOperationEntries[$subPhase->slug] = [
                "label" => $subPhase->name,
                "description" => $subPhase->description,
                "entries" => $entries
            ];
        }

        return response()->json($constructionOperationEntries, 202);
    }

    public function store(Request $request)
    {
        $main_phase = BsatMainPhase::where('slug', 'construction_site_operations')->first();
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

                if ($key === "waste_generated") {
                    $this->storeWasteEntries($request['project_id'], $main_phase->id, $sub_phase_id,
                        $sub_phase_data);
                    $this->updateWasteEntries($request['project_id'], $main_phase->id, $sub_phase_id, $sub_phase_data);
                } else {
                    $this->storeOperationEntries($request['project_id'], $main_phase->id, $sub_phase_id, $sub_phase_data);
                    $this->updateOperationEntries($request['project_id'], $main_phase->id, $sub_phase_id, $sub_phase_data);
                }
            }

            $subPhases = $main_phase->subPhases()->get();

            $constructionOperationEntries = array();

            foreach ($subPhases as $key => $subPhase) {

                if ($subPhase->slug === "waste_generated") {
                    $entries = $subPhase->wasteEntries()->where('project_id', $request['project_id'])->get();
                } else {
                    $entries = $subPhase->operationEntries()->where('project_id', $request['project_id'])->get();
                }

                $constructionOperationEntries[$subPhase->slug] = [
                    "label" => $subPhase->name,
                    "description" => $subPhase->description,
                    "entries" => $entries
                ];
            }

            return response()->json($constructionOperationEntries, 202);

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

        if ($request["sub_phase_slug"] === "waste-generated") {
            if (!UserWasteGeneratedEntry::find($request['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $userWasteEntry = UserWasteGeneratedEntry::find($request['id']);
            $userWasteEntry->delete();
        } else {
            if (!UserOperationEntry::find($request['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $userOperationEntry = UserOperationEntry::find($request['id']);
            $userOperationEntry->delete();
        }

        return response()->json("Success", 202);
    }

}

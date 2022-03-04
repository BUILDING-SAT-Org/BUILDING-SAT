<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatSubPhase;
use DB;

class ProjectSubPhaseController extends Controller
{
    public function index(Request $request)
    {
        $bsatSubPhases = DB::table('bsat_sub_phases')
            ->join('bsat_main_phases', 'bsat_sub_phases.main_phase_id', '=', 'bsat_main_phases.id')
            ->select('bsat_sub_phases.id', 'bsat_sub_phases.name', 'bsat_main_phases.slug as main_phase_slug')
            ->having('main_phase_slug', '!=', 'maintenance_and_replacement')->get();

        return response()->json($bsatSubPhases, 202);
    }

    public function show(Request $request)
    {
        if (!BsatSubPhase::find($request['id'])) {
            return response(array(
                "error" => "Sub Phase Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatSubPhase = BsatSubPhase::find($request['id']);
        return response()->json($bsatSubPhase, 202);
    }

    public function update(Request $request)
    {
        if (!BsatSubPhase::find($request['id'])) {
            return response(array(
                "error" => "Sub Phase Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatSubPhase = BsatSubPhase::find($request['id']);
        $bsatSubPhase->main_phase_id = $request['phase_id'];
        $bsatSubPhase->name = $request['name'];
        $bsatSubPhase->save();

        $bsatSubPhases = BsatSubPhase::all();
        return response()->json($bsatSubPhases, 202);
    }

    public function store(Request $request)
    {
        $bsatSubPhase = new BsatSubPhase();
        $bsatSubPhase->main_phase_id = $request['phase_id'];
        $bsatSubPhase->slug = str_replace(" ", "_", strtolower($request['name']));
        $bsatSubPhase->name = $request['name'];
        $bsatSubPhase->save();

        $bsatSubPhases = BsatSubPhase::all();
        return response()->json($bsatSubPhases, 202);
    }

    public function destroy(Request $request)
    {
        if (!BsatSubPhase::find($request['id'])) {
            return response(array(
                "error" => "Sub Phase Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatSubPhase = BsatSubPhase::find($request['id']);
        $bsatSubPhase->delete();
        $bsatSubPhases = BsatSubPhase::all();
        return response()->json($bsatSubPhases, 202);
    }

    public function destroyBulk(Request $request)
    {
        BsatSubPhase::whereIn('id', $request['ids'])->delete();
        $bsatSubPhases = BsatSubPhase::all();
        return response()->json($bsatSubPhases, 202);
    }
}

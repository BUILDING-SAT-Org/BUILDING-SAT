<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatMainPhase;

class ProjectMainPhaseController extends Controller
{
    public function index(Request $request)
    {
        $bsatMainPhases = BsatMainPhase::all();
        return response()->json($bsatMainPhases, 202);
    }

    public function show(Request $request)
    {
        if (!BsatMainPhase::find($request['id'])) {
            return response(array(
                "error" => "Main Phase Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMainPhase = BsatMainPhase::find($request['id']);
        return response()->json($bsatMainPhase, 202);
    }

    public function update(Request $request)
    {
        if (!BsatMainPhase::find($request['id'])) {
            return response(array(
                "error" => "Main Phase Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMainPhase = BsatMainPhase::find($request['id']);
        $bsatMainPhase->name = $request['name'];
        $bsatMainPhase->save();

        $bsatMainPhases = BsatMainPhase::all();
        return response()->json($bsatMainPhases, 202);
    }

    public function store(Request $request)
    {
        $bsatMainPhase = new BsatMainPhase();
        $bsatMainPhase->name = $request['name'];
        $bsatMainPhase->save();

        $bsatMainPhases = BsatMainPhase::all();
        return response()->json($bsatMainPhases, 202);
    }

    public function destroy(Request $request)
    {
        if (!BsatMainPhase::find($request['id'])) {
            return response(array(
                "error" => "Main Phase Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMainPhase = BsatMainPhase::find($request['id']);
        $bsatMainPhase->delete();
        $bsatMainPhases = BsatMainPhase::all();
        return response()->json($bsatMainPhases, 202);
    }

    public function destroyBulk(Request $request)
    {
        BsatMainPhase::whereIn('id', $request['ids'])->delete();
        $bsatMainPhases = BsatMainPhase::all();
        return response()->json($bsatMainPhases, 202);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BsatMainPhase;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use App\Models\BsatDifficultyLevel;

class DifficultyLevelController extends Controller
{
    use UtilTrait;

    public function index(Request $request)
    {
        $bsatDifficultyLevels = BsatDifficultyLevel::join('bsat_sub_phases as bsp', 'sub_phase_id', '=', 'bsp.id')
            ->select('bsat_difficulty_levels.*', 'bsp.name as sub_phase')
            ->get()
            ->toArray();
        return response($bsatDifficultyLevels)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatDifficultyLevel::find($request['id'])) {
            return response(array(
                "error" => "Difficulty Level Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatDifficultyLevel = BsatDifficultyLevel::find($request['id']);
        return response($bsatDifficultyLevel)->header('Content-Type', 'application/json');
    }

    public function showSubPhases(Request $request)
    {
        $slug = $this->slugify($request['main_phase_slug']);
        $bsatSubPhases = BsatMainPhase::where('slug', $slug)->first()->subPhases()->where('slug', '!=', 'back_filling'
        )->select('id', 'slug', 'name')->get();

        return response($bsatSubPhases)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatDifficultyLevel::find($request['id'])) {
            return response(array(
                "error" => "Difficulty Level Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatDifficultyLevel = BsatDifficultyLevel::find($request['id']);
        $bsatDifficultyLevel->name = $request['name'];
        $bsatDifficultyLevel->sub_phase_id = $request['sub_phase_id'];
        $bsatDifficultyLevel->difficulty_factor = $request['difficulty_factor'];
        $bsatDifficultyLevel->bulking_density = $request['bulking_density'];
        $bsatDifficultyLevel->bulking_factor = $request['bulking_factor'];
        $bsatDifficultyLevel->save();

        $bsatDifficultyLevels = BsatDifficultyLevel::join('bsat_sub_phases as bsp', 'sub_phase_id', '=', 'bsp.id')
            ->select('bsat_difficulty_levels.*', 'bsp.name as sub_phase')
            ->get()
            ->toArray();

        return response($bsatDifficultyLevels, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatDifficultyLevel = new BsatDifficultyLevel();
        $bsatDifficultyLevel->name = $request['name'];
        $bsatDifficultyLevel->sub_phase_id = $request['sub_phase_id'];
        $bsatDifficultyLevel->difficulty_factor = $request['difficulty_factor'];
        $bsatDifficultyLevel->bulking_density = $request['bulking_density'];
        $bsatDifficultyLevel->bulking_factor = $request['bulking_factor'];
        $bsatDifficultyLevel->save();

        $bsatDifficultyLevels = BsatDifficultyLevel::join('bsat_sub_phases as bsp', 'sub_phase_id', '=', 'bsp.id')
            ->select('bsat_difficulty_levels.*', 'bsp.name as sub_phase')
            ->get()
            ->toArray();

        return response($bsatDifficultyLevels, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatDifficultyLevel::find($request['id'])) {
            return response(array(
                "error" => "Difficulty Level Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatDifficultyLevel::find($request['id'])->delete();

        $bsatDifficultyLevels = BsatDifficultyLevel::join('bsat_sub_phases as bsp', 'sub_phase_id', '=', 'bsp.id')
            ->select('bsat_difficulty_levels.*', 'bsp.name as sub_phase')
            ->get()
            ->toArray();
        return response($bsatDifficultyLevels, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatDifficultyLevel::whereIn('id', $request['ids'])->delete();

        $bsatDifficultyLevels = BsatDifficultyLevel::join('bsat_sub_phases as bsp', 'sub_phase_id', '=', 'bsp.id')
            ->select('bsat_difficulty_levels.*', 'bsp.name as sub_phase')
            ->get()
            ->toArray();
        return response($bsatDifficultyLevels, 202)->header('Content-Type', 'application/json');
    }
}

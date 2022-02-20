<?php

namespace App\Http\Controllers;

use App\Models\BsatRecommendation;
use Illuminate\Http\Request;

class BsatRecommendationController extends Controller
{
    public function index(Request $request)
    {
        $bsatRecommendations = BsatRecommendation::all();
        return response($bsatRecommendations)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatRecommendation::find($request['id'])) {
            return response(array(
                "error" => "Recommendation Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatRecommendation = BsatRecommendation::find($request['id']);
        return response($bsatRecommendation)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatRecommendation::find($request['id'])) {
            return response(array(
                "error" => "Recommendation Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatRecommendation = BsatRecommendation::find($request['id']);
        $bsatRecommendation->label = $request['label'];
        $bsatRecommendation->description = $request['description'];
        $bsatRecommendation->save();

        $bsatRecommendations = BsatRecommendation::all();

        return response($bsatRecommendations, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatRecommendation = new BsatRecommendation();
        $bsatRecommendation->label = $request['label'];
        $bsatRecommendation->description = $request['description'];
        $bsatRecommendation->save();

        $bsatRecommendations = BsatRecommendation::all();

        return response($bsatRecommendations, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatRecommendation::find($request['id'])) {
            return response(array(
                "error" => "Recommendation Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatRecommendation::find($request['id'])->delete();

        $bsatRecommendations = BsatRecommendation::all();
        return response($bsatRecommendations, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatRecommendation::whereIn('id', $request['ids'])->delete();

        $bsatRecommendations = BsatRecommendation::all();
        return response($bsatRecommendations, 202)->header('Content-Type', 'application/json');
    }
}

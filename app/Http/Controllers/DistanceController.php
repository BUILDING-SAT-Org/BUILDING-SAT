<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatDistance;

class DistanceController extends Controller
{
    public function index(Request $request)
    {
        $bsatDistances = BsatDistance::join('locations as l', 'origin_id', '=', 'l.id')
            ->join('locations as d', 'destination_id', '=', 'd.id')
            ->select('bsat_distances.*', 'l.label as origin', 'd.label as destination')
            ->get()
            ->toArray();
        return json_encode($bsatDistances);
    }

    public function show(Request $request)
    {
        if (!BsatDistance::find($request['id'])) {
            return response(array(
                "error" => "Distance Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatDistances = BsatDistance::find($request['id']);
        return response($bsatDistances)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatDistance::find($request['id'])) {
            return response(array(
                "error" => "Distance Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatDistance = BsatDistance::find($request['id']);
        $bsatDistance->distance = $request['distance'];
        $bsatDistance->save();

        $bsatDistances = BsatDistance::join('locations as l', 'origin_id', '=', 'l.id')
            ->join('locations as d', 'destination_id', '=', 'd.id')
            ->select('bsat_distances.*', 'l.label as origin', 'd.label as destination')
            ->get()
            ->toArray();

        return response($bsatDistances, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatDistance = new BsatDistance();
        $bsatDistance->origin_id = $request['origin_id'];
        $bsatDistance->destination_id = $request['destination_id'];
        $bsatDistance->distance = $request['distance'];
        $bsatDistance->save();

        $bsatDistances = BsatDistance::join('locations as l', 'origin_id', '=', 'l.id')
            ->join('locations as d', 'destination_id', '=', 'd.id')
            ->select('bsat_distances.*', 'l.label as origin', 'd.label as destination')
            ->get()
            ->toArray();

        return response($bsatDistances, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatDistance::find($request['id'])) {
            return response(array(
                "error" => "Distance Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatDistance::find($request['id'])->delete();

        $bsatDistances = BsatDistance::join('locations as l', 'origin_id', '=', 'l.id')
            ->join('locations as d', 'destination_id', '=', 'd.id')
            ->select('bsat_distances.*', 'l.label as origin', 'd.label as destination')
            ->get()
            ->toArray();
        return response($bsatDistances, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatDistance::whereIn('id', $request['ids'])->delete();

        $bsatDistances = BsatDistance::join('locations as l', 'origin_id', '=', 'l.id')
            ->join('locations as d', 'destination_id', '=', 'd.id')
            ->select('bsat_distances.*', 'l.label as origin', 'd.label as destination')
            ->get()
            ->toArray();
        return response($bsatDistances, 202)->header('Content-Type', 'application/json');
    }
}

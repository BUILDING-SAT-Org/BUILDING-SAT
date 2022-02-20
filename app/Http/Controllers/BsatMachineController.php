<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatMachine;

class BsatMachineController extends Controller
{

    public function index(Request $request)
    {
        $bsatMachines = BsatMachine::all();
        return response($bsatMachines)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatMachine::where("id", $request['id'])) {
            return response(array(
                "error" => "Machine Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMachine = BsatMachine::where("id", $request['id'])->first();
        return response($bsatMachine)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatMachine::where("id", $request['id'])) {
            return response(array(
                "error" => "Machine Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatMachine = BsatMachine::where("id", $request['id'])->first();
        $bsatMachine->countries = $request['countries'];
        $bsatMachine->label = $request['label'];
        $bsatMachine->year = $request['year'];
        $bsatMachine->standard = $request['standard'];
        $bsatMachine->data_source = $request['data_source'];
        $bsatMachine->technical_specification = $request['technical_specification'];
        $bsatMachine->gwp = $request['gwp'];
        $bsatMachine->unit = $request['unit'];
        $bsatMachine->save();

        $bsatMachines = BsatMachine::all();

        return response($bsatMachines, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatMachine = new BsatMachine();
        $bsatMachine->countries = $request['countries'];
        $bsatMachine->label = $request['label'];
        $bsatMachine->year = $request['year'];
        $bsatMachine->standard = $request['standard'];
        $bsatMachine->data_source = $request['data_source'];
        $bsatMachine->technical_specification = $request['technical_specification'];
        $bsatMachine->gwp = $request['gwp'];
        $bsatMachine->unit = $request['unit'];
        $bsatMachine->save();

        $bsatMachines = BsatMachine::all();

        return response($bsatMachines, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatMachine::where("id", $request['id'])) {
            return response(array(
                "error" => "Machine Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatMachine::where("id", $request['id'])->delete();

        $bsatMachines = BsatMachine::all();
        return response($bsatMachines, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatMachine::whereIn('id', $request['ids'])->delete();

        $bsatMachines = BsatMachine::all();
        return response($bsatMachines, 202)->header('Content-Type', 'application/json');
    }
}

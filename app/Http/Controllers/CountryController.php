<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::all();
        return response($countries)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!Country::find($request['id'])) {
            return response(array(
                "error" => "Country Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $countries = Country::find($request['id']);
        return response($countries)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!Country::find($request['id'])) {
            return response(array(
                "error" => "Country Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $country = Country::find($request['id']);
        $country->label = $request['name'];
        $country->save();

        $countries = Country::all();

        return response($countries, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $country = new Country();
        $country->label = $request['name'];
        $country->save();

        $countries = Country::all();

        return response($countries, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!Country::find($request['id'])) {
            return response(array(
                "error" => "Country Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        Country::find($request['id'])->delete();

        $countries = Country::all();
        return response($countries, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        Country::whereIn('id', $request['ids'])->delete();

        $countries = Country::all();
        return response($countries, 202)->header('Content-Type', 'application/json');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatMaterialCategory;

class BsatMaterialCategoryController extends Controller
{
    public function index(Request $request)
    {
        $bsatMaterialCategories = BsatMaterialCategory::all();
        return response($bsatMaterialCategories)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatMaterialCategory::find($request['id'])) {
            return response(array(
                "error" => "Category Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMaterialCategory = BsatMaterialCategory::find($request['id']);
        return response($bsatMaterialCategory)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatMaterialCategory::find($request['id'])) {
            return response(array(
                "error" => "Category Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatMaterialCategory = BsatMaterialCategory::find($request['id']);
        $bsatMaterialCategory->label = $request['label'];
        $bsatMaterialCategory->is_salvage = $request['is_salvage'];
        $bsatMaterialCategory->is_replaceable = $request['is_replaceable'];
        $bsatMaterialCategory->save();

        $bsatMaterialCategory = BsatMaterialCategory::all();

        return response($bsatMaterialCategory, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $bsatMaterialCategory = new BsatMaterialCategory();
        $bsatMaterialCategory->label = $request['label'];
        $bsatMaterialCategory->is_salvage = $request['is_salvage'];
        $bsatMaterialCategory->is_replaceable = $request['is_replaceable'];
        $bsatMaterialCategory->save();

        $bsatMaterialCategories = BsatMaterialCategory::all();

        return response($bsatMaterialCategories, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatMaterialCategory::find($request['id'])) {
            return response(array(
                "error" => "Category Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatMaterialCategory::find($request['id'])->delete();

        $bsatMaterialCategories = BsatMaterialCategory::all();
        return response($bsatMaterialCategories, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatMaterialCategory::whereIn('id', $request['ids'])->delete();

        $bsatMaterialCategories = BsatMaterialCategory::all();
        return response($bsatMaterialCategories, 202)->header('Content-Type', 'application/json');
    }
}

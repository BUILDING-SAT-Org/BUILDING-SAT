<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BsatMaterial;
use Illuminate\Support\Facades\Validator;
use DB;

class BsatMaterialController extends Controller
{
    public function index(Request $request)
    {
        $bsatMaterials = BsatMaterial::leftJoin('bsat_material_categories', 'bsat_materials.category_id', '=', 'bsat_material_categories.id')
            ->select('bsat_materials.*', 'bsat_material_categories.label as category_label')->get();

        return response($bsatMaterials)->header('Content-Type', 'application/json');
    }

    public function show(Request $request)
    {
        if (!BsatMaterial::where("id", $request['id'])) {
            return response(array(
                "error" => "Material NotFound"
            ), 404)->header('Content-Type', 'application/json');
        }
        $bsatMaterial = BsatMaterial::where("id", $request['id'])->first();
        return response($bsatMaterial)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        if (!BsatMaterial::where("id", $request['id'])) {
            return response(array(
                "error" => "Material NotFound"
            ), 404)->header('Content-Type', 'application/json');
        }

        $bsatMaterial = BsatMaterial::where("id", $request['id'])->first();
        $bsatMaterial->category_id = $request['category_id'];
        $bsatMaterial->countries = $request['countries'];
        $bsatMaterial->label = $request['label'];
        $bsatMaterial->year = $request['year'];
        $bsatMaterial->standard = $request['standard'];
        $bsatMaterial->data_source = $request['data_source'];
        $bsatMaterial->service_life = $request['service_life'];
        $bsatMaterial->technical_specification = $request['technical_specification'];
        $bsatMaterial->bulking_density = $request['bulking_density'];
        $bsatMaterial->bulking_factor = $request['bulking_factor'];
        $bsatMaterial->conversion_unit = $request['conversion_unit'];
        $bsatMaterial->gwp = $request['gwp'];
        $bsatMaterial->unit = $request['unit'];
        $bsatMaterial->wastage = $request['wastage'];
        $bsatMaterial->save();

        $bsatMaterials = BsatMaterial::all();

        return response($bsatMaterials, 202)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {

        $bsatMaterial = new BsatMaterial();
        $bsatMaterial->category_id = $request['category_id'];
        $bsatMaterial->countries = $request['countries'];
        $bsatMaterial->label = $request['label'];
        $bsatMaterial->year = $request['year'];
        $bsatMaterial->standard = $request['standard'];
        $bsatMaterial->data_source = $request['data_source'];
        $bsatMaterial->service_life = $request['service_life'];
        $bsatMaterial->technical_specification = $request['technical_specification'];
        $bsatMaterial->bulking_density = $request['bulking_density'];
        $bsatMaterial->bulking_factor = $request['bulking_factor'];
        $bsatMaterial->conversion_unit = $request['conversion_unit'];
        $bsatMaterial->gwp = $request['gwp'];
        $bsatMaterial->unit = $request['unit'];
        $bsatMaterial->wastage = $request['wastage'];
        $bsatMaterial->save();

        $bsatMaterials = BsatMaterial::all();

        return response($bsatMaterials, 202)->header('Content-Type', 'application/json');
    }

    public function destroy(Request $request)
    {
        if (!BsatMaterial::where("id", $request['id'])) {
            return response(array(
                "error" => "Material NotFound"
            ), 404)->header('Content-Type', 'application/json');
        }
        BsatMaterial::where("id", $request['id'])->delete();

        $bsatMaterials = BsatMaterial::all();
        return response($bsatMaterials, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        BsatMaterial::whereIn('id', $request['ids'])->delete();

        $bsatMaterials = BsatMaterial::all();
        return response($bsatMaterials, 202)->header('Content-Type', 'application/json');
    }
}

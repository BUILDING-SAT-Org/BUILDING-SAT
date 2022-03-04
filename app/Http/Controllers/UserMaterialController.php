<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMaterial;
use App\Models\Project;
use App\Traits\ProjectTrait;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserMaterialController extends Controller
{
    use ProjectTrait;

    public function index(Request $request)
    {
        $userMaterials = $this->GetProjectMaterials($request['project_id']);
        return response()->json($userMaterials, 202);
    }

    public function show(Request $request)
    {
        $userMaterial = $this->GetProjectMaterialByID($request['project_id'], $request['id']);
        return response()->json($userMaterial, 202);
    }

    public function update(Request $request)
    {

        $userMaterial = $this->GetProjectMaterialByID($request['project_id'], $request['id']);

        $userMaterial->category_id = $request['category_id'];
        $userMaterial->countries = $request['countries'];
        $userMaterial->label = 'Custom-' . $request['label'];
        $userMaterial->year = $request['year'];
        $userMaterial->standard = $request['standard'];
        $userMaterial->data_source = $request['data_source'];
        $userMaterial->service_life = $request['service_life'];
        $userMaterial->technical_specification = $request['technical_specification'];
        $userMaterial->bulking_density = $request['bulking_density'];
        $userMaterial->bulking_factor = $request['bulking_factor'];
        $userMaterial->conversion_unit = $request['conversion_unit'];
        $userMaterial->gwp = $request['gwp'];
        $userMaterial->unit = $request['unit'];
        $userMaterial->wastage = $request['wastage'];
        $userMaterial->save();

        $userMaterials = $this->GetProjectMaterials($request['project_id']);
        return response()->json($userMaterials, 202);
    }

    public function store(Request $request)
    {

        $userMaterial = new UserMaterial();
        $userMaterial->project_id = $request['project_id'];
        $userMaterial->category_id = $request['category_id'];
        $userMaterial->countries = $request['countries'];
        $userMaterial->label = 'Custom-' . $request['label'];
        $userMaterial->year = $request['year'];
        $userMaterial->standard = $request['standard'];
        $userMaterial->data_source = $request['data_source'];
        $userMaterial->service_life = $request['service_life'];
        $userMaterial->technical_specification = $request['technical_specification'];
        $userMaterial->bulking_density = $request['bulking_density'];
        $userMaterial->bulking_factor = $request['bulking_factor'];
        $userMaterial->conversion_unit = $request['conversion_unit'];
        $userMaterial->gwp = $request['gwp'];
        $userMaterial->unit = $request['unit'];
        $userMaterial->wastage = $request['wastage'];
        $userMaterial->save();

        $userMaterials = $this->GetProjectMaterials($request['project_id']);
        return response()->json($userMaterials, 202);
    }

    public function destroy(Request $request)
    {
        $userMaterial = $this->GetProjectMaterialByID($request['project_id'], $request['id']);
        $userMaterial->delete();
        $userMaterials = $this->GetProjectMaterials($request['project_id']);
        return response()->json($userMaterials, 202);
    }

    public function destroyBulk(Request $request)
    {
        $userProject = $this->GetProjectByID($request['project_id']);
        $userProject->userMaterials()->whereIn('id', $request['ids'])->where('project_id', $request['project_id'])->delete();
        $userMaterials = $this->GetProjectMaterials($request['project_id']);
        return response()->json($userMaterials, 202);
    }
}

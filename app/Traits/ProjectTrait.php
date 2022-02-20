<?php

namespace App\Traits;

use App\Models\BsatMaterial;
use App\Models\BsatMortar;
use App\Models\Project;
use App\Models\ProjectSubPhaseEmission;
use App\Models\UserMaterial;
use App\Models\UserMaterialEntry;
use App\Models\UserMortarEntry;
use App\Models\UserOperationEntry;
use App\Models\UserWasteGeneratedEntry;
use App\Models\BsatMaterialCategory;
use App\Models\BsatMachine;
use App\Models\BsatVehicle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Auth;

trait ProjectTrait
{
    public function GetProjectByID(string $id)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $id)->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }
        return $userProject;
    }

    public function GetProjectMaterialByID(string $project_id, string $id)
    {
        $userProject = $this->GetProjectByID($project_id);
        $userMaterials = $userProject->userMaterials()->get();
        $userMaterial = $userMaterials->where('id', $id)->first();
        if (null == $userMaterial) {
            return throw new NotFoundHttpException("Material Not Found");
        }
        return $userMaterial;
    }

    public function GetProjectMaterials(string $project_id)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $project_id)->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }
        $userMaterials = $userProject->userMaterials()->get();
        return $userMaterials;
    }

    public function GetProjectMachines(string $project_id)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $project_id)->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }
        $userMachines = $userProject->userMachines()->get();
        return $userMachines;
    }

    public function GetProjectMachineByID(string $project_id, string $id)
    {
        $userProject = $this->GetProjectByID($project_id);
        $userMachines = $userProject->userMachines()->get();
        $userMachine = $userMachines->where('id', $id)->first();
        if (null == $userMachine) {
            return throw new NotFoundHttpException("Machine Not Found");
        }
        return $userMachine;
    }

    public function GetAllMachines(string $project_id)
    {
        $userProject = $this->GetProjectByID($project_id);
        $userMachines = $userProject->userMachines()->orderBy('label', 'ASC')->get()->toArray();
        $bsatMachines = BsatMachine::orderBy('label', 'ASC')->get()->toArray();
        $machines = array(
            "id" => 'UM00',
            "label" => 'Custom',
            "children" => $userMachines
        );
        array_push($bsatMachines, $machines);
        return $bsatMachines;
    }

    public function GetProjectVehicles(string $project_id)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $project_id)->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }
        $userVehicles = $userProject->userVehicles()->get();
        return $userVehicles;
    }

    public function GetProjectVehicleByID(string $project_id, string $id)
    {
        $userProject = $this->GetProjectByID($project_id);
        $userVehicles = $userProject->userVehicles()->get();
        $userVehicle = $userVehicles->where('id', $id)->first();
        if (null == $userVehicle) {
            return throw new NotFoundHttpException("Machine Not Found");
        }
        return $userVehicle;
    }

    public function GetAllVehicles(string $project_id)
    {
        $userProject = $this->GetProjectByID($project_id);
        $userVehicles = $userProject->userVehicles()->orderBy('label', 'ASC')->get()->toArray();
        $bsatVehicles = BsatVehicle::orderBy('label', 'ASC')->get()->toArray();
        $vehicles = array(
            "id" => 'UV00',
            "label" => 'Custom',
            "children" => $userVehicles
        );
        array_push($bsatVehicles, $vehicles);
        return $bsatVehicles;
    }

    public function GetAllMaterials(string $project_id)
    {
        $bsatMaterialCategories = BsatMaterialCategory::orderBy('label', 'ASC')->get();
        $bsatMaterials = BsatMaterial::orderBy('label', 'ASC')->get();
        $userMaterials = UserMaterial::where('project_id', $project_id)->orderBy('label', 'ASC')->get();

        $materials = array();
        foreach ($bsatMaterialCategories as $key => $category) {
            $categoryBsatMaterial = $this->filterMaterialByCategory($bsatMaterials, $category->id);

            $bsatMaterials = $bsatMaterials->diff($categoryBsatMaterial);
            $categoryUserMaterials = $this->filterMaterialByCategory($userMaterials, $category->id);

            $userMaterials = $userMaterials->diff($categoryUserMaterials);

            $result = array_merge($categoryBsatMaterial->toArray(), $categoryUserMaterials->toArray());
            $categoryMaterials = array(
                "id" => $category->id,
                "label" => $category->label,
                "children" => $result
            );

            array_push($materials, $categoryMaterials);
        }

        return $materials;
    }

    public function GetAllMortarTypes(string $project_id)
    {
        $bsatMortars = BsatMortar::orderBy('label', 'ASC')->get()->toArray();
        return $bsatMortars;
    }

    public function GetAllMortarTypesAsList(string $project_id)
    {
        $bsatMortars = BsatMortar::orderBy('label', 'ASC')->get()->toArray();
        return $bsatMortars;
    }

    public function GetAllMaterialsAsList(string $project_id)
    {
        $bsatMaterials = BsatMaterial::
        join('bsat_material_categories', 'category_id', '=', 'bsat_material_categories.id')
            ->select('bsat_materials.*', 'bsat_material_categories.is_salvage', 'bsat_material_categories.is_replaceable')
            ->get()
            ->toArray();
        $userMaterials = Project::find($project_id)->userMaterials()
            ->join('bsat_material_categories', 'category_id', '=', 'bsat_material_categories.id')
            ->select('user_materials.*', 'bsat_material_categories.is_salvage', 'bsat_material_categories.is_replaceable')
            ->get()->toArray();

        $materials = array_merge($bsatMaterials, $userMaterials);

        return $materials;
    }

    public function GetAllMaterialsBySubphase(string $project_id, string $subPhase)
    {
        $bsatMaterialCategories = BsatMaterialCategory::where('label', $subPhase)->get();

        $materials = array();
        foreach ($bsatMaterialCategories as $key => $category) {
            $bsatMaterials = $category->materials()->get()->toArray();
            $userMaterials = $category->userMaterials()->where('project_id', $project_id)->get()->toArray();

            $result = array_merge($bsatMaterials, $userMaterials);
            $categoryMaterials = array(
                "id" => $category->id,
                "label" => $category->label,
                "children" => $result
            );

            array_push($materials, $categoryMaterials);
        }

        return $materials;
    }

    public function storeMaterialEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        $project = Project::find($project_id);
        $building_service_life = $project->building_life_expectancy;

        foreach ($data['new_entries'] as $key => $newEntry) {

            $no_replacements = intval($building_service_life / $newEntry["service_life"]);

            $entry = new UserMaterialEntry();
            $entry->project_id = $project_id;
            $entry->sub_phase_id = $sub_phase_id;
            $entry->material_id = $newEntry["material_id"];
            $entry->total_material_co2e = $newEntry["total_material_co2e"];
            $entry->quantity = $newEntry["quantity"];
            $entry->total_bulking_quantity = $newEntry["total_bulking_quantity"];
            $entry->service_life = $newEntry["service_life"];
            $entry->wastage = $newEntry["wastage"];
            $entry->location_id = $newEntry["location_id"];
            $entry->other_location = $newEntry["other_location"];
            $entry->local_distance = $newEntry["local_distance"];
            $entry->local_transport_vehicle_id = $newEntry["local_transport_vehicle_id"];
            $entry->overseas_distance = $newEntry["overseas_distance"];
            $entry->overseas_transport_vehicle_id = $newEntry["overseas_transport_vehicle_id"];
            $entry->local_transport_co2e = $newEntry["local_transport_co2e"];
            $entry->overseas_transport_co2e = $newEntry["overseas_transport_co2e"];
            $entry->total_transport_co2e = $newEntry["total_transport_co2e"];
            $entry->total_co2e = $newEntry["total_co2e"];
            $entry->total_co2e_label = $newEntry["total_co2e_label"];
            $entry->is_replaceable = $newEntry["is_replaceable"];
            $entry->is_salvage = $newEntry["is_salvage"];
            $entry->no_replacements = $no_replacements > 0 ? $no_replacements : 0;
            $entry->maintenance_material_co2e = $this->getNumber_format($newEntry["total_material_co2e"] * $no_replacements);
            $entry->data = $newEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
        $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $subPhaseEmissionResult->save();

    }

    public function updateMaterialEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        $project = Project::find($project_id);
        $building_service_life = $project->building_life_expectancy;

        foreach ($data['updated_entries'] as $key => $updatedEntry) {
            if (!UserMaterialEntry::find($updatedEntry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }

            $no_replacements = intval($building_service_life / $updatedEntry["service_life"]);

            $entry = UserMaterialEntry::find($updatedEntry['id']);
            $entry->material_id = $updatedEntry["material_id"];
            $entry->total_material_co2e = $updatedEntry["total_material_co2e"];
            $entry->quantity = $updatedEntry["quantity"];
            $entry->total_bulking_quantity = $updatedEntry["total_bulking_quantity"];
            $entry->service_life = $updatedEntry["service_life"];
            $entry->wastage = $updatedEntry["wastage"];
            $entry->location_id = $updatedEntry["location_id"];
            $entry->other_location = $updatedEntry["other_location"];
            $entry->local_distance = $updatedEntry["local_distance"];
            $entry->local_transport_vehicle_id = $updatedEntry["local_transport_vehicle_id"];
            $entry->overseas_distance = $updatedEntry["overseas_distance"];
            $entry->overseas_transport_vehicle_id = $updatedEntry["overseas_transport_vehicle_id"];
            $entry->local_transport_co2e = $updatedEntry["local_transport_co2e"];
            $entry->overseas_transport_co2e = $updatedEntry["overseas_transport_co2e"];
            $entry->total_transport_co2e = $updatedEntry["total_transport_co2e"];
            $entry->total_co2e = $updatedEntry["total_co2e"];
            $entry->total_co2e_label = $updatedEntry["total_co2e_label"];
            $entry->is_replaceable = $updatedEntry["is_replaceable"];
            $entry->is_salvage = $updatedEntry["is_salvage"];
            $entry->no_replacements = $no_replacements > 0 ? $no_replacements : 0;
            $entry->data = $updatedEntry["data"];

            $this->clear_landfill_data($entry);

            $entry->save();

            $siteClearanceEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
                ->where('main_phase_id', $main_phase_id)
                ->where('sub_phase_id', $sub_phase_id)
                ->first();

            $siteClearanceEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
            $siteClearanceEmissionResult->material_co2_emission = $data['total_material_co2e'];
            $siteClearanceEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
            $siteClearanceEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
            $siteClearanceEmissionResult->save();

        }
    }

    public function storeMortarEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['new_entries'] as $key => $newEntry) {
            $entry = new UserMortarEntry();
            $entry->project_id = $project_id;
            $entry->sub_phase_id = $sub_phase_id;
            $entry->mortar_id = $newEntry["mortar_id"];
            $entry->area = $newEntry["area"];
            $entry->thickness = $newEntry["thickness"];
            $entry->service_life = $newEntry["service_life"];
            $entry->wastage = $newEntry["wastage"];
            $entry->sand_resource_location_id = $newEntry["sand_resource_location_id"];
            $entry->sand_resource_other_location = $newEntry["sand_resource_other_location"];
            $entry->sand_transport_distance = $newEntry["sand_transport_distance"];
            $entry->sand_transport_vehicle_id = $newEntry["sand_transport_vehicle_id"];
            $entry->cement_resource_location_id = $newEntry["cement_resource_location_id"];
            $entry->cement_resource_other_location = $newEntry["cement_resource_other_location"];
            $entry->cement_transport_distance = $newEntry["cement_transport_distance"];
            $entry->cement_transport_vehicle_id = $newEntry["cement_transport_vehicle_id"];
            $entry->sand_bulking_quantity = $newEntry["sand_bulking_quantity"];
            $entry->cement_bulking_quantity = $newEntry["cement_bulking_quantity"];
            $entry->sand_co2e = $newEntry["sand_co2e"];
            $entry->cement_co2e = $newEntry["cement_co2e"];
            $entry->sand_transport_co2e = $newEntry["sand_transport_co2e"];
            $entry->cement_transport_co2e = $newEntry["cement_transport_co2e"];
            $entry->total_material_co2e = $newEntry["total_material_co2e"];
            $entry->total_transport_co2e = $newEntry["total_transport_co2e"];
            $entry->total_co2e = $newEntry["total_co2e"];
            $entry->total_co2e_label = $newEntry["total_co2e_label"];
            $entry->is_replaceable = $newEntry["is_replaceable"];
            $entry->is_salvage = $newEntry["is_salvage"];
            $entry->data = $newEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
        $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $subPhaseEmissionResult->save();

    }

    public function updateMortarEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['updated_entries'] as $key => $updatedEntry) {
            if (!UserMortarEntry::find($updatedEntry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $entry = UserMortarEntry::find($updatedEntry['id']);
            $entry->mortar_id = $updatedEntry["mortar_id"];
            $entry->area = $updatedEntry["area"];
            $entry->thickness = $updatedEntry["thickness"];
            $entry->service_life = $updatedEntry["service_life"];
            $entry->wastage = $updatedEntry["wastage"];
            $entry->sand_resource_location_id = $updatedEntry["sand_resource_location_id"];
            $entry->sand_resource_other_location = $updatedEntry["sand_resource_other_location"];
            $entry->sand_transport_distance = $updatedEntry["sand_transport_distance"];
            $entry->sand_transport_vehicle_id = $updatedEntry["sand_transport_vehicle_id"];
            $entry->cement_resource_location_id = $updatedEntry["cement_resource_location_id"];
            $entry->cement_resource_other_location = $updatedEntry["cement_resource_other_location"];
            $entry->cement_transport_distance = $updatedEntry["cement_transport_distance"];
            $entry->cement_transport_vehicle_id = $updatedEntry["cement_transport_vehicle_id"];
            $entry->sand_bulking_quantity = $updatedEntry["sand_bulking_quantity"];
            $entry->cement_bulking_quantity = $updatedEntry["cement_bulking_quantity"];
            $entry->sand_co2e = $updatedEntry["sand_co2e"];
            $entry->cement_co2e = $updatedEntry["cement_co2e"];
            $entry->sand_transport_co2e = $updatedEntry["sand_transport_co2e"];
            $entry->cement_transport_co2e = $updatedEntry["cement_transport_co2e"];
            $entry->total_material_co2e = $updatedEntry["total_material_co2e"];
            $entry->total_transport_co2e = $updatedEntry["total_transport_co2e"];
            $entry->total_co2e = $updatedEntry["total_co2e"];
            $entry->total_co2e_label = $updatedEntry["total_co2e_label"];
            $entry->is_replaceable = $updatedEntry["is_replaceable"];
            $entry->is_salvage = $updatedEntry["is_salvage"];
            $entry->data = $updatedEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
        $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $subPhaseEmissionResult->save();

    }

    public function storeOperationEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['new_entries'] as $key => $newEntry) {
            $entry = new UserOperationEntry();
            $entry->project_id = $project_id;
            $entry->sub_phase_id = $sub_phase_id;
            $entry->material_id = $newEntry["material_id"];
            $entry->quantity = $newEntry["quantity"];
            $entry->total_co2e = $newEntry["total_co2e"];
            $entry->total_co2e_label = $newEntry["total_co2e_label"];
            $entry->data = $newEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];

        if ($data["sub_phase"] === "electricity_used_during_operation"
            || $data["sub_phase"] === "fuel_used_during_operation"
            || $data["sub_phase"] === "exported_energy_during_operation"
            || $data["sub_phase"] === "electricity_use_on_site"
            || $data["sub_phase"] === "fuel_use_on_site") {

            $subPhaseEmissionResult->energy_co2_emission = $data['total_energy_co2e'];
            $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e']
                + $data['total_material_co2e'] + $data['total_energy_co2e'];
        } else if ($data["sub_phase"] === "water_consumption_during_operation"
            || $data["sub_phase"] === "water_consumption_on_site") {

            $subPhaseEmissionResult->water_co2_emission = $data['total_water_co2e'];
            $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e']
                + $data['total_material_co2e'] + $data['total_water_co2e'];
        } else {
            $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e']
                + $data['total_material_co2e'];
        }
        $subPhaseEmissionResult->save();

    }

    public function updateOperationEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['updated_entries'] as $key => $updatedEntry) {
            if (!UserOperationEntry::find($updatedEntry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $entry = UserOperationEntry::find($updatedEntry['id']);
            $entry->material_id = $updatedEntry["material_id"];
            $entry->quantity = $updatedEntry["quantity"];
            $entry->total_co2e = $updatedEntry["total_co2e"];
            $entry->total_co2e_label = $updatedEntry["total_co2e_label"];
            $entry->data = $updatedEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];

        if ($data["sub_phase"] === "electricity_used_during_operation"
            || $data["sub_phase"] === "fuel_used_during_operation"
            || $data["sub_phase"] === "exported_energy_during_operation"
            || $data["sub_phase"] === "electricity_use_on_site"
            || $data["sub_phase"] === "fuel_use_on_site") {

            $subPhaseEmissionResult->energy_co2_emission = $data['total_energy_co2e'];
            $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e']
                + $data['total_material_co2e'] + $data['total_energy_co2e'];
        } else if ($data["sub_phase"] === "water_consumption_during_operation"
            || $data["sub_phase"] === "water_consumption_on_site") {

            $subPhaseEmissionResult->water_co2_emission = $data['total_water_co2e'];
            $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e']
                + $data['total_material_co2e'] + $data['total_water_co2e'];
        } else {
            $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e']
                + $data['total_material_co2e'];
        }
        $subPhaseEmissionResult->save();

    }

    public function storeWasteEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['new_entries'] as $key => $newEntry) {
            $entry = new UserWasteGeneratedEntry();
            $entry->project_id = $project_id;
            $entry->sub_phase_id = $sub_phase_id;
            $entry->material_id = $newEntry["material_id"];
            $entry->quantity = $newEntry["quantity"];
            $entry->total_bulking_quantity = $newEntry["total_bulking_quantity"];
            $entry->location_id = $newEntry["location_id"];
            $entry->total_distance = $newEntry["total_distance"];
            $entry->other_location = $newEntry["other_location"];
            $entry->other_location_distance = $newEntry["other_location_distance"];
            $entry->waste_transport_vehicle_id = $newEntry["waste_transport_vehicle_id"];
            $entry->transport_co2e = $newEntry["transport_co2e"];
            $entry->material_co2e = $newEntry["material_co2e"];
            $entry->total_co2e = $newEntry["total_co2e"];
            $entry->total_co2e_label = $newEntry["total_co2e_label"];
            $entry->data = $newEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
        $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $subPhaseEmissionResult->save();

    }

    public function updateWasteEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['updated_entries'] as $key => $updatedEntry) {
            if (!UserWasteGeneratedEntry::find($updatedEntry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $entry = UserWasteGeneratedEntry::find($updatedEntry['id']);
            $entry->material_id = $updatedEntry["material_id"];
            $entry->quantity = $updatedEntry["quantity"];
            $entry->total_bulking_quantity = $updatedEntry["total_bulking_quantity"];
            $entry->location_id = $updatedEntry["location_id"];
            $entry->total_distance = $updatedEntry["total_distance"];
            $entry->other_location = $updatedEntry["other_location"];
            $entry->other_location_distance = $updatedEntry["other_location_distance"];
            $entry->waste_transport_vehicle_id = $updatedEntry["waste_transport_vehicle_id"];
            $entry->transport_co2e = $updatedEntry["transport_co2e"];
            $entry->material_co2e = $updatedEntry["material_co2e"];
            $entry->total_co2e = $updatedEntry["total_co2e"];
            $entry->total_co2e_label = $updatedEntry["total_co2e_label"];
            $entry->data = $updatedEntry["data"];
            $entry->save();
        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
        $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $subPhaseEmissionResult->save();

    }

    public function updateLandfillSalvageEntries($project_id, $main_phase_id, $sub_phase_id, $data)
    {
        foreach ($data['updated_entries'] as $key => $updatedEntry) {
            if (!UserMaterialEntry::find($updatedEntry['id'])) {
                return response(array(
                    "error" => "Entry Not Found"
                ), 404)->header('Content-Type', 'application/json');
            }
            $entry = UserMaterialEntry::find($updatedEntry['id']);
            $entry->salvage_percentage = $updatedEntry["salvage_percentage"];
            $entry->landfill_percentage = $updatedEntry["landfill_percentage"];
            $entry->salvage_quantity = $updatedEntry["salvage_quantity"];
            $entry->landfill_quantity = $updatedEntry["landfill_quantity"];
            $entry->landfill_location_id = $updatedEntry["landfill_location_id"];
            $entry->landfill_other_location = $updatedEntry["landfill_other_location"];
            $entry->landfill_other_location_distance = $updatedEntry["landfill_other_location_distance"];
            $entry->landfill_distance = $updatedEntry["landfill_distance"];
            $entry->landfill_transport_vehicle_id = $updatedEntry["landfill_transport_vehicle_id"];
            $entry->landfill_co2e = $updatedEntry["landfill_co2e"];
            $entry->salvage_co2e = $updatedEntry["salvage_co2e"];
            $entry->landfill_data = $updatedEntry["landfill_data"];

            $entry->save();

        }

        $subPhaseEmissionResult = ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->first();

        if (null == $subPhaseEmissionResult) {
            $subPhaseEmissionResult = new ProjectSubPhaseEmission();
            $subPhaseEmissionResult->project_id = $project_id;
            $subPhaseEmissionResult->main_phase_id = $main_phase_id;
            $subPhaseEmissionResult->sub_phase_id = $sub_phase_id;
        }

        $subPhaseEmissionResult->machinery_co2_emission = $data['total_machinery_co2e'];
        $subPhaseEmissionResult->material_co2_emission = $data['total_material_co2e'];
        $subPhaseEmissionResult->transport_co2_emission = $data['total_transport_co2e'];
        $subPhaseEmissionResult->total_co2_emission = $data['total_machinery_co2e'] + $data['total_transport_co2e'] + $data['total_material_co2e'];
        $subPhaseEmissionResult->save();
    }

    public function getNumber_format($number)
    {
        return (double)number_format($number, 8, '.', '');
    }

    public function clear_landfill_data(&$entry)
    {
        $entry->salvage_percentage = null;
        $entry->landfill_percentage = 100;
        $entry->salvage_quantity = null;
        $entry->landfill_quantity = null;
        $entry->landfill_location_id = null;
        $entry->landfill_other_location = null;
        $entry->landfill_other_location_distance = null;
        $entry->landfill_distance = null;
        $entry->landfill_transport_vehicle_id = null;
        $entry->landfill_co2e = null;
        $entry->salvage_co2e = null;
        $entry->landfill_data = null;
    }
}

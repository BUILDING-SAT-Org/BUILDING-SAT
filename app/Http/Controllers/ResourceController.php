<?php

namespace App\Http\Controllers;

use App\Models\BsatBuildingForm;
use App\Models\BsatBuildingType;
use App\Models\BsatElectricityType;
use App\Models\BsatEnergyType;
use App\Models\BsatFuelType;
use App\Models\BsatMaterialCategory;
use App\Models\BsatProjectType;
use App\Models\BsatSubPhase;
use App\Models\BsatWasteType;
use App\Models\BsatWaterType;
use App\Models\ProjectType;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Country;
use App\Models\UserMachine;
use App\Models\BsatDifficultyLevel;
use App\Models\BsatDistance;
use App\Models\Location;
use App\Traits\ProjectTrait;
use App\Models\BsatMainPhase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DB;
use Auth;

class ResourceController extends Controller
{
    use ProjectTrait;
    use UtilTrait;

    public function view(Request $request)
    {
        try {
            $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
            if (null == $userProject) {
                return redirect('/dashboard');
            }

            return view('pages.manageResources', ['project_id' => $userProject->id, 'project_life' =>
                $userProject->building_life_expectancy,
                'project_name' => $userProject->name]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function index(Request $request)
    {
        $project = $this->GetProjectByID($request['project_id']);

        $earth_works_id = BsatMainPhase::where('slug', 'earth_works')->first()->id;

        $site_clearance = BsatSubPhase::where([
            ["main_phase_id", "=", $earth_works_id],
            ["slug", "=", 'site_clearance'],
        ])->first();

        $soil_excavation = BsatSubPhase::where([
            ["main_phase_id", "=", $earth_works_id],
            ["slug", "=", 'soil_excavation'],
        ])->first();

        $rock_excavation = BsatSubPhase::where([
            ["main_phase_id", "=", $earth_works_id],
            ["slug", "=", 'rock_excavation'],
        ])->first();


        $site_clearance_difficulty = BsatDifficultyLevel::where('sub_phase_id', $site_clearance->id)->get();
        $soil_excavation_difficulty = BsatDifficultyLevel::where('sub_phase_id', $soil_excavation->id)->get();
        $rock_excavation_difficulty = BsatDifficultyLevel::where('sub_phase_id', $rock_excavation->id)->get();

        $destinations = Location::all()->toArray();
        $distances = BsatDistance::all()->toArray();

        $countries = Country::all()->toArray();

        array_push($distances, array(
            "id" => -1,
            "label" => "Other"
        ));

        $materials = $this->GetAllMaterials($request['project_id']);
        $machines = $this->GetAllMachines($request['project_id']);
        $vehicles = $this->GetAllVehicles($request['project_id']);
        $mortars = $this->GetAllMortarTypes($request['project_id']);

        return json_encode([
            'site_clearance_difficulty' => $site_clearance_difficulty,
            'soil_excavation_difficulty' => $soil_excavation_difficulty,
            'rock_excavation_difficulty' => $rock_excavation_difficulty,
            'destinations' => $destinations,
            'materials' => $materials,
            'mortars' => $mortars,
            'machines' => $machines,
            'vehicles' => $vehicles,
            'distances' => $distances,
            'countries' => $countries
        ]);
    }

    public function indexDashboard(Request $request)
    {
        $locations = Location::all()->toArray();
        $countries = Country::all()->toArray();
        $projectTypes = BsatProjectType::all()->toArray();
        $buildingTypes = BsatBuildingType::all()->toArray();
        $buildingForms = BsatBuildingForm::all()->toArray();

        return json_encode([
            'projectTypes' => $projectTypes,
            'locations' => $locations,
            'countries' => $countries,
            'buildingTypes' => $buildingTypes,
            'buildingForms' => $buildingForms,
        ]);
    }

    public function show(Request $request)
    {
        $startTime = microtime(true);
        $project = $this->GetProjectByID($request['project_id']);

        $mainPhaseSlug = str_replace("-", "_", strtolower($request['main_phase_slug']));

        $locations = Location::all()->toArray();
        $projectTypes = BsatProjectType::all()->toArray();
        $buildingTypes = BsatBuildingType::all()->toArray();
        $buildingForms = BsatBuildingForm::all()->toArray();
        $countries = Country::all()->toArray();

        if ("manage_resources" === $mainPhaseSlug || "results" === $mainPhaseSlug) {
            $material_categories = BsatMaterialCategory::all()->toArray();
            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'countries' => $countries,
                'material_categories' => $material_categories,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        }

        $mainPhase = BsatMainPhase::where('slug', $mainPhaseSlug)->first();
        if (null == $mainPhase) {
            return throw new NotFoundHttpException("An Error Occurred");
        }

        $materials_list = $this->GetAllMaterialsAsList($request['project_id']);
        if ($mainPhaseSlug === "maintenance_and_replacement") {
            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'material_list' => $materials_list,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'countries' => $countries,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        }

        $destinations = BsatDistance::join('locations as d', 'destination_id', '=', 'd.id')
            ->select('bsat_distances.distance as distance', 'bsat_distances.destination_id as id', 'd.label as label')
            ->where('origin_id', $project->location_id)
            ->get()
            ->toArray();

        array_push($destinations, array(
            "id" => -1,
            "label" => "Other"
        ));

        $materials = $this->GetAllMaterials($request['project_id']);
        $machines = $this->GetAllMachines($request['project_id']);
        $vehicles = $this->GetAllVehicles($request['project_id']);

        if ("earth_works" === $mainPhaseSlug) {

            $earth_works_id = BsatMainPhase::where('slug', 'earth_works')->first()->id;

            $site_clearance = BsatSubPhase::where([
                ["main_phase_id", "=", $earth_works_id],
                ["slug", "=", 'site_clearance'],
            ])->first();

            $soil_excavation = BsatSubPhase::where([
                ["main_phase_id", "=", $earth_works_id],
                ["slug", "=", 'soil_excavation'],
            ])->first();

            $rock_excavation = BsatSubPhase::where([
                ["main_phase_id", "=", $earth_works_id],
                ["slug", "=", 'rock_excavation'],
            ])->first();

            $site_clearance_difficulty = BsatDifficultyLevel::where('sub_phase_id', $site_clearance->id)->get();
            $soil_excavation_difficulty = BsatDifficultyLevel::where('sub_phase_id', $soil_excavation->id)->get();
            $rock_excavation_difficulty = BsatDifficultyLevel::where('sub_phase_id', $rock_excavation->id)->get();


            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'site_clearance_difficulty' => $site_clearance_difficulty,
                'soil_excavation_difficulty' => $soil_excavation_difficulty,
                'rock_excavation_difficulty' => $rock_excavation_difficulty,
                'destinations' => $destinations,
                'materials' => $materials,
                'material_list' => $materials_list,
                'machines' => $machines,
                'vehicles' => $vehicles,
                'countries' => $countries,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        } elseif ("construction_site_operations" === $mainPhaseSlug) {

            $electricity_types = BsatElectricityType::orderBy('label', 'ASC')->get();
            $water_types = BsatWaterType::orderBy('label', 'ASC')->get();
            $waste_types = BsatWasteType::orderBy('label', 'ASC')->get();
            $fuel_types = BsatFuelType::orderBy('label', 'ASC')->get();

            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'destinations' => $destinations,
                'materials' => $materials,
                'material_list' => $materials_list,
                'vehicles' => $vehicles,
                'countries' => $countries,
                'electricity_types' => $electricity_types,
                'water_types' => $water_types,
                'waste_types' => $waste_types,
                'fuel_types' => $fuel_types,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        } elseif ("energy_consumption" === $mainPhaseSlug) {

            $electricity_types = BsatElectricityType::orderBy('label', 'ASC')->get();
            $fuel_types = BsatFuelType::orderBy('label', 'ASC')->get();
            $energy_type = BsatEnergyType::orderBy('label', 'ASC')->get();

            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'countries' => $countries,
                'electricity_types' => $electricity_types,
                'energy_types' => $energy_type,
                'fuel_types' => $fuel_types,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        } elseif ("water_consumption" === $mainPhaseSlug) {

            $water_types = BsatWaterType::orderBy('label', 'ASC')->get();

            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'countries' => $countries,
                'water_types' => $water_types,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        } elseif ("demolition_phase" === $mainPhaseSlug) {

            $electricity_types = BsatElectricityType::orderBy('label', 'ASC')->get();
            $fuel_types = BsatFuelType::orderBy('label', 'ASC')->get();

            $chemical_category = BsatMaterialCategory::where('label', 'Adhesives, sealents, chemicals and glues (㎏)')->first();

            $bsatChemicals = [];
            $userChemicals = [];
            if ($chemical_category != null) {
                $bsatChemicals = $chemical_category->materials()->orderBy('label', 'ASC')->get()->toArray();
                $userChemicals = $chemical_category->userMaterials()->where('project_id', $request['project_id'])->get()->toArray();
            }

            $customChemicals = array(
                "id" => "CUS",
                "label" => "Custom",
                "children" => $userChemicals
            );

            array_push($bsatChemicals, $customChemicals);

            return json_encode([
                'time' => number_format(microtime(true) - $startTime, 5),
                'destinations' => $destinations,
                'chemicals' => $bsatChemicals,
                'material_list' => $materials_list,
                'materials' => $materials,
                'electricity_types' => $electricity_types,
                'fuel_types' => $fuel_types,
                'vehicles' => $vehicles,
                'countries' => $countries,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ]);
        } else {

            $mortars = $this->GetAllMortarTypes($request['project_id']);
            $mortars_list = $this->GetAllMortarTypesAsList($request['project_id']);

            $resp = [
                'time' => number_format(microtime(true) - $startTime, 5),
                'destinations' => $destinations,
                'materials' => $materials,
                'material_list' => $materials_list,
                'machines' => $machines,
                'mortars' => $mortars,
                'mortars_list' => $mortars_list,
                'vehicles' => $vehicles,
                'countries' => $countries,
                'projectTypes' => $projectTypes,
                'locations' => $locations,
                'buildingTypes' => $buildingTypes,
                'buildingForms' => $buildingForms,
            ];

            return json_encode($resp);
        }
    }
}

<?php

use App\Http\Controllers\BsatEnergyTypeController;
use App\Http\Controllers\BsatFuelTypeController;
use App\Http\Controllers\BsatMortarController;
use App\Http\Controllers\BsatRecommendationController;
use App\Http\Controllers\ConstructionSiteOperationsController;
use App\Http\Controllers\DemolitionPhaseController;
use App\Http\Controllers\EmissionResultController;
use App\Http\Controllers\EnergyConsumptionController;
use App\Http\Controllers\InternalExternalFinishesController;
use App\Http\Controllers\MaintenanceReplacementController;
use App\Http\Controllers\ProjectRecommendationController;
use App\Http\Controllers\SQlController;
use App\Http\Controllers\SubStructureController;
use App\Http\Controllers\SuperStructureController;
use App\Http\Controllers\WaterConsumptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EarthWorkController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\BuildingTypeController;
use App\Http\Controllers\BuildingFormController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\BsatVehicleController;
use App\Http\Controllers\BsatMachineController;
use App\Http\Controllers\DifficultyLevelController;
use App\Http\Controllers\BsatElectricityTypeController;
use App\Http\Controllers\BsatWaterTypeController;
use App\Http\Controllers\BsatWasteTypeController;
use App\Http\Controllers\BsatMaterialCategoryController;
use App\Http\Controllers\BsatMaterialController;
use App\Http\Controllers\UserMaterialController;
use App\Http\Controllers\UserMachineController;
use App\Http\Controllers\ProjectMainPhaseController;
use App\Http\Controllers\ProjectSubPhaseController;
use App\Http\Controllers\UserVehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/signout', [UserController::class, 'logout_user']);

    Route::get('/', function () {
        return redirect("/dashboard");
    });

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });

    Route::get('/project/{user_id}/{project_id}/earthworks', [EarthWorkController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/sub-structure', [SubStructureController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/super-structure', [SuperStructureController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/maintenance-replacement', [MaintenanceReplacementController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/internal-and-external-finishes', [InternalExternalFinishesController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/construction-site-operations', [ConstructionSiteOperationsController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/energy-consumption', [EnergyConsumptionController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/water-consumption', [WaterConsumptionController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/demolition-phase', [DemolitionPhaseController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/results', [EmissionResultController::class, 'view']);
    Route::get('/project/{user_id}/{project_id}/manage-resources', [ResourceController::class, 'view']);

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/manage-bsat-resources', function () {
            return view('pages.adminManageResources');
        });

    });
});

Route::prefix('api')->group(function () {

    Route::get('/resources/countries', [CountryController::class, 'index']);
    Route::get('/generate/countries', [SQlController::class, 'countries']);

    Route::middleware(['auth'])->group(function () {

        Route::middleware(['role:admin'])->group(function () {


            Route::get('/resources/project-types', [ProjectTypeController::class, 'index']);
            Route::get('/resources/project-types/{id}', [ProjectTypeController::class, 'show']);
            Route::put('/resources/project-types/{id}', [ProjectTypeController::class, 'update']);
            Route::post('/resources/project-types', [ProjectTypeController::class, 'store']);
            Route::delete('/resources/project-types/{id}', [ProjectTypeController::class, 'destroy']);
            Route::post('/resources/project-types/delete', [ProjectTypeController::class, 'destroyBulk']);


            Route::get('/resources/building-types', [BuildingTypeController::class, 'index']);
            Route::get('/resources/building-types/{id}', [BuildingTypeController::class, 'show']);
            Route::put('/resources/building-types/{id}', [BuildingTypeController::class, 'update']);
            Route::post('/resources/building-types', [BuildingTypeController::class, 'store']);
            Route::delete('/resources/building-types/{id}', [BuildingTypeController::class, 'destroy']);
            Route::post('/resources/building-types/delete', [BuildingTypeController::class, 'destroyBulk']);


            Route::get('/resources/building-forms', [BuildingFormController::class, 'index']);
            Route::get('/resources/building-forms/{id}', [BuildingFormController::class, 'show']);
            Route::put('/resources/building-forms/{id}', [BuildingFormController::class, 'update']);
            Route::post('/resources/building-forms', [BuildingFormController::class, 'store']);
            Route::delete('/resources/building-forms/{id}', [BuildingFormController::class, 'destroy']);
            Route::post('/resources/building-forms/delete', [BuildingFormController::class, 'destroyBulk']);


            Route::get('/resources/difficulty-levels', [DifficultyLevelController::class, 'index']);
            Route::get('/resources/difficulty-levels/{id}', [DifficultyLevelController::class, 'show']);
            Route::get('/resources/difficulty-levels/{main_phase_slug}/sub-phases', [DifficultyLevelController::class, 'showSubPhases']);
            Route::put('/resources/difficulty-levels/{id}', [DifficultyLevelController::class, 'update']);
            Route::post('/resources/difficulty-levels', [DifficultyLevelController::class, 'store']);
            Route::delete('/resources/difficulty-levels/{id}', [DifficultyLevelController::class, 'destroy']);
            Route::post('/resources/difficulty-levels/delete', [DifficultyLevelController::class, 'destroyBulk']);


            Route::get('/resources/locations', [LocationController::class, 'index']);
            Route::get('/resources/locations/{id}', [LocationController::class, 'show']);
            Route::put('/resources/locations/{id}', [LocationController::class, 'update']);
            Route::post('/resources/locations', [LocationController::class, 'store']);
            Route::delete('/resources/locations/{id}', [LocationController::class, 'destroy']);
            Route::post('/resources/locations/delete', [LocationController::class, 'destroyBulk']);


            Route::get('/resources/distances', [DistanceController::class, 'index']);
            Route::get('/resources/distances/{id}', [DistanceController::class, 'show']);
            Route::put('/resources/distances/{id}', [DistanceController::class, 'update']);
            Route::post('/resources/distances', [DistanceController::class, 'store']);
            Route::delete('/resources/distances/{id}', [DistanceController::class, 'destroy']);
            Route::post('/resources/distances/delete', [DistanceController::class, 'destroyBulk']);


            Route::get('/resources/vehicles', [BsatVehicleController::class, 'index']);
            Route::get('/resources/vehicles/{id}', [BsatVehicleController::class, 'show']);
            Route::put('/resources/vehicles/{id}', [BsatVehicleController::class, 'update']);
            Route::post('/resources/vehicles', [BsatVehicleController::class, 'store']);
            Route::delete('/resources/vehicles/{id}', [BsatVehicleController::class, 'destroy']);
            Route::post('/resources/vehicles/delete', [BsatVehicleController::class, 'destroyBulk']);


            Route::get('/resources/machines', [BsatMachineController::class, 'index']);
            Route::get('/resources/machines/{id}', [BsatMachineController::class, 'show']);
            Route::put('/resources/machines/{id}', [BsatMachineController::class, 'update']);
            Route::post('/resources/machines', [BsatMachineController::class, 'store']);
            Route::delete('/resources/machines/{id}', [BsatMachineController::class, 'destroy']);
            Route::post('/resources/machines/delete', [BsatMachineController::class, 'destroyBulk']);


            Route::get('/resources/countries/{id}', [CountryController::class, 'show']);
            Route::put('/resources/countries/{id}', [CountryController::class, 'update']);
            Route::post('/resources/countries', [CountryController::class, 'store']);
            Route::delete('/resources/countries/{id}', [CountryController::class, 'destroy']);
            Route::post('/resources/countries/delete', [CountryController::class, 'destroyBulk']);


            Route::get('/resources/electricity-types', [BsatElectricityTypeController::class, 'index']);
            Route::get('/resources/electricity-types/{id}', [BsatElectricityTypeController::class, 'show']);
            Route::put('/resources/electricity-types/{id}', [BsatElectricityTypeController::class, 'update']);
            Route::post('/resources/electricity-types', [BsatElectricityTypeController::class, 'store']);
            Route::delete('/resources/electricity-types/{id}', [BsatElectricityTypeController::class, 'destroy']);
            Route::post('/resources/electricity-types/delete', [BsatElectricityTypeController::class, 'destroyBulk']);


            Route::get('/resources/water-types', [BsatWaterTypeController::class, 'index']);
            Route::get('/resources/water-types/{id}', [BsatWaterTypeController::class, 'show']);
            Route::put('/resources/water-types/{id}', [BsatWaterTypeController::class, 'update']);
            Route::post('/resources/water-types', [BsatWaterTypeController::class, 'store']);
            Route::delete('/resources/water-types/{id}', [BsatWaterTypeController::class, 'destroy']);
            Route::post('/resources/water-types/delete', [BsatWaterTypeController::class, 'destroyBulk']);


            Route::get('/resources/waste-types', [BsatWasteTypeController::class, 'index']);
            Route::get('/resources/waste-types/{id}', [BsatWasteTypeController::class, 'show']);
            Route::put('/resources/waste-types/{id}', [BsatWasteTypeController::class, 'update']);
            Route::post('/resources/waste-types', [BsatWasteTypeController::class, 'store']);
            Route::delete('/resources/waste-types/{id}', [BsatWasteTypeController::class, 'destroy']);
            Route::post('/resources/waste-types/delete', [BsatWasteTypeController::class, 'destroyBulk']);


            Route::get('/resources/categories', [BsatMaterialCategoryController::class, 'index']);
            Route::get('/resources/categories/{id}', [BsatMaterialCategoryController::class, 'show']);
            Route::put('/resources/categories/{id}', [BsatMaterialCategoryController::class, 'update']);
            Route::post('/resources/categories', [BsatMaterialCategoryController::class, 'store']);
            Route::delete('/resources/categories/{id}', [BsatMaterialCategoryController::class, 'destroy']);
            Route::post('/resources/categories/delete', [BsatMaterialCategoryController::class, 'destroyBulk']);


            Route::get('/resources/fuel-types', [BsatFuelTypeController::class, 'index']);
            Route::get('/resources/fuel-types/{id}', [BsatFuelTypeController::class, 'show']);
            Route::put('/resources/fuel-types/{id}', [BsatFuelTypeController::class, 'update']);
            Route::post('/resources/fuel-types', [BsatFuelTypeController::class, 'store']);
            Route::delete('/resources/fuel-types/{id}', [BsatFuelTypeController::class, 'destroy']);
            Route::post('/resources/fuel-types/delete', [BsatFuelTypeController::class, 'destroyBulk']);


            Route::get('/resources/energy-types', [BsatEnergyTypeController::class, 'index']);
            Route::get('/resources/energy-types/{id}', [BsatEnergyTypeController::class, 'show']);
            Route::put('/resources/energy-types/{id}', [BsatEnergyTypeController::class, 'update']);
            Route::post('/resources/energy-types', [BsatEnergyTypeController::class, 'store']);
            Route::delete('/resources/energy-types/{id}', [BsatEnergyTypeController::class, 'destroy']);
            Route::post('/resources/energy-types/delete', [BsatEnergyTypeController::class, 'destroyBulk']);


            Route::get('/resources/materials', [BsatMaterialController::class, 'index']);
            Route::get('/resources/materials/{id}', [BsatMaterialController::class, 'show']);
            Route::put('/resources/materials/{id}', [BsatMaterialController::class, 'update']);
            Route::post('/resources/materials', [BsatMaterialController::class, 'store']);
            Route::delete('/resources/materials/{id}', [BsatMaterialController::class, 'destroy']);
            Route::post('/resources/materials/delete', [BsatMaterialController::class, 'destroyBulk']);


            Route::get('/resources/mortars', [BsatMortarController::class, 'index']);
            Route::get('/resources/mortars/{id}', [BsatMortarController::class, 'show']);
            Route::put('/resources/mortars/{id}', [BsatMortarController::class, 'update']);
            Route::post('/resources/mortars', [BsatMortarController::class, 'store']);
            Route::delete('/resources/mortars/{id}', [BsatMortarController::class, 'destroy']);
            Route::post('/resources/mortars/delete', [BsatMortarController::class, 'destroyBulk']);


            Route::get('/project-phases', [ProjectMainPhaseController::class, 'index']);
            Route::get('/project-phases/{id}', [ProjectMainPhaseController::class, 'show']);
            Route::put('/project-phases/{id}', [ProjectMainPhaseController::class, 'update']);
            Route::post('/project-phases', [ProjectMainPhaseController::class, 'store']);
            Route::delete('/project-phases/{id}', [ProjectMainPhaseController::class, 'destroy']);
            Route::post('/project-phases/delete', [ProjectMainPhaseController::class, 'destroyBulk']);


            Route::get('/project-sub-phases', [ProjectSubPhaseController::class, 'index']);
            Route::get('/project-sub-phases/{id}', [ProjectSubPhaseController::class, 'show']);
            Route::put('/project-sub-phases/{id}', [ProjectSubPhaseController::class, 'update']);
            Route::post('/project-sub-phases', [ProjectSubPhaseController::class, 'store']);
            Route::delete('/project-sub-phases/{id}', [ProjectSubPhaseController::class, 'destroy']);
            Route::post('/project-sub-phases/delete', [ProjectSubPhaseController::class, 'destroyBulk']);


            Route::get('/resources/recommendations/{id}', [BsatRecommendationController::class, 'show']);
            Route::put('/resources/recommendations/{id}', [BsatRecommendationController::class, 'update']);
            Route::post('/resources/recommendations', [BsatRecommendationController::class, 'store']);
            Route::delete('/resources/recommendations/{id}', [BsatRecommendationController::class, 'destroy']);
            Route::post('/resources/recommendations/delete', [BsatRecommendationController::class, 'destroyBulk']);
        });


        Route::get('/projects/{project_id}/resources/materials', [UserMaterialController::class, 'index']);
        Route::get('/projects/{project_id}/resources/materials/{id}', [UserMaterialController::class, 'show']);
        Route::put('/projects/{project_id}/resources/materials/{id}', [UserMaterialController::class, 'update']);
        Route::post('/projects/{project_id}/resources/materials', [UserMaterialController::class, 'store']);
        Route::delete('/projects/{project_id}/resources/materials/{id}', [UserMaterialController::class, 'destroy']);
        Route::post('/projects/{project_id}/resources/materials/delete', [UserMaterialController::class, 'destroyBulk']);


        Route::get('/projects/{project_id}/resources/machines', [UserMachineController::class, 'index']);
        Route::get('/projects/{project_id}/resources/machines/{id}', [UserMachineController::class, 'show']);
        Route::put('/projects/{project_id}/resources/machines/{id}', [UserMachineController::class, 'update']);
        Route::post('/projects/{project_id}/resources/machines', [UserMachineController::class, 'store']);
        Route::delete('/projects/{project_id}/resources/machines/{id}', [UserMachineController::class, 'destroy']);
        Route::post('/projects/{project_id}/resources/machines/delete', [UserMachineController::class, 'destroyBulk']);


        Route::get('/projects/{project_id}/resources/vehicles', [UserVehicleController::class, 'index']);
        Route::get('/projects/{project_id}/resources/vehicles/{id}', [UserVehicleController::class, 'show']);
        Route::put('/projects/{project_id}/resources/vehicles/{id}', [UserVehicleController::class, 'update']);
        Route::post('/projects/{project_id}/resources/vehicles', [UserVehicleController::class, 'store']);
        Route::delete('/projects/{project_id}/resources/vehicles/{id}', [UserVehicleController::class, 'destroy']);
        Route::post('/projects/{project_id}/resources/vehicles/delete', [UserVehicleController::class, 'destroyBulk']);


        Route::get('/projects/{project_id}/resources/recommendations', [ProjectRecommendationController::class, 'index']);
        Route::post('/projects/{project_id}/resources/recommendations', [ProjectRecommendationController::class, 'store']);
        Route::delete('/projects/{project_id}/resources/recommendations/{id}', [ProjectRecommendationController::class, 'destroy']);


        Route::get('/projects', [ProjectController::class, 'index']);
        Route::get('/projects/{project_id}', [ProjectController::class, 'show']);
        Route::put('/projects/{project_id}', [ProjectController::class, 'update']);
        Route::post('/projects/{project_id}/put', [ProjectController::class, 'update']);
        Route::post('/projects', [ProjectController::class, 'store']);
        Route::delete('/projects/{project_id}', [ProjectController::class, 'destroy']);
        Route::post('/projects/delete', [ProjectController::class, 'destroyBulk']);


        Route::get('/resources/dashboard', [ResourceController::class, 'indexDashboard']);
        Route::get('/resources/{project_id}/{main_phase_slug}', [ResourceController::class, 'show']);


        Route::get('/earthwork-entries/{project_id}', [EarthWorkController::class, 'index']);
        Route::get('/earthwork-entries/{project_id}/{id}', [EarthWorkController::class, 'show']);
        Route::post('/earthwork-entries/{project_id}', [EarthWorkController::class, 'store']);
        Route::delete('/earthwork-entries/{project_id}/{id}', [EarthWorkController::class, 'destroy']);

        Route::get('/earthwork-entries/{project_id}/entries/{sub_phase_slug}', [EarthWorkController::class, 'showSubPhase']);


        Route::get('/sub-structure-entries/{project_id}', [SubStructureController::class, 'index']);
        Route::post('/sub-structure-entries/{project_id}', [SubStructureController::class, 'store']);
        Route::delete('/sub-structure-entries/{project_id}/{sub_phase_slug}/{id}', [SubStructureController::class, 'destroy']);


        Route::get('/super-structure-entries/{project_id}', [SuperStructureController::class, 'index']);
        Route::post('/super-structure-entries/{project_id}', [SuperStructureController::class, 'store']);
        Route::delete('/super-structure-entries/{project_id}/{sub_phase_slug}/{id}', [SuperStructureController::class, 'destroy']);


        Route::get('/internal-and-external-finishes-entries/{project_id}', [InternalExternalFinishesController::class, 'index']);
        Route::post('/internal-and-external-finishes-entries/{project_id}', [InternalExternalFinishesController::class, 'store']);
        Route::delete('/internal-and-external-finishes-entries/{project_id}/{sub_phase_slug}/{id}', [InternalExternalFinishesController::class, 'destroy']);


        Route::get('/construction-site-operation-entries/{project_id}', [ConstructionSiteOperationsController::class, 'index']);
        Route::post('/construction-site-operation-entries/{project_id}', [ConstructionSiteOperationsController::class, 'store']);
        Route::delete('/construction-site-operation-entries/{project_id}/{sub_phase_slug}/{id}', [ConstructionSiteOperationsController::class, 'destroy']);


        Route::get('/energy-consumption-entries/{project_id}', [EnergyConsumptionController::class, 'index']);
        Route::post('/energy-consumption-entries/{project_id}', [EnergyConsumptionController::class, 'store']);
        Route::delete('/energy-consumption-entries/{project_id}/{sub_phase_slug}/{id}', [EnergyConsumptionController::class, 'destroy']);


        Route::get('/water-consumption-entries/{project_id}', [WaterConsumptionController::class, 'index']);
        Route::post('/water-consumption-entries/{project_id}', [WaterConsumptionController::class, 'store']);
        Route::delete('/water-consumption-entries/{project_id}/{sub_phase_slug}/{id}', [WaterConsumptionController::class, 'destroy']);


        Route::get('/demolition-phase-entries/{project_id}', [DemolitionPhaseController::class, 'index']);
        Route::post('/demolition-phase-entries/{project_id}', [DemolitionPhaseController::class, 'store']);
        Route::delete('/demolition-phase-entries/{project_id}/{sub_phase_slug}/{id}', [DemolitionPhaseController::class, 'destroy']);


        Route::get('/maintenance-replacement/{project_id}', [MaintenanceReplacementController::class, 'index']);
        Route::post('/maintenance-replacement/{project_id}', [MaintenanceReplacementController::class, 'store']);


        Route::get('/results/{project_id}', [EmissionResultController::class, 'index']);
        Route::get('/results/{project_id}/{main_phase_slug}', [EmissionResultController::class, 'show']);
        Route::get('/results/{project_id}/{main_phase_slug}/type/{type}', [EmissionResultController::class, 'showType']);
        Route::get('/results/{project_id}/{main_phase_slug}/{sub_phase_slug}', [EmissionResultController::class, 'showSubPhase']);


        Route::get('/resources/recommendations', [BsatRecommendationController::class, 'index']);
    });
});

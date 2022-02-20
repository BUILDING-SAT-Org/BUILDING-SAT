<?php

namespace App\Http\Controllers;

use App\Models\BsatMainPhase;
use App\Models\BsatSubPhase;
use App\Models\ProjectSubPhaseEmission;
use App\Traits\ProjectTrait;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Auth;

class EmissionResultController extends Controller
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

            return view('pages.results', ['project_id' => $userProject->id, 'project_life' =>
                $userProject->building_life_expectancy,
                'project_name' => $userProject->name]);

        } catch (\Throwable $th) {
            return redirect('/dashboard');
        }
    }

    public function index(Request $request)
    {

        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return redirect('/dashboard');
        }

        $main_phases = [
            "earth_works",
            "sub_structure",
            "super_structure",
            "internal_and_external_finishes",
            "construction_site_operations",
            "energy_consumption",
            "water_consumption",
            "maintenance_and_replacement",
            "demolition_phase"
        ];

        $bsat_main_phases = BsatMainPhase::all();

        $project_emissions = ProjectSubPhaseEmission::join('bsat_main_phases', 'main_phase_id', '=', 'bsat_main_phases.id')
            ->where('project_id', $request['project_id'])->get();

        $emissions = array();
        $chart = array();
        $construction_subPhase_labels = array();
        $construction_subPhase_co2e_machinery = array();
        $construction_subPhase_co2e_transport = array();
        $construction_subPhase_co2e_material = array();
        $construction_subPhase_co2e_energy = array();
        $construction_subPhase_co2e_water = array();
        $construction_subPhase_co2e_total = array();

        $operation_subPhase_labels = array();
        $operation_subPhase_co2e_machinery = array();
        $operation_subPhase_co2e_transport = array();
        $operation_subPhase_co2e_material = array();
        $operation_subPhase_co2e_energy = array();
        $operation_subPhase_co2e_water = array();
        $operation_subPhase_co2e_total = array();

        $demolition_subPhase_labels = array();
        $demolition_subPhase_co2e_machinery = array();
        $demolition_subPhase_co2e_transport = array();
        $demolition_subPhase_co2e_material = array();
        $demolition_subPhase_co2e_energy = array();
        $demolition_subPhase_co2e_water = array();
        $demolition_subPhase_co2e_total = array();

        $construction_total_machinery_co2e = 0;
        $construction_total_transport_co2e = 0;
        $construction_total_material_co2e = 0;
        $construction_total_energy_co2e = 0;
        $construction_total_water_co2e = 0;
        $construction_total_co2e = 0;

        $operation_total_machinery_co2e = 0;
        $operation_total_transport_co2e = 0;
        $operation_total_material_co2e = 0;
        $operation_total_energy_co2e = 0;
        $operation_total_water_co2e = 0;
        $operation_total_co2e = 0;

        $demolition_total_machinery_co2e = 0;
        $demolition_total_transport_co2e = 0;
        $demolition_total_material_co2e = 0;
        $demolition_total_energy_co2e = 0;
        $demolition_total_water_co2e = 0;
        $demolition_total_co2e = 0;

        foreach ($main_phases as $key => $main_phase_slug) {
            $total_machinery_co2e = 0;
            $total_material_co2e = 0;
            $total_transport_co2e = 0;
            $total_energy_co2e = 0;
            $total_water_co2e = 0;
            $total_co2e = 0;
            $main_phase_name = $this->filterCollectionMainPhase($bsat_main_phases, $main_phase_slug)->first()->name;

            $project_emissions = $project_emissions->filter(function ($value, $key) use (
                $main_phase_slug,
                &$total_machinery_co2e,
                &$total_material_co2e,
                &$total_transport_co2e,
                &$total_energy_co2e,
                &$total_water_co2e,
                &$total_co2e,
                &$main_phase_name
            ) {

                if ($value->slug == $main_phase_slug) {

                    if (null == $main_phase_name) {
                        $main_phase_name = $value->name;
                    }
                    $total_machinery_co2e = $total_machinery_co2e + $value->machinery_co2_emission;
                    $total_material_co2e = $total_material_co2e + $value->material_co2_emission;
                    $total_transport_co2e = $total_transport_co2e + $value->transport_co2_emission;
                    $total_energy_co2e = $total_energy_co2e + $value->energy_co2_emission;
                    $total_water_co2e = $total_water_co2e + $value->water_co2_emission;
                    $total_co2e = $total_co2e + $value->total_co2_emission;
                } else {
                    return true;
                }
            });

            $total_machinery_co2e = $this->getNumber_format($total_machinery_co2e);
            $total_material_co2e = $this->getNumber_format($total_material_co2e);
            $total_transport_co2e = $this->getNumber_format($total_transport_co2e);
            $total_energy_co2e = $this->getNumber_format($total_energy_co2e);
            $total_water_co2e = $this->getNumber_format($total_water_co2e);
            $total_co2e = $this->getNumber_format($total_co2e);

            $emissions[$main_phase_slug] = [
                "count" => $project_emissions->count(),
                "main_phase" => $main_phase_slug,
                "label" => $main_phase_name,
                "total_machinery_co2e" => $this->getNumber_format_result($total_machinery_co2e),
                "total_material_co2e" => $this->getNumber_format_result($total_material_co2e),
                "total_transport_co2e" => $this->getNumber_format_result($total_transport_co2e),
                "total_energy_co2e" => $this->getNumber_format_result($total_energy_co2e),
                "total_water_co2e" => $this->getNumber_format_result($total_water_co2e),
                "total_co2e" => $this->getNumber_format_result($total_co2e),
            ];

            if ($main_phase_slug === "earth_works" ||
                $main_phase_slug === "sub_structure" ||
                $main_phase_slug === "super_structure" ||
                $main_phase_slug === "internal_and_external_finishes" ||
                $main_phase_slug === "construction_site_operations") {

                array_push($construction_subPhase_labels, $main_phase_name);
                array_push($construction_subPhase_co2e_machinery, $total_machinery_co2e);
                array_push($construction_subPhase_co2e_transport, $total_transport_co2e);
                array_push($construction_subPhase_co2e_material, $total_material_co2e);
                array_push($construction_subPhase_co2e_energy, $total_energy_co2e);
                array_push($construction_subPhase_co2e_water, $total_water_co2e);
                array_push($construction_subPhase_co2e_total, $total_co2e);

                $construction_total_machinery_co2e = $construction_total_machinery_co2e + $total_machinery_co2e;
                $construction_total_transport_co2e = $construction_total_transport_co2e + $total_transport_co2e;
                $construction_total_material_co2e = $construction_total_material_co2e + $total_material_co2e;
                $construction_total_energy_co2e = $construction_total_energy_co2e + $total_energy_co2e;
                $construction_total_water_co2e = $construction_total_water_co2e + $total_water_co2e;
                $construction_total_co2e = $construction_total_co2e + $total_co2e;

            } elseif ($main_phase_slug === "energy_consumption" || $main_phase_slug === "water_consumption" ||
                $main_phase_slug === "maintenance_and_replacement") {

                array_push($operation_subPhase_labels, $main_phase_name);
                array_push($operation_subPhase_co2e_machinery, $total_machinery_co2e);
                array_push($operation_subPhase_co2e_transport, $total_transport_co2e);
                array_push($operation_subPhase_co2e_material, $total_material_co2e);
                array_push($operation_subPhase_co2e_energy, $total_energy_co2e);
                array_push($operation_subPhase_co2e_water, $total_water_co2e);
                array_push($operation_subPhase_co2e_total, $total_co2e);

                $operation_total_machinery_co2e = $operation_total_machinery_co2e + $total_machinery_co2e;
                $operation_total_transport_co2e = $operation_total_transport_co2e + $total_transport_co2e;
                $operation_total_material_co2e = $operation_total_material_co2e + $total_material_co2e;
                $operation_total_energy_co2e = $operation_total_energy_co2e + $total_energy_co2e;
                $operation_total_water_co2e = $operation_total_water_co2e + $total_water_co2e;
                $operation_total_co2e = $operation_total_co2e + $total_co2e;

            } elseif ($main_phase_slug === "demolition_phase") {

                array_push($demolition_subPhase_labels, $main_phase_name);
                array_push($demolition_subPhase_co2e_machinery, $total_machinery_co2e);
                array_push($demolition_subPhase_co2e_transport, $total_transport_co2e);
                array_push($demolition_subPhase_co2e_material, $total_material_co2e);
                array_push($demolition_subPhase_co2e_energy, $total_energy_co2e);
                array_push($demolition_subPhase_co2e_water, $total_water_co2e);
                array_push($demolition_subPhase_co2e_total, $total_co2e);

                $demolition_total_machinery_co2e = $demolition_total_machinery_co2e + $total_machinery_co2e;
                $demolition_total_transport_co2e = $demolition_total_transport_co2e + $total_transport_co2e;
                $demolition_total_material_co2e = $demolition_total_material_co2e + $total_material_co2e;
                $demolition_total_energy_co2e = $demolition_total_energy_co2e + $total_energy_co2e;
                $demolition_total_water_co2e = $demolition_total_water_co2e + $total_water_co2e;
                $demolition_total_co2e = $demolition_total_co2e + $total_co2e;
            }
        }

        $resp["tables"] = [
            "construction_phase" => [
                $emissions["earth_works"],
                $emissions["sub_structure"],
                $emissions["super_structure"],
                $emissions["internal_and_external_finishes"],
                $emissions["construction_site_operations"]
            ],
            "operation_phase" => [
                $emissions["energy_consumption"],
                $emissions["water_consumption"],
                $emissions["maintenance_and_replacement"]
            ],
            "demolition_phase" => [
                $emissions["demolition_phase"]
            ]
        ];

        $resp["charts"] = [
            "construction_phase" => [
                "labels" => $construction_subPhase_labels,
                "co2e_machinery" => $construction_subPhase_co2e_machinery,
                "co2e_transport" => $construction_subPhase_co2e_transport,
                "co2e_material" => $construction_subPhase_co2e_material,
                "co2e_energy" => $construction_subPhase_co2e_energy,
                "co2e_water" => $construction_subPhase_co2e_water,
                "co2e_total" => $construction_subPhase_co2e_total,
            ],
            "operation_phase" => [
                "labels" => $operation_subPhase_labels,
                "co2e_machinery" => $operation_subPhase_co2e_machinery,
                "co2e_transport" => $operation_subPhase_co2e_transport,
                "co2e_material" => $operation_subPhase_co2e_material,
                "co2e_energy" => $operation_subPhase_co2e_energy,
                "co2e_water" => $operation_subPhase_co2e_water,
                "co2e_total" => $operation_subPhase_co2e_total,
            ],
            "demolition_phase" => [
                "labels" => $demolition_subPhase_labels,
                "co2e_machinery" => $demolition_subPhase_co2e_machinery,
                "co2e_transport" => $demolition_subPhase_co2e_transport,
                "co2e_material" => $demolition_subPhase_co2e_material,
                "co2e_energy" => $demolition_subPhase_co2e_energy,
                "co2e_water" => $demolition_subPhase_co2e_water,
                "co2e_total" => $demolition_subPhase_co2e_total,
            ]
        ];

        $construction_total_machinery_co2e = $this->getNumber_format($construction_total_machinery_co2e);
        $construction_total_transport_co2e = $this->getNumber_format($construction_total_transport_co2e);
        $construction_total_material_co2e = $this->getNumber_format($construction_total_material_co2e);
        $construction_total_energy_co2e = $this->getNumber_format($construction_total_energy_co2e);
        $construction_total_water_co2e = $this->getNumber_format($construction_total_water_co2e);
        $construction_total_co2e = $this->getNumber_format($construction_total_co2e);

        $operation_total_machinery_co2e = $this->getNumber_format($operation_total_machinery_co2e);
        $operation_total_transport_co2e = $this->getNumber_format($operation_total_transport_co2e);
        $operation_total_material_co2e = $this->getNumber_format($operation_total_material_co2e);
        $operation_total_energy_co2e = $this->getNumber_format($operation_total_energy_co2e);
        $operation_total_water_co2e = $this->getNumber_format($operation_total_water_co2e);
        $operation_total_co2e = $this->getNumber_format($operation_total_co2e);

        $demolition_total_machinery_co2e = $this->getNumber_format($demolition_total_machinery_co2e);
        $demolition_total_transport_co2e = $this->getNumber_format($demolition_total_transport_co2e);
        $demolition_total_material_co2e = $this->getNumber_format($demolition_total_material_co2e);
        $demolition_total_energy_co2e = $this->getNumber_format($demolition_total_energy_co2e);
        $demolition_total_water_co2e = $this->getNumber_format($demolition_total_water_co2e);
        $demolition_total_co2e = $this->getNumber_format($demolition_total_co2e);

        $project_co2e = $construction_total_co2e + $operation_total_co2e + $demolition_total_co2e;
        $project_machinery_co2e = $construction_total_machinery_co2e + $operation_total_machinery_co2e + $demolition_total_machinery_co2e;
        $project_transport_co2e = $construction_total_transport_co2e + $operation_total_transport_co2e + $demolition_total_transport_co2e;
        $project_material_co2e = $construction_total_material_co2e + $operation_total_material_co2e + $demolition_total_material_co2e;
        $project_energy_co2e = $construction_total_energy_co2e + $operation_total_energy_co2e +
            $demolition_total_energy_co2e;
        $project_water_co2e = $construction_total_water_co2e + $operation_total_water_co2e +
            $demolition_total_water_co2e;

        $summary_table = [
            [
                "label" => "Construction Phase",
                "total_machinery_co2e" => $this->getNumber_format_result($construction_total_machinery_co2e),
                "total_transport_co2e" => $this->getNumber_format_result($construction_total_transport_co2e),
                "total_material_co2e" => $this->getNumber_format_result($construction_total_material_co2e),
                "total_energy_co2e" => $this->getNumber_format_result($construction_total_energy_co2e),
                "total_water_co2e" => $this->getNumber_format_result($construction_total_water_co2e),
                "total_co2e" => $this->getNumber_format_result($construction_total_co2e)
            ],
            [
                "label" => "Operation Phase",
                "total_machinery_co2e" => $this->getNumber_format_result($operation_total_machinery_co2e),
                "total_transport_co2e" => $this->getNumber_format_result($operation_total_transport_co2e),
                "total_material_co2e" => $this->getNumber_format_result($operation_total_material_co2e),
                "total_energy_co2e" => $this->getNumber_format_result($operation_total_energy_co2e),
                "total_water_co2e" => $this->getNumber_format_result($operation_total_water_co2e),
                "total_co2e" => $this->getNumber_format_result($operation_total_co2e),
            ],
            [
                "label" => "Demolition Phase",
                "total_machinery_co2e" => $this->getNumber_format_result($demolition_total_machinery_co2e),
                "total_transport_co2e" => $this->getNumber_format_result($demolition_total_transport_co2e),
                "total_material_co2e" => $this->getNumber_format_result($demolition_total_material_co2e),
                "total_energy_co2e" => $this->getNumber_format_result($demolition_total_energy_co2e),
                "total_water_co2e" => $this->getNumber_format_result($demolition_total_water_co2e),
                "total_co2e" => $this->getNumber_format_result($demolition_total_co2e),
            ]
        ];

        $summary_chart = [
            "labels" => ["Construction Phase", "Operation Phase", "Demolition Phase"],
            "co2e_machinery" => [
                $construction_total_machinery_co2e,
                $operation_total_machinery_co2e,
                $demolition_total_machinery_co2e
            ],
            "co2e_transport" => [
                $construction_total_transport_co2e,
                $operation_total_transport_co2e,
                $demolition_total_transport_co2e
            ],
            "co2e_material" => [
                $construction_total_material_co2e,
                $operation_total_material_co2e,
                $demolition_total_material_co2e
            ],
            "co2e_energy" => [
                $construction_total_energy_co2e,
                $operation_total_energy_co2e,
                $demolition_total_energy_co2e
            ],
            "co2e_water" => [
                $construction_total_water_co2e,
                $operation_total_water_co2e,
                $demolition_total_water_co2e
            ],
            "co2e_total" => [
                $construction_total_co2e,
                $operation_total_co2e,
                $demolition_total_co2e
            ],
        ];

        $resp["summary"] = [
            "summary" => [
                "project_co2e" => $this->getNumber_format_result($project_co2e),
                "project_machinery_co2e" => $this->getNumber_format_result($project_machinery_co2e),
                "project_transport_co2e" => $this->getNumber_format_result($project_transport_co2e),
                "project_material_co2e" => $this->getNumber_format_result($project_material_co2e),
                "project_energy_co2e" => $this->getNumber_format_result($project_energy_co2e),
                "project_water_co2e" => $this->getNumber_format_result($project_water_co2e),
                "co2e_m2" => $this->getNumber_format_result($project_co2e / $userProject->ground_floor_area /
                    $userProject->building_life_expectancy)
            ],
            "table" => $summary_table,
            "chart" => $summary_chart
        ];

        return response()->json($resp, 202);

    }

    public function show(Request $request): \Illuminate\Http\JsonResponse
    {
        $main_phase_slug = $this->slugify($request['main_phase_slug']);
        $bsatMainPhase = BsatMainPhase::where('slug', $main_phase_slug)->first();

        if ($bsatMainPhase->slug === "maintenance_and_replacement") {

            $maintenance_material_co2e = 0;
            $emissions = $bsatMainPhase->emissionResults()->where('project_id', $request['project_id'])->get();

            foreach ($emissions as $key => $emission) {
                $maintenance_material_co2e = $maintenance_material_co2e + $emission->material_co2_emission;
            }
            $maintenance_material_co2e = $this->getNumber_format($maintenance_material_co2e);

            $data = array(
                "table" => [[
                    "id" => $bsatMainPhase->id,
                    "material_co2_emission" => $maintenance_material_co2e,
                    "machinery_co2_emission" => 0,
                    "transport_co2_emission" => 0,
                    "energy_co2_emission" => 0,
                    "water_co2_emission" => 0,
                    "total_co2_emission" => $maintenance_material_co2e,
                    "sub_phase" => "Maintenance And Replacement",
                ]],
                "chart" => [
                    "slugs" => ["maintenance_and_replacement"],
                    "labels" => [$bsatMainPhase->name],
                    "co2e_machinery" => [0],
                    "co2e_transport" => [0],
                    "energy_co2_emission" => [0],
                    "water_co2_emission" => [0],
                    "co2e_material" => [$maintenance_material_co2e],
                    "co2e_total" => [$maintenance_material_co2e],
                ]
            );

            return response()->json($data, 202);
        }

        $subPhases = $bsatMainPhase->subPhases()->get();
        $results = array();
        $subPhase_labels = array();
        $subPhase_slugs = array();
        $subPhase_co2e_machinery = array();
        $subPhase_co2e_transport = array();
        $subPhase_co2e_material = array();
        $subPhase_co2e_energy = array();
        $subPhase_co2e_water = array();
        $subPhase_co2e_total = array();
        foreach ($subPhases as $key => $subPhase) {
            $subPhaseResult = $subPhase->emissionResults()->where('project_id', $request['project_id'])->first();

            if (null != $subPhaseResult) {
                array_push($subPhase_labels, $subPhase->name);
                array_push($subPhase_slugs, $subPhase->slug);
                array_push($subPhase_co2e_machinery, $subPhaseResult->machinery_co2_emission);
                array_push($subPhase_co2e_transport, $subPhaseResult->transport_co2_emission);
                array_push($subPhase_co2e_material, $subPhaseResult->material_co2_emission);
                array_push($subPhase_co2e_energy, $subPhaseResult->energy_co2_emission);
                array_push($subPhase_co2e_water, $subPhaseResult->water_co2_emission);
                array_push($subPhase_co2e_total, $subPhaseResult->total_co2_emission);

                $results[$subPhase->slug] = [
                    "sub_phase" => $subPhase->name,
                    "machinery_co2_emission" => $this->getNumber_format_result($subPhaseResult->machinery_co2_emission),
                    "transport_co2_emission" => $this->getNumber_format_result($subPhaseResult->transport_co2_emission),
                    "material_co2_emission" => $this->getNumber_format_result($subPhaseResult->material_co2_emission),
                    "energy_co2_emission" => $this->getNumber_format_result($subPhaseResult->energy_co2_emission),
                    "water_co2_emission" => $this->getNumber_format_result($subPhaseResult->water_co2_emission),
                    "total_co2_emission" => $this->getNumber_format_result($subPhaseResult->total_co2_emission),
                ];
            }

        }

        $data = array(
            "table" => $this->orderResults($main_phase_slug, $results),
            "chart" => array(
                "slugs" => $subPhase_slugs,
                "labels" => $subPhase_labels,
                "co2e_machinery" => $subPhase_co2e_machinery,
                "co2e_transport" => $subPhase_co2e_transport,
                "co2e_material" => $subPhase_co2e_material,
                "co2e_energy" => $subPhase_co2e_energy,
                "co2e_water" => $subPhase_co2e_water,
                "co2e_total" => $subPhase_co2e_total,
            )
        );

        return response()->json($data, 202);
    }

    public function showType(Request $request): \Illuminate\Http\JsonResponse
    {
        $main_phase_slug = $this->slugify($request['main_phase_slug']);
        $bsatMainPhase = BsatMainPhase::where('slug', $this->slugify($request['main_phase_slug']))->first();

        if ($bsatMainPhase->slug === "maintenance_and_replacement") {

            $maintenance_material_co2e = 0;
            $emissions = $bsatMainPhase->emissionResults()->where('project_id', $request['project_id'])->get();

            foreach ($emissions as $key => $emission) {
                $maintenance_material_co2e = $maintenance_material_co2e + $emission->material_co2_emission;
            }
            $maintenance_material_co2e = $this->getNumber_format($maintenance_material_co2e);

            if ($request["type"] == "table") {
                $data = [[
                    "id" => $bsatMainPhase->id,
                    "material_co2_emission" => $maintenance_material_co2e,
                    "machinery_co2_emission" => 0,
                    "transport_co2_emission" => 0,
                    "energy_co2_emission" => 0,
                    "water_co2_emission" => 0,
                    "total_co2_emission" => $maintenance_material_co2e,
                    "sub_phase" => "Maintenance And Replacement",
                ]];
            } else if ($request["type"] == "chart") {
                $data = array(
                    "chart" => array(
                        "slugs" => ["maintenance_and_replacement"],
                        "labels" => [$bsatMainPhase->name],
                        "co2e_machinery" => [0],
                        "co2e_transport" => [0],
                        "energy_co2_emission" => [0],
                        "water_co2_emission" => [0],
                        "co2e_material" => [$maintenance_material_co2e],
                        "co2e_total" => [$maintenance_material_co2e],
                    )
                );
            } else {
                return throw new NotFoundHttpException("Not Found");
            }

            return response()->json($data, 202);
        }

        $subPhases = $bsatMainPhase->subPhases()->get();
        $results = array();
        $subPhase_slugs = array();
        $subPhase_labels = array();
        $subPhase_co2e_machinery = array();
        $subPhase_co2e_transport = array();
        $subPhase_co2e_material = array();
        $subPhase_co2e_energy = array();
        $subPhase_co2e_water = array();
        $subPhase_co2e_total = array();
        foreach ($subPhases as $key => $subPhase) {
            $subPhaseResult = $subPhase->emissionResults()->where('project_id', $request['project_id'])->first();

            if (null != $subPhaseResult) {

                if ($request["type"] == "chart") {
                    array_push($subPhase_labels, $subPhase->name);
                    array_push($subPhase_slugs, $subPhase->slug);
                    array_push($subPhase_co2e_machinery, $subPhaseResult->machinery_co2_emission);
                    array_push($subPhase_co2e_transport, $subPhaseResult->transport_co2_emission);
                    array_push($subPhase_co2e_material, $subPhaseResult->material_co2_emission);
                    array_push($subPhase_co2e_energy, $subPhaseResult->energy_co2_emission);
                    array_push($subPhase_co2e_water, $subPhaseResult->water_co2_emission);
                    array_push($subPhase_co2e_total, $subPhaseResult->total_co2_emission);
                } else if ($request["type"] == "table") {
                    $results[$subPhase->slug] = [
                        "sub_phase" => $subPhase->name,
                        "machinery_co2_emission" => $this->getNumber_format_result($subPhaseResult->machinery_co2_emission),
                        "transport_co2_emission" => $this->getNumber_format_result($subPhaseResult->transport_co2_emission),
                        "material_co2_emission" => $this->getNumber_format_result($subPhaseResult->material_co2_emission),
                        "energy_co2_emission" => $this->getNumber_format_result($subPhaseResult->energy_co2_emission),
                        "water_co2_emission" => $this->getNumber_format_result($subPhaseResult->water_co2_emission),
                        "total_co2_emission" => $this->getNumber_format_result($subPhaseResult->total_co2_emission),
                    ];
                }
            }

        }

        $data = [];
        if ($request["type"] == "table") {
            $data = $this->orderResults($main_phase_slug, $results);
        } else if ($request["type"] == "chart") {
            $data = array(
                "chart" => array(
                    "slugs" => $subPhase_slugs,
                    "labels" => $subPhase_labels,
                    "co2e_machinery" => $subPhase_co2e_machinery,
                    "co2e_transport" => $subPhase_co2e_transport,
                    "co2e_material" => $subPhase_co2e_material,
                    "co2e_energy" => $subPhase_co2e_energy,
                    "co2e_water" => $subPhase_co2e_water,
                    "co2e_total" => $subPhase_co2e_total,
                )
            );
        } else {
            return throw new NotFoundHttpException("Not Found");
        }
        return response()->json($data, 202);
    }

    public function showSubPhase(Request $request): \Illuminate\Http\JsonResponse
    {
        $bsatMainPhase = BsatMainPhase::where('slug', $this->slugify($request['main_phase_slug']))->first();
        $bsatSubPhase = BsatSubPhase::where([
            ["main_phase_id", "=", $bsatMainPhase->id],
            ["slug", "=", $this->slugify($request['sub_phase_slug'])],
        ])->first();

        $emissionResult = $this->ResultEntryByID($request['project_id'], $bsatMainPhase->id, $bsatSubPhase->id);
        return response()->json($emissionResult, 202);
    }

    public function ResultEntryByID($project_id, $main_phase_id, $sub_phase_id)
    {
        return ProjectSubPhaseEmission::where('project_id', $project_id)
            ->where('main_phase_id', $main_phase_id)
            ->where('sub_phase_id', $sub_phase_id)
            ->get();
    }

    public function getNumber_format($number)
    {
        return (double)number_format($number, 8, '.', '');
    }

    public function getNumber_format_result($number)
    {
        return number_format($number, 8, '.', '');
    }

    public function orderResults($main_phase_slug, $results)
    {
        $orderedResults = array();
        $order = array();
        switch ($main_phase_slug) {
            case "earth_works":
                $order = [
                    "site_clearance",
                    "soil_excavation",
                    "rock_excavation",
                    "back_filling"
                ];
                break;
            case "sub_structure":
                $order = [
                    "foundation",
                    "retaining_walls",
                    "earth_support_systems",
                    "formwork",
                    "insulation",
                    "termite_treatment_and_damp_proof_course",
                    "other_concrete_works",
                    "mortar_substructure",
                ];
                break;
            case "super_structure":
                $order = [
                    "walls_and_facades",
                    "columns",
                    "beams",
                    "floor_slabs",
                    "roof_and_ceiling",
                    "doors_and_windows",
                    "service_equipment",
                    "mortar_superstructure",
                ];
                break;
            case "internal_and_external_finishes":
                $order = [
                    "floor_finishes",
                    "wall_finishes",
                    "roof_and_ceiling_finishes",
                    "mortar_internal_and_external_finishes",
                ];
                break;
            case "construction_site_operations":
                $order = [
                    "electricity_use_on_site",
                    "fuel_use_on_site",
                    "water_consumption_on_site",
                    "waste_generated",
                ];
                break;
            case "energy_consumption":
                $order = [
                    "electricity_used_during_operation",
                    "fuel_used_during_operation",
                    "exported_energy_during_operation",
                ];
                break;
            case "water_consumption":
                $order = [
                    "water_consumption_during_operation",
                ];
                break;
            case "demolition_phase":
                $order = [
                    "electricity_use_on_site",
                    "fuel_use_on_site",
                    "chemicals",
                    "landfill_and_salvage",
                ];
                break;
        }

        foreach ($order as $key => $el) {
            if (sizeof($results) == 0) {
                break;
            }
            array_push($orderedResults, $results[$el]);
        }

        return $orderedResults;
    }
}

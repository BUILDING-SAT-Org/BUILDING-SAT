<?php

namespace App\Http\Controllers;

use App\Models\ProjectRecommendation;
use App\Traits\ProjectTrait;
use App\Traits\UtilTrait;
use Illuminate\Http\Request;
use DB;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectRecommendationController extends Controller
{
    use ProjectTrait;
    use UtilTrait;

    public function index(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        $projectRecommendations = $userProject->recommendations()
            ->join('bsat_recommendations as br', 'recommendation_id', '=', 'br.id')
            ->select('project_recommendations.*', 'br.label', 'br.description')
            ->get()
            ->toArray();

        return response()->json($projectRecommendations, 202);

    }

    public function store(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        $projectRecommendations = new ProjectRecommendation();
        $projectRecommendations->project_id = $request['project_id'];
        $projectRecommendations->recommendation_id = $request['recommendation_id'];
        $projectRecommendations->save();

        $projectRecommendations = $userProject->recommendations()
            ->join('bsat_recommendations as br', 'recommendation_id', '=', 'br.id')
            ->select('project_recommendations.*', 'br.label', 'br.description')
            ->get()
            ->toArray();

        return response()->json($projectRecommendations, 202);
    }

    public function destroy(Request $request)
    {
        $userProject = Auth::user()->projects()->get()->where('id', $request['project_id'])->first();
        if (null == $userProject) {
            return throw new NotFoundHttpException("Project Not Found");
        }

        if (!ProjectRecommendation::where('id', $request['id'])->where('project_id', $userProject->id)) {
            return response(array(
                "error" => "Recommendation Not Found"
            ), 404)->header('Content-Type', 'application/json');
        }
        ProjectRecommendation::where('id', $request['id'])->where('project_id', $userProject->id)->delete();

        $projectRecommendations = $userProject->recommendations()
            ->join('bsat_recommendations as br', 'recommendation_id', '=', 'br.id')
            ->select('project_recommendations.*', 'br.label', 'br.description')
            ->get()
            ->toArray();
        return response($projectRecommendations, 202)->header('Content-Type', 'application/json');
    }

    public function destroyBulk(Request $request)
    {
        ProjectRecommendation::whereIn('id', $request['ids'])->delete();

        $projectRecommendations = ProjectRecommendation::all();
        return response($projectRecommendations, 202)->header('Content-Type', 'application/json');
    }
}

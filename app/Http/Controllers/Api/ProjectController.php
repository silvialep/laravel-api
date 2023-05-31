<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) {

        $requestData = $request->all();
        $types = Type::all();
        $technologies = Technology::all();

        if($request->has('type_id') && $requestData['type_id']) {
            $projects = Project::where('type_id', $requestData['type_id'])->with('type', 'technologies')->paginate(4);

            if(count($projects) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Non ci sono progetti con questa tipologia'
                ]);
            }
        } else {
            $projects = Project::with('type', 'technologies')->paginate(4);
        }

        return response()->json([
            'success' => true,
            'results' => $projects,
            'allTypes' => $types,
            'allTechnologies' => $technologies,
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        
        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Il progetto richiesto non esiste',
            ]);
        }
    }
}

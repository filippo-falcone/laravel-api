<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->paginate(4);
        $data = [
            'success' => true,
            'results' => $projects,
        ];
        return response()->json($data);
    }

    public function show($slug)
    {
        $project = Project::where('slug', '=', $slug)->with('type', 'technologies')->first();
        if ($project) {
            $data = [
                'success' => true,
                'project' => $project
            ];
        } else {
            $data = [
                'success' => false,
                'error' => 'Project not found'
            ];
        }
        return response()->json($data);
    }
}

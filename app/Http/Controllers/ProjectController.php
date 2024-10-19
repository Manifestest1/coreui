<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
        /**
     * Display a listing of the projects.
     */
    public function index()
    {
        return response()->json(Project::all(), 200);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        return response()->json($project, 200);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->validateRequest($request);

        $project->update($request->all());

        return response()->json($project, 200);
    }

    /**
     * Remove the specified project from storage.
     
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(null, 204);
    }*/

    /**
     * Validate the request.
     */
    protected function validateRequest(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:employees,id',
            'project_name' => 'required|string|max:255',
            'brief_description' => 'required|string',
            'role_of_employee' => 'required|string',
            'Technologies_used' => 'required|string',
        ]);
    }
}

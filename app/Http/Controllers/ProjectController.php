<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectTypes = Project::all();
        return apiSuccess('All Projects' , $projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {       
        $validated = $request->validate([
            'start_date' => 'required|date',
            'duration' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0', 
            'location'  => 'required|string|max:255',
            'description' => 'required|string', 
            'building_no' => 'required|string|max:15',
            'budget' => 'nullable|integer|min:0',
            'note' => 'nullable|string|max:1000',
            'project_type_id' => 'required|exists:project_types,id',            
        ]);
        //يجب أن تتحدد أثناء تسجيل الدخول
        $validated['customer_id'] = 2;
        $project = Project::create($validated);
        return apiSuccess("تم إضافة المشروع بنجاح" , $project );
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return apiSuccess("بيانات المشروع" , $project );        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'duration' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0', 
            'location'  => 'required|string|max:255',
            'description' => 'required|string',
            'building_no' => 'required|string|max:15',
            'budget' => 'nullable|integer|min:0',
            'note' => 'nullable|string|max:1000',
            'project_type_id' => 'required|exists:project_types,id',            
        ]);
        $project->update($validated);
        return apiSuccess("تم تعديل المشروع بنجاح" , $project );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return apiSuccess("تم حذف المشروع بنجاح"  );
    }

    public function projectTypes(){
        $projectTypes = ProjectType::all();
        return apiSuccess(' Project Types' , $projectTypes);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
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
        return apiSuccess('All Projects' , $projectTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $validated = $request->validate([
            'start_date' => 'required|date',
            'duration' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0', 
            'location_details'  => 'required|string|max:255',
            'description' => 'required|string', 
            'building_no' => 'required|string|max:15',
            'budget' => 'nullable|integer|min:0',
            'note' => 'nullable|string|max:1000',
            'project_type_id' => 'required|exists:project_types,id', 
            'documents' => 'nullable|array',
            'documents.*.file' => 'required|file|max:50000',
            'documents.*.type' => 'required|exists:document_types,id',
            'documents.*.description' => 'required|max:255',           
        ]);
        //يجب أن تتحدد أثناء تسجيل الدخول
        $validated['customer_id'] = 2;
        $project = Project::create($validated);

         if ($request->has('documents')) {
            foreach ($request->documents as $document) {

                $docName = $document['file']->store('projects', 'public');
                
                
                Document::create([
                    'path' => $docName,
                    'description' => $document['description'],
                    'document_type_id' => $document['type'],
                    // 'user_id' => Auth::id(),
                    'user_id' => 2,
                    'project_id' => $project->id
                ]);
            }
        }
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
}

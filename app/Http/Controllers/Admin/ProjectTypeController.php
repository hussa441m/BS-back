<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectType;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectTypes = ProjectType::all();

        return apiSuccess('كافة أنواع المشاريع ', $projectTypes);

    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $projectType = ProjectType::create($validated);
        return apiSuccess('تم إضافة نوع المشروع بنجاح' , $projectType);
    }
        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $projectType->update($validated);
        return apiSuccess('تم تعديل نوع المشروع بنجاح' , $projectType);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectType $projectType)
    {
        $projectType->delete();
        return apiSuccess('تم حذف نوع المشروع بنجاح');
    }
}

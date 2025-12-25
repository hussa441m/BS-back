<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class ٌRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return apiSuccess('كافة أدوار المزودين ', $roles);

    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $accountStatus = Role::create($validated);
        return apiSuccess('تم إضافة الدور بنجاح' , $accountStatus);
    }
        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $accountStatus)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $accountStatus->update($validated);
        return apiSuccess('تم تعديل الدور بنجاح' , $accountStatus);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $accountStatus)
    {
        $accountStatus->delete();
        return apiSuccess('تم حذف الدور بنجاح');
    }
}

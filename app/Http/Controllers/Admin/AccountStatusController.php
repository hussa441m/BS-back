<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountStatus;

class AccountStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountStatuses = AccountStatus::all();

        return apiSuccess('كافة حالات الحساب ', $accountStatuses);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $accountStatus = AccountStatus::create($validated);
        return apiSuccess('تم إضافة حالة الحساب بنجاح', $accountStatus);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountStatus $accountStatus)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $accountStatus->update($validated);
        return apiSuccess('تم تعديل حالة الحساب بنجاح', $accountStatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountStatus $accountStatus)
    {
        if ($accountStatus->users()->count())
            return apiError('لا يمكن حذف الحالة لوجود حسابات مرتبطة بها', statusCode: 200);

        $accountStatus->delete();
        return apiSuccess('تم حذف حالة الحساب بنجاح');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ChangeStateUser;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function getProviders(Request $request)
    {
        $status = $request->status;
        $users = User::when($status, function ($q) use ($status) {
            return $q->where('status',  $status);
        })->with('profile')->get();
        //   return $providers;              
        return apiSuccess('مزودي الخدمة ',  $users);
    }

    public function update(User $user, Request $request)
    {
        $status = $request->status;

        // return $status;
        $user->update(['status' => $status]);
        // return $user;
        $user->notify(new ChangeStateUser($status));
        return apiSuccess("تم  تعديل حالة الحساب");
    }
}

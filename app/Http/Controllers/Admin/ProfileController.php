<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use App\Notifications\AcceptClient;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $profiles = User::where('type' , 'client')
        ->when($status, function ($q) use ($status) {
            return $q->where('status',  $status);
        })->with('profile')->get();
        //   return $profiles;              
        return apiSuccess('العملاء ',   ProfileResource::collection($profiles));
    }

    public function accept(User $user )
    {
        
        $user->update(['status' => 'active']);
        
        $user->notify(new AcceptClient());
        return apiSuccess("تم  قبول  الحساب");
    }
}

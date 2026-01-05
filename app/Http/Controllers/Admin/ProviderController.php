<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ActivateProvider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function acceptProvider(User $user)
    {
        $user->update(['accepted' => 1]);
        $user->user->notify(new ActivateProvider());
        return apiSuccess("تم  قبول مزودالخدمة بنجاح");
    }
}

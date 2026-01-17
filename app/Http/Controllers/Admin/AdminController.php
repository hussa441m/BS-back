<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Booking;
use App\Models\Comment;
use App\Models\Complaint;
use App\Models\Profile;
use App\Models\Provider;
use App\Models\User;
use App\Notifications\ProviderAccountAccepted;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    

    public function getComplaint()
    {
        $complaints = Complaint::with( 'project:id,name',
                'tourist:id,name',
                'service.provider:id,name',
            )->get();
        return apiSuccess('الشكاوى ',  $complaints);
    }

    

    public function totals()
    {
        $profileCount = Profile::count();
        return apiSuccess("إجماليات", [
            'projects' => \App\Models\Project::count(),
            'clients' => $profileCount,
            'customer' => User::count() - $profileCount -1,
        ]);
    }
}

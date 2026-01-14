<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Project;
use App\Notifications\Offer as NotificationsOffer;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function getNewProjects(Request $request)
    {
        $projectTypes = $request->user()->profile->projectTypes->modelKeys();
        $projects =  Project::with('projectType','province')->where('status', 'new')->whereIn('project_type_id', $projectTypes)->get();
        return apiSuccess("المشاريع الجديدة", $projects);
    }
    function getProjects(Request $request, $status)
    {        
        $profile = $request->user()->profile;
        $projects =  Project::where('performed_by', $profile->id)->where('status', $status)->get();
        return apiSuccess("المشاريع التي حالتها $status", $projects);
    }

    function addOffer(Request $request, Project $project)
    {
        $user = $request->user();
        $validated =  $request->validate([
            'cost' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
            'details' => 'required',
        ]);
        
        $validated['project_id'] = $project->id;
        $validated['offered_by'] = $user->profile->id;

        $offer = Offer::create($validated);
        $project->customer->notify(new NotificationsOffer($user->name));

        return apiSuccess("تم إضافة عرضك", $offer);
    }    
}

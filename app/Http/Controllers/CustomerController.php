<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\Offer;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{

function getClients(Role $role){
    $profiles = $role->profiles()->with('user')->get();
        return apiSuccess("العملاء - ($role->name)",  ProfileResource::collection( $profiles));
    }


    function getOffers(Project $project){
        $offers = $project->offers()->with('documents')->get()->map(function($offer){
            $offer->documents = $offer->documents->map(function($doc){
                $doc->path = asset('storage/' . $doc->path);
                return $doc;
            });
            return $offer;
        });

        return apiSuccess("عروض المشروع", $offers);
    }    

    function acceptOffer(Project $project , Offer $offer){
        $offer->update(['isSelected' => true]);
        $project->update(['performed_by' => $offer->offered_by , 'status' => 'active']);
        return apiSuccess("تم قبول العرض" );        
    }
    function getSteps(Project $project){

    }
    

}

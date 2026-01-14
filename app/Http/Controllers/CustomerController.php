<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function getOffers(Project $project){
        $offers = $project->offers;
        return apiSuccess("عروض المشروع" , $offers);
    }

    function AcceptOffers(Project $project , Offer $offer){
        $offer->update(['isSelected' => true]);
        $project->update(['performed_by' => $offer->offered_by , 'status' => 'active']);
        return apiSuccess("تم قبول العرض" );        
    }
    function getSteps(Project $project){

    }
}

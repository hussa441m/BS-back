<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    protected $fillable = ['start_date' , 'end_date' , 'duration' , 'area' , 'location_details' , 
    'description' , 'building_no'  ,'budget' ,  'note' , 'status' , 'project_type_id', 'customer_id' , 'performed_by'];
}

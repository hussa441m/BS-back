<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
     
    protected $fillable = ['title' , 'note' , 'order' , 'project_id' , ]; 

    function documents(){
        return $this->morphMany(Document::class , 'documentable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [  'experience_start', 'admin_comment','user_id','role_id'];

    function user(){
        return $this->hasOne(User::class);
    }
}

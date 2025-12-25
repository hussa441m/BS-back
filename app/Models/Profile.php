<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [  'is_consultant','experience_start', 'admin_comment','user_id','role_id'];
}

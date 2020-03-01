<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey ='user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institute_head', 'email', 'password','fk_role_id','institute_name','institute_province','institute_city','institute_phone','institute_address','institute_email','users_status',
        'inst_head_job_title','inst_head_mobile_no','inst_head_landline_no','inst_official_bank_ac_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $table='contest_categories';
    protected $primaryKey='contest_category_id';

    protected $fillable=['contest_category_name','contest_registration_start_date','contest_registration_end_date',
        'contest_date','status','created_at','updated_at'];

}

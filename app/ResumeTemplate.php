<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeTemplate extends Model
{
    protected $table = "resumetemplates";


    public static function getRecordWithSlug($slug)
    {
        return ResumeTemplate::where('slug', '=', $slug)->first();
    }
	
}

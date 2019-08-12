<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public static function getRecordWithSlug($slug)
    {
        return Blog::where('slug', '=', $slug)->first();
    }
}

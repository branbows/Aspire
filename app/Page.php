<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static function getRecordWithSlug($slug)
    {
        return Page::where('slug', '=', $slug)->first();
    }
}

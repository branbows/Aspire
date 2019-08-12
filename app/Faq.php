<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FaqCategory;

class Faq extends Model
{
    public static function getRecordWithSlug($slug)
    {
        return Faq::where('slug', '=', $slug)->first();
    }

    public function getFaqCategory()
    {
    	return $this->belongsTo(FaqCategory::class, 'category_id');
    }

    public static function getFaqCategories()
    {
    	return FaqCategory::where('status', 1)->pluck('category', 'id');
    }
}

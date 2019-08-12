<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Faq;

class FaqCategory extends Model
{
    protected $table="faqcategories";


    public static function getRecordWithSlug($slug)
    {
        return FaqCategory::where('slug', '=', $slug)->first();
    }

    public function getFaqs()
    {
    	return $this->hasMany(Faq::class, 'category_id', 'id');
    }
}

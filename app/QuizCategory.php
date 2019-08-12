<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    protected $table = "quizcategories";
 

    public static function getRecordWithSlug($slug)
    {
        return QuizCategory::where('slug', '=', $slug)->first();
    }

    /**
     * Lists the list of quizes related to the selected category
     * @return [type] [description]
     */
    public function quizzes()
    {
        
        return $this->getQuizzes()
        ->where('start_date','<=',date('Y-m-d'))
        ->where('end_date','>=',date('Y-m-d'))
        ->where('total_questions','>','0')
        ->get();

        
    }

    public function getQuizzes()
    {
        return $this->hasMany('App\Quiz', 'category_id');

    }


    public static function getShowFrontCategories($limit=0)
    {
       if ($limit>0) {
        
         $list   = Quiz::where('show_in_front',1)
                          // ->where('is_paid',0)
                          ->groupby('category_id')
                          ->limit(6)
                          ->get();
                          // dd($list);
       } else {
         $list   = Quiz::where('show_in_front',1)
                          // ->where('is_paid',0)
                          ->groupby('category_id')
                          ->get();
       }
      
      $cat_ids  = array_pluck($list,'category_id');
      
      $categories = [];
      foreach ($cat_ids as $key => $value) {
        
        $categories[]  = QuizCategory::where('id',$value)->first();                

      }  
      return $categories;
   }





   /**
    * [getPracticeExamsCategories Practice Exams Categories]
    * @return [type] [description]
    */
   public static function getPracticeExamsCategories($limit='')
   {

      if ($limit>0) {

        $list   = Quiz::where('show_in_front', 1)
                      ->groupby('category_id')
                      ->limit($limit)
                      ->get();
      } else {
        
        $list   = Quiz::where('show_in_front', 1)
                      ->groupby('category_id')
                      ->get();
      }

      $cat_ids  = array_pluck($list,'category_id');
      
      $categories = [];
      foreach ($cat_ids as $key => $value) {
        $categories[]  = QuizCategory::where('id',$value)->first();                
      }  
      return $categories;
   }
}

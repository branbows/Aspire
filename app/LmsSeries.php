<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class LmsSeries extends Model
{
   protected $table = 'lmsseries';

   

    public static function getRecordWithSlug($slug)
    {
        return LmsSeries::where('slug', '=', $slug)->first();
    }

    /**
     * This method lists all the items available in selected series
     * @return [type] [description]
     */
    public function getContents()
    {
        return DB::table('lmsseries_data')
          ->join('lmscontents', 'lmscontents.id', '=', 'lmscontent_id')
            ->where('lmsseries_id', '=', $this->id)->get();
    }


    public static function getFreeSeries($limit=0)
    {
        
       /* $records  = LmsSeries::where('show_in_front',1)
                                ->groupby('lms_category_id')
                                ->inRandomOrder()
                                ->pluck('lms_category_id')
                                ->toArray();
        if($limit > 0){
            
          $lms_cats  = LmsCategory::whereIn('id',$records)->limit(6)->get();
        }
        else{

          $lms_cats  = LmsCategory::whereIn('id',$records)->get();

        }
        return $lms_cats;   */                   


         $records  = LmsSeries::where('show_in_front',1)
                                ->groupby('lms_category_id')
                                ->orderby('created_at','desc')
                                ->pluck('lms_category_id')
                                ->toArray();
        if($limit > 0){
            
          $lms_cats  = LmsCategory::whereIn('id',$records)->orderby('created_at','desc')->limit(6)->get();
        }
        else{

          $lms_cats  = LmsCategory::whereIn('id',$records)->orderby('created_at','desc')->get();

        }
        return $lms_cats;      
        
    }


    public function viewContents($limit= '')
    {
       
      $contents_data   = LmsSeriesData::where('lmsseries_id',$this->id)
                                  ->pluck('lmscontent_id')
                                  ->toArray();
       
       if($contents_data){
          
        if($limit!=''){

         $contents  = LmsContent::whereIn('id',$contents_data)->paginate($limit);
        }else{
         $contents  = LmsContent::whereIn('id',$contents_data)->get();

        }
         
         if($contents)
         return $contents;

          return FALSE;

       } 

       return FALSE;
                                 

    }

   
}

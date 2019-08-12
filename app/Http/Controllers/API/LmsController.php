<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class LmsController extends Controller
{

    /**
     * List the categories available
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function lms(Request $request, $slug='')
    {
     

      $user_id = $request->user_id;
      $user =   $user = \App\User::where('id','=', $user_id)->first();

  

      $response['status'] = 0;
      $response['message'] = null;
      $response['records'] = null;
     $records = null;
    
          $category = \App\LmsCategory::getRecordWithSlug($slug); 
          
          if($category){
             $records             = \App\LmsSeries::where('lms_category_id','=',$category->id)
                                        ->where('start_date','<=',date('Y-m-d'))
                                        ->where('end_date','>=',date('Y-m-d'))        
                                        ->get();

              $recs = [];
              
              foreach ($records  as $item) {
                
                $temp['id']          = $item->id;
                $temp['title']    = $item->title;
                $temp['slug']        = $item->slug;
                $temp['image']       = $item->image;
                $temp['description'] = $item->description;
                $temp['is_paid']     = $item->is_paid;
                $temp['cost']     = $item->cost;
                if($item->is_paid == 1){
                   $temp['validity']     = $item->validity;
                }elseif($item->is_paid == 0){
                   $temp['validity']     = -1;

                }
                $temp['is_purchased'] = (int)\App\Payment::isItemPurchased($item->id, 'lms', $user->id);

                $temp['created_at']  = getViewFormat($item->created_at);
                $temp['updated_at']  = getViewFormat($item->updated_at);
                // $temp['items'] = $item->contents()->count();
                $recs[] = $temp;

              }

              $records = $recs;
                 $response['status'] = 1;
            }
            else{
              $response['message'] = 'Invalid category';
            }
        

     
      $response['records'] = $records;

      return $response;
    } 



       /**
     * This method displays all the details of selected exam series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function viewItem(Request $request, $slug, $content_slug='')
    { 
        
        $record = \App\LmsSeries::getRecordWithSlug($slug); 
          $user_id = $request->user_id;
        $user =   $user = \App\User::where('id','=', $user_id)->first();
        $response['status'] = 0;
        $response['message'] = '';
        $response['contents'] = null;
        if(!$record)
        {
          $response['message'] = 'Invalid category';
          return $response;
        }

        $content_record = FALSE;
        if($content_slug) {
          $content_record = \App\LmsContent::getRecordWithSlug($content_slug);
          if(!$content_record)
          {
            $response['message'] = 'Invalid Content Record';
            return $response;
          }
        }
        

        if($content_record){
            if($record->is_paid) {
            if(!isItemPurchased( $record->id, 'lms'))
            {
                $response['message'] = 'This user has no permission to access';
                return $response;
            }
          }
        }

        

        $response['item']           = $record;
        $response['is_purchased']   = (int)\App\Payment::isItemPurchased($record->id, 'lms', $user->id);

        $response['list']           = $record->getContents();
        $response['content_record']     = $content_record;
        $response['status']=1;
        return $response;
    
    }

    public function lmsSeries(Request $request)
    {
      
      $user_id = $request->user_id;

      $user    = \App\User::where('id','=', $user_id)->first();


      $interested_categories  = null;
      $categories             = null;

      $response['status']  = 0;
      $response['message'] = null;
      $response['records'] = null;

       if($user->settings)
       {
         $interested_categories =  json_decode($user->settings)->user_preferences;
       }

        if($interested_categories){

         if( count( $interested_categories->lms_categories ) ){
           
           $categories  = \App\LmsCategory::whereIn('id',(array) $interested_categories->lms_categories)
                                           ->pluck('id')
                                           ->toArray();

             }                                      
        }

        if( count( $categories ) > 0 ){
              

        $recs = \App\LmsSeries::whereIn('lms_category_id',$categories)->get();
        
        $records = [];

        foreach($recs as $r)
        {
          
          $total_items  = \App\LmsSeriesData::where('lmsseries_id',$r->id)->get()->count();
          $temp['title']              = $r->title;
          $temp['id']                 = $r->id;
          $temp['slug']               = $r->slug;
          $temp['category_id']        = $r->category_id;
          $temp['is_paid']            = $r->is_paid;
          $temp['cost']               = $r->cost;
          $temp['validity']           = $r->validity;
          $temp['total_exams']        = $r->total_exams;
          $temp['total_questions']    = $r->total_questions;
          $temp['image']              = $r->image;
          $temp['short_description']  = $r->short_description;
          $temp['start_date']         = $r->start_date;
          $temp['end_date']           = $r->end_date;
          $temp['total_items']        = $total_items;
          $temp['is_purchased']       = (int)\App\Payment::isItemPurchased($r->id, 'lms', $user->id);
          
          $records[] = $temp;
        }

            $response['status']  = 1;
            $response['records'] = $records;
            return $response;

         }
         else{

            $response['status']  = 0;
            $response['message'] = 'Please Update Your Settings';
            return $response;
         }
        
       

       
    }

}
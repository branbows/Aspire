<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Image;
use ImageSettings;


class UsersController extends Controller
{
 

   public function profile(Request $request, $id)
   {	
   		$response['status'] = 0;
   		$response['message'] = '';
   		$user = \App\User::where('id', '=', $id)->first();
   		if(!$user)
   		{
   			$response['message'] = 'Invalid Userid';
   			return $response;
   		}
   		$response['status'] = 1;
   		$response['user'] = $user;
   		return $response;
   } 


   /**
    * This methos will return the list of settings available and the user selected settings
    */

   public function settings(Request $request, $id)
   {
   	  $response['status'] = 0;
   		$response['message'] = '';
   		$user = \App\User::where('id', '=', $id)->first();
   		if(!$user)
   		{
   			$response['message'] = 'Invalid Userid';
   			return $response;
   		}

   		$response['quiz_categories']   = \App\QuizCategory::get();
        $response['lms_category']      = \App\LmsCategory::get();

        $response['selected_options'] = [
                                        'quiz_categories'=>[],
                                        'lms_categories'=>[],
                                        ];
        if(isset($user->settings))
          $response['selected_options'] = json_decode($user->settings)->user_preferences;
        $response['status'] = 1;
        return $response;


   }
   
   public function updateSettings(Request $request)
   {
   		

   }

   public function paymentsHistory($user_id)
   {

    $response['status'] = 1;
    $response['message'] = '';
    
    $records = \App\Payment::select(['item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway', 'updated_at','payment_status','id','cost', 'after_discount', 'paid_amount'])
     ->where('user_id', '=', $user_id)
            ->orderBy('updated_at', 'desc')->get();
     $response['data'] = $records;
     return $response;
   }

   public function bookmarks($user_id)
   {
    $response['status'] = 1;
    $response['message'] = '';

      $records = \App\Bookmark::join('questionbank', 'questionbank.id', '=', 'bookmarks.item_id')
            ->select(['question_type', 'question','marks','bookmarks.id','bookmarks.user_id'])
            ->where('user_id','=',$user_id)
            ->orderBy('bookmarks.updated_at', 'desc')->get();
            
      $response['data'] = $records;
      return $response;
   }

   public function saveFeedback(Request $request)
   {
      $user_id = $request->user_id;


         $columns = array(
                            'title'                   => 'bail|required|max:40' ,
                            'subject'                 => 'bail|required|max:40' ,
                            'description'             => 'bail|required' ,
                            );
           
            $validated =  \Validator::make($request->all(),$columns);
            if(count($validated->errors()))
            {
                $response['status'] = 0;        
                $response['message'] = 'Validation Errors';
                $response['errors'] = $validated->errors()->messages();
                return $response;
            }    

        $record = new \App\Feedback();
        $name             =  $request->title;
        $record->title        = $name;
        $record->slug         = $record->makeSlug($name);
        $record->subject      = $request->subject;
        $record->description    = $request->description;
        $record->user_id      = $user_id;
        $record->save();

      $response['status'] = 1;
      $response['message'] = 'Feedback updated successfully';
      return $response;
   }


    /**
     * This method updates the password submitted by the user
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function updatePassword(Request $request)
    {

      $response['status'] = 0;
      $response['message'] = '';

        $columns = [
            'old_password' => 'required',
            'password'     => 'required|confirmed',
        ];

         $validated =  \Validator::make($request->all(),$columns);
            if(count($validated->errors()))
            {
                $response['status'] = 0;        
                $response['message'] = 'Validation Errors';
                $response['errors'] = $validated->errors()->messages();
                return $response;
            }    

             $credentials = $request->only('old_password', 'password', 'password_confirmation');


        $id = $request->user_id;
      
        $user = \App\User::where('id', '=', $id)->first();

      if(!$user)
      {
        $response['message'] = 'Invalid Userid';
        return $response;
      }

        
        if (\Hash::check($credentials['old_password'], $user->password)){
            $password = $credentials['password'];
            $user->password = bcrypt($password);
            $user->save();
            $response['status'] = 1;
            $response['message'] = 'Password updated successfully';

        }else {
            $response['status'] = 0;
            $response['message'] = 'Old and new passwords are not same';
       }

       return $response;
  }


  /**
      * Update the specified resource in storage.
      *
      * @param  int  $id
      * @return Response
      */
     public function update(Request $request, $id)
     {  

        $record     = \App\User::where('id', $id)->first();

      if(!$record)
      {
        $response['message'] = 'Invalid Userid';
        return $response;
      }
        $columns = [
        'name'      => 'bail|required|max:20|',
        'phone'     => 'bail|required|max:10',
        // 'image'     => 'bail|mimes:png,jpg,jpeg|max:2048',

        ];

          
          $response['status'] = 0;        
          $response['message'] = '';

         $validated =  \Validator::make($request->all(),$columns);
            if(count($validated->errors()))
            {
                $response['status'] = 0;        
                $response['message'] = 'Validation Errors';
                $response['errors'] = $validated->errors()->messages();
                return $response;
            }    


        $name = $request->name;
        if($name != $record->name)
            $record->slug = $record::makeSlug($name);

        $record->name = $name;
        

       $record->phone = $request->phone;
       $record->address = $request->address;
       $record->save();
       
         $response['status'] = 1;        
         $response['message'] = 'Record updated successfully';
         return $response;
      }




     protected function processUpload(Request $request, User $user)
     {

       
         if ($request->hasFile('image')) {
          
          $imageObject = new ImageSettings();
          
          $destinationPath      = $imageObject->getProfilePicsPath();
          $destinationPathThumb = $imageObject->getProfilePicsThumbnailpath();
          
          $fileName = $user->id.'.'.$request->image->guessClientExtension();
          ;
          $request->file('image')->move($destinationPath, $fileName);
          $user->image = $fileName;
         
          Image::make($destinationPath.$fileName)->fit($imageObject->getProfilePicSize())->save($destinationPath.$fileName);
         
          Image::make($destinationPath.$fileName)->fit($imageObject->getThumbnailSize())->save($destinationPathThumb.$fileName);
          $user->save();
        }
     }


     /**
      * [uploadUserProfileImage description]
      * @param  Request $request [description]
      * @return [type]           [description]
      */
    public function uploadUserProfileImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'image'         => 'required'
        ]);

        if ($validator->fails()) {

            $response['status']  = 0;
            $response['message'] = 'Invalid input';
            $response['errors']  = $validator->errors()->messages();
            return $response;
        }

        $user_id        = $request->user_id;
    
        $user = User::join('role_user', 'users.id', 'role_user.user_id')
                        ->select(['users.*'])
                        ->where('users.id', $user_id)
                        ->where('users.role_id', getRoleData('student'))
                        ->where('users.login_enabled', 1)
                        ->get();

        // $record     = \App\User::where('id', $id)->first();

        if (count($user)) {

            $user = $user[0];

            $previous_image = $user->image;

            $base64_string = base64_decode($request->input('image'));
             $img_name = 'profile_image_'.time().'.'.'jpeg';
            
            //orginial image
            file_put_contents('public/uploads/users/'.$img_name, $base64_string);
            $user->image      = $img_name;
            $user->save();


            //thumb
            Image::make(IMAGE_PATH_PROFILE.$img_name)->fit(100,100)->save('public/uploads/users/thumbnail/'.$img_name);

            $image_path =   public_path("uploads/users/".$previous_image);
                
            if ($previous_image && file_exists($image_path)) {
                //File::delete($image_path);
                unlink($image_path);

                $image_thumbpath = public_path('uploads/users/thumbnail/'.$previous_image);

                if (file_exists($image_thumbpath)) {
                    unlink($image_thumbpath);
                }
            }


            $response['status']  = 1;
            $response['message'] = 'Profile Image uploaded successfully..';
            $response['image_name'] = $img_name;
            return $response;

        } else {

            $response['status'] = 0;
            $response['message'] = 'Loggedin User record not found';
            return $response;
        }
    }


         /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function deleteBookmarkById(Request $request, $item_id)
    {
      // $user     = \App\User::where('id', $request->user_id)->first();
      $response['status'] = 0;
      // if(!$user)
      // {
      //   $response['message'] = 'Invalid Userid';
      //   return $response;
      // }
// return $item_id;
      // $record = \App\Bookmark::where('item_id', '=', $item_id )
      //             ->where('user_id', '=', $user->id)
      //             ->where('item_type', '=', 'questions')
      //             ->first();

       $record = \App\Bookmark::find($item_id);

        if(!$record)
        {
          $response['status'] = 0;
          $response['message'] = 'Invalid Bookmark record';  
          return $response;
        }
        
        $record->delete();
        $response['status'] = 1;
        $response['message'] = 'Bookmark removed';
        return json_encode($response);
    }

    /**
     * This method will reset 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function resetUsersPassword(Request $request)
     {
        // dd($request);
         $user  = \App\User::where('email','=',$request->email)->first();

         $response['status'] = 0;
         $response['message'] = '';
         
         if(!$user)
         {
            $response['message'] = 'Invalid User';
            return $response;
         }

          \DB::beginTransaction();

         try{

         if($user!=null){

           $password       = str_random(8);
           $user->password = bcrypt($password);

           $user->save();
           
           \DB::commit();

           $user->notify(new \App\Notifications\UserForgotPassword($user,$password));

           $response['status'] = 1;
           $response['message'] = 'New password is sent to your email account';

         }

         else{

            $response['status'] = 0;
           $response['message'] = 'No Email exists';
            
         }
      }

      catch(\Exception $ex){
          \DB::rollBack();
          $response['message'] = $ex->getMessage();
      }
         
         
        return $response;
         
     }


     public function updateUserPreferrenses(Request $request, $user_id)
     {


        // header('Content-type: application/x-www-form-urlencoded');

        $record = \App\User::where('id', $user_id)->first();
        // return $record;
        $options = [];
        if($record->settings)
        {
            $options =(array) json_decode($record->settings)->user_preferences;
        }

        /*$options['quiz_categories'] = [];
        $options['lms_categories']  = [];*/

        $options = array();

        if($request->has('quiz_categories')) {
          // foreach($request->quiz_categories as $key => $value)
            $options['quiz_categories'] = json_decode($request->quiz_categories);
        }
        if($request->has('lms_categories')) {
          // foreach($request->lms_categories as $key => $value)
            $options['lms_categories'] = json_decode($request->lms_categories);
        }
        
        $record->settings = json_encode(array('user_preferences'=>$options));
        $record->save();

        $response['status'] = 1;        
        $response['message'] = 'User preferrences updated successfully';
        $response['user_selected_data']   = $record->settings;

        return $response;
    }



 public function instructions($exam_slug)
 {
      
      $instruction_page = '';
      $record = \App\Quiz::where('slug',$exam_slug)->first();

      if(!$record)
      {
         $response['status'] = 0;        
         $response['message'] = 'Exam is not existed';
         return $response;
      }

      if($record->instructions_page_id)
      $instruction_page = \App\Instruction::where('id',$record->instructions_page_id)->first();
      
      $response['instruction_data'] = '';
      
      if($instruction_page){
        $response['instruction_data']  = $instruction_page->content;
        $response['instruction_title'] = $instruction_page->title;
      }

     
      //If Other than student tries to attempt the exam 
      //Restrict the access to that exam
      // if(!checkRole(['student']))
      // {
      //    $response['status'] = 0;        
      //    $response['message'] = 'You have no permission to access';
      //    return $response;
      // }

        $response['status']  = 1;        
        $response['message'] = '';
        // $response['data']    = $response;
         return $response;

      
 }


  public function subjectAnalysis($user_id)
  {
      $user = \App\User::find($user_id);

      if(!$user)
      {
         $response['status'] = 0;        
         $response['message'] = 'User is not found';
         return $response;
      }

      $records = array();
      $records = ( new \App\QuizResult())->getOverallSubjectsReport($user);
      
      $result=array();
      foreach ($records as $key=>$record) {
          $record['subject_id'] = $key;
          array_push($result, $record);
      }


      if(!$result)
      {
          $response['status'] = 0;        
          $response['message'] = 'No records are not available';
          return $response;
      }
        
      $response['subjects']   = $result;
      $response['user']       = $user;
      $response['status']  = 1;        
      $response['message'] = '';
      
      return $response;        
  }




 public function examAnalysis($user_id)
 {
      
       $user = \App\User::find($user_id);

      if(!$user)
      {
         $response['status'] = 0;        
         $response['message'] = 'User is not found';
         return $response;
      }


       $records = array();

        $records = \App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
            ->select(['title','is_paid' ,'dueration', 'quizzes.total_marks',  \DB::raw('count(quizresults.user_id) as attempts, quizzes.slug, user_id') ])
            ->where('user_id', '=', $user->id)
            ->groupBy('quizresults.quiz_id')
            ->get();
        
        $response['records']   = $records;
        $response['user']       = $user;
        $response['status']  = 1;        
        $response['message'] = '';
        
        return $response;


 }


       public function historyAnalysis($user_id, $exam_id ='')
       {
            $user = \App\User::find($user_id);

            if(!$user)
            {
               $response['status'] = 0;        
               $response['message'] = 'User is not found';
               return $response;
            }

              $exam_record = FALSE;
              if($exam_id)
              {
                $exam_record = \App\Quiz::find($exam_id);
              
              }
               $records = array();
                if(!$exam_id)
                   $records = \App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
                  ->select(['title','is_paid' , 'marks_obtained', 'exam_status','quizresults.created_at', 'quizzes.total_marks','quizzes.slug', 'quizresults.slug as resultsslug','user_id','exam_type' ])
                  ->where('user_id', '=', $user->id)
                  ->orderBy('quizresults.updated_at', 'desc')
                  ->get();
                else
                  $records = \App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
                  ->select(['title','is_paid' , 'marks_obtained', 'exam_status','quizresults.created_at', 'quizzes.total_marks','quizzes.slug', 'quizresults.slug as resultsslug','user_id' ])
                  ->where('user_id', '=', $user->id)
                  ->where('quiz_id', '=', $exam_record->id )
                  ->orderBy('quizresults.updated_at', 'desc')
                  ->get();

              $response['records']   = $records;
              $response['user']       = $user;
              $response['status']  = 1;        
              $response['message'] = '';
              
              return $response;
      }


      public function  saveBookmarks(Request $request) 
      {
          $validator = Validator::make($request->all(), [
              'item_id'       => 'required',
              'user_id'       => 'required'
          ]);

          if ($validator->fails()) {

              $response['status']  = 0;
              $response['message'] = 'Invalid input';
              $response['errors']  = $validator->errors()->messages();
              return $response;
          }

          $user_id        = $request->user_id;

          $user = User::join('role_user', 'users.id', 'role_user.user_id')
                          ->select(['users.*'])
                          ->where('users.id', $user_id)
                          ->where('users.role_id', getRoleData('student'))
                          ->where('users.login_enabled', 1)
                          ->get();

          if (count($user)) {

              $user = $user[0];

              //check bookmark already exist
              $bkmark_existed = \App\Bookmark::where('user_id',$user_id)
                                      ->where('item_id',$request->item_id)
                                      ->get();

              if (count($bkmark_existed)) {

                $bkmark_existed = $bkmark_existed[0];
                $bkmark_existed->delete();
                $response['status'] = 0;
                $response['message'] = 'Bookmark removed ';
                return json_encode($response);

              } else {  

                $record = new \App\Bookmark();

                $record->user_id = $user_id;
                $record->item_id = $request->item_id;
                $record->item_type = 'questions';
                   
                $record->save();
                $response['status'] = 1;
                $response['message'] = 'Bookmark saved ';
                return json_encode($response);
              }
              
          } else {

              $response['status'] = 0;
              $response['message'] = 'Loggedin User record not found';
              return $response;

          }
      }



      public function socialLoginUser(Request $request)
      {
          $email = $request->email;
          $name = $request->name;
          
          $user = \App\User::where('email','=',$email)->first();
          if(!$user)
          {
            $data['email'] = $email;
            $data['name'] = $name;
            $data = (object)$data;
            $user = $this->registerWithSocialLogin($data);
          }

          if ($request->device_id) {
              $user->device_id = $request->device_id;
              $user->save();
          }
          return $user;

      }


       /**
      * This method accepts the user object from social login methods 
      * Registers the user with the db
      * Sends Email with credentials list 
      * @param  User   $user [description]
      * @return [type]       [description]
      */
     public function registerWithSocialLogin($receivedData = '')
     {
        $user           = new \App\User();
        // $password         = str_random(8);
        $password         = 'password';
        $user->password   = bcrypt($password);
        $slug             = $user->makeSlug($receivedData->name);
        $user->username   = $slug;
        $user->slug       = $slug;

        $role_id        = getRoleData('student');
        
        $user->name  = $receivedData->name;
        $user->email = $receivedData->email;
        $user->role_id = $role_id;
        $user->login_enabled  = 1;
         if(!env('DEMO_MODE')) {
        $user->save();
        $user->roles()->attach($user->role_id);
        try{
            $user->notify(new \App\Notifications\NewUserRegistration($user,$user->email,$password));
        }
        catch(Exception $ex)
        {
            return $user;
        }
      
        }
       return $user;
     }
	
    public function updatePayment(Request $request)
    {
       
       $response['status'] = 0;
       $response['message'] = 'Oops..! something went wrong';

      try{

      $payment                  = new \App\Payment();
      $payment->user_id         = $request->user_id;
      $payment->item_id         = $request->item_id;
      $payment->item_name       = $request->item_name;
      $payment->plan_type       = $request->plan_type;
      $payment->start_date      = $request->start_date;
      $payment->end_date        = $request->end_date;
      $payment->slug            = getHashCode();
      $payment->payment_gateway = $request->payment_gateway;
      $payment->transaction_id  = $request->transaction_id;
      $payment->actual_cost     = $request->actual_cost;
      $payment->coupon_applied  = $request->coupon_applied;
      $payment->coupon_id       = $request->coupon_id;
      $payment->discount_amount = $request->discount_amount;
      $payment->cost            = $request->actual_cost;
      $payment->after_discount  = $request->after_discount;
      $payment->payment_status  = $request->payment_status;
      $payment->paid_amount     = $request->after_discount;
      // dd($payment);
      $payment->save();

       if($payment->coupon_applied)
        {
          $this->couponcodes_usage($payment);
        }

       $response['status'] = 1;
       $response['message'] = 'Payment updated successfully';

      }

      catch(\Exception $ex)
      {
        $response['status'] = 0;
        $response['message'] = $ex->getMessage();
      }

      return $response;
    }



    public function updateOfflinePayment(Request $request)
    {
         
      try{

      $payment                  = new \App\Payment();
      $payment->user_id         = $request->user_id;
      $payment->item_id         = $request->item_id;
      $payment->item_name       = $request->item_name;
      $payment->plan_type       = $request->plan_type;
      $payment->start_date      = $request->start_date;
      $payment->end_date        = $request->end_date;
      $payment->slug            = getHashCode();
      $payment->payment_gateway = "offline";
      $payment->actual_cost     = $request->actual_cost;
      $payment->coupon_applied  = $request->coupon_applied;
      $payment->coupon_id       = $request->coupon_id;
      $payment->discount_amount = $request->discount_amount;
      $payment->cost            = ($request->cost) ? $request->cost : $request->actual_cost;
      $payment->after_discount  = $request->after_discount;
      $payment->paid_amount     = $request->after_discount;
      $payment->payment_status  = "pending";
      $payment->notes           = $request->payment_details;

      $other_details = array();

      $other_details['is_coupon_applied'] = $request->coupon_applied;
      $other_details['coupon_applied']    = $request->coupon_applied;
      $other_details['actual_cost']       = $request->actual_cost;
      $other_details['after_discount']    = $request->after_discount;
      $other_details['coupon_id']         = $request->coupon_id;
      $other_details['payment_details']   = $request->payment_details;
      $other_details['discount_availed']  = $request->discount_amount;
      
      $payment->other_details  = json_encode($other_details);

      $payment->save();

       if($payment->coupon_applied)
        {
          $this->couponcodes_usage($payment);
        }

       $response['status'] = 1;
       $response['message'] = 'Your Payment Request Submitted To Admin Successfully';

      }

      catch(\Exception $ex)
      {
        $response['status'] = 0;
        $response['message'] = $ex->getMessage();
      }

      return $response;

    }

      public function couponcodes_usage($payment_record)
    {
          $coupon_usage['user_id'] = $payment_record->user_id;
          $coupon_usage['item_id'] = $payment_record->item_id;
          $coupon_usage['item_type'] = $payment_record->plan_type;
          $coupon_usage['item_cost'] = $payment_record->actual_cost;
          $coupon_usage['total_invoice_amount'] = $payment_record->paid_amount;
          $coupon_usage['discount_amount'] = $payment_record->discount_amount;
          $coupon_usage['coupon_id'] = $payment_record->coupon_id;
          $coupon_usage['updated_at'] =  new \DateTime();
          \DB::table('couponcodes_usage')->insert($coupon_usage);
          return TRUE;
    }	

    
}
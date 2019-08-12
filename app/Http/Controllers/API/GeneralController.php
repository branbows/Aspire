<?php

namespace App\Http\Controllers\API;

use \App;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Auth;

class GeneralController extends Controller
{
	/**
	 * This methos will return the random 5 exam and lms series records for dashboard
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function getTopExamAndLms(Request $request)
	{

      $user_id = $request->user_id;
      $user =   $user = \App\User::where('id','=', $user_id)->first();

		$exam_records = \App\Quiz::select(['id','title','slug','dueration','category_id', 
											'is_paid', 'cost', 'validity', 'total_marks',
											'having_negative_mark', 'negative_mark', 'total_questions',
											'image','exam_type', 'start_date','end_date','has_language',
											'language_name' ])
                       ->where('is_popular',1)
                       ->inRandomOrder()
                       ->limit(5)
                       ->get();

    $lms_series =   \App\LmsSeries::select(['id','title','slug', 'is_paid', 'cost',
                        'validity', 'total_items', 'lms_category_id', 'image',
                        'short_description', 'description', 'start_date','end_date'])
                       ->where('is_popular',1)
                      ->inRandomOrder()
                      ->limit(5)
                      ->get();
     $exam_recs = [];

     foreach($exam_records as $item)
     {
        $temp['id']          = $item->id;
                $temp['title']    = $item->title;
                $temp['slug']        = $item->slug;
                $temp['image']       = $item->image;
                $temp['description'] = $item->description;
                $temp['is_paid']     = $item->is_paid;
                $temp['cost']     = $item->cost;
                $temp['exam_type']     = $item->exam_type;
                $temp['validity']     = $item->validity;
                $temp['total_items']     = $item->total_items;
                $temp['is_purchased'] = (int)\App\Payment::isItemPurchased($item->id, 'combo', $user->id);

                $temp['created_at']  = getViewFormat($item->created_at);
                $temp['updated_at']  = getViewFormat($item->updated_at);
                // $temp['items'] = $item->contents()->count();
                $exam_recs[] = $temp;
     }

		
      $lms_recs = [];
   foreach($lms_series as $item)
   {
       $temp['id']          = $item->id;
                $temp['title']    = $item->title;
                $temp['slug']        = $item->slug;
                $temp['image']       = $item->image;
                $temp['description'] = $item->description;
                $temp['is_paid']     = $item->is_paid;
                $temp['cost']     = $item->cost;
                $temp['validity']     = $item->validity;
                $temp['total_items']     = $item->total_items;
                // $temp['is_purchased'] = (int)\App\Payment::isItemPurchased($item->id, 'lms', $user->id);

                $temp['created_at']  = getViewFormat($item->created_at);
                $temp['updated_at']  = getViewFormat($item->updated_at);
                // $temp['items'] = $item->contents()->count();
                $lms_recs[] = $temp;
   }

		$response['status'] = 1;
		$response['exam_records'] = $exam_recs;
		$response['lms_records'] = $lms_recs;
		return $response;
	}

	/**
	 * This method will return the list of subscribed categories
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function examCategories(Request $request)
	{
		$user_id = $request->user_id;
		$user = \App\User::where('id','=', $user_id)->first();
		
		$interested_categories      = null;
		
		$response['status'] = 1;
		$response['categories'] = null;

        if($user->settings)
        {
          $interested_categories =  json_decode($user->settings)->user_preferences;
        }
        
        if($interested_categories) {
        if(count($interested_categories->quiz_categories))

        	$response['categories']         = \App\QuizCategory::
                                      whereIn('id',(array) $interested_categories->quiz_categories)->get();
        }

        if(!$response['categories'])
        {
        	$response['status'] = 0;
        	$response['message'] = 'No preferences selected';
        }
        return $response;

	}

	/**
	 * This method will return the list of lms categories for this student
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function lmsCategories(Request $request)
	{
		$user_id = $request->user_id;
		$user = \App\User::where('id','=', $user_id)->first();
		
		$interested_categories      = null;
		
		$response['status'] = 1;
		$response['categories'] = null;

         $interested_categories      = null;
        if($user->settings)
        {
          $interested_categories =  json_decode($user->settings)->user_preferences;
        }
        
        if($interested_categories)    {
         if(count($interested_categories->lms_categories))
        $response['categories']       = \App\LmsCategory::
                                      whereIn('id',(array) $interested_categories->lms_categories)
                                      ->get();
        }

        if(!$response['categories'])
        {
        	$response['status'] = 0;
        	$response['message'] = 'No preferences selected';
        }
        return $response;
	}

	public function examList($slug='')
	{
		 $category = FALSE;
	}

	public function notifications()
	{
			$response['status'] = 1;
        	$response['message'] = '';
           $date = date('Y-m-d');
		 $records = \App\Notification::where('valid_from', '<=', $date)
                              ->where('valid_to', '>=', $date)->select(['title', 'valid_from', 'valid_to', 'url', 'id','slug' ])
            ->orderBy('updated_at', 'desc')->get();
            $response['records'] = $records;
            return $response;
	}




	 /**
     * This method will load the static pages
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function staticPages($key='privacy-policy')
    {
    	
        $current_theme = getDefaultTheme();
   		$page_content  = getThemeSetting($key,$current_theme); 

      	$response['status']  = 1;
        $response['message'] = '';
        $response['records'] = $page_content;
        return $response;
    }


    public function validateCoupon(Request $request)
    {     
    	$coupon_code 		= $request->coupon_code;
        $user               = getUserRecord($request->student_id);
    	$item_type 			= $request->item_type;
    	$purchased_amount 	= $request->cost;

    	$item 				= null;
    	if($item_type=='combo')
    	{
    		$item = \App\ExamSeries::where('slug', '=', $request->item_name)->first();
    	}
        else if($item_type=='exam'){
            $item = \App\Quiz::where('slug', '=', $request->item_name)->first();
        }
        else if($item_type=='lms'){
            $item = \App\LmsSeries::where('slug', '=', $request->item_name)->first();
        }

    	if(!$item){

    		 $response['status']  = 0;
             $response['message'] = 'invalid item';
             return $response; 
    		// return json_encode(array('status'=>'0', 'message'=>'invalid item'));
    	}
    	

        $coupon_data = \App\Couponcode::where('coupon_code', '=', $coupon_code)->first();
        if($coupon_data){

            if($coupon_data->institute_id != $user->institute_id){
                 
                 $response['status']  = 0;
                 $response['message'] = 'You are not eligible to use this coupon code';
                 return $response; 
              
                // return json_encode(array('status'=>'0', 'message'=>'You are not eligible to use this coupon code'));
            }
        }

    	$couponObject 		= new \App\Couponcode();
    	$couponRecord 		= $couponObject->checkValidity($coupon_code, $item_type);
    	$status 			= 0;
    	$discount_availed 	= 0;
    	$message 			= 'invalid';
    	$amount_to_pay 		= $purchased_amount;
    	$coupon_id			= 0;

    	if($couponRecord)
    	{
          	if($this->checkCouponUsage($couponRecord, $item, $item_type, $user))
    		{
    			//Coupon is valid
    			//Limit is not reached so do the follwoing operations
    			// 1) Check the minimum amount critria
    			// 2) Calculate discount eligiblity
    			// 3) Return the status message to user
    			if($purchased_amount>=$couponRecord->minimum_bill){
    				$discount_amount = $this->calculateDiscount($couponRecord, $purchased_amount);
    				$amount_to_pay = $purchased_amount - $discount_amount;
    				$discount_availed = $discount_amount;
    				if($amount_to_pay<0)
    					$amount_to_pay = 0;
    				$message 	= 'hey_you_are_eligible_for_discount';
    				$status 	= 1;
    				$coupon_id	= $couponRecord->id;
    			}
    			else {
    				$message = 'minimum_bill_not_reached. this_is_valid_for_minimum_purchase_of'.' '.getCurrencyCode().$couponRecord->minimum_bill;
    			}

    		}
    		else {
    			$message = 'limit_reached';
    		}

    	}
    	else
    	{
    		$message = 'invalid_coupon';
    	}

    	         

    	         $response['status']        = $status;
                 $response['message']       = $message;
                 $response['amount_to_pay'] = $amount_to_pay;
                 $response['discount']      = $discount_availed;
                 $response['coupon_id']     = $coupon_id;
                 return $response; 

    	

       
    }



      public function checkCouponUsage($couponRecord, $item, $item_type, $user)
    {

        $recs = DB::table('couponcodes_usage')
                        ->where('user_id','=',$user->id)
                        ->where('coupon_id', '=', $couponRecord->id)
                        ->get();
    	
          $count = count($recs);
    	if($count >= $couponRecord->usage_limit)
    		return FALSE;
    	return TRUE;
    }


     /**
     * This method calculates the eligible discount for using for this coupon
     * @param  [type] $couponRecord     [description]
     * @param  [type] $purchased_amount [description]
     * @return [type]                   [description]
     */
    public function calculateDiscount($couponRecord, $purchased_amount)
    {
    	$discount_amount = 0;
    	if($couponRecord->discount_type == 'percent')
    	{
    		$actual_discount = ($purchased_amount * ($couponRecord->discount_value / 100));
    		if($actual_discount > $couponRecord->discount_maximum_amount)
    		{
    			$actual_discount = $couponRecord->discount_maximum_amount;
    		}
    		$discount_amount = $actual_discount;
    		if($discount_amount<0)
    			$discount_amount = 0;
    	}
    	else {
    		$discount_amount = $couponRecord->discount_value;
    	}

    	return $discount_amount;
    }



    public function gatewayDetails()
    {
        
             $razorpay['razorpay_apikey']   = getRazorKey();
             $razorpay['razorpay_secret']   = getRazorSecret();
              
             $payu['payu_merchant_key']  = env('PAYU_MERCHANT_KEY', '');
             $payu['payu_salt']          = env('PAYU_SALT', '');
             $payu['payu_working_key']   = env('PAYU_WORKING_KEY', '');
             $payu['payu_testmode']      = env('PAYU_TESTMODE', '');
             
             $paypal['email']        = getSetting('email','paypal');
             $paypal['currency']     = getSetting('currency','paypal');
             $paypal['account_type'] = getSetting('account_type','paypal');
             
            return json_encode(array('razorpay'=>$razorpay, 'payu'=>$payu, 'paypal'=>$paypal ));   
        
    }

    public function saveTransaction(Request $request)
    {

       $response['status'] = 0;
       $response['message'] = 'Oops..! something went wrong';
       $response['record'] = null;

       try{
      $user_id                  = $request->user_id;
      $payment                  = new \App\Payment();
      $payment->slug            = getHashCode();
      $payment->user_id         = $user_id;
      $payment->item_id         = $request->item_id;
      $payment->item_name       = $request->item_name;
      $payment->start_date      = $request->start_date;
      $payment->end_date        = $request->end_date;
      $payment->plan_type       = $request->plan_type;
      $payment->payment_gateway = $request->payment_gateway; 
      $payment->transaction_id  = $request->transaction_id; 
      $payment->paid_by_parent  = 0; 
      $payment->paid_by         = $request->paid_by;
      $payment->actual_cost     = $request->actual_cost;
      $payment->coupon_applied  = $request->coupon_applied;
      $payment->coupon_id       = $request->coupon_id;
      $payment->discount_amount = $request->discount_amount;
      $payment->cost            = $request->cost;
      $payment->after_discount  = $request->after_discount;
      $payment->paid_amount  = $request->after_discount;
      $payment->payment_status  = $request->payment_status;
      $payment->save();

        if($payment->coupon_applied)
        {
          $this->couponcodes_usage($payment);
        }

       $response['status'] = 1;
       $response['record'] = $payment;
       $response['message'] = 'Payment updated successfully';

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

    public function getCurrencyCode()
    {
      $response['status']   = 1;
      $response['message']  = 'Currency code';
      $response['record']   = getCurrencyCode();
      return $response;
      // return getCurrencyCode();
    }


    public function getPaymentGateways()
    {

        $response['status']     = 1;
        $response['message']    = 'Site Mobile Gateways';

        $data = [];
        $data['payu']           = getSetting('payu', 'mobile_gateways');
        $data['paypal']         = getSetting('paypal', 'mobile_gateways');
        $data['razorpay']       = getSetting('razorpay', 'mobile_gateways');
        
        $data['offline_payment'] = getSetting('offline_payment', 'mobile_gateways');

        $response['data']  = $data;
        
        return $response;
    }

}
  
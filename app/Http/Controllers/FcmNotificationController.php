<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App;
use Auth;
use App\User;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

use LaravelFCM\Sender\FCMSender;
use FCM;

class FcmNotificationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }


     /**
     * send fcm notification page
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
	    if(!checkRole(getUserGrade(2)))
	    {
	        prepareBlockUserMessage();
	        return back();
	    }

        $data['active_class']       = 'fcm_notifications';
        $data['title']              = getPhrase('push_notification');
        $data['layout']     	 	= getLayout();
    	// return view('coupons.list', $data);
         $view_name = getTheme().'::fcm.send_notification';
        return view($view_name, $data);
    }


      /**
      * send notification to users
      *
      * @return Response
      */
     public function sendNotification(Request $request )
     {
       
       	if(!checkRole(getUserGrade(2)))
	    {
	        prepareBlockUserMessage();
	        return back();
	    }

        $columns = array(
        'title'  	=> 'bail|required|max:100',
        'message' 	=> 'bail|required|max:200',
        );
         

        $this->validate($request,$columns);
          
        $message=''; 
        try { 
	       if (!env('DEMO_MODE')) {

	       		// $site_title = getSetting('site_settings','site_title');
	       		$title = $request->title;
	       		$content = $request->message;

	       		$optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);

                $notificationBuilder = new PayloadNotificationBuilder($title);
                $notificationBuilder->setBody($content)->setSound('default');

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['a_data' => 'my_data']);

                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();

                $tokens = array();

                $tokens = User::where('role_id',getRoleData('student'))
                                    ->where('login_enabled',1)
                                    ->where('device_id','!=',null)
                                    ->pluck('device_id')
                                    ->toArray();

                //dd($tokens);
                                    

                if (count($tokens)) {
                        $downstreamResponse=FCM::sendTo($tokens, $option, $notification, $data);
	       				$message .= getPhrase('push_notification_sent_successfully');
	       		} else {
	       			 $message .= getPhrase('no_students_found');
	       		}
	        }

	    } catch(Exception $ex) {

	        $message .= getPhrase('\ncannot_send_push_notification, as it is in demo version');
	        $exception = 1;
	    }

      	$flash = app('App\Http\Flash');
      	$flash->create('Success...!', $message, 'success', 'flash_overlay',FALSE);
       
        return redirect(URL_FCM_NOTIFICATION);  
     }
}
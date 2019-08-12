<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use \App;
use Password;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
 

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    

    /**
     * Send Reset Password Link to User Email
     *
     * @return void
     */
    public function postEmail( Request $request )
    {
        $details = App\User::where('email', '=', $request->email)->first();

        if( $details )
        {
            $forgot_token = str_random(30);
            $details->remember_token = $forgot_token;
            $random_password = str_random(10);
            //$details->password = bcrypt( str_random(30) );
            $details->save();


            $login_link = URL_USERS_LOGIN;
            $changepassword_link = URL_RESET_PASSWORD . '/' . $forgot_token;
            $site_title = getSetting('site_title', 'site_settings');
            
            try{
                // sendEmail('forgotpassword', array('username'=>$details->name, 'to_email' => $details->email, 'changepassword_link' =>  $changepassword_link, 'site_title' => $site_title));

                sendEmail('forgotpassword', 
                        array('username'=>$details->name, 
                            'to_email' => $details->email, 
                            'password' => $random_password, 
                            'login_link' => $login_link, 
                            'changepassword_link' =>  $changepassword_link, 
                            'site_title' => $site_title)
                        );

                flash('Success...!', 'Reset Password Sent To Your Mail', 'success');
            }
            catch(Exception $ex)
            {
                flash('Ooops...!', 'There was an error : ' . $ex->getMessage(), 'error');
            }
                     
            return redirect( URL_USERS_LOGIN );
        }
        else
        {
            flash('Ooops...!', 'We have not found your email address', 'error');
            return redirect( URL_USERS_LOGIN );
        }
    }


    /**
     * Reset Password Form
     *
     *
     */
    public function getReset( $forgot_token )
    {
        $details = App\User::where('remember_token', '=', $forgot_token)->first();
        if( $details )
        {
            $data['token'] = $forgot_token;
            $data['main_active']    = 'register';
            return view('auth.passwords.reset', $data);
        }
        else
        {
            flash('Ooops...!', 'link is not valid. please check your email for details', 'error');
            return redirect( URL_USERS_LOGIN );
        }
    }

    /**
     * User Reset Password
     *
     *
     */
    public function postReset(Request $request)
    {

        $this->validate($request, [
        'password'  => 'required|min:6|confirmed',
        'password_confirmation'  => 'required|min:6',
        ]);
        $details = App\User::where('remember_token', '=', $request->token)->first();
        if( $details )
        {
            $details->password          = bcrypt($request->password);
            $details->remember_token    = null;
           
            $details->save();
            flash('Congrulations...!', 'You have successfully reset your password. Please login here.', 'success');
            return redirect( URL_USERS_LOGIN);
        }
        else
        {
            flash('Ooops...!', 'link_is_not_valid. please_check_your_email_for_details', 'error');
            return redirect( URL_USERS_LOGIN );
        }
    }
    
}

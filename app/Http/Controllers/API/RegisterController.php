<?php

namespace App\Http\Controllers\API;


use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

  


    /**
     * This method is used to register users from mobile app
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function postRegisterApp(Request $request)
     {
         
        

            $columns = array(
                            'name'     => 'bail|required|max:20|',
                            'username' => 'bail|required|unique:users,username',
                            'email'    => 'bail|required|unique:users,email',
                            'password' => 'bail|required|min:5',
                            'password_confirmation'=>'bail|required|min:5|same:password',
                            );
           
            $validated =  \Validator::make($request->all(),$columns);
            if(count($validated->errors()))
            {
                $response['status'] = 0;        
                $response['message'] = 'Validation Errors';
                $response['errors'] = $validated->errors()->messages();
                return $response;
            }    
            
        // $validated = $request->validated();

        $role_id = STUDENT_ROLE_ID;
        $response['status'] = 0;
        
        $response['message'] = '';
        // $response['errors'] = $validated->errors()->messages();
        // $response['validations'] = $validated;

        try 
        {

            $user           = new User();
            $name           = $request->name;
            
            $user->name     = $name;
            $user->username = $request->username;
            $user->email    = $request->email;
            $password       = $request->password;
            $user->password       = bcrypt($password);
            $user->role_id        = $role_id;

            $slug = $user::makeSlug($name);
            $user->slug           = $slug;


            $user->login_enabled  = 1;

            if ($request->device_id)
                $user->device_id = $request->device_id;

            $user->save();

           
            $user->roles()->attach($user->role_id);
            $response['status'] = 1;
            $response['message'] = 'Registered Successfully';
            
            if (!env('DEMO_MODE')) {

             $user->notify(new \App\Notifications\NewUserRegistration($user,$user->email,$password));
            }

        }
        catch(Exception $ex)
        {
            $response['status'] = 0;
            $message = $ex->getMessage();
            $response['message'] = $message;
        }
        // flash('success','You Have Registered Successfully. Please Check Your Email Address', 'overlay');
        return $response;
     }



}

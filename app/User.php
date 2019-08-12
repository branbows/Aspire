<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Cashier\Billable;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use Billable;
    use Messagable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   protected $dates = ['trial_ends_at', 'subscription_ends_at'];
    
    public function staff()
    {
        return $this->hasOne('App\Staff');
    }
 
     /**
     * The roles that belong to the user.
     */
    public function roles()
    {
         return $this->belongsToMany('App\Role', 'role_user');
         
    }


     
    /**
     * Returns the student record from students table based on the relationship
     * @return [type]        [Student Record]
     */
    public function student()
    {
        return $this->hasOne('App\Student');
    }

    



    public static function getRecordWithSlug($slug)
    {
        return User::where('slug', '=', $slug)->first();
    }

    public function isChildBelongsToThisParent($child_id, $parent_id)
    {
        return User::where('id', '=', $child_id)
              ->where('parent_id','=',$parent_id)
              ->get()
              ->count();
    }

    public function getLatestUsers($limit = 5)
    {
        return User::where('role_id','=',getRoleData('student'))
                     ->orderBy('id','desc')
                     ->limit($limit)
                     ->get();
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
        $user        = new User();
        $password         = str_random(8);
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

     /**
     * This method will return the user title
     * @return [type] [description]
     */
    public function getUserTitle()
    {
        return ucfirst($this->name);
    }


    public static function getUserSeleted($type='')
    { 
        $user         = Auth::user();
        $preferences  = (array)json_decode($user->settings);
        // dd($preferences);
        $cats  = array();
        $lmscats  = array();
        if(isset($preferences['user_preferences'])){

        $cats         = $preferences['user_preferences']->quiz_categories; 
        $lmscats      = $preferences['user_preferences']->lms_categories; 

       }

        if($type == 'categories')
        return $cats;

        if($type == 'lms_categories')
          return count($lmscats);
      
       if($type == 'quizzes' && $cats)
           return Quiz::whereIn('category_id',$cats)->where('total_questions','>',0)->get()->count();

       return 0;

     }



     /**
     * This method will return the user work experience
     * @return [type] [description]
     */
    public function experience()
    {
        return $this->hasMany('App\Workexperience');
    }


     /**
     * This method will return the user projects
     * @return [type] [description]
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }


    /**
     * This method will return the user academic profiles
     * @return [type] [description]
     */
    public function academicProfiles()
    {
        return $this->hasMany('App\Academicprofile');
    }


    /**
     * This method will return the user technical skills
     * @return [type] [description]
     */
    public function technicalSkills()
    {
        return $this->hasMany('App\Technicalskill');
    }


    /**
     * This method will return the user extra curricular activities
     * @return [type] [description]
     */
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
}

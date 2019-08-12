<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App;
use \App\UserSubscription;
use \App\Quiz;
use \App\LmsSeries;
use Response;
use Exception;
use Auth;

use App\Feedback;
use App\User;
use App\Page;

class SiteController extends Controller
{
    
    public function index()
    {
     
    
      if (env('DB_DATABASE')!='') {
       
        try {
          
         $current_theme            = getDefaultTheme(); 
         $data['home_title']       = getThemeSetting('home_page_title',$current_theme);
         $data['home_link']        = getThemeSetting('home_page_link',$current_theme); 
         $data['home_image']       = getThemeSetting('home_page_image',$current_theme); 
         $data['home_back_image']  = getThemeSetting('home_page_background_image',$current_theme); 

   

        $data['key'] = 'home';
        
        $data['active_class'] = 'home';

        // $categories           = App\QuizCategory::getShowFrontCategories(8); 

        $categories           = App\QuizCategory::getPracticeExamsCategories(8); 

        
        $data['categories']   = $categories;

        if(count($categories) > 0 ){

          $firstOne        = $categories[0];
          $quizzes         = Quiz::where('category_id',$firstOne->id)
                                 ->where('show_in_front',1)
                                 ->where('total_marks','>',0)
                                 ->limit(6)
                                 ->get();

          $data['quizzes'] = $quizzes;
          // dd($quizzes);
        }
      
         $lms_cates  = LmsSeries::getFreeSeries(8);

         if(count($lms_cates) > 0){
           
            $firstlmsOne  = $lms_cates[0];
            /*$firstSeries  = LmsSeries::where('lms_category_id',$firstlmsOne->id)
                                       ->where('show_in_front',1)
                                       ->where('total_items','>',0)
                                       ->limit(6)
                                       ->get();*/
            
            $firstSeries  = LmsSeries::where('lms_category_id',$firstlmsOne->id)
                                       ->where('show_in_front',1)
                                       ->where('total_items','>',0)
                                       ->orderby('created_at','desc')
                                       ->limit(4)
                                       ->get();

            $data['lms_cates']  = $lms_cates;
            $data['lms_series'] = $firstSeries;
         }
        
        
        //testimonies
        $data['testimonies'] = Feedback::join('users', 'users.id','=','feedbacks.user_id')
                                        ->select(['feedbacks.title','feedbacks.description','users.name','users.image'])
                                        ->where('feedbacks.read_status', 1)
                                        ->orderBy('feedbacks.updated_at', 'desc')
                                        ->get();

       

         
        $view_name = getTheme().'::site.index';
        return view($view_name, $data);

          }catch (Exception $e) {

              // return view('200');
               return redirect( URL_UPDATE_DATABASE );
           }

      }

      else {

        return redirect('/install');
      }

   
   
        // return view('system-emails.site.subscription');
    }
    /**
     * This method will load the static pages
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function sitePages($key='privacy-policy')
    {
        
        $available_pages = ['privacy-policy', 'terms-conditions','about-us','courses','pattren','pricing','syllabus'];
        if(!in_array($key, $available_pages))
        {
            pageNotFound();
            return back();
        }
        $data['title']        = ucfirst(getPhrase($key));
        if($key == 'about-us'){

        $data['title']        = getPhrase('about_us');
        }
        elseif($key == 'privacy-policy'){
        $data['title']        = getPhrase('privacy_policy');

        }
        elseif($key == 'terms-conditions'){
        $data['title']        = getPhrase('terms_conditions');

        }
        $data['key']          = $key;
        $data['active_class'] = $key;

        // return view('site.dynamic-view', $data);

         $view_name = getTheme().'::site.dynamic-view';
        return view($view_name, $data);
        
    }


    /**
     * This method save the subscription email
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function saveSubscription(Request $request)
    { 
      

       $email  = $request->useremail;
       $record   = UserSubscription::where('email',$email)->first(); 
       if(!$record){
           $new_record   = new UserSubscription();
           $new_record->email  = $email;
           $new_record->save();
           echo json_encode(array('status'=>'ok'));
       }
       else{
        echo json_encode(array('status'=>'existed'));
       }

    }

    /**
     * This method display the all fornt end exam categories
     * and exams
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function frontAllExamCats($slug='')
    { 
       
        $search_term = \Input::get('search_term');
        

        $data['key'] = 'home';
        
        $data['active_class'] = 'practice_exams';
        $categories           = App\QuizCategory::getPracticeExamsCategories(); 
        $data['categories']   = $categories;
        $quizzes  = array();
        
        if($categories && !$slug)
        {

          $firstOne = $categories[0];

            if ($search_term) {
              
              $quizzes  = Quiz::where('category_id', $firstOne->id)
                             ->where('show_in_front',1)
                             ->where('total_marks','>',0)
                             ->where('title','LIKE','%'.$search_term.'%')
                             ->paginate(9);

            } else {

              $quizzes  = Quiz::where('category_id', $firstOne->id)
                             ->where('show_in_front',1)
                             ->where('total_marks','>',0)
                             ->paginate(9);
            }

          $data['title']  = ucfirst($firstOne->category);
        }
        if($categories && $slug){
           
           $category  = App\QuizCategory::where('slug',$slug)->first();

            if ($search_term) {

              $quizzes   = Quiz::where('category_id', $category->id)
                             ->where('show_in_front',1)
                             ->where('total_marks','>',0)
                             ->where('title','LIKE','%'.$search_term.'%')
                             ->paginate(9);
            } else {

              $quizzes   = Quiz::where('category_id', $category->id)
                             ->where('show_in_front',1)
                             ->where('total_marks','>',0)
                             ->paginate(9);
            }

            $data['title']  = ucfirst($category->category);

        }
       
          $data['quizzes']   = $quizzes;
          $data['quiz_slug'] = $slug;

          $data['search_term'] = $search_term;

        $view_name = getTheme().'::site.allexam_categories';
        return view($view_name, $data);

      
    }

    /**
     * View all front end lms categories and series
     * @param  string $slug [description]
     * @return [type]       [description]
     */
    public function forntAllLMSCats($slug='')
    {
       
       $search_term = \Input::get('search_term');

        $data['key'] = 'home';
        
        $data['active_class'] = 'lms';
        $lms_cates            = array();
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['lms_cates']    = $lms_cates;
        $all_series           = array();

        if(count($lms_cates) && !$slug)
        {

          $firstOne        = $lms_cates[0];

          if ($search_term) {

            $all_series = LmsSeries::where('lms_category_id', $firstOne->id)
                                    ->where('show_in_front',1)
                                    ->where('total_items','>',0)
                                    ->where('title','LIKE','%'.$search_term.'%')
                                    ->paginate(9);

          } else {

            $all_series = LmsSeries::where('lms_category_id', $firstOne->id)
                                   ->where('show_in_front',1)
                                   ->where('total_items','>',0)
                                   ->paginate(9);
          }


           $data['title']  = ucfirst($firstOne->category);                               
         
        }
        
        if($lms_cates && $slug)
        {
           $category     = App\LmsCategory::where('slug',$slug)->first();


           if ($search_term) {

              $all_series   = LmsSeries::where('lms_category_id',$category->id)
                                      ->where('show_in_front',1)
                                      ->where('total_items','>',0)
                                      ->where('title','LIKE','%'.$search_term.'%')
                                      ->paginate(9);

           } else {

              $all_series   = LmsSeries::where('lms_category_id',$category->id)
                                      ->where('show_in_front',1)
                                      ->where('total_items','>',0)
                                      ->paginate(9);
           }
 
          $data['title']  = ucfirst($category->category);                             
        }
          $data['all_series']   = $all_series;
          $data['lms_cat_slug'] = $slug;

          $data['search_term'] = $search_term;

            $view_name = getTheme().'::site.alllms_categories';
        return view($view_name, $data);


    }

    /**
     * View all contents in specific lms series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function forntLMSContents($slug)
    {
       
        $data['key'] = 'home';
        
        $data['active_class'] = 'lms';

        $lms_series   = LmsSeries::where('slug',$slug)->first();
        $lms_category = App\LmsCategory::where('id',$lms_series->lms_category_id)->first();
        $contents     = $lms_series->viewContents(9);

        // dd($lms_series);

        $data['contents']     = $contents;
        $data['lms_series']   = $lms_series;

        
        $data['title']        = ucfirst($lms_series->title);
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['lms_cates']    = $lms_cates;
        $data['lms_cat_slug'] = $lms_category->slug;
        
            $view_name = getTheme().'::site.lms-contents';
        return view($view_name, $data);

    }
    
    /**
     * Downlaod lms file type contents
     * @return [type] [description]
     */
    public function downloadLMSContent($content_slug){
        $content_record = App\LmsContent::getRecordWithSlug($content_slug);
        // dd($content_record);
        
        try {
          
           $pathToFile= "public/uploads/lms/content"."/".$content_record->file_path;
              
           return Response::download($pathToFile);

        } catch (Exception $e) {
           
           flash('Ooops','file_is_not_found','error');
           return back();
        }
        

    }

    /**
     * View video type lms contents
     * @param  [type] $content_slug [description]
     * @return [type]               [description]
     */
    public function viewVideo($content_slug,$series_id='')
    {
       // dd($series_id);
        $content_record = App\LmsContent::getRecordWithSlug($content_slug);

     
        $data['key'] = 'home';
        
        $data['active_class']    = 'lms';
        $data['title']           = ucfirst($content_record->title);
        $data['content_record']  = $content_record;
        $data['video_src']       =  $video_src = $content_record->file_path;
        if($series_id!=''){
           $first_series   = LmsSeries::where('id',$series_id)->first();

             $all_series   = LmsSeries::where('lms_category_id',$first_series->lms_category_id)
                                         ->where('id','!=',$first_series->id)
                                         ->where('show_in_front',1)
                                         ->where('total_items','>',0)
                                         ->get();
         // dd($all_series);
        }
                                       
         $data['first_series']  = $first_series;
         $data['all_series']    = $all_series;

          $view_name = getTheme().'::site.lms-content-video';
        return view($view_name, $data);
    }
    
    /**
     * Send a email to super admin with user contact us details
     * @param Request $request [description]
     */
    public function ContactUs(Request $request)
    {
       // dd($request);
       $data  = array(); 
       $data['name']     = $request->name;
       $data['email']    = $request->email; 
       $data['number']   = $request->phone; 
       $data['subject']  = $request->subject; 
       $data['message']  = $request->message; 
        
        try {
           
            $super_admin  = App\User::where('role_id',1)->first();

            $super_admin->notify(new \App\Notifications\UserContactUs($super_admin, $data));

            sendEmail('usercontactus', array('name'=> $request->name, 
                      'to_email' => $request->email ));

         } catch (Exception $e) {
           // dd($e->getMessage());
         } 
        
        flash('congratulations','our_team_will_contact_you_soon','success');
        return redirect(URL_SITE_CONTACTUS);

    }


    public function getSeriesContents(Request $request)
    {
       $lms_series   = LmsSeries::find($request->lms_series_id);
       $contents     = $lms_series->viewContents();

       return json_encode(array('contents'=>$contents));

    }

    


    public function takeExamLogin($quiz_id)
    {
      // dd($quiz_id);
       session()->put('exam_id',$quiz_id);
       session()->put('active_time',time());

       
        if(Auth::check()){

           return redirect( PREFIX );
        }
       return redirect( URL_USERS_LOGIN );
    }





    /**
     * [page view details]
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function page($slug)
    {
        
        if (!$slug)
          return redirect( PREFIX );

        $page = Page::where('slug', $slug)->first();
        if (!$page)
            return redirect( PREFIX );

        $data['page']   = $page;
        $data['title']  = $page->name;
        $data['active_class'] = 'pages';

        // return view('site.dynamic-view', $data);

         $view_name = getTheme().'::site.page';
        return view($view_name, $data);
        
    }


}

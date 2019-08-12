<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Input;
use DB;
use App\Workexperience;
use App\Project;
use App\Technicalskill;
use App\Activity;
use App\Academicprofile;
use App\ResumeTemplate;


class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(PREFIX);
    }


    /**
      * Show the form for editing the user resume.
      *
      * @param  unique string  $slug
      * @return Response
      */
    public function editResume($slug)
    {
        $record = User::where('slug', $slug)->get()->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);

        /**
        * Validate the non-admin user wether is trying to access other user profile
        * If so return the user back to previous page with message
        */
       
        if(!isEligible($slug))
          return back();

        if(!checkRole(getUserGrade(5))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['record']             = $record;

    
        /**
        * get Resume Templates
        */
 
        $data['resume_templates'] = TRUE;
                           

        $data['active_class']       = 'resume';
        $data['title']              = getPhrase('edit_resume');
        $data['layout']             = getLayout();
      
        // return view('student.resume.build-resume', $data);

         $view_name = getTheme().'::student.resume.build-resume';
        return view($view_name, $data);

    }

    /**
     * Update the user resume in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function updateResume(Request $request, $slug)
    {
        // dd($request);

        // dd($request->projects_save);

        $record     = User::where('slug', $slug)->first();

        if(!isEligible($slug))
          return back();

        if(!checkRole(getUserGrade(5))) {
            prepareBlockUserMessage();
            return back();
        }

        $columns = [
        'name'                  => 'bail|required|max:20|',
        'department'            => 'bail|required|max:100|',
        'college_place'         => 'bail|required|max:100|',
        'country'               => 'bail|required|max:50|',
        'phone'                 => 'bail|required|max:20|',
        'dob'                   => 'bail|required|',
        'nationality'           => 'bail|required|max:100|',
        'qualification'         => 'bail|required|max:100|',
        'college_name'          => 'bail|required|max:100|',
        'state'                 => 'bail|required|max:100|',
        'gender'                => 'bail|required|',
        'marital_status'        => 'bail|required|',
        'father_name'           => 'bail|required|max:100|',
        'career_objective'      => 'bail|max:500',
        'declaration'           => 'bail|max:500'
        ];

        $this->validate($request,$columns);


        $name = $request->name;
        if($name != $record->name)
            $record->slug = $record::makeSlug($name);


        $record->name               = $request->name;
        $record->qualification      = $request->qualification;
        $record->department         = $request->department;
        $record->college_name       = $request->college_name;
        $record->college_place      = $request->college_place;
        $record->state              = $request->state;
        $record->country            = $request->country;
        $record->phone              = $request->phone;
        $record->gender             = $request->gender;
        $record->dob                = $request->dob;
        $record->marital_status     = $request->marital_status;
        $record->father_name        = $request->father_name;
        $record->nationality        = $request->nationality;
        $record->passport_number    = $request->passport_number;
        $record->linguistic_ability = $request->linguistic_ability;
        $record->personal_strength  = $request->personal_strength;
        $record->present_address    = $request->present_address;
        $record->field_of_interest  = $request->field_of_interest;
        $record->subject_taught     = $request->subject_taught;

        $record->career_objective   = $request->career_objective;
        $record->declaration        = $request->declaration;


        $record->save();


        
        //work experience details
        $work_experience = Input::get('workexperiencesave');

        if (count($work_experience)>0)
        {
            $user_experience = Workexperience::where('user_id','=',$record->id)->get();
            if (count($user_experience)>0)
            {
              //Delete previous work experience before update
               DB::table('workexperience')
              ->where('user_id', '=', $record->id)
              ->delete();
            }

            $count = count($work_experience);
          
             
            //loop through and save data
            for($i=0; $i<$count;$i++) {

              
              $details = json_decode($work_experience[$i]);
            

              $workexperience = new Workexperience;

              $workexperience->user_id               = $record->id;
              $workexperience->work_experience       = $details->work_experience;

              if ($details->from_date!='' && $details->from_date!=null)
                $workexperience->from_date =  date('Y-m-d',strtotime($details->from_date));
              else
                $workexperience->from_date = null;


              if ($details->to_date!='' && $details->to_date!=null)
                $workexperience->to_date =  $details->to_date;
              else
                $workexperience->to_date = null;

              $workexperience->save();
            }
        }
        //work experience details



        //projects details save
         $project_details = Input::get('projects_save');
        if (count($project_details)>0)
        {
            $user_projects = Project::where('user_id','=',$record->id)->get();
            if (count($user_projects)>0)
            {
              //Delete previous projects before update
               DB::table('projects')
              ->where('user_id', '=', $record->id)
              ->delete();
            }

            $count = count($project_details);
            
            //loop through and save data
            for($i = 0; $i < $count; ++$i) {

              $details = json_decode($project_details[$i]);

              $project = new Project;
             
              $project->user_id               = $record->id;
              $project->project_title         = $details->project_title;
              $project->project_description   = $details->project_description;
              $project->save();
            }
        }
        //projects done



        //technical skills save
        $technical_skills = Input::get('technical_skills_save');
        if (count($technical_skills)>0)
        {
            $user_technical_skills = Project::where('user_id','=',$record->id)->get();
            if (count($user_technical_skills)>0)
            {
              //Delete previous technical skills before update
               DB::table('technicalskills')
              ->where('user_id', '=', $record->id)
              ->delete();
            }


            $count = count($technical_skills);
            
            //loop through and save data
            for($i = 0; $i < $count; ++$i) {

              $details = json_decode($technical_skills[$i]);

              $technicalskill = new Technicalskill;
             
              $technicalskill->user_id               = $record->id;
              $technicalskill->skill_type            = $details->skill_type;
              $technicalskill->skills_known          = $details->skills_known;
              $technicalskill->save();
            }
        }
        //technical skills




        //extra curricular activties save
        $activities_data = Input::get('activities_data_save');
        if (count($activities_data)>0)
        {
            $user_activities = Activity::where('user_id','=',$record->id)->get();
            if (count($user_activities)>0)
            {
              //Delete previous technical skills before update
               DB::table('activities')
              ->where('user_id', '=', $record->id)
              ->delete();
            }


            $count = count($activities_data);
            
            //loop through and save data
            for($i = 0; $i < $count; ++$i) {

              $details = json_decode($activities_data[$i]);

              $activity = new Activity;
             
              $activity->user_id               = $record->id;
              $activity->activity_description            = $details->activity_description;
              $activity->save();
            }
        }
        //activties


        //academic profile save
         $academic_data = Input::get('academic_data');
        if (count($academic_data)>0)
        {
            $user_academics = Activity::where('user_id','=',$record->id)->get();
            if (count($user_academics)>0)
            {
              //Delete previous academic profiles before update
               DB::table('academicprofiles')
              ->where('user_id', '=', $record->id)
              ->delete();
            }


            $count = count($academic_data);
            
            //loop through and save data
            for($i = 0; $i < $count; ++$i) {

              $details = json_decode($academic_data[$i]);

              $academic = new Academicprofile;
             
              $academic->user_id                = $record->id;
              $academic->examination_passed     = $details->examination_passed;
              $academic->university             = $details->university;
              $academic->passed_out_year        = $details->passed_out_year;
              $academic->marks_obtained         = $details->marks_obtained;
              $academic->class                  = $details->class;
              $academic->save();

            }
        }
        //academic profile



        $message = getPhrase('details_saved_successfully');
        $flash = app('App\Http\Flash');
        $flash->create('Success...!', $message, 'success', 'flash_overlay',FALSE); 

        return redirect(URL_USER_BUILD_RESUME.$record->slug);  

    }

    /**
     * Check resource exsit in storage.
     *
     * @param  array  $record
     * @return \Illuminate\Http\Response
     */
    public function isValidRecord($record)
    {
      if ($record === null) {
        flash('Ooops...!', getPhrase("page_not_found"), 'error');
        return $this->getRedirectUrl();
      }
    }

    public function getUserResumeData()
    {
        $user = \Auth::user();
        if (!$user)
          return redirect(PREFIX);

        //work experience
        $work_experience = $user->experience()->select('work_experience','from_date','to_date')->get();

        //projects
        $projects = $user->projects()->select('project_title','project_description')->get();

        
        //academicprofiles
        $academic_profiles = $user->academicProfiles()->select('examination_passed','university','passed_out_year','marks_obtained','class')->get();


        //skills_data
        $technical_skills  = $user->technicalSkills()->select('skill_type','skills_known')->get();

        //activities_data
        $activities = $user->activities()->select('activity_description')->get();


        return json_encode(array('work_experience'=>$work_experience,'projects_data'=>$projects,'academic_data'=>$academic_profiles,'skills_data'=>$technical_skills,'activities_data'=>$activities));
    }

     /**
      * Show the user selected resume template.
      *
      * @param  unique string  $slug
      * @return Response
      */
    public function resumeTemplate($user_slug, $resume_slug)
    {

        $user = User::where('slug', $user_slug)->first();

        if($isValid = $this->isValidRecord($user))
         return redirect($isValid);

        /**
        * Validate the non-admin user wether is trying to access other user profile
        * If so return the user back to previous page with message
        */
       
        if(!isEligible($user_slug))
          return back();

        if(!checkRole(getUserGrade(5))) {
            prepareBlockUserMessage();
            return back();
        }
        $data['user']             = $user;

        //work experience
        $data['work_experience']  = $user->experience()->get();
        
        //project
        $data['projects']         = $user->projects()->get();

        //academic_profiles
        $data['academic_profiles'] = $user->academicProfiles()->get();

        //technical_skills
        $data['technical_skills']  = $user->technicalSkills()->get();

        //activities
        $data['activities']        = $user->activities()->get();
      $template = 'white_template';
      $new_template = null;
        if($resume_slug)
          $new_template = ResumeTemplate::where('slug','=',$resume_slug)->first();
        else
          $new_template = ResumeTemplate::where('is_default','=', '1')->first();



        if($new_template)
          $template = $new_template->resume_key;
        $view = 'student.resume.templates.'.$template;

        $data['active_class']       = 'resume';
        $data['title']              = getPhrase('resume_template');


       

        $templatecontent = '';

        $file_name = $user->username.'_resume.doc';

       
        $view = \View::make($view, $data);

        // dd($view);

        $html_data = ($view);

        echo $html_data;

        die();

      //   $contents = (string) $view;

      //   $contents = $view->render();

      // $headers = array(
      //   "Content-type"=>"text/html",
      //   "Content-Disposition"=>"attachment;Filename=$file_name"
      // );

      //       return \Response::make($contents,200, $headers);
    }



   /**
      * Show the user selected resume template.
      *
      * @param  unique string  $slug
      * @return Response
      */
    public function userResume($slug)
    {
        $user = User::where('slug', $slug)->first();

        if($isValid = $this->isValidRecord($user))
         return redirect($isValid);

        /**
        * Validate the non-admin user wether is trying to access other user profile
        * If so return the user back to previous page with message
        */
       
        if(!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }
        $data['user']             = $user;

        //work experience
        $data['work_experience']  = $user->experience()->get();

        //project
        $data['projects']         = $user->projects()->get();

        //academic_profiles
        $data['academic_profiles'] = $user->academicProfiles()->get();

        //technical_skills
        $data['technical_skills']  = $user->technicalSkills()->get();

        //activities
        $data['activities']        = $user->activities()->get();
    
        $data['active_class']       = 'users';
        $data['title']              = getPhrase('user_resume');

        $template = 'white_template';

        $new_template = App\ResumeTemplate::where('is_default','=','1')->first();
        if($new_template)
          $template = $new_template->resume_key;

       
        $view = 'student.resume.templates.'.$template;

        

      $view = \View::make($view, $data);
      

     
        $html_data = ($view);

        echo $html_data;

        die();

      // $contents = (string) $view;

      // $contents = $view->render();
      // $file_name  = $user->username.'_resume.doc';

      // $headers = array(
      //   "Content-type"=>"text/html",
      //   "Content-Disposition"=>"attachment;Filename=$file_name"
      // );

      // return \Response::make($contents,200, $headers);

        // return view(, $data);
    }

}

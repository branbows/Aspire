<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class ExamsController extends Controller
{

    /**
     * List the categories available
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function exams(Request $request, $slug='')
    {
      $category = FALSE;

      $user_id = $request->user_id;
      $user =   $user = \App\User::where('id','=', $user_id)->first();

      $interested_categories      = null;

      $response['status'] = 0;
      $response['message'] = null;
      $response['exams'] = null;

      if(!$user)
      {
        $response['message'] = 'Invalid User';
        return $response;
      }


     $records = null;
      if($slug=='all')
        {
             
           if ($user->settings)
           {
             $interested_categories =  json_decode($user->settings)->user_preferences;
           }
           // dd($interested_categories);
             $cats  = $interested_categories->quiz_categories;
            
            $records = \App\Quiz::join('quizcategories', 'quizzes.category_id', '=', 'quizcategories.id')
            ->select(['title', 'dueration', 'category', 'is_paid', 'total_marks','tags','quizzes.slug','quizzes.validity','quizzes.cost','quizzes.exam_type', 'quizzes.section_data','quizzes.has_language','quizzes.image','quizzes.language_name','quizzes.id as id' ])
            ->where('total_marks', '!=', 0)
            ->where('start_date','<=',date('Y-m-d'))
            ->where('end_date','>=',date('Y-m-d'))
            ->whereIn('quizzes.category_id',$cats)
            ->get();

        }
        else {
          $category = \App\QuizCategory::getRecordWithSlug($slug);

          if($category){
            $records = \App\Quiz::join('quizcategories', 'quizzes.category_id', '=', 'quizcategories.id')
                ->select(['title', 'dueration', 'category', 'is_paid', 'total_marks','quizzes.slug', 'quizzes.validity','quizzes.cost','quizzes.exam_type', 'quizzes.section_data','quizzes.has_language','quizzes.image','quizzes.language_name','quizzes.id as id' ])
                ->where('quizzes.category_id', '=', $category->id)
                ->where('total_marks', '!=', 0)
                ->where('start_date','<=',date('Y-m-d'))
                ->where('end_date','>=',date('Y-m-d'))
                ->get();
                 $response['status'] = 1;
            }
            else{
              $response['message'] = 'Invalid category';
            }
        }

     
      // $response['exams'] = $records;
      $exams =[];
      // $record = $records[2];
      foreach($records as $item)
      {
        
        $temp['title'] = $item->title;
        $temp['dueration'] = $item->dueration;
        $temp['category'] = $item->category;
        $temp['is_paid'] = $item->is_paid;

        $temp['is_purchased'] = (int)\App\Payment::isItemPurchased($item->id, 'exam', $user->id);
        $temp['total_marks'] = $item->total_marks;
        $temp['slug'] = $item->slug;
        $temp['validity'] = $item->validity;
        $temp['cost'] = $item->cost;
        $temp['id'] = $item->id;
        $temp['total_questions'] = count($item->getQuestions());

        $temp['exam_type'] = $item->exam_type;
        $temp['section_data'] = $item->section_data;
        $temp['has_language'] = $item->has_language;
        $temp['image'] = $item->image;
        $temp['language_name'] = $item->language_name;
        

        $exams[] = $temp;

      }
      
      $response['exams'] = $exams;
      return $response;
    } 




    /**
     * This method displays all the details of selected exam series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function viewSeriesItem(Request $request, $slug='')
    {
     
        $record = \App\ExamSeries::getRecordWithSlug($slug); 
        $response['status'] = 0;
        $response['message']='';

        $user_id = $request->user_id;
        $user =   $user = \App\User::where('id','=', $user_id)->first();

        if(!$record)
        {
         $response['message'] = 'Invalid Exam Series';
         return $response;
        }

        $r = $record;
          $temp['title']    = $r->title;
          $temp['id']       = $r->id;
          $temp['slug']       = $r->slug;
          $temp['category_id']       = $r->category_id;
          $temp['is_paid']       = $r->is_paid;
          $temp['cost']       = $r->cost;
          $temp['validity']       = $r->validity;
          $temp['total_exams']       = $r->total_exams;
          $temp['total_questions']       = $r->total_questions;
          $temp['image']       = $r->image;
          $temp['short_description']       = $r->short_description;
          $temp['start_date']       = $r->start_date;
          $temp['end_date']       = $r->end_date;
          $temp['end_date']       = $r->end_date;
          $temp['is_purchased'] = (int)\App\Payment::isItemPurchased($r->id, 'combo', $user->id);

         
        $response['content_record']     = FALSE;
        $response['item']               = $temp;
        $response['total_exams']          = $record->total_exams;
        $response['items_list']          = $record->itemsList();
        $response['status'] = 1;
        return $response;
    }

    public function examSeries(Request $request)
    {
      
      $user_id = $request->user_id;

      $user    = \App\User::where('id','=', $user_id)->first();

      $interested_categories  = null;
      $categories             = null;

      $response['status']     = 0;
      $response['message']    = null;
      $response['records']    = null;

       if($user->settings)
       {
         $interested_categories =  json_decode($user->settings)->user_preferences;
       }

       if( $interested_categories ) {

        if( count( $interested_categories->quiz_categories ) ){

             $categories   = \App\QuizCategory::whereIn('id',(array) $interested_categories->quiz_categories)
                                            ->pluck('id')
                                            ->toArray();
             }                               
        }

        // return $response['data']  = $categories;
        
        if( count( $categories ) > 0){


            $recs    = \App\ExamSeries::whereIn('category_id',$categories)->get();
        $records = [];

        foreach($recs as $r)
        {

          $temp['title']             = $r->title;
          $temp['id']                = $r->id;
          $temp['slug']              = $r->slug;
          $temp['category_id']       = $r->category_id;
          $temp['is_paid']           = $r->is_paid;
          $temp['cost']              = $r->cost;
          $temp['validity']          = $r->validity;
          $temp['total_exams']       = $r->total_exams;
          $temp['total_questions']   = $r->total_questions;
          $temp['image']             = $r->image;
          $temp['short_description'] = $r->short_description;
          $temp['start_date']        = $r->start_date;
          $temp['end_date']          = $r->end_date;
          $temp['end_date']          = $r->end_date;
          $temp['is_purchased']      = (int)\App\Payment::isItemPurchased($r->id, 'combo', $user->id);
          $records[] = $temp;

          }

          $response['status'] = 1;
          $response['records'] = $records;
          return $response;

        }else{
           
           $response['status'] = 0;
          $response['message'] = 'Please Update Your Settings';
          return $response;

        }
       

	

       
    }

    public function getQuestions(Request $request, $slug)
    {

      // return $data['test']  = "ghaa";

        $quiz                = \App\Quiz::getRecordWithSlug($slug);
        $questions = [];
        $data['status'] = 0;
        $sno = 1;
        if(!$quiz)
        {
          $data['message'] = 'Invalid quiz';
          return $data;
        }


       $user_id = $request->user_id;

        $user =   $user = \App\User::where('id','=', $user_id)->first();

        if(!$user)
        {
          $data['message'] = 'Invalid UserID';
          return $data;
        }

        $current_state       = null;
        $any_resume_exam     = FALSE;

        $time                = $this->convertToHoursMins($quiz->dueration);
        $atime               = $this->convertToHoursMins($quiz->dueration);
        $current_question_id = null;
         // dd($prepared_records);
        $prepared_records = null;

         if($quiz->exam_type=='NSNT'){      

        if(!$any_resume_exam){

          $prepared_records   = (object) $quiz->prepareQuestions($quiz->getQuestions(),'',$user_id);
          // $questionsset = [];
          // foreach($prepared_records->questions as $q)
          // {
          //   $q->answers = json_decode($q->answers);
          //   $questionsset[]  = $q;
          // }
          //  $prepared_records->questions = $questionsset;

        }


        if($current_state) 
        {
           $temp = [];

           foreach($current_state as $key => $val)
           {
              $temp[(int) $key] = $val;
              
           }
           $current_state = $temp;
        }

      }
      else{
        
        $section_data    = (array)json_decode($quiz->section_data);
        $sections        = array(); 
        $section_names   = array();

        foreach ($section_data as $key => $value) {
          // dd($value);
          $sections[]  = $key;
          $section_names[]  = $value->section_name;

        }

        $questions    = $quiz->getSectionQuestions($section_data);
        $fquestions = [];
        foreach($questions as $question)
        {
           $newData = [];
           $newData['sno'] = $sno++;
           $newData['is_bookmarked'] = $question->isQuestionBookmarked()->where('user_id', $user_id)->count();
           $question->question_tags = $newData;

           if($question->question_type == 'para' || $question->question_type == 'audio' 
              || $question->question_type == 'video'){
             

                 $questions_data  = json_decode($question->answers);
               
                 $temp = $this->decodeQuestionsData($questions_data);

                 // if(count($temp['options']))
                 //   $temp['options'] = $temp['options'][0];
                 // if(count($temp['optionsl2']))
                 //   $temp['optionsl2'] = $temp['optionsl2'][0];

                 // if($question->id==66)
                 //  dd(($temp['options']));
                  // dd(($temp));
               
                // dd('asdf');

             $question->answers = json_encode($temp);
            }

           // if($question->id==66)

          $fquestions[] = $question;
        }
        $questions = $fquestions;
        $this->saveQuizQuestions($questions, $quiz,$user_id);
       }

       

        $data['time_hours']         = makeNumber($time['hours'],2,'0','left');
        $data['time_minutes']       = makeNumber($time['minutes'],2,'0','left');
        $data['time_seconds']       = makeNumber($time['seconds'],2,'0','left');

        $data['atime_hours']         = makeNumber($atime['hours'],2,'0','left');
        $data['atime_minutes']       = makeNumber($atime['minutes'],2,'0','left');
        $data['atime_seconds']       = makeNumber($atime['seconds'],2,'0','left');

        $data['quiz']               = $quiz;
        $data['user']               = $user;
        $data['title']              = $quiz->title;
       
                //No Section Exams Form
        if($quiz->exam_type == 'NSNT'){
        // if(1){

        $data['current_state']       = $current_state;
        $data['current_question_id'] = $current_question_id;
        $final_questions             = $prepared_records->questions;
        $final_subjects              = $prepared_records->subjects;
        $data['questions']           = $final_questions;
        $data['subjects']            = $final_subjects;
        $bookmarks                   = array_pluck($final_questions, 'id');
        $data['bookmarks']           = $bookmarks;
      
        $temp_answers = [];
        foreach ($final_questions as $question) {
            
            if($question->question_type == 'para' || $question->question_type == 'audio' 
              || $question->question_type == 'video'){
             

                 $questions_data  = json_decode($question->answers);
                $ftemp  = [];
                 $t = $this->decodeQuestionsData($questions_data);
                // dd($t);
                foreach($t as $temp ){

                  if(isset($temp['options']))
                  {
                   if(count($temp['options']))
                   {
                     $temp['options'] = $temp['options'][0];
                   }
                  }

                 if(isset($temp['optionsl2']))
                 {
                   if(count($temp['optionsl2']))
                   {
                     $temp['optionsl2'] = $temp['optionsl2'][0];

                   }
                 }
                 // if(count($temp['options']))
                  $ftemp[] = $temp;
                }
                 // if($question->id==67)
                 //  dd(($t));
                  // dd(($temp));
               
                // dd('asdf');

             $question->answers = json_encode($t);
            }

        }

         // $data['all_options']  = $all_options;
       
        

       $data['right_bar_data']     = array(
                                              'questions'      => $final_questions, 
                                              'current_state'  => $current_state, 
                                              'quiz'           => $quiz, 
                                              'time_hours'     => $data['time_hours'], 
                                              'time_minutes'   => $data['time_minutes'],
                                              'atime_hours'    => $data['atime_hours'], 
                                              'atime_minutes'  => $data['atime_minutes']
                                              );

        }

        if($quiz->exam_type=='SNT'){

          
           $data['right_bar_data']     = array(
                                              'questions'      => $questions, 
                                              'current_state'  => $current_state, 
                                              'quiz'           => $quiz, 
                                              'time_hours'     => $data['time_hours'], 
                                              'time_minutes'   => $data['time_minutes'],
                                              'atime_hours'    => $data['atime_hours'], 
                                              'atime_minutes'  => $data['atime_minutes']
                                              );
 
          }
           else {


               $section_data  = (array)json_decode($quiz->section_data);
               $section_keys = array_keys($section_data);

               $first_section_data = null;
               if(is_array($section_data)){
               if(count($section_data)){
	               if(isset($section_data[$section_keys[0]]))
	               	$first_section_data = $section_data[$section_keys[0]];
           		}
           		}



              $section_timings = [];
              $index = 0;
               foreach($section_data as $key=>$value) 
               {
                  $section_time =  $value->section_time;
                  $section_hrs = 0;
                  $section_minutes = $section_time;
                  $section_seconds = 1;  
                  
                  if($section_time>60)
                  {
                    $section_hrs     = floor($section_time / 60);
                    $section_minutes = ($section_time % 60);
                  }

                  $section_timings[$index]['section_key'] = $key;
                  $section_timings[$index]['section_name'] = $value->section_name;
                  $section_timings[$index]['hrs'] = $section_hrs;
                  $section_timings[$index]['minutes'] = $section_minutes;
                  $section_timings[$index]['seconds'] = $section_seconds;
                  $index++;
               }
 

               $time_hours = 0;//$section_timings[0]['hrs'];
               $time_minutes = 0;
               if(count($section_timings))
               {
               		if(isset($section_timings[0]))
               		{
               		$time_hours = $section_timings[0]['hrs'];
               
               		$time_minutes = $section_timings[0]['minutes'];
               		}
           		}
             // $data['right_bar_path']     = 'student.exams.sectiontimer-exam-rigth-bar';
             $data['right_bar_data']     = array(
                                              'questions'      => $questions, 
                                              'current_state'  => $current_state, 
                                              'quiz'           => $quiz, 
                                              'time_hours'     => $time_hours, 
                                              'time_minutes'   => $time_minutes,
                                             
                                              );
            $data['section_timings']   = $section_timings;  
         
          }

        // dd($data);
        return $data;

    }

    public function decodeQuestionsData($questions_data)
    {
      $ftemp = [];
      $i=0;
       foreach ($questions_data as $answer) {
                  $temp=[];
                  $options = [];
                  $temp['question'] = $answer->question;
                  $temp['questionl2'] = '';
                  if(isset($answer->questionl2))
                  $temp['questionl2'] = $answer->questionl2;
                  $temp['total_options'] = $answer->total_options;
                  
                   $options  = ($answer->options);
                   $optionsl2  = null;
                   if(isset($answer->questionl2))
                   $optionsl2  = ($answer->optionsl2);

                   if(is_array($options))
                   {
                  if(count($options))
                    $options = $options[0];
                }
                if(is_array($optionsl2))
                {
                  if(count($optionsl2))
                    $optionsl2 = $optionsl2[0];
                
                }
               

                $temp_options = [];
                foreach($options as $o)
                {
                  $temp_options[] = $o;
                }
              $temp_optionsl2 = [];
              if($optionsl2)
                foreach($optionsl2 as $o)
                {
                  $temp_optionsl2[] = $o;
                }

                if(count($temp_options))
                  $temp_options = $temp_options;
                
                if(count($temp_optionsl2))
                {
                  $temp_optionsl2 = $temp_optionsl2;
                }


                $temp['options'] = $temp_options;
                if($i>0)
                {
                  if(isset($temp_options[0]))
                  {
                    if(is_array($temp_options[0]))
                      $temp['options'] = $temp_options[0];
                  }

                  if(isset($temp_optionsl2[0]))
                  {
                    if(is_array($temp_optionsl2[0]))
                      $temp['optionsl2'] = $temp_optionsl2[0];
                  }



                }

                $ftemp[] = $temp;
                
                 $i++;
                }

                return $ftemp;
    }

    public function saveQuizQuestions($questions, $quiz, $user_id)
    {
         $record                        = new \App\QuizQuestions();
         $record->quiz_id               = $quiz->id;
         $record->student_id            = $user_id;
         $record->questions_data        = json_encode($questions);
         $record->save();
    }

        /**
     * Convert minutes to Hours and minutes
     */
     function convertToHoursMins($time, $format = '%02d:%02d') 
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        $result['hours'] = $hours;
        $result['minutes'] = $minutes;
        $result['seconds'] = 0;
        return $result;
    }



     /**
     * This method returns the datatable for the student exam attempts
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function overallSubjectAnalysis($id)
    {
      
      $user = \App\User::where('id', $id)->first();
      $response['status'] = 0;
      $response['message'] = '';

      if(!$user)
      {
        $response['message'] = 'Invalid User';
        return $response;
      }

       
        $records = array();
       $records = ( new \App\QuizResult())->getOverallSubjectsReport($user);
       if(!$records)
        {
          $response['message'] = 'No Records available';
          return $response;
        }
        $color_correct = getColor('background',rand(00,9999));
        $color_wrong = getColor('background', rand(00,9999));
        $color_not_attempted = getColor('background', rand(00,9999)); 
        $i=0;
        $labels = [];
        $dataset = [];
        $dataset_label = [];
        $bgcolor = [];
        $border_color = [];
        
        $marks_labels = [getPhrase('correct'), getPhrase('wrong'), getPhrase('not_answered')];
        $time_labels = [getPhrase('time_spent_on_correct_answers'), getPhrase('time_spent_on_wrong_answers')];

       foreach($records as $record) {
       $record = (object)$record;
      
       //Marks
        $subjects_display[$i]['subject_name'] = $record->subject_name;
        $subjects_display[$i]['correct_answers'] = $record->correct_answers;
        $subjects_display[$i]['wrong_answers'] = $record->wrong_answers;
        $subjects_display[$i]['not_answered'] = $record->not_answered;

        // Time
         $subjects_display[$i]['time_spent_on_correct_answers'] = $record->time_spent_on_correct_answers;
         $subjects_display[$i]['time_spent_on_wrong_answers']   = $record->time_spent_on_wrong_answers;
         $subjects_display[$i]['time_to_spend']                 = $record->time_to_spend;
         $subjects_display[$i]['time_spent']                    = $record->time_spent;

      
        $marks_dataset = [$record->correct_answers, $record->wrong_answers, $record->not_answered];
        $time_dataset = [$record->time_spent_on_correct_answers, $record->time_spent_on_wrong_answers];
        $dataset_label = $record->subject_name;
       
        $bgcolor  = [$color_correct,$color_wrong,$color_not_attempted];
        
        $border_color = [$color_correct,$color_wrong,$color_not_attempted];

        
        $marks_data['type'] = 'pie'; 
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $marks_data['title'] = $record->subject_name;  

        $marks_data['data']   = (object) array(
            'labels'            => $marks_labels,
            'dataset'           => $marks_dataset,
            'dataset_label'     => $dataset_label,
            'bgcolor'           => $bgcolor,
            'border_color'      => $border_color
            );
        
        $data['chart_data'][] = (object)$marks_data;


        $time_data['type'] = 'bar'; 
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $time_data['title'] = $record->subject_name;  

        $time_data['data']   = (object) array(
            'labels'            => $time_labels,
            'dataset'           => $time_dataset,
            'dataset_label'     => $dataset_label,
            'bgcolor'           => $bgcolor,
            'border_color'      => $border_color
            );
        
        $data['time_data'][] = (object)$time_data;

        $i++;
       } 
     
      $data['chart_data'][] = (object)$marks_data;

      $overall_correct_answers = 0;
      $overall_wrong_answers = 0;
      $overall_not_answered = 0;

      $overall_time_spent_correct_answers = 0;
      $overall_time_spent_wrong_answers = 0;
      
      foreach($records as $r)
      {
        $r = (object)$r;
        $overall_correct_answers  += $r->correct_answers;
        $overall_wrong_answers    += $r->wrong_answers;
        $overall_not_answered     += $r->not_answered;
        
        $overall_time_spent_correct_answers     += $r->time_spent_on_correct_answers;
        $overall_time_spent_wrong_answers       += $r->time_spent_on_wrong_answers;
      }

        $overall_marks_dataset = [$overall_correct_answers, $overall_wrong_answers, $overall_not_answered];
        $overall_time_dataset = [$overall_time_spent_correct_answers, $overall_time_spent_wrong_answers];

        $overall_marks_data['type'] = 'doughnut'; 
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $overall_marks_data['title'] =  getPhrase('overall_marks_analysis');
        $overall_marks_data['data']   = (object) array(
            'labels'            => $marks_labels,
            'dataset'           => $overall_marks_dataset,
            'dataset_label'     => getPhrase('overall_marks_analysis'),
            'bgcolor'           => $bgcolor,
            'border_color'      => $border_color
            );

      $data['right_bar_path']     = 'student.exams.subject-analysis.right-bar-performance-chart';
      $data['right_bar_data']     = array('right_bar_data' => (object)$overall_marks_data);
        
      $data['overall_data'][] = (object)$overall_marks_data;
       
      $data['subjects_display']   = $records;
      $data['active_class']       = 'analysis';
      $data['title']              = getPhrase('overall_subject_wise_analysis');
      $data['user']               = $user;
      $userid = $user->id;
      $data['layout']             = getLayout();

      // return view('student.exams.subject-analysis.subject-analysis', $data);

              $view_name = getTheme().'::student.exams.subject-analysis.subject-analysis';
        return view($view_name, $data);   

    }


     /**
     * After the exam complets the data will be submitted to this method
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function finishExam(Request $request, $slug)
    {
      
      // $alldata = json_decode(file_get_contents('php://input'), true);

      // header('Content-Type: application/json');
      $alldata = \Input::all();
      
      /*$response['record']  =  $alldata['time_spent'];
      $response['message'] = 'testing';
      return $response;*/

      $formated_data = [];
      $formated_data['time_spent'] = (array)json_decode($alldata['time_spent']);
      $formated_data['quiz_id'] = json_decode($alldata['quiz_id']);
      $formated_data['student_id'] = json_decode($alldata['student_id']);
      $formated_data['answers'] = (array)json_decode($alldata['answers']);



      // dd($formated_data);
      // dd($formated_data);
      // $time_spent = $alldata['time_spent'];
      // $answers = $alldata['answers'];
      // dd(json_decode($answers));
      // dd(($request->quiz_id));
      // // dd(($request->time_spent));
        $quiz = \App\Quiz::getRecordWithSlug($slug);

       $user_record = \App\User::where('id', $formated_data['student_id'])->first();
       $user = $user_record;
       $response['status'] = 0;
       $response['message'] = '';
        if(!$quiz)
        {
          $response['message'] = 'Invalid Quiz Record';
            return $response;
        }
        if(!$user)
        {
            $response['message'] = 'Invalid User Record';
            return $response;
        }

        $input_data = $formated_data;
        // $input_data = \Input::all();
        $answers = array();
        $time_spent = $request->time_spent;

       
       
        //Remove _token key from answers data prepare the list of answers at one place
        // foreach ($input_data as $key => $value) {
        //     if($key=='_token' || $key=='time_spent')
        //         continue;
        //     $answers[$key] = $value;
        // }
        $temp_answers = $formated_data['answers'];
        foreach($temp_answers as $key=>$ans)
        {
          // $key = (int)$key;
          // dd($key);
          $answers[(int)$key]=$ans;
        }

        // return $response['data'] = $answers;
        // $qution = $this->getQuestionRecord(72);
        // return $response['data'] = $qution['time_to_spend'];


        // dd($answers);

        // $recorded_questions    = QuizQuestions::where('quiz_id',$quiz->id)
        //                                       ->where('student_id',$user_record->id)
        //                                       ->where('is_exam_completed',0)
        //                                       ->first();


        // $recorded_questions->is_exam_completed  = 1;
        // $recorded_questions->save();   


        //Get the list of questions and prepare the list at one place
        //This is to find the unanswered questions
        //List the unanswered questions list at one place
        $questions = \DB::table('questionbank_quizzes')->select('questionbank_id', 'subject_id')
                     ->where('quize_id','=',$quiz->id)
                     ->get();
        
       /* return $response['data'] = array('input_time_spent'=>$time_spent,
                                          'get_questions'=>$questions);*/

        $subject                  = [];
        $time_spent_not_answered  = [];
        $not_answered_questions   = [];

        foreach($questions as $q)
        {
          
          // dd(json_decode($time_spent));
          $subject_id = $q->subject_id;
           if(! array_key_exists($q->subject_id, $subject)) {
              $subject[$subject_id]['subject_id']       = $subject_id;
              $subject[$subject_id]['correct_answers']  = 0;
              $subject[$subject_id]['wrong_answers']    = 0;
              $subject[$subject_id]['not_answered']     = 0;
              $subject[$subject_id]['time_spent']       = 0;
              $subject[$subject_id]['time_to_spend']       = 0;
              $subject[$subject_id]['time_spent_correct_answers']    = 0;
              $subject[$subject_id]['time_spent_wrong_answers']    = 0;
            }
            if(! array_key_exists($q->questionbank_id, $answers)){
              $subject[$subject_id]['not_answered']     += 1;
              $not_answered_questions[] = $q->questionbank_id;
              $time_spent_not_answered[$q->questionbank_id]['time_to_spend'] = 0;

             

              $time_spent_not_answered[$q->questionbank_id]['time_spent'] = 0;//$time_spent[$q->questionbank_id];

              $subject[$subject_id]['time_spent'] += 0;//$time_spent[$q->questionbank_id];
              
              
            }
        }
        
        $result =   $this->processAnswers($answers, $subject, $time_spent, $quiz->negative_mark);
        $result['not_answered_questions'] = json_encode($not_answered_questions);
        $result['time_spent_not_answered_questions'] = json_encode($time_spent_not_answered);
        
        $result = (object) $result;
        $answers = json_encode($answers);
        
        $record = new \App\QuizResult();
        $record->quiz_id = $quiz->id;
        $record->user_id = $user->id;
        $record->marks_obtained = $result->marks_obtained;
        $record->total_marks = $quiz->total_marks;
        $record->percentage = $this->getPercentage($result->marks_obtained, $quiz->total_marks);
        
        $exam_status = 'pending';
        if($record->percentage >= $quiz->pass_percentage)
            $exam_status = 'pass';
        else
            $exam_status = 'fail';

        $record->exam_status = $exam_status;
        $record->answers = $answers;
        $record->subject_analysis = $result->subject_analysis;
        $record->correct_answer_questions = $result->correct_answer_questions;
        $record->wrong_answer_questions = $result->wrong_answer_questions;
        $record->not_answered_questions = $result->not_answered_questions;
        $record->time_spent_correct_answer_questions = $result->time_spent_correct_answer_questions;
        $record->time_spent_wrong_answer_questions = $result->time_spent_wrong_answer_questions;
        $record->time_spent_not_answered_questions = $result->time_spent_not_answered_questions;

        $record->slug = getHashCode();
       
        
        $content = 'You have attempted exam. The score percentage is '.formatPercentage($record->percentage);
       
        $record->save();

    
       
        $template    = new \App\EmailTemplate();
          $content_data =  $template->sendEmailNotification('exam-result', 
         array('username'    =>$user_record->name, 
                  'content'  => $content,
                  'to_email' => $user_record->email));
      
      try {
        
  $user_record->notify(new \App\Notifications\StudentExamResult($user_record,$exam_status,$quiz->title,$quiz->pass_percentage)); 

      } catch (\Exception $e) {
        // dd($e->getMessage());
      }

        $topperStatus = false;
        $data['isUserTopper']       = $topperStatus;
        $data['rank_details']       = FALSE;
        $data['quiz']               = $quiz;
        $data['active_class']       = 'exams';
        $data['title']              = $quiz->title;
        $data['record']             = $record;

        $data['user']               = $user_record;
         
        //Chart Data START
        // $color_correct = getColor('background', rand(1,999));
        // $color_wrong = getColor('background', rand(1,999));
        // $color_not_attempted = getColor('background', rand(1,999));

        // $labels_marks = [getPhrase('correct'), getPhrase('wrong'), getPhrase('not_answered')];
        // $dataset_marks = [count(json_decode($record->correct_answer_questions)),
        //                   count(json_decode($record->wrong_answer_questions)), 
        //                   count(json_decode($record->not_answered_questions))];

        // $dataset_label_marks = "Marks";
        // $bgcolor  = [$color_correct,$color_wrong,$color_not_attempted];
        // $border_color = [$color_correct,$color_wrong,$color_not_attempted];
        // $chart_data['type'] = 'doughnut';
        //  $chart_data['data']   = (object) array(
        //     'labels'            => $labels_marks,
        //     'dataset'           => $dataset_marks,
        //     'dataset_label'     => $dataset_label_marks,
        //     'bgcolor'           => $bgcolor,
        //     'border_color'      => $border_color
        //     );
        
        // $data['marks_data'][] = (object)$chart_data; 

 
        $time_spent = 0;
        foreach(json_decode($record->time_spent_correct_answer_questions) as $rec)
        {
          $time_spent += 0;//$rec->time_spent;
        }
        foreach(json_decode($record->time_spent_wrong_answer_questions) as $rec)
        {
          $time_spent += 0;//$rec->time_spent;
        }
        foreach(json_decode($record->time_spent_not_answered_questions) as $rec)
        {
          $time_spent += 0;//$rec->time_spent;
        }

        //Time Chart Data
        // $color_correct       = getColor('background', rand(1,999));
        // $color_wrong          = getColor('background', rand(1,999));
        // $color_not_attempted  = getColor('background', rand(1,999));
        // $total_time           = $quiz->dueration*60;
        // $total_time_spent     = ($time_spent);
 
        // $labels_time          = [getPhrase('total_time').' (sec)', getPhrase('consumed_time').' (sec)'];
        // $dataset_time         = [ $total_time, $time_spent];

        // $dataset_label_time   = "Time in sec";
        // $bgcolor              = [$color_correct,$color_wrong,$color_not_attempted];
        // $border_color         = [$color_correct,$color_wrong,$color_not_attempted];
        // $chart_data['type']   = 'pie';
        //  $chart_data['data']  = (object) array(
        //                                         'labels'          => $labels_time,
        //                                         'dataset'         => $dataset_time,
        //                                         'dataset_label'   => $dataset_label_time,
        //                                         'bgcolor'         => $bgcolor,
        //                                         'border_color'    => $border_color
        //                                         );
        
        // $data['time_data'][]  = (object)$chart_data; 
 
        //Chart Data END

        // $quizrecordObject     = new \App\QuizResult();
        // $history              = array();
        // $history              = $quizrecordObject->getHistory();

        

        
        
        // return view('student.exams.results', $data);
        $response['status'] = 1;
        $response['message'] = 'Successfully completed';
        $response['record'] = $data;
        return $response;
        //  $view_name = getTheme().'::student.exams.results';
        // return view($view_name, $data);


    }

    /**
     * Pick grade record based on percentage from grades table
     * @param  [type] $percentage [description]
     * @return [type]             [description]
     */
    public function getPercentageRecord($percentage)
    {
        return \DB::table('grades')
                ->where('percentage_from', '<=',$percentage)
                ->where('percentage_to', '>=',$percentage)
                ->get();
    }

    /**
     * This below method process the submitted answers based on the 
     * provided answers and quiz questions
     * @param  [type] $answers [description]
     * @return [type]          [description]
     */
    public function processAnswers($answers, $subject, $time_spent, $negative_mark = 0)
    {
        $obtained_marks     = 0;
        $correct_answers    = 0;
        $obtained_negative_marks = 0;

        $corrent_answer_question            = [];
        $wrong_answer_question              = [];
        $time_spent_correct_answer_question = [];
        $time_spent_wrong_answer_question   = [];


        
        foreach ($answers as $key => $value) {
          if( is_numeric( $key ))
         {
            $question_record  = (object) $this->getQuestionRecord($key);

            $question_type    = $question_record->question_type;
            $actual_answer    = $question_record->correct_answers;
          
            $subject_id       = $question_record->subject_id;
            if(! array_key_exists($subject_id, $subject)) {
              $subject[$subject_id]['subject_id']       = $subject_id;
              $subject[$subject_id]['correct_answers']  = 0;
              $subject[$subject_id]['wrong_answers']    = 0;
              $subject[$subject_id]['time_spent_correct_answers']    = 0;
              $subject[$subject_id]['time_spent_wrong_answers']    = 0;
              $subject[$subject_id]['time_spent']       = 0;
              $subject[$subject_id]['time_to_spend']       = 0;
             
             
            }

             $subject[$subject_id]['time_spent']       += 0;//$time_spent[$question_record->id];
             $subject[$subject_id]['time_to_spend']    += $question_record->time_to_spend;

             

            switch ($question_type) {
                case 'radio':
                                if($value[0] == $actual_answer)
                                {
                                    $correct_answers++;
                                    $obtained_marks                 += $question_record->marks;
                                    $corrent_answer_question[]       = $question_record->id;
                                    $subject[$subject_id]['correct_answers'] +=1;
                                    $subject[$subject_id]['time_spent_correct_answers'] += 0;//$time_spent[$question_record->id];

                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = 0;//$time_spent[$question_record->id];
                                    
                                }
                                else {
                                  
                                    $wrong_answer_question[]          = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += 0;//$time_spent[$question_record->id];
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                     = 0;//$time_spent[$question_record->id];
                                }
                               
                                break;

                case 'checkbox':
                                $actual_answer = json_decode($actual_answer);
                                $i=0;
                                $flag= 1;
                                foreach($value as $answer_key => $answer_value )
                                {
                                    if(isset($actual_answer[$answer_key]))
                                    {
                                        if( $actual_answer[$answer_key]->answer != 
                                            $answer_value )
                                        {
                                            $flag = 0; break;
                                        }
                                    }
                                    else {
                                        $flag = 0; break;
                                    }

                                }

                                if($flag)
                                {
                                    $correct_answers++;
                                    $obtained_marks += $question_record->marks;
                                    $corrent_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['correct_answers'] +=1;
                                    $subject[$subject_id]['time_spent_correct_answers'] 
                                                                += 0;//$time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = 0;//$time_spent[$question_record->id];

                                }
                                else {
                                    $wrong_answer_question[]          = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                     $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += 0;//$time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = 0;//$time_spent[$question_record->id];
                                }
                                
                                break;
                case 'blanks': 
                                $actual_answer = json_decode($actual_answer);
                                 $i=0;
                                $flag= 1;
                                foreach($actual_answer as $answer)
                                {
                                    if(strcasecmp(
                                        trim($answer->answer),
                                        trim($value[$i++])) != 0)
                                    {
                                        $flag = 0; break;
                                    }
                                }

                                if($flag)
                                {
                                    $correct_answers++;
                                    $obtained_marks += $question_record->marks;
                                    $corrent_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['correct_answers'] +=1;
                                     $subject[$subject_id]['time_spent_correct_answers'] 
                                                                += 0;//$time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = 0;// $time_spent[$question_record->id];


                                }
                                else
                                {
                                    $wrong_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                    $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += 0;//$time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = 0;//$time_spent[$question_record->id];
                                }
                                
                                break;
                    case (  $question_type == 'para'  || 
                            $question_type == 'audio' || 
                            $question_type == 'video' 
                          ):
                                 $actual_answer = json_decode($actual_answer);
                                 $indidual_marks = $question_record->marks/$question_record->total_correct_answers;
                                $i=0;
                                $flag= 0;
                                foreach($value as $answer_key => $answer_value )
                                {
                                    if($actual_answer[$answer_key]->answer == $answer_value)
                                    {
                                        $flag=1;
                                        $obtained_marks += $indidual_marks;    
                                    }
                                }

                                if($flag)
                                {
                                    $correct_answers++;
                                    $corrent_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['correct_answers'] +=1;
                                    $subject[$subject_id]['time_spent_correct_answers'] 
                                                                += 0;//$time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = 0;//$time_spent[$question_record->id];

                                }
                                else
                                {
                                    $wrong_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                     $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += 0;//$time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = 0;//$time_spent[$question_record->id];
                                }
                              
                                break;
                case 'match':
                                $actual_answer = json_decode($actual_answer);
                                $indidual_marks = $question_record->marks/$question_record->total_correct_answers;
                                $i=0;
                                 $flag= 0;
                                foreach($actual_answer as $answer)
                                {
                                  if(isset($value[$i]))
                                  {
                                    if($answer->answer == $value[$i])
                                    {
                                  
                                       $flag=1;
                                        $obtained_marks += $indidual_marks;
                                    }
                                  }
                                  $i++;
                                }

                                if($flag)
                                {
                                    $correct_answers++;
                                    $corrent_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['correct_answers'] +=1;
                                    $subject[$subject_id]['time_spent_correct_answers'] 
                                                                += 0;//$time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = 0;//$time_spent[$question_record->id];

                                }
                                else
                                {
                                    $wrong_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                     $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += 0;//$time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = 0;//$time_spent[$question_record->id];
                                }
                    break;
                
            }

          }
  

        }
        // dd($time_spent_correct_answer_question);
          return array(
                        'total_correct_answers' => $correct_answers,
                        'marks_obtained'        => $obtained_marks,
                        'negative_marks'        => $obtained_negative_marks,
                        'subject_analysis'      => json_encode($subject),
                        'correct_answer_questions' => json_encode($corrent_answer_question),
                        'wrong_answer_questions' => json_encode($wrong_answer_question),
                        'time_spent_correct_answer_questions' => json_encode($time_spent_correct_answer_question),
                        'time_spent_wrong_answer_questions' => json_encode($time_spent_wrong_answer_question),
                        );

    }

    /**
     * Returns the percentage of the number
     * @param  [type] $total [description]
     * @param  [type] $goal  [description]
     * @return [type]        [description]
     */
    public function getPercentage($total, $goal)
    {
        return ($total / $goal) * 100;
    }

    /**
     * Returns the specific question record based on question_id
     * @param  [type] $question_id [description]
     * @return [type]              [description]
     */
    function getQuestionRecord($question_id)
    {
        return \App\QuestionBank::where('id','=',$question_id)->first();
    }



    public function getExamKey($slug)
    {


        $quiz_result         = \App\QuizResult::where('slug',$slug)->first();

        $quiz                = \App\Quiz::where('id',$quiz_result->quiz_id)->first();
        $questions = [];
        $data['status'] = 0;
        $sno = 1;
        if(!$quiz)
        {
          $data['message'] = 'Invalid quiz';
          return $data;
        }


        $user_id = $quiz_result->user_id;

        $user =   $user = \App\User::where('id','=', $user_id)->first();

        if(!$user)
        {
          $data['message'] = 'Invalid UserID';
          return $data;
        }

        $current_state       = null;
        $any_resume_exam     = FALSE;

        $time                = $this->convertToHoursMins($quiz->dueration);
        $atime               = $this->convertToHoursMins($quiz->dueration);
        $current_question_id = null;
         // dd($prepared_records);
        $prepared_records = null;

         if($quiz->exam_type=='NSNT'){      

        if(!$any_resume_exam){

          $prepared_records   = (object) $quiz->prepareQuestions($quiz->getQuestions(),'',$user_id);
         
        }


        if($current_state) 
        {
           $temp = [];

           foreach($current_state as $key => $val)
           {
              $temp[(int) $key] = $val;
              
           }
           $current_state = $temp;
        }

      }
      else{
        
        $section_data    = (array)json_decode($quiz->section_data);
        $sections        = array(); 
        $section_names   = array();

        foreach ($section_data as $key => $value) {
          // dd($value);
          $sections[]  = $key;
          $section_names[]  = $value->section_name;

        }

        $questions    = $quiz->getSectionQuestions($section_data);
        $fquestions = [];
        foreach($questions as $question)
        {
           $newData = [];
           $newData['sno'] = $sno++;
           $newData['is_bookmarked'] = $question->isQuestionBookmarked()->where('user_id', $user_id)->count();
           $question->question_tags = $newData;

           if($question->question_type == 'para' || $question->question_type == 'audio' 
              || $question->question_type == 'video'){
             

                 $questions_data  = json_decode($question->answers);
               
                 $temp = $this->decodeQuestionsData($questions_data);


             $question->answers = json_encode($temp);
            }


          $fquestions[] = $question;
        }

        $questions = $fquestions;


        $submitted_answers = [];

            $answers = (array)json_decode($quiz_result->answers);
            
            foreach ($answers as $key => $value) {

                $submitted_answers[$key] = $value;

            }

        foreach ($questions as $question) {
 
            if(array_key_exists($question->id, $submitted_answers)) {
                
                foreach ($submitted_answers[$question->id] as $user_key => $user_value) {
                     
                if($question->question_type == 'radio'){
                   
                     $question->user_submitted = $user_value;
               
                  }
                elseif($question->question_type == 'checkbox' || $question->question_type == 'para' || $question->question_type == 'audio' || $question->question_type == 'video' || $question->question_type == 'match'){


                      $list = array();

                      for($index = 0; $index < $question->total_correct_answers; $index++)
                      {
                          $list[$index]['answer']   = $submitted_answers[$question->id][$index];
                      }

                      $question->user_submitted  =  json_encode($list);
                     
                      
                  }
                elseif($question->question_type == 'blanks') {

                      $question->user_submitted = $user_value;
                  }  
                
                   
                }

               }  

            }   
     
         


        $this->saveQuizQuestions($questions, $quiz,$user_id);
       }

       

        $data['time_hours']         = makeNumber($time['hours'],2,'0','left');
        $data['time_minutes']       = makeNumber($time['minutes'],2,'0','left');
        $data['time_seconds']       = makeNumber($time['seconds'],2,'0','left');

        $data['atime_hours']         = makeNumber($atime['hours'],2,'0','left');
        $data['atime_minutes']       = makeNumber($atime['minutes'],2,'0','left');
        $data['atime_seconds']       = makeNumber($atime['seconds'],2,'0','left');

        $data['quiz']               = $quiz;
        $data['user']               = $user;
        $data['title']              = $quiz->title;



       if($quiz->exam_type == 'NSNT'){
        // if(1){

        $data['current_state']       = $current_state;
        $data['current_question_id'] = $current_question_id;
        $final_questions             = $prepared_records->questions;
        $final_subjects              = $prepared_records->subjects;
        $data['questions']           = $final_questions;
        $data['subjects']            = $final_subjects;
        $bookmarks                   = array_pluck($final_questions, 'id');
        $data['bookmarks']           = $bookmarks;
        $temp_answers = [];
        



            $submitted_answers = [];

            $answers = (array)json_decode($quiz_result->answers);
            
            foreach ($answers as $key => $value) {

                $submitted_answers[$key] = $value;

            }

        foreach ($final_questions as $question) {
 
            if(array_key_exists($question->id, $submitted_answers)) {
                
                foreach ($submitted_answers[$question->id] as $user_key => $user_value) {
                     
                if($question->question_type == 'radio'){
                   
                     $question->user_submitted = $user_value;
               
                  }
                elseif($question->question_type == 'checkbox' || $question->question_type == 'para' || $question->question_type == 'audio' || $question->question_type == 'video' || $question->question_type == 'match'){


                      $list = array();

                      for($index = 0; $index < $question->total_correct_answers; $index++)
                      {
                          $list[$index]['answer']   = $submitted_answers[$question->id][$index];
                      }

                      $question->user_submitted  =  json_encode($list);
                     
                      
                  }
                elseif($question->question_type == 'blanks') {


                      $list = array();

                      for($index = 0; $index < $question->total_correct_answers; $index++)
                      {
                          $list[$index]['answer']   = $submitted_answers[$question->id][$index];
                      }

                      $question->user_submitted  =  json_encode($list);

                      // $question->user_submitted = $user_value;
                  }  
                
                   
                }

            }     
     

            
            if($question->question_type == 'para' || $question->question_type == 'audio' 
              || $question->question_type == 'video'){
             

                 $questions_data  = json_decode($question->answers);
                $ftemp  = [];
                 $t = $this->decodeQuestionsData($questions_data);
                // dd($t);
                foreach($t as $temp ){

                  if(isset($temp['options']))
                  {
                   if(count($temp['options']))
                   {
                     $temp['options'] = $temp['options'][0];
                   }
                  }

                 if(isset($temp['optionsl2']))
                 {
                   if(count($temp['optionsl2']))
                   {
                     $temp['optionsl2'] = $temp['optionsl2'][0];

                   }
                 }
                 // if(count($temp['options']))
                  $ftemp[] = $temp;
                }
                 // if($question->id==67)
                 //  dd(($t));
                  // dd(($temp));
               
                // dd('asdf');

             $question->answers = json_encode($t);
            }

        }

         // $data['all_options']  = $all_options;
       
        

       $data['right_bar_data']     = array(
                                              'questions'      => $final_questions, 
                                              'current_state'  => $current_state, 
                                              'quiz'           => $quiz, 
                                              'time_hours'     => $data['time_hours'], 
                                              'time_minutes'   => $data['time_minutes'],
                                              'atime_hours'    => $data['atime_hours'], 
                                              'atime_minutes'  => $data['atime_minutes']
                                              );

        }

        if($quiz->exam_type=='SNT'){

          
           $data['right_bar_data']     = array(
                                              'questions'      => $questions, 
                                              'current_state'  => $current_state, 
                                              'quiz'           => $quiz, 
                                              'time_hours'     => $data['time_hours'], 
                                              'time_minutes'   => $data['time_minutes'],
                                              'atime_hours'    => $data['atime_hours'], 
                                              'atime_minutes'  => $data['atime_minutes']
                                              );
 
          }
           else {


               $section_data  = (array)json_decode($quiz->section_data);
               $section_keys = array_keys($section_data);

               $first_section_data = null;
               if(is_array($section_data)){
               if(count($section_data)){
                 if(isset($section_data[$section_keys[0]]))
                  $first_section_data = $section_data[$section_keys[0]];
              }
              }



              $section_timings = [];
              $index = 0;
               foreach($section_data as $key=>$value) 
               {
                  $section_time =  $value->section_time;
                  $section_hrs = 0;
                  $section_minutes = $section_time;
                  $section_seconds = 1;  
                  
                  if($section_time>60)
                  {
                    $section_hrs     = floor($section_time / 60);
                    $section_minutes = ($section_time % 60);
                  }

                  $section_timings[$index]['section_key'] = $key;
                  $section_timings[$index]['section_name'] = $value->section_name;
                  $section_timings[$index]['hrs'] = $section_hrs;
                  $section_timings[$index]['minutes'] = $section_minutes;
                  $section_timings[$index]['seconds'] = $section_seconds;
                  $index++;
               }
 

               $time_hours = 0;//$section_timings[0]['hrs'];
               $time_minutes = 0;
               if(count($section_timings))
               {
                  if(isset($section_timings[0]))
                  {
                  $time_hours = $section_timings[0]['hrs'];
               
                  $time_minutes = $section_timings[0]['minutes'];
                  }
              }
             // $data['right_bar_path']     = 'student.exams.sectiontimer-exam-rigth-bar';
             $data['right_bar_data']     = array(
                                              'questions'      => $questions, 
                                              'current_state'  => $current_state, 
                                              'quiz'           => $quiz, 
                                              'time_hours'     => $time_hours, 
                                              'time_minutes'   => $time_minutes,
                                             
                                              );
            $data['section_timings']   = $section_timings;  
         
          }

        // dd($data);
        return $data;

    }


   

}
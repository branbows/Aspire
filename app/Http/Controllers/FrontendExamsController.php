<?php

namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests;
use App\User;
use App\Quiz;
use App\Subject;
use App\QuestionBank;
use App\QuizCategory;
use App\QuizResult;
use App\EmailTemplate;
use App\TotalAttempted;
use Yajra\Datatables\Datatables;
use App\EmailSettings;
use DB;
use Auth;
use Input;
use Exception;


class FrontendExamsController extends Controller
{
    
   public function examsList()
   {
     
      $categories           = QuizCategory::getShowFrontCategories();   
      
      $data['categories']   = $categories;
      $data['active_class'] = 'exams';
      $data['title']        = 'Exams';
    
      // return view('front-exams.exams-list',$data);

      $view_name = getTheme().'::front-exams.exams-list';
        return view($view_name, $data);


   }


    /**
     * Displays the instructions before start of the exam
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function instructions($slug)
    {
      // dd($slug);
      
      $instruction_page = '';
      $record = Quiz::getRecordWithSlug($slug);

       if($record->instructions_page_id)
      $instruction_page = App\Instruction::where('id',$record->instructions_page_id)->first();
      
      $data['instruction_data'] = '';
      
      if($instruction_page){
        $data['instruction_data'] = $instruction_page->content;
        $data['instruction_title'] = $instruction_page->title;
      }

      $data['record']           = $record;
      $data['title']            = $record->title;
      $data['block_navigation'] = TRUE;

        // return view('front-exams.instructions', $data);
         $view_name = getTheme().'::front-exams.instructions';
        return view($view_name, $data);
    }


    /**
     * Start Front Exam
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function startExam($slug)
    {
      
        $quiz = Quiz::getRecordWithSlug($slug);
        
        $prepared_records   = (object) $quiz->prepareQuestions($quiz->getQuestions(),'front_examstarted');
        $final_questions    = $prepared_records->questions;
        $final_subjects     = $prepared_records->subjects;
        $data['questions']          = $final_questions;
      
        $bookmarks                  = array_pluck($final_questions, 'id');
        $data['bookmarks']          = $bookmarks;
        $data['subjects']           = $final_subjects;
        $time                       = $this->convertToHoursMins($quiz->dueration);
        $atime                      = $this->convertToHoursMins($quiz->dueration);

        $data['time_hours']         = makeNumber($time['hours'],2,'0','left');
        $data['time_minutes']       = makeNumber($time['minutes'],2,'0','left');
        $data['time_seconds']       = makeNumber($time['seconds'],2,'0','left');

        $data['atime_hours']         = makeNumber($atime['hours'],2,'0','left');
        $data['atime_minutes']       = makeNumber($atime['minutes'],2,'0','left');
        $data['atime_seconds']       = makeNumber($atime['seconds'],2,'0','left');
  
        $data['quiz']               = $quiz;
        $data['active_class']       = 'practice_exams';
        $data['title']              = $quiz->title;
        $data['right_bar']          = TRUE;
        $data['block_navigation']          = TRUE;

        $data['right_bar_path']     = 'student.exams.exam-right-bar';
    
        $data['right_bar_data']     = array(
                                            'questions'     => $final_questions, 
                                            'quiz'          => $quiz, 
                                            'time_hours'    => $data['time_hours'], 
                                            'time_minutes'  => $data['time_minutes'],
                                            'atime_hours'    => $data['atime_hours'], 
                                            'atime_minutes'  => $data['atime_minutes']
                                            );

        // return view('front-exams.exam-form', $data); 

        
        $view_name = getTheme().'::front-exams.exam-form';
        return view($view_name, $data);

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
        $result['hours']   = $hours;
        $result['minutes'] = $minutes;
        $result['seconds'] = 0;
        return $result;
    }


    /**
     * After the exam complets the data will be submitted to this method
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function finishExam(Request $request, $slug)
    {
 
        $quiz = Quiz::getRecordWithSlug($slug);


       
        $input_data = Input::all();
        $answers = array();
        $time_spent = $request->time_spent;
       
        //Remove _token key from answers data prepare the list of answers at one place
        foreach ($input_data as $key => $value) {
            if($key=='_token' || $key=='time_spent')
                continue;
            $answers[$key] = $value;
        }
      

        //Get the list of questions and prepare the list at one place
        //This is to find the unanswered questions
        //List the unanswered questions list at one place
        $questions = DB::table('questionbank_quizzes')->select('questionbank_id', 'subject_id')
                     ->where('quize_id','=',$quiz->id)
                     ->get();
        
         
        $subject                  = [];
        $time_spent_not_answered  = [];
        $not_answered_questions   = [];

        foreach($questions as $q)
        {
          
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
              $time_spent_not_answered[$q->questionbank_id]['time_spent'] = $time_spent[$q->questionbank_id];
              $subject[$subject_id]['time_spent']      += $time_spent[$q->questionbank_id];
            }
        }
        
        $result =   $this->processAnswers($answers, $subject, $time_spent, $quiz->negative_mark);
        $result['not_answered_questions'] = json_encode($not_answered_questions);
        $result['time_spent_not_answered_questions'] = json_encode($time_spent_not_answered);
        
        $result = (object) $result;
        $answers = json_encode($answers);
        

        $topperStatus = false;
        $data['isUserTopper']       = $topperStatus;
        $data['rank_details']       = FALSE;
        $data['quiz']               = $quiz;
        $data['active_class']       = 'exams';
        $data['title']              = $quiz->title;
        $data['result']             = $result;

         
        //Chart Data START
        $color_correct = getColor('background', rand(1,999));
        $color_wrong = getColor('background', rand(1,999));
        $color_not_attempted = getColor('background', rand(1,999));

        $labels_marks = [getPhrase('correct'), getPhrase('wrong'), getPhrase('not_answered')];
        $dataset_marks = [count(json_decode($result->correct_answer_questions)),
                          count(json_decode($result->wrong_answer_questions)), 
                          count(json_decode($result->not_answered_questions))];

        $dataset_label_marks = "Marks";
        $bgcolor  = [$color_correct,$color_wrong,$color_not_attempted];
        $border_color = [$color_correct,$color_wrong,$color_not_attempted];
        $chart_data['type'] = 'doughnut';
         $chart_data['data']   = (object) array(
            'labels'            => $labels_marks,
            'dataset'           => $dataset_marks,
            'dataset_label'     => $dataset_label_marks,
            'bgcolor'           => $bgcolor,
            'border_color'      => $border_color
            );
        
        $data['marks_data'][] = (object)$chart_data; 

 
        $time_spent = 0;
        foreach(json_decode($result->time_spent_correct_answer_questions) as $rec)
        {
          $time_spent += $rec->time_spent;
        }
        foreach(json_decode($result->time_spent_wrong_answer_questions) as $rec)
        {
          $time_spent += $rec->time_spent;
        }
        foreach(json_decode($result->time_spent_not_answered_questions) as $rec)
        {
          $time_spent += $rec->time_spent;
        }

        //Time Chart Data
        $color_correct       = getColor('background', rand(1,999));
        $color_wrong          = getColor('background', rand(1,999));
        $color_not_attempted  = getColor('background', rand(1,999));
        $total_time           = $quiz->dueration*60;
        $total_time_spent     = ($time_spent);
 
        $labels_time          = [getPhrase('total_time').' (sec)', getPhrase('consumed_time').' (sec)'];
        $dataset_time         = [ $total_time, $time_spent];

        $dataset_label_time   = "Time in sec";
        $bgcolor              = [$color_correct,$color_wrong,$color_not_attempted];
        $border_color         = [$color_correct,$color_wrong,$color_not_attempted];
        $chart_data['type']   = 'pie';
         $chart_data['data']  = (object) array(
                                                'labels'          => $labels_time,
                                                'dataset'         => $dataset_time,
                                                'dataset_label'   => $dataset_label_time,
                                                'bgcolor'         => $bgcolor,
                                                'border_color'    => $border_color
                                                );
        
        $data['time_data'][]    = (object)$chart_data; 
        $data['marks_obtained'] = $result->marks_obtained;
        $data['total_marks']    = $quiz->total_marks;
        $percentage             = $this->getPercentage($result->marks_obtained, $quiz->total_marks);
        $data['percentage']     = $percentage;

         $exam_status = 'pending';
        if($percentage >= $quiz->pass_percentage)
            $exam_status = 'pass';
        else
            $exam_status = 'fail';

        $data['exam_status']    = $exam_status;
 
        //Chart Data END
       
       $data['block_navigation']          = TRUE;
        
        // return view('front-exams.results', $data);

            $view_name = getTheme().'::front-exams.results';
        return view($view_name, $data);
    }

    /**
     * Pick grade result based on percentage from grades table
     * @param  [type] $percentage [description]
     * @return [type]             [description]
     */
    public function getPercentageRecord($percentage)
    {
        return DB::table('grades')
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
            $question_record  = $this->getQuestionRecord($key);
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
             
            }

             $subject[$subject_id]['time_spent']       += $time_spent[$question_record->id];
             $subject[$subject_id]['time_to_spend']    += $question_record->time_to_spend;
            switch ($question_type) {
                case 'radio':
                                if($value[0] == $actual_answer)
                                {
                                    $correct_answers++;
                                    $obtained_marks                 += $question_record->marks;
                                    $corrent_answer_question[]       = $question_record->id;
                                    $subject[$subject_id]['correct_answers'] +=1;
                                    $subject[$subject_id]['time_spent_correct_answers'] += $time_spent[$question_record->id];

                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = $time_spent[$question_record->id];
                                    
                                }
                                else {
                                  
                                    $wrong_answer_question[]          = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += $time_spent[$question_record->id];
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                     = $time_spent[$question_record->id];
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
                                                                += $time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = $time_spent[$question_record->id];

                                }
                                else {
                                    $wrong_answer_question[]          = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                     $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += $time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = $time_spent[$question_record->id];
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
                                                                += $time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = $time_spent[$question_record->id];


                                }
                                else
                                {
                                    $wrong_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                    $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += $time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = $time_spent[$question_record->id];
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
                                                                += $time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = $time_spent[$question_record->id];

                                }
                                else
                                {
                                    $wrong_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                     $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += $time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = $time_spent[$question_record->id];
                                }
                              
                                break;
                case 'match':
                                $actual_answer = json_decode($actual_answer);
                                $indidual_marks = $question_record->marks/$question_record->total_correct_answers;
                                $i=0;
                                 $flag= 0;
                                foreach($actual_answer as $answer)
                                {
                                    if($answer->answer == $value[$i++])
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
                                                                += $time_spent[$question_record->id];
                                    $time_spent_correct_answer_question[$question_record->id]['time_to_spend'] 
                                                                    = $question_record->time_to_spend;
                                    $time_spent_correct_answer_question[$question_record->id]['time_spent'] 
                                                                    = $time_spent[$question_record->id];

                                }
                                else
                                {
                                    $wrong_answer_question[] = $question_record->id;
                                    $subject[$subject_id]['wrong_answers'] += 1;
                                     $subject[$subject_id]['time_spent_wrong_answers']    
                                                                += $time_spent[$question_record->id];
                                    $obtained_marks                   -= $negative_mark;
                                    $obtained_negative_marks          += $negative_mark;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_to_spend'] 
                                                                       = $question_record->time_to_spend;
                                    $time_spent_wrong_answer_question[$question_record->id]['time_spent'] 
                                                                       = $time_spent[$question_record->id];
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
        return QuestionBank::where('id','=',$question_id)->first();
    }

}
<?php
namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quiz;
use App\Subject;
use App\QuestionBank;
use App\QuizCategory;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Exception;
use Image;
use ImageSettings;
use File;

class QuizController extends Controller
{
         
    public function __construct()
    {
      $this->middleware('auth');
    }

    protected  $examSettings;

    public function setExamSettings()
    {
        $this->examSettings = getExamSettings();
    }

    public function getExamSettings()
    {
        return $this->examSettings;
    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['active_class']       = 'exams';
        $data['title']              = getPhrase('quizzes');
      // return view('exams.quiz.list', $data);

        $view_name = getTheme().'::exams.quiz.list';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug = '')
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();

        if($slug=='')
        {
             

            $records = Quiz::join('quizcategories', 'quizzes.category_id', '=', 'quizcategories.id')
            ->select(['title', 'dueration', 'category', 'is_paid', 'total_marks','exam_type','tags','quizzes.slug' ])
            ->orderBy('quizzes.updated_at', 'desc');
             

        }
        else {
            $category = QuizCategory::getRecordWithSlug($slug);
        
        $records = Quiz::join('quizcategories', 'quizzes.category_id', '=', 'quizcategories.id')
            ->select(['title', 'dueration', 'category', 'is_paid', 'total_marks','exam_type','tags','quizzes.slug' ])
            ->where('quizzes.category_id', '=', $category->id)
            ->orderBy('quizcategories.updated_at', 'desc');
        }


        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                           <li><a href="'.URL_QUIZ_UPDATE_QUESTIONS.$records->slug.'"><i class="fa fa-spinner"></i>'.getPhrase("update_questions").'</a></li>
                            <li><a href="'.URL_QUIZ_EDIT.'/'.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
                            
                           $temp = '';
                           if(checkRole(getUserGrade(1))) {
                    $temp .= ' <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                      }
                    
                    $temp .='</ul></div>';


                    $link_data .=$temp;
            return $link_data;
            })
        ->editColumn('is_paid', function($records)
        {
            return ($records->is_paid) ? '<span class="label label-primary">'.getPhrase('paid') .'</span>' : '<span class="label label-success">'.getPhrase('free').'</span>';
        })
        ->editColumn('title',function($records)
        {
          return '<a href="'.URL_QUIZ_UPDATE_QUESTIONS.$records->slug.'">'.$records->title.'</a>';
        })

         ->editColumn('exam_type',function($records)
        {
           return App\ExamType::where('code',$records->exam_type)->first()->title;

        })

        ->removeColumn('id')
        ->removeColumn('slug')
        ->removeColumn('tags')
         
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
      $data['record']             = FALSE;
      $data['active_class']       = 'exams';
      $data['categories']         = array_pluck(QuizCategory::all(), 'category', 'id');
      $data['instructions']       = array_pluck(App\Instruction::all(), 'title', 'id');
      $data['exam_types']         = App\ExamType::where('status','=',1)->get()->pluck('title','code')->toArray();
      // dd($data);
      $data['title']              = getPhrase('create_quiz');
      // return view('exams.quiz.add-edit', $data);

          $view_name = getTheme().'::exams.quiz.add-edit';
        return view($view_name, $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

      $record = Quiz::getRecordWithSlug($slug);
      if($isValid = $this->isValidRecord($record))
        return redirect($isValid);

      $data['record']           = $record;
      $data['active_class']     = 'exams';
      $data['settings']         = FALSE;
      $data['instructions']     = array_pluck(App\Instruction::all(), 'title', 'id');
      $data['categories']       = array_pluck(QuizCategory::all(), 'category', 'id');
      $data['exam_types']         = App\ExamType::get()->pluck('title','code')->toArray();

      $data['title']            = getPhrase('edit_quiz');
      // return view('exams.quiz.add-edit', $data);

        $view_name = getTheme().'::exams.quiz.add-edit';
        return view($view_name, $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {
      // dd($request);
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

      $record = Quiz::getRecordWithSlug($slug);
     $rules = [
         'title'               => 'bail|required|max:40' ,
         'dueration'           => 'bail|required|integer' ,
         'pass_percentage'     => 'bail|required|numeric|max:100|min:1' ,
         'category_id'         => 'bail|required|integer' ,
         'instructions_page_id' => 'bail|required|integer' ,
            ];
   

         /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
       $name = $request->title;
        if($name != $record->title)
            $record->slug = $record->makeSlug($name, TRUE);
      
       //Validate the overall request
       $this->validate($request, $rules);
       
        if ($request->show_in_front == 1 && $request->is_paid==0) {
             
            /*if($request->is_paid == 1){
              flash('Ooops...!','practice_exam_must_be_non_paid_exam','overlay');
              return back();
            }*/
            if ($request->exam_type !='NSNT') {
                flash('Ooops...!','practice_exam_must_be_no_section_no_timer_exam','overlay');
                return back();
            }
        }  

        $record->title        = $name;
        $record->category_id    = $request->category_id;
        $record->dueration      = $request->dueration;
        $record->total_marks    = $request->total_marks;
        $record->pass_percentage  = $request->pass_percentage;
        $record->tags       = '';
        $record->is_paid      = $request->is_paid;
        
        $record->cost       = 0;
        $record->validity       = -1;
        if($record->is_paid) {
          $record->cost         = $request->cost;
          $record->validity     = $request->validity;
        }

        $record->publish_results_immediately      
                      = 1;
        $record->having_negative_mark = 1;
        $record->negative_mark = $request->negative_mark;
        $record->instructions_page_id = $request->instructions_page_id;
        $record->show_in_front = $request->show_in_front;

        if(!$request->negative_mark)
          $record->having_negative_mark = 0;

        $record->description    = $request->description;
        $record->record_updated_by  = Auth::user()->id;

        $record->start_date = $request->start_date;
        $record->end_date = $request->end_date;
        $record->exam_type          = $request->exam_type;
        $record->has_language       = $request->has_language;
         if($request->has_language == 1){
        $record->language_name       = $request->language_name;

        }

        $record->is_popular       = $request->is_popular;
        
        if(!env('DEMO_MODE')) {
          $record->save();
        }

         $file_name = 'examimage';
        if ($request->hasFile($file_name))
        {

             $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
              $this->validate($request, $rules);

              $record->image      = $this->processUpload($request, $record,$file_name);
              $record->save();
        }

        flash('success','record_updated_successfully', 'success');
      return redirect(URL_QUIZZES);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }


      $rules = [
         'title'               => 'bail|required|max:40' ,
         'dueration'           => 'bail|required|integer' ,
         'category_id'         => 'bail|required|integer' ,
         'instructions_page_id' => 'bail|required|integer' ,
         'pass_percentage'     => 'bail|required|numeric|max:100|min:1' ,
          'examimage'                => 'bail|mimes:png,jpg,jpeg|max:2048'
            ];
        $this->validate($request, $rules);
          
        if ($request->show_in_front == 1 && $request->is_paid==0) {
             
            
            if ($request->exam_type !='NSNT') {
                flash('Ooops...!','practice_exam_must_be_no_section_no_timer_exam','overlay');
                return back();
            }
        }  


        $record = new Quiz();
        $name             =  $request->title;
        $record->title        = $name;
        $record->slug         = $record->makeSlug($name, TRUE);
        $record->category_id    = $request->category_id;
        $record->dueration      = $request->dueration;
        $record->total_marks    = $request->total_marks;
        $record->pass_percentage  = $request->pass_percentage;
        $record->tags       = '';
        $record->is_paid      = $request->is_paid;
        $record->cost       = 0;
        $record->validity       = -1;
        if($record->is_paid) {
          $record->cost         = $request->cost;
          $record->validity     = $request->validity;
        }

        $record->publish_results_immediately            
                                    = $request->publish_results_immediately;
        $record->publish_results_immediately      
                      = 1;
        
        $record->having_negative_mark = 1;
        $record->negative_mark = $request->negative_mark;
        $record->start_date = $request->start_date;
        $record->end_date = $request->end_date;
        $record->instructions_page_id = $request->instructions_page_id;
        $record->show_in_front = $request->show_in_front;

        if(!$request->negative_mark)
          $record->having_negative_mark = 0;
        
        $record->description    = $request->description;
        $record->record_updated_by  = Auth::user()->id;
        $record->exam_type          = $request->exam_type;
        $record->has_language       = $request->has_language;

        if($request->has_language == 1){
        $record->language_name       = $request->language_name;

        }

        $record->is_popular       = $request->is_popular;

        $record->save();

         $file_name = 'examimage';
        if ($request->hasFile($file_name))
        {

             $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
             $this->validate($request, $rules);
             $this->setExamSettings();
             $examSettings = $this->getExamSettings();
             $path = $examSettings->categoryImagepath;
             $this->deleteFile($record->image, $path);

              $record->image      = $this->processUpload($request, $record,$file_name);
              $record->save();
        }

      flash('success','record_added_successfully', 'success');
      return redirect(URL_QUIZZES);
    }
 
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
      /**
       * Delete the questions associated with this quiz first
       * Delete the quiz
       * @var [type]
       */
        $record = Quiz::where('slug', $slug)->first();
        try{
        if(!env('DEMO_MODE')) {
          $record->delete();
        }
        $response['status'] = 1;
        $response['message'] = getPhrase('record_deleted_successfully');
         } catch (Exception $e) {
            $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->getMessage();
          else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
         }
        return json_encode($response);

    }

    public function isValidRecord($record)
    {
      if ($record === null) {

        flash('Ooops...!', getPhrase("page_not_found"), 'error');
        return $this->getRedirectUrl();
    }

    return FALSE;
    }

    public function getReturnUrl()
    {
      return URL_QUIZZES;
    }


    /**
     * Returns the list of subjects based on the requested subject
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSubjectData(Request $request)
    {

      $subject_id = $request->subject_id;
      $subject = Subject::where('id','=',$subject_id)->first();
      $topics = $subject
            ->topics()
            ->where('parent_id', '=', '0')
            ->get(['topic_name', 'id']);
      $questions = $subject->questions()->get(['id', 'subject_id', 'topic_id', 'question_type', 'question', 
                                               'marks', 'difficulty_level', 'status']);
      return json_encode(array('topics'=>$topics, 'questions'=>$questions, 'subject'=>$subject));
    }
    
    /**
     * Updates the questions in a selected quiz
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function updateQuestions($slug)
    {
       if(!checkRole(getUserGrade(2)))
       {
            prepareBlockUserMessage();
            return back();
        }

   /**
       * Get the Quiz Id with the slug
       * Get the available questions from questionbank_quizzes table
       * Load view with this data
       */
    $record = Quiz::getRecordWithSlug($slug);     
      $data['record']           = $record;
      $data['active_class']       = 'exams';
        // $data['right_bar']          = FALSE;
        // $data['right_bar_path']     = 'exams.quiz.right-bar-update-questions';
        
        $data['settings']           = FALSE;
        $previous_questions = array();

        if($record->total_questions > 0)
        {
            $questions = DB::table('questionbank_quizzes')
                            ->where('quize_id', '=', $record->id)
                            ->get();
            // dd($questions);
            foreach($questions as $question)
            {
                $temp = array();
                $temp['id']          = $question->subject_id.$question->questionbank_id;
                $temp['subject_id']  = $question->subject_id;
                $temp['question_id'] = $question->questionbank_id;
                $temp['marks']       = $question->marks;
                
                $question_details         = QuestionBank::find($question->questionbank_id);
                $subject                  = $question_details->subject;
                
                $temp['question']         = $question_details->question;
                $temp['question_type']    = $question_details->question_type;
                $temp['difficulty_level'] = $question_details->difficulty_level;
                $temp['subject_title']    = $subject->subject_title;
                array_push($previous_questions, $temp);
            }

            $section_data = [];

            $section_wise_questions       = [];
            $settings['is_have_sections'] = 0;
            $settings['questions']        = $previous_questions;

            if($record->exam_type!='NSNT') {
            $settings['is_have_sections'] = 1;

              if($record->section_data) {

                  $section_data = json_decode($record->section_data);
              }

              $temp_questions =[];

              foreach($previous_questions as $question)
                $temp_questions[$question['question_id']] = $question;

              
              foreach($section_data as $sd)
              {
                $index = str_replace(' ','_',$sd->section_name);
                $section_wise_questions[$index]['section_name'] = $sd->section_name;
                $section_wise_questions[$index]['section_time'] = $sd->section_time;
               
                 foreach($sd->questions as $q_no) 
                 {
                  $section_wise_questions[$index]['questions'][] = $temp_questions[$q_no];
                 }

                 $index++;
              }

              $settings['questions'] = $section_wise_questions;
            }
            
            $settings['total_marks']  = $record->total_marks;
            $settings['section_data'] = $record->section_data;
            $data['settings']         = json_encode($settings);
        }
        
        
      $data['subjects']     = array_pluck(App\Subject::all(), 'subject_title', 'id');
      $data['title']        = getPhrase('update_questions_for').' '.$record->title;
      // dd($data);

      // return view('exams.quiz.update-questions', $data);

        $view_name = getTheme().'::exams.quiz.update-questions';
        return view($view_name, $data);

    }

    public function storeQuestions(Request $request, $slug)
    {
       
       // dd($request);

        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $added_sections  = $request->add_section_names;
        $added_times     = $request->add_section_times;

        DB::beginTransaction();

       try {

        $quiz = Quiz::getRecordWithSlug($slug); 

        $quiz_id    = $quiz->id;
        $questions  = json_decode($request->saved_questions);
        // dd($questions);
        $marks = 0;
        $questions_to_update = array();
        $sections_data = array();

        foreach ($questions as $ques_key => $q) 
        {
           // dd($q);
          if($quiz->exam_type!='NSNT')
          {
            
          foreach($q->questions as $question)
          {
            // dd($question);
              $temp = array();
              $temp['subject_id']       = $question->subject_id;
              $temp['questionbank_id']  = $question->question_id;
              $temp['quize_id']         = $quiz_id;
              $temp['marks']            = $question->marks;
              $marks                   += $question->marks;

              array_push($questions_to_update, $temp);

              $key = str_replace(' ', '_', $added_sections[$ques_key]);
              // dd($key);
              $sections_data[$key]['section_name']  = $added_sections[$ques_key];
              $sections_data[$key]['section_time']  = $added_times[$ques_key];
            
              
              if(!isset($sections_data[$key]['questions']))
                $sections_data[$key]['questions'] = [];
              if(!in_array($question->question_id, $sections_data[$key]['questions']))
                array_push($sections_data[$key]['questions'], $question->question_id);

            }

          }

          else {

            $temp = array();
            $temp['subject_id']       = $q->subject_id;
            $temp['questionbank_id']  = $q->question_id;
            $temp['quize_id']         = $quiz_id;
            $temp['marks']            = $q->marks;
            $marks                   += $q->marks;
         
            array_push($questions_to_update, $temp);
          }
        }

        $sections_data  = json_encode($sections_data);

        $total_questions = count($questions_to_update);

     
          //Clear all previous questions
          DB::table('questionbank_quizzes')->where('quize_id', '=', $quiz_id)->delete();
          //Insert New Questions
          DB::table('questionbank_quizzes')->insert($questions_to_update);
          $quiz->total_questions = $total_questions;
          $quiz->total_marks     = $marks;
          $quiz->section_data    = $sections_data;
          $quiz->save();

          DB::commit();
          flash('success','record_updated_successfully', 'success');

        }

        catch (Exception $e) {
           
           DB::rollBack();
           flash('Oops...!','Error! Improper Data Submitted Please Try Again', 'error');

        }

        return redirect(URL_QUIZZES);
    }


     /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function examTypes()
    {
        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

        $data['active_class']       = 'exams';
        $data['title']              = getPhrase('exam_types');
        $data['exam_types']         = App\ExamType::get();
        // return view('exams.exam-types', $data);

          $view_name = getTheme().'::exams.exam-types';
        return view($view_name, $data);
    }

    public function editExamType($code)
    { 
      
       if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

        $data['active_class']       = 'exams';
        $data['title']              = getPhrase('edit_exam_type');
        $data['record']             = App\ExamType::where('code',$code)->first();
        // dd($data);

        // return view('exams.edit-exam-type', $data);

          $view_name = getTheme().'::exams.edit-exam-type';
        return view($view_name, $data);

    }


    public function updateExamType(Request $request, $code)
    {
         if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }
      

       $record   = App\ExamType::where('code',$code)->first()->update($request->all());
      
       flash('success','exam_type_updated_successfully','success'); 
       return redirect(URL_EXAM_TYPES);

    }

     public function processUpload(Request $request, $record, $file_name)
     {
         if(env('DEMO_MODE')) {
        return ;
       }

         if ($request->hasFile($file_name)) {
          $examSettings = getExamSettings();
          
          $destinationPath      = $examSettings->categoryImagepath;
          
          $fileName = $record->id.'-'.$file_name.'.'.$request->$file_name->guessClientExtension();
          
          $request->file($file_name)->move($destinationPath, $fileName);
         
         //Save Normal Image with 300x300
          Image::make($destinationPath.$fileName)->fit($examSettings->imageSize)->save($destinationPath.$fileName);
         return $fileName;
        }
     }

      public function deleteFile($record, $path, $is_array = FALSE)
    {
         if(env('DEMO_MODE')) {
        return ;
       }
       
        $files = array();
        $files[] = $path.$record;
        File::delete($files);
    }

   


}

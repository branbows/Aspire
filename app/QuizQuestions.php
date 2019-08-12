<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestions extends Model
{
	
    protected $table = 'quiz_questions';

    /**
    * This method find if student exam is
    * resumed or not
    * @param  [type] $schedule_data [description]
    * @return [type]                [description]
    */
   public static function resumeExam($quiz_id='')
   {
     
     $user  = \Auth::user();
     
     $exam = QuizQuestions::where('student_id',$user->id)
                            ->where('quiz_id',$quiz_id)
                            ->where('is_exam_completed',0)
                            ->first();
     if($exam)
      return TRUE;

      return FALSE;                      

   }
}

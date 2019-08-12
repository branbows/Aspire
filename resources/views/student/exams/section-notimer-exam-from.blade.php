@extends('layouts.examlayout')

@section('content')



{{-- @include('student.exams.exam-leftbar-subjects', array('subjects' => $subjects)) --}}

<link href="{{CSS}}animate.css" rel="dns-prefetch"/>



<div id="page-wrapper" class="examform" ng-controller="angExamScript" ng-init="initAngData({{json_encode($bookmarks)}})">

    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="row">

            <div class="col-lg-12">

                <ol class="breadcrumb">

                    <li>

                        <a href="javascript:void(0);">

                            <i class="mdi mdi-home">

                            </i>

                        </a>

                    </li>

                    <li class="active">

                        {{ $title }}

                    </li>

                </ol>

            </div>

        </div>

        <!-- /.row -->

        <!-- Page Hints -->

        <div class="row">

            <div class="col-md-12">

                 <ul class="suggestions">

                    <li class="icon" id="subjectBar" title="{{getPhrase('click_here_to_list_subjects')}}">

                        <i class=" icon-books">

                        </i>

                    </li>  

                      <li>

                        <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" 

                        title="Left Arrow for Previous Question">

                            <i class="fa fa-arrow-left fa-2"></i> &nbsp;{{getPhrase('previous')}}

                        </a>

                    </li>

                    <li>

                        <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" 

                        title="Right Arrow for Next Question">

                           &nbsp;{{getPhrase('next')}} &nbsp;<i class="fa fa-arrow-right fa-2"></i> 

                        </a>

                    </li>

                    <li>

                        <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" title="Escape for Clear Answer ">

                           ESCAPE {{getPhrase('clear_answer')}}

                        </a>

                    </li>

                    <li>

                        <a class="positive" data-placement="bottom" data-toggle="tooltip" href="#" title="Add/Remove Bookmark">

                            SHIFT + <i class="fa fa-arrow-up fa-2"></i> <i class="fa fa-arrow-down fa-2"></i> {{getPhrase('bookmarks')}}

                        </a>

                    </li>  

                   

                </ul>

            </div>

        </div>

         <div>
       
         @include('student.exams.languages',['quiz'=>$quiz])
          </div>



        <!-- /.row -->

        <!-- /.row -->

        {!! Form::open(array('url' => URL_STUDENT_EXAM_FINISH_EXAM.$quiz->slug, 'method' => 'POST', 'id'=>'onlineexamform')) !!}

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-custom">

                    <div class="panel-heading">

                        <div class="pull-right exam-duration">

                            {{getPhrase('exam_duration')}}:

                            <span>

                                {{ $time_hours }}:{{ $time_minutes }}:00

                            </span>

                        </div>
                 <div class="pull-right hints">
                        <span class="hint">
                            {{getPhrase('hints')}}
                        </span>
                        <label class="checkbox-inline">
                            <input ng-model="hints" style="display:block;" type="checkbox">
                        
                                </input>
                            </input>
                        </label>
                    </div>
                       

                        <h1>

                            <span class="text-uppercase">

                                {{$title}}

                            </span>

                            : {{getPhrase('question')}}

                            <span id="question_number">

                                1

                            </span>

                            of {{ count($questions)}}

                        </h1>

    

                    </div>


          <div class="st-time-section st-category st-heading-panel st-english clearfix">

            <?php

               $section_data  = (array)json_decode($quiz->section_data);
              
           ?>
             
    <ul class="nav nav-pills st-currents">  

           @foreach($section_data as $key=>$value)
             
            
  
        <li class="dropdown" id="{{$key}}">

           <a href="javascript:void(0);" 
              onclick="showSubjectQuestion('subject_{{$key}}','{{$value->section_name}}');" 
              data-psubject_title="{{$value->section_name}}"
              data-psubject_id="{{$key}}" 
              id="subject_section_{{$key}}"
              class="btn btn-success btn-sm st-exam-modules">
              {{ $value->section_name }} 

            <i class="fa fa-info-circle st-custom-angle" aria-hidden="true"></i></a>

                
            </li>
            
        
          @endforeach

                </ul>

            </div>

                    <div class="panel-body question-ans-box">

                        {{-- START of questions List --}}

                        <div id="questions_list">

                        

                        <?php 



                        $questionHasVideo = FALSE; ?>


                           @foreach($section_data as $key=>$value)
                              
                              <?php
                               // dd($section_data);
                              $section_questions  =  $value->questions;

                             ?>


                            @foreach($section_questions as $key_id => $question_id)

                                <?php
                                 
                                 $question  = App\QuestionBank::where('id',$question_id)->first();


                                ?>


                            <?php if(!$questionHasVideo)

                            {

                                if($question->question_type=='video')

                                $questionHasVideo = TRUE;

                            } ?>

                            <?php    

                                    $image_path = PREFIX.(new App\ImageSettings())->

                                    getExamImagePath(); 



                                    ?>


                             <?php 

                            $display_question = 'display:none;';
                            $previous_answers = [];
                            $time_spent = 0;
                            if($current_question_id)
                            {
                                if($current_question_id==$question->id) {
                                    $display_question = 'display:block;';
                                }
                                else
                                    $display_question = 'display:none;';
                            }
                               if($current_state) 
                               {
                                    if(array_key_exists($question->id, $current_state)) 
                                    {
                                        
                                        $previous_answers = $current_state[$question->id]->answers;
                                        $time_spent = $current_state[$question->id]->time_spent;
                                    }
                                    else 
                                    { 
                                        
                                    }
                                }

                                ?>


      

                            <div 
                            class="question_div subject_{{$key}}" 
                            name="question[{{$question->id}}]" 
                            id="{{$question->id}}" 
                            style="display: none;" 
                            value="0">

 

                            <input type="hidden" name="time_spent[{{$question->id}}]" id="time_spent_{{$question->id}}" value="0">

                                
                                <div class="questions">

                                    <span class="language_l1">{!! $question->question !!}   </span>
                                    <span class="language_l2" style="display: none;">{!! $question->question_l2 !!}   </span>

                                    <div class="row">
  <div class="col-md-8 text-center">
  @if($question->question_type!='audio' && $question->question_type !='video')
  @if($question->question_file)
  <img class="image " src="{{$image_path.$question->question_file}}" style="max-height:200px;">
  @endif
  @endif
  </div>
  <div class="col-md-4">
   <span class="pull-right"> <a ng-if="bookmarks[{{$question->id}}] >= 0" 

                                title="{{getPhrase('unbookmark_this_question')}}" 

                                ng-click="bookmark({{$question->id}},'delete','questions');" 

                                href="javascript:void(0)" class="pull-right btn btn-link"> 

                                <i class="fa fa-star item-bookmark"></i></a>

                

                                

                                <a ng-if="bookmarks[{{$question->id}}] == -1" title="{{getPhrase('bookmark_this_question')}}" ng-click="bookmark({{$question->id}},'add','questions');" href="javascript:void(0)" class="pull-right btn btn-link"> <i class="fa fa-star-o item-bookmark"></i></a>
                                   {{$question->marks}} Mark(s)</span>
  </div>
  </div>

                                 

                                    <div class="option-hints pull-right default" data-placement="left" data-toggle="tooltip" ng-show="hints" title="{{ $question->hint }}">

                                        <i class="mdi mdi-help-circle">

                                        </i>

                                    </div>

                                </div>

                                <hr>

                                    <?php	 

                                    $image_path = PREFIX.(new App\ImageSettings())->

                                    getExamImagePath(); 



                                    ?>



								@include('student.exams.question_'.$question->question_type, array('question', $question, 'image_path' => $image_path,'previous_answers'=>$previous_answers  ))
	

                                </hr>

                            </div>

                            @endforeach
                            
                        @endforeach

                        </div>

                        {{-- End of questions List --}}

                        

                        <hr>

                            <div class="row">

                                <div class="col-md-12">

                                    <button class="btn btn-lg btn-success button prev" type="button">

                                        <i class="mdi mdi-chevron-left ">

                                        </i>

                                        {{getPhrase('previous')}}

                                    </button>

                                    <button class="btn btn-lg btn-dark button next" id="markbtn" type="button">

                                        {{getPhrase('mark_for_review')}} & {{getPhrase('next')}}

                                    </button>

                                    <button class="btn btn-lg btn-success button next" type="button">

                                        {{ getPhrase('next')}}

                                        <i class="mdi mdi-chevron-right">

                                        </i>

                                    </button>

                                    <button class="btn btn-lg btn-dark button clear-answer" type="button">

                                        {{getphrase('clear_answer')}}

                                    </button>

                                    <button class="btn btn-lg btn-danger button   finish" type="button">

                                        {{getPhrase('finish')}}

                                    </button>

                                </div>

                            </div>

                        </hr>

                    </div>

                </div>

            </div>

            {!! Form::close() !!}

             <input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz->id}}">
            <input type="hidden" name="student_id" id="student_id" value="{{$user->id}}">

        </div>

    </div>

</div>

<!-- /#page-wrapper -->

@stop



@section('footer_scripts')

  

@include('student.exams.scripts.js-scripts-section-no-timer',['quiz_record'=>$quiz])
@include('common.editor')


<!--JS Control-->

@if($questionHasVideo)

@include('common.video-scripts')


@endif



<script type="text/javascript">


    $(document).ready(function () {

        showSubjectQuestion('subject_{{$sections[0]}}','{{$section_names[0]}}');

    
    current_hours = {{ $time_hours }}; 
    current_minutes = {{ $time_minutes }}; 
    current_seconds = {{ $time_seconds }}; 

     intilizetimer(current_hours, current_minutes, current_seconds); 

     @if($current_question_id)
        resumeSetup('{{$current_question_id}}');
     @endif
    
     $('input').click(function(){
        qn = parseInt($(this).attr('name'));
        
         saveResumeExamData(qn);
     });

    // intilizetimer(5,20,0);

});

function resumeSetup(current_question_id) {
    DIV_REFERENCE.first().hide();
    
    current_question_number = $('#'+current_question_id).attr('data-current-question');
    $('#question_number').html(current_question_number);
    
    $('#'+current_question_id).fadeIn(300);
    

 
}

/**

 * intilizetimer(hours, minutes, seconds)

 * This method will set the values to defaults

 */


document.onmousedown=disableclick;
    status="right_clickdisabled";
    function disableclick(event)
    {
      if(event.button==2)
       {
         
         return false;    
       }
    } 
  


    function languageChanged(language_value)
    {
      if(language_value=='language_l2')
      {
        $('.language_l1').hide();
        $('.language_l2').show();
      }
      else {
        $('.language_l2').hide();
        $('.language_l1').show(); 
      }
      
    }



</script>

<script>

$('.finish').click(function(){

 alertify.confirm('Are you sure you want to submit examination and once submitted you cannot make any changes',

    function(e){ 
     
      if(e){

        $("#onlineexamform").submit();

          alertify.success('Ok') 
      }

      else{

      }

  });

});

 

</script>


@stop



 
   
 


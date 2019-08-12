@extends('layouts.examlayout2')


@section('content')

<link href="{{CSS}}animate.css" rel="dns-prefetch"/>



<div id="page-wrapper" class="examform" ng-controller="angExamScript"  ng-init="initAngData({{json_encode($bookmarks)}})">

    <div class="container-fluid" style="padding-left: 0 !important;padding-right: 0 !important;">

      
 
        {!! Form::open(array('url' => URL_STUDENT_EXAM_FINISH_EXAM.$quiz->slug, 'method' => 'POST', 'id'=>'onlineexamform')) !!}

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-custom custom-panel">

                    <div class="panel-heading heading-panel">

                      
               

                        <h1 style="line-height: initial;vertical-align: -webkit-baseline-middle;">

                            <span class="text-uppercase title-heading">

                                {{$title}}

                            </span>

                            <!-- : {{getPhrase('question')}}


                            {{ count($questions)}} -->

                        </h1>


        <div id="timerdiv" class="countdown-styled timer-style">
          <span class="remaining">
            <i class="mdi mdi-timer" style="margin-right:2px;font-size:15px !important;"></i> 
          Time Remaining
           </span>
            <span id="hours" style="color:#fff !important;">{{ $time_hours}}</span> :
            <span id="mins" style="color:#fff !important;">{{ $time_minutes}}</span> : 
            <span id="seconds" style="color:#fff !important;">00</span>

 <h2  class="question-cnt">
<!--   <i class="mdi mdi-printer"></i>  -->
  {{getPhrase('question')}}

                           <span id="question_number">
  
                                1

                            </span>
  
                            of {{ count($questions)}}</h2>
          </div>

   
  
                    </div>
                    <div class="flag-details" >

                      <span class="positive" id="show-cal" style="cursor: pointer;" onclick="showCal()">
                        <i class="fa fa-calculator" style="margin-right: 6px;padding: 4px 0;" ></i>
                      Calculator
                    </span>

                     <span class="positive next review-next" id="markbtn" style="cursor: pointer; float: right;" type="button">
                        <i class="fa fa-flag" ></i>
                      Flag for Review
                    </span>
                    
                    </div> 




                        {{-- START of questions List --}}

                        <div id="questions_list" class="list-questions list-get">

                        

                        <?php 
                             
                             $questionHasVideo = FALSE;
                             $total_para_ques = 0;
                         ?>

                            @foreach($questions as $question)



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
                            class="question_div div-question subject_{{$question->subject_id}}" 
                            name="question[{{$question->id}}]" 
                            id="{{$question->id}}" 
                            data-questiontype = "{{$question->question_type}}"
                            style="display:none;" value="0">

 

                            <input type="hidden" name="time_spent[{{$question->id}}]" id="time_spent_{{$question->id}}" value="0">

                                
                                        @if($question->question_type != 'para') 
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 questions"> 

<div class="main-content">

                                            <span class="language_l1 ">{!! $question->question !!}   </span>
                                            @if($question->question_l2) 
                                             @if($question->question_type == 'radio' || $question->question_type == 'checkbox' || $question->question_type == 'blanks' || $question->question_type == 'match')
                                           <span class="language_l2" style="display: none;"> {!! $question->question_l2 !!}   </span>
                                           @else
                                           <span class="language_l2" style="display: none;"> {!! $question->question !!}   </span>
                                             @endif
                                           @else
                                           <span class="language_l2" style="display: none;"> {!! $question->question !!}   </span>
                                           @endif


                                                                                <div class="row">
                                                                 <div class="col-md-8 text-center">
                                                          @if($question->question_type!='audio' && $question->question_type !='video')
                                                           @if($question->question_file)
                                                                    <img class="image img-responsive" src="{{$image_path.$question->question_file}}" >
                                                             @endif
                                                               @endif
                                                             </div>


                                                                          <div class="col-md-4">
                                                                  
                                                                  </div>


                                                                  </div>

                       </div>  </div>
                                      @endif


                                        <!-- <hr class="bottom-hr"> -->

                                            <?php  

                                            $image_path = PREFIX.(new App\ImageSettings())->

                                            getExamImagePath(); 

                                             if($question->question_type == 'para' )
                                                    ++$total_para_ques;



                                            ?>



                        @include('student.exams.layout2.question_'.$question->question_type, array('question', $question, 'image_path' => $image_path,'previous_answers'=>$previous_answers ,'total_para_ques'=>$total_para_ques ))
          

                                        </hr>

                                    </div>

                                    @endforeach

                       
                      </div>
                       

                        {{-- End of questions List --}}



               


                        


</div>

<div class="footer" style="background:#006caa;">
                            <div class="row max ">

                                <div class="col-md-12">
  
                                   <button class="btn btn-lg btn-info button success-btn next" type="button" >

                                        {{ getPhrase('next')}}

                                       
                                       <i class="fa fa-arrow-right" style="font-size: 16px;font-weight: 500;"></i>
                                    </button>


                                    <button class="btn btn-lg btn-info button paranext nextpara para-next" type="button" >

                                       {{ getPhrase('next')}}
                                         <i class="fa fa-arrow-right" style="font-size: 16px;font-weight: 500;"></i>
                                     
                                     </button>


                                       {{-- <button class="btn btn-lg btn-info button finish myfinish-2 pull-right" type="button" style="display: none;margin-right: 20px;">
                                 
                                      <i class="fa fa-sign-out">

                                        </i>

                                        {{getPhrase('end_exam')}}
                                         

                                    </button> --}}


                                     <button class="btn btn-info button review review-btn myfinish-2 pull-right" type="button" onclick="viewReviewInfo()" style="display: none;margin-right: 20px;">
                                 
                                      <i class="fa fa-eye">

                                        </i>

                                        {{getPhrase('review_questions')}}
                                         

                                    </button>

                                     {{-- Question Previous --}}
                                     <button class="btn btn-lg btn-info button success-btn prev pull-right prev-btn" type="button" >
                                         <i class="fa fa-arrow-left" style="font-size: 16px;font-weight: 500;"></i>
                                        {{ getPhrase('previous')}}
                                       

                                     </button>
                                     
                                     {{-- Paragrap Previous --}}
                                      <button class="btn btn-lg btn-info button success-btn paraprev pull-right para-prev-btn" type="button" >

                                       <i class="fa fa-arrow-left" style="font-size: 16px;font-weight: 500;"></i>

                                        {{ getPhrase('previous')}}
                                        
                                     </button>


                                      {{-- review Data --}}

                                     <button class="btn btn-info button review review-btn myfinish-1" type="button" onclick="viewReviewInfo()">
                                 
                                      <i class="fa fa-eye">

                                        </i>

                                        {{getPhrase('review_questions')}}
                                         

                                    </button>

                                     <button class="btn btn-info button review-back review-btn" type="button" onclick="reviewBack()" style="display: none;">
                                 
                                      <i class="fa fa-arrow-left">

                                        </i>

                                        {{getPhrase('back')}}
                                         

                                    </button>

                                    {{-- end review Data --}}

                                  

                                    <button class="btn btn-lg btn-info button finish " type="button">
                                 
                                      <i class="fa fa-sign-out">

                                        </i>

                                        {{getPhrase('end_exam')}}
                                         

                                    </button>




                                </div>

                            </div>
                          </div>

                   <!--      <hr class="bottom-hr"> -->

                       </div>

                </div>

            </div>

            {!! Form::close() !!}

             <input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz->id}}">
            <input type="hidden" name="student_id" id="student_id" value="{{$user->id}}">

        </div>


           {{-- Review questions --}}


<div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><span id='msg1'></span> {{getPhrase('review_questions')}}</h4>
      </div>
      <div class="modal-body">
           
           <?php 
  $questions  = $questions;
  $quiz     = $quiz;
  if(isset($current_state))
    $cState     = $current_state;

 ?>

          <div class="panel-body">
          <div class="sub-heading">
            <h3>{{$quiz->title}}</h3>
            <p>{{ ucfirst($quiz->category->category) .' '. getPhrase('category')}}</p>
          </div>
          <ul class="question-palette" id="pallete_list">
            @for($i=0; $i<count($questions); $i++)

            <?php 
                $default_class = 'not-visited';
                if(isset($cState) && $cState) {
                if(array_key_exists($questions[$i]->id, $cState))
                  $default_class = 'answered';
              }
            ?>

            <li  class="palette pallete-elements {{$default_class}}" onclick="showSpecificQuestion({{$i}});">
            <span>{{$i+1}}</span>
            </li>

            @endfor
          </ul>
        </div>
        <div class="panel-heading">
          <h2>{{ getPhrase('summary')}}</h2>
        </div>
        <div class="panel-body">
          <ul class="legends">
            <li  class="palette answered"><span id="palette_total_answered">1</span> {{getPhrase('answered')}}</li>
            <li  class="palette marked"><span id="palette_total_marked">2</span> {{getPhrase('marked')}}</li>
            <li  class="palette not-answered"><span id="palette_total_not_answered">3</span> {{getPhrase('not_answered')}}</li>
            <li  class="palette not-visited"><span id="palette_total_not_visited">4</span> {{getPhrase('not_visited')}}</li>
          </ul>
        </div>




      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">{{getPhrase('close')}}</button>
      </div>

    </div>

  </div>
</div>

</div>


    </div>



 



<style type="text/css">
  /* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  
  height: 100%;
}
.footer {
  position: absolute;
    bottom: -44px;
  width: 100%;
  /* Set the fixed height of the footer here  */
  height: 42px;
  background-color: #999999;
}

/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */
body > .container-fluid {
  padding-top: 50px;
}
.container-fluid .col-sm-6 { 
  padding: 0;
}
.navbar {
  margin-bottom: 0;
}
.select-option ul li img{width: 100px;height:100px;margin:12px;}
.footer {
  padding: 9px 0;
}
.btn-info:hover, .btn-info:focus {
    border-left: none !important;
}
.next,.paranext{position: relative;}
.next:before,.paranext:before{    content: "";
    background: #fff;
    height: 38px;
    width: 2px;
    position: absolute;
    bottom: 0;
    left: -8px;}
.finish{height: 42px !important;}
.finish:hover,.finish:focus{border-right:none !important;border-left: none !important; }
.next:hover,.next:focus{border-left: none !important;border-right: none !important;}
.custom-panel{background:#fff !important;}
.heading-panel {
    padding: 41px 18px !important;
    padding-top: 0 !important;
    box-shadow: none !important;
    background: #006caa !important;
}
.btn-lg.button{margin-top:-11px !important;}
.next,.para-next{    height: 41px !important;
    width: initial !important;
       padding-left: 32px !important;
    padding-top: 6px !important;border-left: none !important; }
.flag-details{margin-top:0 !important;    text-align: left !important;}
.main-content { overflow-y:auto;
  border-right: 2px solid #006caa;
    box-shadow: 2px 0px 0px 0px #006caa;
  padding: 20px;
  height:calc(100vh - 110px);
} 
@media(min-width:1401px) and (max-width:2400px) {
.para-main-question,.questions-container{
      min-height: 700px !important;
    max-height: 844px !important;
    overflow-y: overlay;
    overflow-x: hidden;
}

}
   input[type="radio"] + label .radio-button {
    width: 12px !important;
    margin-top: 8px !important;
    margin-right: 10px !important;
    height: 12px !important;
    border: 1px solid #b3b3b3 !important;
    border-radius: 100%;
    background: #dedede !important;
}
    input[type="radio"]:checked + label .active {
    display: block;
    color: transparent !important;
    width: 6px !important;
    background: #7d7f82 !important;
    height: 6px !important;
    margin: 2px !important;
    line-height: 1;
} 
 @media(min-width:300px) and (max-width:1400px) {
.para-main-question,.questions-container{
min-height: 100px  !important;
max-height: 560px  !important;
overflow-y: overlay;
    overflow-x: hidden;
}
}  
@media(max-width: 1199px){.questions-match{width: 50% !important;}}
@media(max-width: 768px){
  .questions-match{width: 100% !important;}
/*.main-content{height: calc(100vh - 250px) !important;}*/
  .c-pull-left,
.c-pull-right{margin:5px;}
}
@media(min-width: 768px){

  .c-pull-left{float: left;}  
.c-pull-right{float: right;}
}


/******* previous buttons ******/

.para-prev-btn,.prev-btn{ 
    background: transparent !important;
    padding-top: 14px;
    margin-left: :0 !important;
    width: 179px;
    margin: 0 auto !important;
    margin-right: -5px !important;
 }
.para-prev-btn:hover,.para-prev-btn:focus,.prev-btn:hover,.prev-btn:focusm.prev-btn:active,.para-prev-btn:active{border:none;background: none;}


.myfinish-2:before{position: absolute;
    background: #fff;
    height: 42px;
    width: 2px;
    top: 0px;
    content: "";
    left: 0;}
.myfinish-2{position: relative;}
.para-main-question,.questions-container,.questions,.list-style-none{font-size: 12pt !important;}



/********** modifications *********/

.review-btn {background:transparent !important;    margin-top: -5px !important;}
.review-btn:hover,.review-btn:focus{background:transparent !important;}
.review-next:before{display: none !important;}
.review-next,.review-next:hover,.review-next:focus{margin-top:-4px !important ;border:none !important;border-left:none !important;border-right: none !important;}
.data-col{ padding-left: 0 !important;
    border: 1px solid #b9b9b9;
    border-left: none !important;
    border-top: none !important;    margin-bottom: -1px !important;}
.data-content { overflow-y:auto;
  border-right:none !important;
    box-shadow: none !important;
  padding: 0px;
  height:calc(100vh - 182px) !important;overflow-x: hidden;
}
.data-row{border-bottom:1px solid #b9b9b9;}
.data{        padding: 10px !important;
    margin: -3px !important;
    padding-left: 0px !important;
    border: 1px solid #b3b3b3;
    border-left: none;
    border-top: none;
    margin-left: 3px !important;}
.data-questions{          margin: 8px !important;
    margin-top: 0 !important;
    margin-right: -22px !important;
    padding-right: 0 !important;
      margin-bottom: 2px !important;}

</style> 


<!-- /#page-wrapper -->

@stop



@section('footer_scripts')

  

@include('student.exams.scripts.js-scripts-2')

@include('common.editor')


<!--JS Control-->

@if($questionHasVideo)

@include('common.video-scripts')


@endif



<script type="text/javascript">


    $(document).ready(function () {

    // $('#myfullscreen').trigger('click');
    
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


function viewfull(){

  showfullscreen();
}    

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
    status=getPhrase("right_clickdisabled");
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


    function viewReviewInfo(){

           $('#myModal').modal('show');


      
  }


  function reviewBack(){

      $('.review-info').hide();        
      $('.questions-info').show();        
      $('.review-back').hide();        
      $('.review').show();    
      $('.next').show();        
      $('.prev').show();  


      if(CURR_INDEX == MAXIMUM_QUESTIONS)

      { 

            var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');
        
           if(question_type != 'para'){
           // console.log('haoi');
                 $('.next').hide();
                 $('.paranext').hide();
                 $('.prev').show();
                 $('.paraprev').hide();
                 $('.myfinish-1').hide();
                 $('.myfinish-2').show();
         }
            
      }
           
          
    }






</script>

<script>

$('.finish').click(function(){
          
  var theAnswer = confirm("Once you submit your answers, you can not make any changes. Are you sure you want to submit?");
  
   if(theAnswer){

       $("#onlineexamform").submit();

       alertify.success('Answers Submitted. Please wait a moment') 
   }
  
  else{
       
    }

  });

 

</script>

<script>
 function showCal(){

  var calculator_window = null;
      
          //var size = { width: 267, height: 205 };
          var size = { width: 225, height: 393 };
          calculator_window = window.open('http://practice.ukcat.ac.uk/pages/calculator-ti108.aspx','calculator_window', 'height='+size.height+',width='+size.width+',toolbar=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,modal=no');
     
     
}

</script>

@stop



 
   
 


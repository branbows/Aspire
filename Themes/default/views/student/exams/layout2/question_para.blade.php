<?php 



  $answers = json_decode($question->answers);



    // dd($answers);

 ?>



 <style>

       .para-left-panel,.para-right-panel{position: relative;}

       .para-left-panel::after{position: absolute;content: "";width: 1px;height: 100%;background: #e6e6e6;top: 0;right:  0;

       }

       .para-right-panel::after{position: absolute;content: "";width: 1px;height: 100%;background: #e6e6e6;top: 0;left: -1px;

       }

       .para-main-question{min-height: 100px;max-height: 600px;overflow-y: auto;padding-left: 12px;}

       .c-right{float: right;}

       .border-gray{border:5px solid #e6e6e6;padding: 10px;margin-bottom: 30px;}

       .bg-gray-btn{       background: #f6f6f6;

    padding: 10px 10px 0px 10px;

    border-top: 1px solid #e6e6e6;

    bottom: -10px;

    position: relative;

    margin: 0 5px;}

    .bg-gray-btn .btn-sm{font-size: 12px;

    padding: 8px 7px;}
.para-main-content{
    border-right: 0px solid #006caa;
    box-shadow: 4px 0px 0px 0px #006caa;
    padding: 20px;
    height: calc(100vh - 110px);
}
    hr{display: none}
    .questions-paralist{font-size: 20px;
    padding: 23px !important;    padding-left: 37px !important;
    padding-top: 12px !important;}

  /* .border-gray input[type="radio"] + label span.fa-stack, .border-gray input[type="checkbox"] + label span.fa-stack{margin-top: 12px;}*/

    /*.choice-img{display: inline-block;}*/
/*@media(max-width:768px) {
    .para-main-content{    height: calc(100vh - 400px) !important;}
  }*/
</style>



<div class="border-gray grey-border" style="border:none !important;">



<div class="row">



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 para-left-panel para-main-content">



            <div class="para-main-question questions questions-paralist">  



               <span class="language_l1" style="color: black;"> {!! $question->question !!}  </span>



                       @if($question->question_l2) 

                         @if($question->question_type == 'radio' || $question->question_type == 'checkbox' || $question->question_type == 'blanks' || $question->question_type == 'match')

                         

                       <span class="language_l2" style="display: none; color: black;"> {!! $question->question_l2 !!}   </span>

                       @else

                       <span class="language_l2" style="display: none;color: black;"> {!! $question->question !!}   </span>

                         @endif

                       @else

                       <span class="language_l2" style="display: none;color: black;"> {!! $question->question !!}   </span>

                       @endif

                         <div class="row">

                                <div class="col-md-8 text-center">
                                                        
                                          @if($question->question_file)

                                              <img class="image img-responsive" src="{{$image_path.$question->question_file}}" >

                                              @endif
                                                             
                                  </div>


                                <div class="col-md-4">
                                                                  
                                </div>


                           </div>



            </div>



    </div>

  

 



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 para-right-panel panel-right para-ques-get questions-paralist">



        <ul class="questions-container">



             <div id="para_questions_{{$total_para_ques}}" class="para-vis">



            <?php $i=0; $q=1;?>

            @foreach($answers as $answer)

            <?php

              

             $options    = (array)$answer->options; 

             $option_img = isset($answer->options_images)? (array)$answer->options_images: 0 ; 


             // dd($answers);



              $optionsl2 = null;

             

            



             ?>

             {{-- Para Question Start --}}



       



            <div class="question_para"  style="display:none;" >







                <div class="question">

                    <p>

                       {{--  Q{{$q++}}) --}} <span class="language_l1" style="color: black;">{!!$answer->question !!}</span>

                       

                        <span class="language_l2" style="display: none;color: black;">{!!$answer->question !!}</span>



                       @if(isset($answer->has_file))



                        @if($answer->has_file==1 && $answer->file_name !='')



                        <img src="{{$image_path.$answer->file_name}}"  style="margin-top: 10px;">



                        @endif

                        

                      @endif



                      

                        {{-- If question Having any mage --}}

                    </p>

                </div>

                <div class="select-answer">



                    <div class="row ">

                        @foreach($options as $key=>$value)

                            

                        <?php $index = 1; ?>

                        @foreach($value as $key1 => $value1)

                    

                        <div class="col-md-12">

                            <input id="{{$question->id.'_'.$i.'_'.$index}}" value="{{$index}}" name="{{$question->id}}[{{$i}}]" type="radio"/>

                            <label for="{{$question->id.'_'.$i.'_'.$index}}">

                                <span class="fa-stack radio-button button-radio">

                                    <i class="mdi mdi-check active">

                                    </i>

                                </span>

                                <span class="language_l1" style="margin-top: 15px;color: black;">{!!$value1!!}</span>



                            @if( $option_img )

                                 @if( count($option_img) )

                                   

                                 <?php

                                  $temp1   = 0;
                                  $temp2   = 0;
                                  
                                  foreach ( $option_img as $o_key => $o_value ) {

                                   $temp1  = (array)$o_value;

                                  }

                                  if($temp1){
                                      
                                      $temp2  = isset($temp1[$key1])? (array)$temp1[$key1]:0; 

                                  }
                                
                                 ?>

                                  
                                   @if( $temp2 )
                                       
                                       <img src="{{ $image_path.$temp2['file_name'] }}" class="choice-img" style="margin-top: 10px;" >


                                    @endif



                                 @endif


                            @endif





                                @if($optionsl2)

                                <span class="language_l2" style="display: none;color: black;">{!! $value1 !!}</span>



                                @else

                                <span class="language_l2" style="display: none;color: black;">{!!$value1!!}</span>

                                

                                @endif

                            </label>



                            {{-- If Option Having any mage --}}





                        </div>

                         <?php $index++; ?> 

                        @endforeach 

                        

                    @endforeach

                    <?php $i++; ?>

                    </div>

                  

                 

                </div>



            </div>



       



            {{-- Para Question End --}}





          



                @endforeach



                 </div>



            

        </ul>

        </div>

        <div class="clearfix">
          
        </div>

        <div class="bg-gray-btn">

         <div class="row parashow">
                        
                        <div class="col-md-12">
                                



                              {{--      <button class="btn btn-sm btn-info button paranext c-right " type="button" >

                                     {{ getPhrase('next')}}
                                     <i class="mdi mdi-chevron-right">
                                       
                                     </i>
                                
                                  </button> --}}



                                </div>




                        </div>

        </div>

    





                  





</div>

</div>
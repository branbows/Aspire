
<?php $answers = json_decode($question->answers); 
 
$video_path= EXAM_UPLOADS.$question->question_file;
 if($question->question_file_is_url)
$video_path= $question->question_file;
    

?>
 @if($question->question_type=='video')
    <div class="row">
          <video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto" width="300" height="264"
          poster="" data-setup='{"aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'>
            <source src="{{$video_path}}" type='video/mp4'>
            
            <p class="vjs-no-js">
              To view this video please enable JavaScript, and consider upgrading to a web browser that
              <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <ul class="questions-container">
            <div id="para_questions">
            <?php $i=0;  $q=1; ?>
            @foreach($answers as $answer)
            <?php 
            $options = (array) $answer->options; 
            $option_img = isset($answer->options_images)? (array)$answer->options_images: null ; 
             $optionsl2 = null;
            
            ?>
             <div class="question_para" style="display: none;">
                <div class="question">
                    <h3>
                          Q{{$q++}}) <span class="language_l1">{!!$answer->question !!}</span>
                      
                        <span class="language_l2" style="display: none;">{!!$answer->question !!}</span>

                      @if(isset($answer->has_file))

                        @if($answer->has_file==1 && $answer->file_name !='')

                        <img src="{{$image_path.$answer->file_name}}" >

                        @endif
                        
                      @endif


                      
                    </h3>
                </div>
                <div class="select-answer">
                    <ul class="row">
                          @foreach($options as $key=>$value)
                        <?php $index = 1; ?>
                        @foreach($value as $key1 => $value1)
                        
                        <li class="col-md-6">
                            <input id="{{$question->id.'_'.$i.'_'.$index}}" value="{{$index}}" name="{{$question->id}}[{{$i}}]" type="radio"/>
                            <label for="{{$question->id.'_'.$i.'_'.$index}}">
                                <span class="fa-stack radio-button">
                                    <i class="mdi mdi-check active">
                                    </i>
                                </span>
                                  <span class="language_l1">{!!$value1!!}</span>
                            
                              @if( count($option_img) )

                                 <?php

                                  $t1  = isset($option_img[$key])? (array)$option_img[$key]: null;
                                  
                                  $t2  = null;

                                  if($t1){

                                  $t2  = isset($t1[$key1])? (array)$t1[$key1]: null; 
                                }


                                 ?>

                                   @if( count($t1) && count((array)$t2) )

                                     @if( isset($t2['has_file']) && $t2['has_file'] == 1  )

                                  
                                        <img src="{{ $image_path.$t2['file_name'] }}" >

                                      @endif

                                    @endif

                                 @endif
                                    
                                @if($optionsl2)
                                <span class="language_l2" style="display: none;">{!! $value1 !!}</span>
                                @else
                                <span class="language_l2" style="display: none;">{!!$value1!!}</span>
                                @endif
                            </label>
                        </li>
                         <?php $index++; ?> 
                        @endforeach 
                        
                    @endforeach
                    <?php $i++; ?>
                    </ul>
                </div>
            </div>

       
           

                @endforeach

                 </div>
           
        </ul>
    </div>
</div>

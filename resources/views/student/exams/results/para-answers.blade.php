
<?php 
    $options = json_decode($question->answers); 
    $correct_answers = json_decode($question->correct_answers);
    
     $outer_index=0;

?>
<div class="row">
    <div class="col-md-12">
        <ul class="questions-container fullwidth">
          <?php 
          foreach($options as $option) { 
            // dd($user_answers);
            $cAnswer = $correct_answers[$outer_index]->answer;
            $uAnswer = $user_answers[$outer_index];
            // dd($uAnswer);
            // print_r($option->options[0]);
              $sub_options = (array)$option->options;
              $optionsl2  = null;
              if(isset($option->optionsl2))
              $optionsl2 = (array) $option->optionsl2; 


            foreach($sub_options as $key => $value)
             $sub_options = $value;
            ?>  
            <li>
                <div class="question">
                    <h3> <span class="language_l1">{!!$option->question !!}</span>
                        @if(isset($option->questionl2))
                        <span class="language_l2" style="display: none;">{!! $option->questionl2 !!}</span>
                        @endif
                    </h3> </div>
               
                <div class="select-answer">
                    <ul class="row">
                    <?php $index=0; 
                     
                     foreach($sub_options as $key1 => $value1) { 
                        $correct_answer_class = '';
                        if($cAnswer==$index+1)
                        {
                              $correct_answer_class = 'correct-answer';
                        }
                        
                        $submitted_value = '';
                        if($user_answers) 
                        {
                           if($uAnswer == $index+1) 
                           {
                                $submitted_value = 'checked';
                                
                            }
                        }
                      
                        ?>
                        <li class="col-md-6 {{$correct_answer_class}} answer_radio" >
                            <input type="radio" name="option{{$question->id.$outer_index}}" id="1radio1"  {{$submitted_value}} disabled="">
                            <label for="1radio1"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>  <span class="language_l1">{!!$value1!!}</span>
                              @if($optionsl2)
                                <span class="language_l2" style="display: none;">{!!$optionsl2[$key][$key1]!!}</span>
                                @endif
                                  </label>
                        </li>
                        <?php $index++; } ?>
                    </ul>
                </div>
            </li>
            <hr>
            <?php } ?>

        </ul>
    </div>
</div>

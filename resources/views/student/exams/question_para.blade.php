<?php $answers = json_decode($question->answers);
    // dd($question);
 ?>
<div class="row">
    <div class="col-md-12">
        <ul class="questions-container">
            <?php $i=0; ?>
            @foreach($answers as $answer)
            <?php

             $options   = (array) $answer->options; 
             // dd($options);
              $optionsl2 = null;
              if(isset($answer->optionsl2)) 
             $optionsl2 = (array) $answer->optionsl2; 

             ?>
            <li>
                <div class="question">
                    <h3>
                        <span class="language_l1">{!!$answer->question !!}</span>
                         @if(isset($answer->questionl2))
                        <span class="language_l2" style="display: none;">{!! $answer->questionl2 !!}</span>
                        @endif
                    </h3>
                </div>
                <div class="select-answer">

                    <ul class="row ">
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
                                @if($optionsl2)
                                <span class="language_l2" style="display: none;">{!!$optionsl2[$key][$key1]!!}</span>
                                @endif
                            </label>
                        </li>
                         <?php $index++; ?> 
                        @endforeach 
                        
                    @endforeach
                    <?php $i++; ?>
                    </ul>
                  
                 
                </div>
            </li>
            <hr>

                @endforeach
            </hr>
        </ul>
    </div>
</div>

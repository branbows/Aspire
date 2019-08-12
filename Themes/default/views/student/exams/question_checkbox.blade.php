<?php
 
    $answers = json_decode($question->answers);

    $i=1;
   
 ?>

<div class="select-answer">
    <ul class="row list-style-none">
    
     @foreach($answers as $answer)
     @if(isset($answer->option_value))
       <li class="col-md-6">
       <?php $rand_no = mt_rand(1,1000000); ?>
            <input  id="{{$answer->option_value}}_{{$rand_no}}" value="{{$i++}}" name="{{$question->id}}[]" type="checkbox">
           
                <label for="{{$answer->option_value}}_{{$rand_no}}">
                    <span class="fa-stack checkbox-button">
                        <i class="mdi mdi-check active">
                        </i>
                    </span>
                     <span class="language_l1">{!! $answer->option_value !!}</span>
                     @if(isset($answer->optionl2_value))
                <span class="language_l2" style="display: none;">{!! $answer->optionl2_value !!}</span>
                 @else
                <span class="language_l2" style="display: none;">{!! $answer->option_value !!}</span>
                @endif
                </label>
            </input>
             @if($answer->has_file)
            <img src="{{$image_path.$answer->file_name}}" >
            @endif
        </li>  
        @endif
     @endforeach    

      

    </ul>
      
</div>

<?php
    $answers = json_decode($question->answers);
    $i=1;
 ?>
<div class="select-answer">
    <ul class="row list-style-none">
         <?php $index = 0;?>
        @foreach($answers as $answer)
        
        <li class="col-md-6">
            <input id="{{ $answer->option_value}}{{$question->id}}{{$i}}" value="{{$i}}" name="{{$question->id}}[]" 
              @if(isset($previous_answers) && count($previous_answers))
                @if(isset($previous_answers[$index]))
                    @if($previous_answers[$index]=='true')
                        checked
                    @endif
                @endif
            @endif
            type="radio"/>
            
            <label for="{{$answer->option_value}}{{$question->id}}{{$i++}}">
                <span class="fa-stack radio-button">
                    <i class="mdi mdi-check active">
                    </i>
                </span>
                <span class="language_l1">{!! $answer->option_value !!}</span>

                @if(isset($answer->optionl2_value))
                <span class="language_l2" style="display: none;">{!! $answer->optionl2_value !!}</span>
                @endif

            </label>

            @if($answer->has_file)
            <img src="{{$image_path.$answer->file_name}}" height="50" width="50">
            @endif

        </li>
         <?php $index++;?>
        @endforeach
    </ul>
 
</div>

<div class="row col-lg-6 col-sm-6 col-md-6 col-xs-12 select-answer select-option">

    <div style="margin-left: 15px;color:black;">
        <p><span class="language_l1" >{!!$question->second_question !!}</span></p>
         @if($question->right_question_file)
            <img src="{{$image_path.$question->right_question_file}}" height="200px" width="200px" class="img-responsive">
            @endif
      </div>

    <div class="col-md-12">
        <ul class="filling-blank blank-fill" style="margin-top: 20px;">

            @for($i=1; $i <= $question->total_correct_answers; $i++)
            <li>
                <span class="numbers-count">
                    {{ $i }}
                </span>
                <fieldset class="form-group">
                    <input class="form-control pull-right" placeholder="Blank {{$i}}" type="text" name="{{$question->id}}[]">
                   
                </fieldset>
            </li>
            @endfor
             
        </ul>
        
    </div>
 
</div>
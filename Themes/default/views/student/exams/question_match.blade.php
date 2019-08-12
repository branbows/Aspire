<?php $answers = json_decode($question->answers); 
$leftdata     =  $answers->left;
$rightdata    =  $answers->right;

$leftl2  = null;
$rightl2  = null;
if(isset($leftdata->optionsl2) && isset($rightdata->optionsl2)){
$leftl2       =  $leftdata->optionsl2;
$rightl2      =  $rightdata->optionsl2;
}
// echo "<pre>";
// print_r($answers);

?>
<div class="match-questions row">
    <div class="col-md-6">
        <h4><span class="language_l1">{{ $leftdata->title  }}</span></h4>
        @if(isset($leftdata->titlel2))
        <h4><span class="language_l2" style="display: none;">{{ $leftdata->titlel2  }}</span></h4>
        @else
        <h4><span class="language_l2" style="display: none;">{{ $leftdata->title  }}</span></h4>
        @endif
    </div>
    <div class="col-md-6">
        <h4><span class="language_l1">{{ $rightdata->title  }}</span></h4>
         @if(isset($rightdata->titlel2))
        <h4><span class="language_l2" style="display: none;">{{ $rightdata->titlel2  }}</span></h4>
        @else
        <h4><span class="language_l2" style="display: none;">{{ $rightdata->title  }}</span></h4>

        @endif
    </div>

    <div class="col-md-6">
        {{-- First Language --}}
        <ul class="option option-left">
        <?php $i=1;?>
        @foreach($leftdata->options as $key => $value)
            <li>
                <span class="numbers-count">
                   {{ $i++ }}
                </span>
                 <span class="language_l1">{!! $value !!} </span>
                 @if($leftl2 && isset($leftl2[$key] ))
                 <span class="language_l2" style="display: none;">{!! $leftl2[$key] !!} </span>
                 @else
                 <span class="language_l2" style="display: none;">{!! $value !!} </span>
                 @endif
            </li>
         @endforeach
        </ul>


       

    </div>
    <div class="col-md-6">
      
        {{-- First Language --}}
        <ul class="option option-right">
        <?php $i=1;?>
        @foreach($rightdata->options as $key => $value)
            <li>
                <fieldset class="form-group">
                    <input class="form-control pull-right" id="ans" max="2" maxlength="2" min="1" placeholder="2" name="{{$question->id}}[]" type="text">
                        <p class="language_l1">
                            {!! $value !!}
                        </p>
                        @if($rightl2 && isset($rightl2[$key]))
                        <p class="language_l2" style="display: none;">
                          {!! $rightl2[$key] !!}
                        </p>
                        @else
                         <p class="language_l2" style="display: none;">
                          {!! $value !!}
                        </p>
                        @endif
                    </input>
                </fieldset>

            </li>
         @endforeach    
        </ul>

      
    </div>
</div>
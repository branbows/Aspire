 					
				<div class="row">

					<div class="col-md-6">

					<fieldset class="form-group">

					
						{{ Form::label('category', getphrase('category')) }}

						<span class="text-red">*</span>

						{{Form::select('category_id', $categories, null, ['class'=>'form-control'])}}

					</fieldset> 


 					<fieldset class="form-group">

						{{ Form::label('question', getphrase('question')) }}

						<span class="text-red">*</span>

						{{ Form::text('question', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('question'),

							'ng-model'=>'question', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.question.$touched && formQuiz.question.$invalid}'
						)) }}

						<div class="validation-error" ng-messages="formQuiz.question.$error" >

	    					{!! getValidationMessage()!!}

						</div>

					</fieldset>


					<fieldset class="form-group">

						<?php $status = array('1' =>'Active', '0' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-red">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}

					</fieldset> 

				</div>



					<div class="col-md-6">
				
					<fieldset class="form-group">

						{{ Form::label('answer', getphrase('answer')) }}

						<span class="text-red">*</span>

						<?php
	                        $val=old('answer');
	                        if ($record)
	                         $val = $record->answer;
                    	?>


						{{ Form::textarea('answer', $value = null , $attributes = 

						array('class' => 'form-control ckeditor', 

		                    'placeholder' => 'Answer',

		                    'ng-model' => 'answer',

		                    'rows' => '5',

		                    'ng-init'=>'answer="'.$val.'"',

		                    ))
						}}

					</fieldset>


					<div class="buttons text-center">

						<button class="btn btn-lg btn-success button"

						ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>

					</div>

		 		</div>


		 		

			</div>
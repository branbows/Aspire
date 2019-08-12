 					
				<div class="row">

 					<fieldset class="form-group col-md-6">

						{{ Form::label('name', getphrase('name')) }}

						<span class="text-red">*</span>

						{{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('name'),

							'ng-model'=>'name', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.name.$touched && formQuiz.name.$invalid}',

							'ng-minlength' => '4',

							'ng-maxlength' => '50',

						)) }}

						<div class="validation-error" ng-messages="formQuiz.name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

					</fieldset>



					<fieldset class="form-group col-md-6">

						<?php $status = array('1' =>'Active', '0' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-red">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}

					</fieldset> 

				</div>


				<div class="row">



					<fieldset class="form-group">

						{{ Form::label('content', getphrase('content')) }}

						<span class="text-red">*</span>

						<?php
	                        $val=old('content');
	                        if ($record)
	                         $val = $record->content;
                    	?>


						{{ Form::textarea('content', $value = null , $attributes = 

						array('class' => 'form-control ckeditor', 

		                    'placeholder' => 'Content',

		                    'ng-model' => 'content',

		                    'ng-init'=>'content="'.$val.'"',

		                    ))
						}}

					</fieldset>


					<div class="buttons text-center">

						<button class="btn btn-lg btn-success button"

						ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>

					</div>

		 		</div>
 					
				<div class="row">

					
 					<fieldset class="form-group col-md-8">

						{{ Form::label('category', getphrase('category')) }}

						<span class="text-red">*</span>

						{{ Form::text('category', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('category'),

							'ng-model'=>'category', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.category.$touched && formQuiz.category.$invalid}',

							'ng-maxlength' => '50',

						)) }}

						<div class="validation-error" ng-messages="formQuiz.category.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

					</fieldset>



					<fieldset class="form-group col-md-8">

						<?php $status = array('1' =>'Active', '0' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-red">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}

					</fieldset> 

		 	</div>

		 	<div class="buttons text-center">

				<button class="btn btn-lg btn-success button"

				ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>

			</div>
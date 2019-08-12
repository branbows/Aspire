 					
				<div class="row">

 					<fieldset class="form-group">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-red">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('title'),

							'ng-model'=>'title', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',

							'ng-maxlength' => '100',

						)) }}

						<div class="validation-error" ng-messages="formQuiz.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

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

		                    'ng-model' => 'content'

		                   
		                    ))
						}}

					</fieldset>



				</div>


				<div class="row">


					<fieldset class="form-group col-md-6">

						{{ Form::label('tags', getphrase('tags')) }}

					
						{{ Form::text('tags', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Exams.Notifications.Other Exams',

							'ng-model'=>'tags', 

							'ng-maxlength' => '50',

						)) }}

						<div class="validation-error" ng-messages="formQuiz.tags.$error" >

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

						{{ Form::label('image', getphrase('image')) }}

						<small>(for better resolution 1200*1200)</small>

						<div class="form-group row">

							<div class="col-md-6">

							{!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}

							</div>

						</div>


							<?php if(isset($record) && $record) { 

								  if($record->image!='') {

								?>

						<div class="form-group row">

							<div class="col-md-12">

								<img src="{{ getBlogImgPath($record->image) }}" class="img-responsive"/>

							</div>

						</div>

						<?php } } ?>

					</fieldset>

				</div>


					<div class="buttons text-center">

						<button class="btn btn-lg btn-success button"

						ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>

					</div>

		 		
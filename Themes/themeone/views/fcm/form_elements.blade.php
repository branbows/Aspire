 			<fieldset class="form-group">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-red">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('title'),

							'ng-model'=>'title',
							
							'required'=> 'true', 

							'ng-class'=>'{"has-error": formUsers.title.$touched && formUsers.title.$invalid}',

							'ng-minlength' => 5,

							'ng-maxlength' => 100

						)) }}

				<div class="validation-error" ng-messages="formUsers.title.$error" >

					{!! getValidationMessage()!!}

				</div>

			</fieldset>




			<fieldset class="form-group">

					{{ Form::label('message', getphrase('message')) }}

					<span class="text-red">*</span>

						{{ Form::textarea('message', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('message'),

						'ng-model'=>'message',

						'required'=> 'true', 

						'ng-class'=>'{"has-error": formUsers.message.$touched && formUsers.message.$invalid}',

						'ng-minlength' => 5,

						'ng-maxlength' => 200

						)) }}

					<div class="validation-error" ng-messages="formUsers.message.$error" >

						{!! getValidationMessage()!!}

					</div>

			</fieldset>


			<div class="buttons text-center">

				<button class="btn btn-lg btn-success button"

				ng-disabled='!formUsers.$valid' > {{ $button_name }}</button>

			</div>

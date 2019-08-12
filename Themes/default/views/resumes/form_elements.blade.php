 		
 					 <fieldset class="form-group">

						{{ Form::label('title', getphrase('title')) }}
						<span class="text-red">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('title'),
							'ng-model'=>'title',
							'ng-pattern' => getRegexPattern("name"),
							'required'=> 'true',
							'ng-minlength' => '2',
							'ng-maxlength' => '30', 
							'ng-class'=>'{"has-error": formEmails.title.$touched && formEmails.title.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="formEmails.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					</div>
					</fieldset>


					 <fieldset class="form-group">
						
						{{ Form::label('key', getphrase('key')) }}
						<span class="text-red">*</span>
						{{ Form::text('resume_key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('key'),
							'ng-model'=>'resume_key',
							'required'=> 'true', 
							'ng-minlength' => '2',
							'ng-maxlength' => '30',
							'ng-class'=>'{"has-error": formEmails.resume_key.$touched && formEmails.resume_key.$invalid}'
						)) }}
						<div class="validation-error" ng-messages="formEmails.resume_key.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('pattern')!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					</div>
					</fieldset>

					
					 
					     

		            <fieldset  class="form-group">

		           <?php $checked = '';
			         if(isset($record->status) && $record->status==1) { 
			              $checked = 'checked';
			           }
			            ?>

		            <label class="checkbox-inline">

		              <input  type="checkbox" 

		                  data-toggle="toggle" 

		                  data-onstyle="success" 

		                  data-offstyle="default"

		                  name="status" 

		                  value="1" 

		                  {{$checked}}
		                  >  Status

		          
		                </label>

		            </fieldset>



		              <fieldset  class="form-group">

		           <?php $checked = '';
			         if(isset($record->is_default) && $record->is_default==1) { 
			              $checked = 'checked';
			           }
			            ?>

		            <label class="checkbox-inline">

		              <input  type="checkbox" 

		                  data-toggle="toggle" 

		                  data-onstyle="success" 

		                  data-offstyle="default"

		                  name="is_default" 

		                  value="1" 

		                  {{$checked}}
		                  >  Default Template

		          
		                </label>

		            </fieldset>

		
				<fieldset class="form-group">

						{{ Form::label('image', getphrase('image')) }}

						<div class="form-group row">

							<div class="col-md-6">

							{!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}

							</div>

							<?php if (isset($record) && $record) { 

								  if ($record->image!='')
								  {

								?>

							<div class="col-md-6">

								<img class="img-responsive" src="{{ getResumeTemplateImg($record->image) }}" />

							</div>




							<?php } } ?>

						</div>

					</fieldset>



					
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button" ng-disabled='!formEmails.$valid'>{{ $button_name }}</button>
						</div>

		 	
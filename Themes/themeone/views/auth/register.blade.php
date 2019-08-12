@extends('layouts.sitelayout')

@section('content')

 <!--  <section class="cs-primary-bg cs-page-banner" style="margin-top:100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title text-center">{{getPhrase('create_a_new_account')}}</h2>
                </div>
            </div>
        </div>
    </section> -->

  <!-- Login Section -->
  <div  style="background-image: url({{IMAGES}}login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">
    <div class="container">
         <div class="row cs-row" style="margin-top: 180px">
             
            <div class="col-md12">
                <div class="cs-box-resize-sign login-box">
                   <h4 class="text-center login-head">{{getPhrase('create_account')}}</h4>
                    <!-- Form Login/Register -->
                    	{!! Form::open(array('url' => URL_USERS_REGISTER, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"registrationForm")) !!}

                        @include('errors.errors')	

                        <div class="form-group">

                        	<label for="name">{{getPhrase('name')}}</label><span style="color: red;">*</span>

						   {{ Form::text('name', $value = null , $attributes = array('class'=>'form-control',

									'placeholder' => getPhrase("name"),

									'ng-model'=>'name',

									'ng-pattern' => getRegexPattern('name'),

									'required'=> 'true', 

									'ng-class'=>'{"has-error": registrationForm.name.$touched && registrationForm.name.$invalid}',

									'ng-minlength' => '4',

								)) }}

									<div class="validation-error" ng-messages="registrationForm.name.$error" >

										{!! getValidationMessage()!!}

										{!! getValidationMessage('minlength')!!}

										{!! getValidationMessage('pattern')!!}

									</div>

                        </div>

                        <div class="form-group">

                          <label for="username">{{getPhrase('username')}}</label><span style="color: red;">*</span>

                         {{ Form::text('username', $value = null , $attributes = array('class'=>'form-control',

								'placeholder' => getPhrase("username"),

								'ng-model'=>'username',

								'required'=> 'true', 

								'ng-class'=>'{"has-error": registrationForm.username.$touched && registrationForm.username.$invalid}',

								'ng-minlength' => '4',

							)) }}

						<div class="validation-error" ng-messages="registrationForm.username.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('minlength')!!}

							{!! getValidationMessage('pattern')!!}

						</div>

                        </div>


                         <div class="form-group">
                        	
                          <label for="email">{{getPhrase('email')}}</label><span style="color: red;">*</span>

                        {{ Form::email('email', $value = null , $attributes = array('class'=>'form-control',

									'placeholder' => getPhrase("email"),

									'ng-model'=>'email',

									'required'=> 'true', 

									'ng-class'=>'{"has-error": registrationForm.email.$touched && registrationForm.email.$invalid}',

								)) }}

							<div class="validation-error" ng-messages="registrationForm.email.$error" >

								{!! getValidationMessage()!!}

								{!! getValidationMessage('email')!!}

							</div>


                        </div>


                          <div class="form-group">
                        	
                          <label for="password">{{getPhrase('password')}}</label><span style="color: red;">*</span>

					    {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',

								'placeholder' => getPhrase("password"),

								'ng-model'=>'registration.password',

								'required'=> 'true', 

								'ng-class'=>'{"has-error": registrationForm.password.$touched && registrationForm.password.$invalid}',

								'ng-minlength' => 5

							)) }}

						<div class="validation-error" ng-messages="registrationForm.password.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('password')!!}

						</div>



                        </div>


                          <div class="form-group">
                        	
                       <label for="password_confirmation">{{getPhrase('password_confirmation')}}</label><span style="color: red;">*</span>

                       {{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call',

								'placeholder' => getPhrase("password_confirmation"),

								'ng-model'=>'registration.password_confirmation',

								'required'=> 'true', 

								'ng-class'=>'{"has-error": registrationForm.password_confirmation.$touched && registrationForm.password_confirmation.$invalid}',

								'ng-minlength' => 5,

								'compare-to' =>"registration.password"

							)) }}

						<div class="validation-error" ng-messages="registrationForm.password_confirmation.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('minlength')!!}

							{!! getValidationMessage('confirmPassword')!!}

						</div>


                        </div>

                        <?php $parent_module = getSetting('parent', 'module'); ?>

							@if(!$parent_module)

						<input type="hidden" name="is_student" value="0">

							@else

                          <div class="form-group">


                           
                             <div class="col-md-12">


							</div>

							<div class="col-md-12">

							<ul class="login-links mt-2">
                              	 <li>
                              	 	
							{{ Form::radio('is_student', 0, true, array('id'=>'free')) }}

								

								<label for="free"> <span class="  radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('i_am_a_student')}}</label> 
                              	 </li>
                              	 <li>
                              	 	{{ Form::radio('is_student', 1, false, array('id'=>'paid' )) }}

								<label for="paid"> 

								<span class="  radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('i_am_a_parent')}} </label>
                              	 </li>
                            </ul>

							

							</div>

                          </div>

                          @endif


                         <div class="form-group">

                             @if($rechaptcha_status == 'yes')


		               

				          <div class="col-md-12 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin-top: 15px">
		                           

		                           
		                                {!! app('captcha')->display() !!}

		                          

                               </div>


                             @endif


                        </div>

                      	<div class="text-center mt-2">
                      		<button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!registrationForm.$valid'>{{getPhrase('register_now')}}</button>
                      	</div>

                    </form>
                    <!-- Form Login/Register -->
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Login Section -->

@stop



@section('footer_scripts')

	@include('common.validations')
		     	{{-- <script src="{{JS}}recaptcha.js"></script> --}}
		     		<script src='https://www.google.com/recaptcha/api.js'></script>



@stop
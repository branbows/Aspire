@extends('layouts.sitelayout')



@section('content')



    

       <!-- Login Section -->

       <div  style="background-image: url({{IMAGES}}login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">

    <div class="container">

        <div class="row cs-row" style="margin-top: 180px">

        

            <div class="col-md-12">

                <div class="cs-box-resize  login-box">

                 <h4 class="text-center login-head">{{getPhrase('login')}}</h4>

                   

                    <!-- Form Login/Register -->

                    	{!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")) !!}



                        @include('errors.errors')	



                        <div class="form-group">



                        	<label for="email">{{getPhrase('email_address')}}:</label>



                            {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control',



        								'ng-model'=>'email',



        								'required'=> 'true',



        								'id'=> 'email',



                        'placeholder' => getPhrase('username').'/'.getPhrase('email'),



        								'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',



									     )) }}



        								<div class="validation-error" ng-messages="loginForm.email.$error" >



        									{!! getValidationMessage()!!}



        									{!! getValidationMessage('email')!!}



        								</div>



                        </div>



                        <div class="form-group">

                            <label for="pwd">Password:</label>



                           {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',



      									'placeholder' => getPhrase("password"),



      									'ng-model'=>'registration.password',



      									'required'=> 'true', 

      									'id'=> 'password', 



      									'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',



      									'ng-minlength' => 5



          								)) }}



          							<div class="validation-error" ng-messages="loginForm.password.$error" >



          								{!! getValidationMessage()!!}



          								{!! getValidationMessage('password')!!}



          							</div>



                        </div>





                         <div class="form-group">



                             @if($rechaptcha_status == 'yes')





		               



				          <div class="  form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

		                           



		                            

		                                {!! app('captcha')->display() !!}



		                            



                               </div>





                             @endif





                        </div>



                      	<button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!loginForm.$valid' style="margin-left: 85px;">{{getPhrase('login')}}</button>



                    </form>

                    <br>



                     <div class="row">

                      <div class="col-md-6" >

                    @if(getSetting('facebook_login', 'module'))

                      <a href="{{URL_FACEBOOK_LOGIN}}" class="btn btn-primary btn-sm"><i class="fa fa-facebook"></i> {{getPhrase('facebook')}}</a>

                    @endif

                    </div>

                     <div class="col-md-6" >

                    @if(getSetting('google_plus_login', 'module'))  

                      <a href="{{URL_GOOGLE_LOGIN}}" class="btn btn-danger btn-sm"><i class="fa fa-google-plus"></i>  {{getPhrase('google+')}}</a>

                    @endif

                  </div>

                    

                    <div class="col-md-12">

                    @if(getSetting('facebook_login', 'module')||getSetting('google_plus_login', 'module'))

                    <br>

                    <div class="alert alert-info margintop30">

                      <strong>{{getPhrase('note')}}: </strong>

                      {{getPhrase('social_logins_are_only_for_student_accounts')}}

                    </div>

                    @endif



                    </div>

        </div>

        <br>

                    <ul class="login-links mt-2">

                               <li><a href="{{URL_USERS_REGISTER}}">{{getPhrase('register')}}</a></li>

                               <li> <a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> {{getPhrase('forgot_password')}}</a></li>

                            </ul>



                    <!-- Form Login/Register -->

                </div>

            </div>

        </div>

    </div>

    <!-- Login Section -->





	<!-- Modal -->



<div id="myModal" class="modal fade" role="dialog">



  <div class="modal-dialog">



	{!! Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")) !!}



    <!-- Modal content-->



    <div class="modal-content">



      <div class="modal-header">



        <button type="button" class="close" data-dismiss="modal">&times;</button>



        <h4 class="modal-title">{{getPhrase('forgot_password')}}</h4>



      </div>



      <div class="modal-body">



        <div class="form-group">

          <label>Email Address</label>



				 







	    		{{ Form::email('email', $value = null , $attributes = array('class'=>'form-control',



			'ng-model'=>'email',



			'required'=> 'true',



			'placeholder' => getPhrase('email'),



			'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}',



		)) }}



	<div class="validation-error" ng-messages="passwordForm.email.$error" >



		{!! getValidationMessage()!!}



		{!! getValidationMessage('email')!!}



	</div>







			</div>



      </div>



      <div class="modal-footer">



      <div class="pull-right">



        <button type="button" class="btn btn-default" data-dismiss="modal">{{getPhrase('close')}}</button>



        <button type="submit" class="btn btn-primary" ng-disabled='!passwordForm.$valid'>{{getPhrase('submit')}}</button>



        </div>



      </div>



    </div>



	{!! Form::close() !!}



  </div>



</div>

</div>



@stop







@section('footer_scripts')



	@include('common.validations')

    

    <script src='https://www.google.com/recaptcha/api.js'></script>





 

@stop
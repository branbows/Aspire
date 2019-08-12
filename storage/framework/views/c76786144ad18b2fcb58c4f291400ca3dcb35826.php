<?php $__env->startSection('content'); ?>



    

       <!-- Login Section -->

       <div  style="background-image: url(<?php echo e(IMAGES); ?>login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">

    <div class="container">

        <div class="row cs-row" style="margin-top: 180px">

        

            <div class="col-md-12">

                <div class="cs-box-resize  login-box">

                 <h4 class="text-center login-head"><?php echo e(getPhrase('login')); ?></h4>

                   

                    <!-- Form Login/Register -->

                    	<?php echo Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")); ?>




                        <?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	



                        <div class="form-group">



                        	<label for="email"><?php echo e(getPhrase('email_address')); ?>:</label>



                            <?php echo e(Form::text('email', $value = null , $attributes = array('class'=>'form-control',



        								'ng-model'=>'email',



        								'required'=> 'true',



        								'id'=> 'email',



                        'placeholder' => getPhrase('username').'/'.getPhrase('email'),



        								'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',



									     ))); ?>




        								<div class="validation-error" ng-messages="loginForm.email.$error" >



        									<?php echo getValidationMessage(); ?>




        									<?php echo getValidationMessage('email'); ?>




        								</div>



                        </div>



                        <div class="form-group">

                            <label for="pwd">Password:</label>



                           <?php echo e(Form::password('password', $attributes = array('class'=>'form-control instruction-call',



      									'placeholder' => getPhrase("password"),



      									'ng-model'=>'registration.password',



      									'required'=> 'true', 

      									'id'=> 'password', 



      									'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',



      									'ng-minlength' => 5



          								))); ?>




          							<div class="validation-error" ng-messages="loginForm.password.$error" >



          								<?php echo getValidationMessage(); ?>




          								<?php echo getValidationMessage('password'); ?>




          							</div>



                        </div>





                         <div class="form-group">



                             <?php if($rechaptcha_status == 'yes'): ?>





		               



				          <div class="  form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">

		                           



		                            

		                                <?php echo app('captcha')->display(); ?>




		                            



                               </div>





                             <?php endif; ?>





                        </div>



                      	<button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!loginForm.$valid' style="margin-left: 85px;"><?php echo e(getPhrase('login')); ?></button>



                    </form>

                    <br>



                     <div class="row">

                      <div class="col-md-6" >

                    <?php if(getSetting('facebook_login', 'module')): ?>

                      <a href="<?php echo e(URL_FACEBOOK_LOGIN); ?>" class="btn btn-primary btn-sm"><i class="fa fa-facebook"></i> <?php echo e(getPhrase('facebook')); ?></a>

                    <?php endif; ?>

                    </div>

                     <div class="col-md-6" >

                    <?php if(getSetting('google_plus_login', 'module')): ?>  

                      <a href="<?php echo e(URL_GOOGLE_LOGIN); ?>" class="btn btn-danger btn-sm"><i class="fa fa-google-plus"></i>  <?php echo e(getPhrase('google+')); ?></a>

                    <?php endif; ?>

                  </div>

                    

                    <div class="col-md-12">

                    <?php if(getSetting('facebook_login', 'module')||getSetting('google_plus_login', 'module')): ?>

                    <br>

                    <div class="alert alert-info margintop30">

                      <strong><?php echo e(getPhrase('note')); ?>: </strong>

                      <?php echo e(getPhrase('social_logins_are_only_for_student_accounts')); ?>


                    </div>

                    <?php endif; ?>



                    </div>

        </div>

        <br>

                    <ul class="login-links mt-2">

                               <li><a href="<?php echo e(URL_USERS_REGISTER); ?>"><?php echo e(getPhrase('register')); ?></a></li>

                               <li> <a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> <?php echo e(getPhrase('forgot_password')); ?></a></li>

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



	<?php echo Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")); ?>




    <!-- Modal content-->



    <div class="modal-content">



      <div class="modal-header">



        <button type="button" class="close" data-dismiss="modal">&times;</button>



        <h4 class="modal-title"><?php echo e(getPhrase('forgot_password')); ?></h4>



      </div>



      <div class="modal-body">



        <div class="form-group">

          <label>Email Address</label>



				 







	    		<?php echo e(Form::email('email', $value = null , $attributes = array('class'=>'form-control',



			'ng-model'=>'email',



			'required'=> 'true',



			'placeholder' => getPhrase('email'),



			'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}',



		))); ?>




	<div class="validation-error" ng-messages="passwordForm.email.$error" >



		<?php echo getValidationMessage(); ?>




		<?php echo getValidationMessage('email'); ?>




	</div>







			</div>



      </div>



      <div class="modal-footer">



      <div class="pull-right">



        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(getPhrase('close')); ?></button>



        <button type="submit" class="btn btn-primary" ng-disabled='!passwordForm.$valid'><?php echo e(getPhrase('submit')); ?></button>



        </div>



      </div>



    </div>



	<?php echo Form::close(); ?>




  </div>



</div>

</div>



<?php $__env->stopSection(); ?>







<?php $__env->startSection('footer_scripts'); ?>



	<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    

    <script src='https://www.google.com/recaptcha/api.js'></script>





 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.sitelayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
@include('emails.template_header')

 <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
	  <h5 class="text-center" style="font-size:20px;font-weight:600;">Password updated successfully</h5>
	</div>
  </div>
  
   
   <div class="row">
    <div class="col-lg-12">
    	<p style="font-size:20px;margin:11px 0;">Dear {{$user_name}}, </p>
      <p style="font-size:20px;margin:11px 0;">Greetings,</p>
	<p style="font-size:20px;margin:11px 0;">Your password is updated.</p>
  <p style="font-size:20px;margin:11px 0;">Please find the login details</p>
  <p style="font-size:20px;margin:11px 0;"><strong>Email:</strong> {{$email}}</p>
  <p style="font-size:20px;margin:11px 0;"><strong>Password:</strong> {{$password}}</p>


    <br>
    <p style="font-size:20px;margin:11px 0;"><a href="{{URL_USERS_LOGIN}}"> Click here to Login</a></p>
  <br><br>


  
<p style="font-size:20px;margin:11px 0;">Sincerely, </p>
<p style="font-size:20px;margin:11px 0;">Customer Support Services</p>

	</div>
   </div>



@include('emails.disclaimer')


@include('emails.template_footer')
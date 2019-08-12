@include('emails.template_header')

 <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
    <h5 class="text-center" style="font-size:20px;font-weight:600;">Registration was successfull</h5>
  </div>
  </div>
  
   
   <div class="row">
    <div class="col-lg-12">
      <p style="font-size:20px;margin:11px 0;">Dear {{$user_name}}, </p>
      <p style="font-size:20px;margin:11px 0;">Greetings,</p>
  <p style="font-size:20px;margin:11px 0;">Thank you for your registration with {{getSetting('site_title','site_settings')}}.</p>
    <p style="font-size:20px;margin:11px 0;"><a href="{{$link}}"> Click here to active your account</a></p>
  
    <br>
    <p style="font-size:20px;margin:11px 0;">After active your account, You can login with the below details</p>
  <p style="font-size:20px;margin:11px 0;"><strong>Email:</strong> {{$email}}</p>
  <p style="font-size:20px;margin:11px 0;"><strong>Password:</strong> {{$password}}</p>
  <br><br>


  
<p style="font-size:20px;margin:11px 0;">Sincerely, </p>
<p style="font-size:20px;margin:11px 0;">Customer Support Services</p>

  </div>
   </div>



@include('emails.disclaimer')


@include('emails.template_footer')
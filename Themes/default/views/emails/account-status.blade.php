@include('emails.template_header')

 <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
    <h5 class="text-center" style="font-size:20px;font-weight:600;">Your Account Status has been Changed</h5>
  </div>
  </div>
  
   
   <div class="row">
    <div class="col-lg-12">
      <p style="font-size:20px;margin:11px 0;">Dear {{$user_name}}, </p>
      <p style="font-size:20px;margin:11px 0;">Greetings,</p>
  <p style="font-size:20px;margin:11px 0;">Thank you for using {{$site_title}}.</p>
    
    <p style="font-size:20px;margin:11px 0;">
      Your Account has been {{$status}} by Admin.
    </p>
  
   
  <br><br>

   <br>

    @if ($status!='Activated')
    <p style="font-size:20px;margin:11px 0;"> <a href="{{$link}}"> Please contact Admin for further details.</a> </p>

    <br><br>
    <br><br>
    @endif
  
<p style="font-size:20px;margin:11px 0;">Sincerely, </p>
<p style="font-size:20px;margin:11px 0;">Customer Support Services</p>

  </div>
   </div>



@include('emails.disclaimer')


@include('emails.template_footer')
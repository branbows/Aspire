 @include('system-emails.header')
 
 <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
    <h5 class="text-center" style="font-size:20px;font-weight:600;">{{getPhrase('offline_payment_cancelled')}}</h5>
  </div>
  </div>
   
   <div class="row">
    <div class="col-lg-12">
      <p style="font-size:20px;margin:11px 0;">Dear {{$username}}, </p>
      <p style="font-size:20px;margin:11px 0;">Greetings,</p>
  <p style="font-size:20px;margin:11px 0;">Your offline payment is cancelled for {{$plan}}</p><br>
  <p style="font-size:20px;margin:11px 0;"><b>Comments:</b>{{$comments}}</p>
  
  

<p style="font-size:20px;margin:11px 0;">Sincerely, </p>
<p style="font-size:20px;margin:11px 0;">Customer Support Services</p>

  </div>
   </div>

@include('system-emails.disclaimer')



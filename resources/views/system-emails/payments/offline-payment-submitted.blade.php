 @include('system-emails.header')
 
 <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
    <h5 class="text-center" style="font-size:20px;font-weight:600;">{{getPhrase('offline_payment_submitted')}}</h5>
  </div>
  </div>
   
   <div class="row">
    <div class="col-lg-12">
      <p style="font-size:20px;margin:11px 0;">Dear {{$username}}, </p>
      <p style="font-size:20px;margin:11px 0;">Greetings,</p>
  <p style="font-size:20px;margin:11px 0;">User {{ $name  }}  is submitted a offline payment for {{$item_name}}</p><br>
  <p style="font-size:20px;margin:11px 0;">{{getPhrase('please_verify_the_payment_details_update_the_payment_status')}}</p><br>
  

<p style="font-size:20px;margin:11px 0;">Sincerely, </p>
<p style="font-size:20px;margin:11px 0;">Customer Support Services</p>

  </div>
   </div>

@include('system-emails.disclaimer')



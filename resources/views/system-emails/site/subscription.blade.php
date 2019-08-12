<!DOCTYPE html>

<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>

<body>
<div class="Wrapper">

<div class="container">
  
  <table style="width:100%;margin-top:60px;">
  <tbody>
    <tr>
	  <td style="width:70%;">
		    <img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}" alt="logo" style="margin-top:20px;width:250px;margin-left:30px;">
	  </td>
	  <td style="width:30%;">
		   <h4 class="text-left" style="font-size:24px;font-weight:600;">{{getSetting('site_title','site_settings')}}</h4>
		   <p class="text-left" style="font-size:20px;font-weight:100;">	
		{{getSetting('site_address','site_settings')}}
		   </p>
	  </td>
	</tr>
  </tbody>
  </table>

  
  
  
  <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
	  <h4 class="text-center" style="font-size:24px;font-weight:600;">User Subscription</h4>
	</div>
  </div>
  
   
   
   <div class="row">
    <div class="col-lg-12">
	<p style="font-size:20px;margin:65px 0;">Thank you for subscribing to {{getSetting('site_title','site_settings')}}</p>
	</div>
   </div>
   
 
   
   
   <div class="row">
    <div class="col-lg-12">
	 <p style="font-size:20px;margin-top:35px;"></p>
	</div>
   </div>
</div>

</div>
</body>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>
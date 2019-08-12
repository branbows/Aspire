<!DOCTYPE html>
<html>

<head>

        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="saas,crm,bootstrap4,template,download">
    <meta name="description" content="OhDearCRM is a Bootstrap4 Responsive Template for Startups,SaaS Companies and Agencies.">
    <meta name="author" content="">
    <title>Resume</title>
    <link rel="icon" href="" width="100%">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            box-sizing: border-box;
        }
        
        .header,
        .footer {
            background-color: grey;
            color: white;
            padding: 15px;
        }
        
        .column {
            float: left;
            padding: 15px;
        }
        
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        
        .menu {
            /*width: 45%;*/

            width: 30%;
        }
        
        h4 {
            line-height: 4px;
        }
        
        .content {
            /*width: 55%;*/
            width: 70%;
        }
        
        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        
        .yellow-bg {
            background: #efc115a1;
        }
        
        .menu li {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        
        .menu li h1,
        .menu li h4 {
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body onload="printMe()">
    <div class="clearfix" id="printableArea">

        <div class="column menu" style="text-align:center;">
         <img src="{{ getProfilePath($user->image) }}" alt="" style="width:120px;height:120px;margin:0 auto;">
            <h1 style="text-transform:uppercase;font-size:21px;">{{ucwords($user->name)}}</h1>
            <p style="font-weight: 500;text-transform: uppercase;font-size: 12px;line-height: 0px;">{{$user->qualification}} </p>
            <p style="font-weight: 500;text-transform: uppercase;font-size: 12px;line-height: 0px;">{{$user->department}} </p>
            <div class="clearfix">
                <div class="column menu" style="padding:7px;width:20%;">  </div>
                <div class="column content" style="padding:7px;width:80%;">
                    <p style="line-height:25px;margin:0;padding:0;font-weight:500;text-align:left;">{{$user->college_name}}</p>
                    <p style="line-height:25px;margin:0;padding:0;font-weight:500;text-align:left;">{{$user->college_place}}</p>
                    <p style="line-height:25px;margin:0;padding:0;font-weight:500;text-align:left;">{{$user->state}} &nbsp; {{$user->country}}</p>
                    <p style="line-height:25px;margin:0;padding:0;font-weight:500;text-align:left;"><strong>Email:</strong> {{$user->email}}</p>
                    <p style="line-height:25px;margin:0;padding:0;font-weight:500;text-align:left;"><strong>Mobile:</strong> {{$user->phone}}</p>
                </div>
            </div>
            
            <h1 style="text-transform:uppercase;font-size:21px;margin-top:23px;">{{getPhrase('personal_profile')}}</h1>
            <div class="clearfix">
                <div class="column menu" style="padding:7px;width:100%;">
                    <p style="padding:0;margin:0;overflow: hidden;line-height:25px;font-weight:500;display: -webkit-box; -webkit-line-clamp: 3;-webkit-box-orient: vertical;  "> <div class="table-responsive">
           <table class="table">
         <tr>
            <td>{{getPhrase('name')}}:</td>
            <td>{{$user->name}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('gender')}}:</td>
            <td>{{$user->gender}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('date_of_birth')}}:</td>
            <td>{{$user->dob}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('marital_status')}}:</td>
            <td>{{$user->marital_status}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('nationality')}}:</td>
            <td>{{$user->nationality}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('father_name')}}:</td>
            <td>{{$user->father_name}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('linguistic_ability')}}:</td>
            <td>{{$user->linguistic_ability}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('passport_number')}}:</td>
            <td>{{$user->passport_number}}</td>
         </tr>
         <tr>
            <td>{{getPhrase('present_address')}}:</td>
            <td>{{$user->present_address}}
            </td>
         </tr>
         <td>{{getPhrase('personal_strength')}}:</td>
         <td>{{$user->personal_strength}}</td>
         
      </table>
   </div></p>
                </div>
               
            </div>
           
        </div>

        <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;margin-left: 10px;">{{getPhrase('career_objective')}}:</h1>
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;width: 40rem;    margin-left: 10px;">{!!  $user->career_objective !!}</p>
       
          
           @if (isset($work_experience) && count($work_experience))

          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('work_experience')}}:</h1>
            @foreach($work_experience as $experience)
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{{$experience->work_experience}} из {{$experience->from_date}} в {{$experience->to_date}}</p>

             @endforeach
        </div>

        @endif


           @if (isset($projects) && count($projects))

          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('projects')}} and {{getPhrase('work_done')}}:</h1>
           @foreach ($projects as $project)
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{{$project->project_title}}</p>

             @if($project->project_description)

             <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{{ $project->project_description }}</p>

             @endif

             @endforeach
        </div>

        @endif


          @if (isset($academic_profiles) && count($academic_profiles))

          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('academic_profile')}}:</h1>
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;"> 

                <!-- <div class="table-responsive"> -->
           <table class="table" cellspacing="0" cellpadding="10" border="1" width="100%">
         <tr>
            <th>{{getPhrase('examination_passed')}}</th>
            <th>{{getPhrase('university')}}/{{getPhrase('board')}}</th>
            <th>{{getPhrase('year')}}</th>
            <th>% {{getPhrase('marks_obtained')}}</th>
            <th>{{getPhrase('class')}}</th>
         </tr>
         @foreach ($academic_profiles as $academic)
         <tr>
            <td>{{$academic->examination_passed}}</td>
            <td>{{$academic->university}}</td>
            <td>{{$academic->passed_out_year}}</td>
            <td>{{$academic->marks_obtained}}</td>
            <td>{{$academic->class}}</td>
         </tr>
         @endforeach
         
      </table>
   <!-- </div> -->

</p>

        </div>

        @endif


        @if (isset($technical_skills) && count($technical_skills))

          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('technical_skills')}}:</h1>
            @foreach ($technical_skills as $skill)
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{{$skill->skill_type}} : {{$skill->skills_known}}</p>

             @endforeach
        </div>

        @endif

       @if ($user->field_of_interest)

          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('field_of_interest')}}:</h1>
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{!!  $user->field_of_interest !!}</p>
        </div>

        @endif

           @if ($user->subject_taught)
       
          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('subject_taught')}}:</h1>
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{!!  $user->subject_taught !!}</p>
        </div>

        @endif


          @if (isset($activities) && count($activities))

          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('extra_activities')}}:</h1>
            @foreach ($activities as $activity)
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{{$activity->activity_description}}</p>

             @endforeach
        </div>

        @endif

          @if ($user->declaration)
       
          <div class="column content">
            <h1 style="text-transform:uppercase;font-size:21px;">{{getPhrase('declaration')}}:</h1>
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{!!  $user->declaration !!}</p>
            <p style="font-weight: 500;font-size: 14px;line-height: 15px;">{!!  $user->name !!}</p>
        </div>

        @endif

    </div>
     </div>



     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
   function printMe(){
      var printContents = document.getElementById('printableArea').innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              printContents + "</body>";;

     window.print();

     document.body.innerHTML = originalContents;
   };
</script> 

</body>

</html>
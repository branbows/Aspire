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
            width: 35%;
        }
        
        h4 {
            line-height: 4px;
        }
        
        .content {
            width: 65%;
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
    <div class="clearfix yellow-bg" id="printableArea">
        <div class="column menu">
            <ul>
              <li>
                         <img src="{{ getProfilePath($user->image) }}" alt="" style="width:120px;height:120px;margin:0 auto;">
              </li>
                <li>
                    <h1 style="text-align:left;">{{ucwords($user->name)}}</h1></li>
                <li>
                    <h4 style="text-align:left;line-height:24px;">{{$user->qualification}}</h4> 
                    <h4 style="text-align:left;line-height:24px;">{{$user->department}}</h4> 
                </li>
            </ul>
        </div>
        <div class="column content">
            <p style="text-align:right;">{{$user->college_name}} </p>
            <p style="text-align:right;">{{$user->college_place}} </p>
            <p style="text-align:right;">{{$user->state}} &nbsp; {{$user->country}}  </p>
            <p style="text-align:right;"><strong>Email:</strong> {{$user->email}} </p>
            <p style="text-align:right;"><strong>Mobile:</strong> {{$user->phone}} </p>
        </div>
    </div>
    
    <div class="clearfix">
          <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('career_objective')}}</h3> </li>
            </ul>
        </div>
        <div class="column content">
            <p style="font-weight:500;">{!!  $user->career_objective !!}</p>
        </div>
    </div>

@if (isset($work_experience) && count($work_experience))
    <div class="clearfix yellow-bg">
        <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('work_experience')}}</h3> </li>
            </ul>
        </div>
        <div class="column content">
            @foreach($work_experience as $experience)

            <p style="font-weight:500;line-height:19px;">{{$experience->work_experience}} {{getPhrase('from')}} {{$experience->from_date}} {{getPhrase('to')}} {{$experience->to_date}}</p>

             @endforeach
        </div>
    </div>

 @endif 

 @if (isset($projects) && count($projects))

    <div class="clearfix">
        <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('projects')}}</h3> </li>
            </ul>
        </div>
        <div class="column content">

              @foreach ($projects as $project)

              <p style="font-weight:500;">{{$project->project_title}}

            @if($project->project_description)
            <p style="font-weight:500;">{{ $project->project_description }}</p>
            @endif

          </p>
           @endforeach

           
        </div>
    </div>

  @endif
    
   @if (isset($academic_profiles) && count($academic_profiles)) 
    <div class="clearfix yellow-bg">
        <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('academic_profile')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">

            <p style="font-weight:500;line-height:19px;"> 
                <div class="table-responsive">
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
   </div>
</p>
           
        </div>
    </div>

    @endif

     @if (isset($technical_skills) && count($technical_skills))
    <div class="clearfix">
        <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('technical_skills')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">
            @foreach ($technical_skills as $skill)

            <p style="font-weight:500;line-height:19px;">{{$skill->skill_type}} : {{$skill->skills_known}}</p>

             @endforeach
        </div>
    </div>

 @endif 

@if ($user->field_of_interest)

 <div class="clearfix yellow-bg">
          <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('field_of_interest')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">
            <p style="font-weight:500;">{{$user->field_of_interest}}</p>
        </div>
    </div>
  @endif  

  @if ($user->subject_taught)

 <div class="clearfix">
          <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('subject_taught')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">
            <p style="font-weight:500;">{{$user->subject_taught}}</p>
        </div>
    </div>
  @endif  


   @if (isset($activities) && count($activities))
    <div class="clearfix  yellow-bg">
        <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('activities')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">
            @foreach ($activities as $activity)

            <p style="font-weight:500;line-height:19px;">{{$activity->activity_description}}</p>

             @endforeach
        </div>
    </div>

 @endif 


    <div class="clearfix">
        <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('personal_profile')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">

            <p style="font-weight:500;line-height:19px;"> 
                  <div class="table-responsive">
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
   </div>
</p>
           
        </div>
    </div>

 @if ($user->declaration)
     <div class="clearfix yellow-bg">
          <div class="column menu">
            <ul>
                <li>
                    <h3 style="text-align:left;">{{getPhrase('declaration')}}:</h3> </li>
            </ul>
        </div>
        <div class="column content">
            <p style="font-weight:500;">{!!$user->declaration!!}</p>
            <p style="font-weight:500;">{{$user->name}}</p>
        </div>
    </div>

    @endif


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
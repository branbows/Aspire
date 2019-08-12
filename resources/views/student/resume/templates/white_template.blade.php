
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>

<head>
   <META http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 

</head>

<body onload="printMe()">
   
      
      
   
   <div width="950px" id="printableArea">
         <img src="{{ getProfilePath($user->image) }}" alt="" style="width:120px;height:120px;margin:0 auto; float: right;">

      <h1 class="text-center">{{getPhrase('resume')}}</h1>
      <div>
         <p>{{$user->name}}</p>
         <p>{{$user->qualification}}</p>
         <p>{{$user->department}}</p>
         <p>{{$user->college_name}} &nbsp; {{$user->college_place}}</p>
         <p>{{$user->state}} &nbsp; {{$user->country}}</p>
      </div>
      <br>
      <div>
         <p><strong>{{getPhrase('email')}}:</strong> {{$user->email}} </p>
         <p><strong>{{getPhrase('mobile')}}:</strong> {{$user->phone}} </p>
      </div>
      <hr>

      <h3>{{getPhrase('career_objective')}}:</h3>
      <p>{!!  $user->career_objective !!}</p>



       @if (isset($work_experience) && count($work_experience))
        <div>
           <h3>{{getPhrase('work_experience')}}:</h3>

           <ul>
               @foreach($work_experience as $experience)
              <li>{{$experience->work_experience}} from {{$experience->from_date}} to {{$experience->to_date}}  </li>
               @endforeach
           </ul>

        </div>

      @endif





      @if (isset($projects) && count($projects))
      <h3>{{getPhrase('projects')}} &amp; {{getPhrase('work_done')}}:</h3>

     
      <ol>
         @foreach ($projects as $project)
          <li>{{$project->project_title}}

            @if($project->project_description)
            <ul>
            <li>{{ $project->project_description }}</li>
            </ul>
            @endif

          </li>
           @endforeach
       </ol>


       

      <hr>
      @endif   

      @if (isset($academic_profiles) && count($academic_profiles))
      <h3>{{getPhrase('academic_profile')}}:</h3>
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
      @endif


      @if (isset($technical_skills) && count($technical_skills))
      <h3>{{getPhrase('technical_skills')}}:</h3>
      @foreach ($technical_skills as $skill)
      <p> {{$skill->skill_type}} : {{$skill->skills_known}}</p>
      @endforeach
      @endif
     

      @if ($user->field_of_interest)
      <h3>{{getPhrase('field_of_interest')}}:</h3>
      <p>{{$user->field_of_interest}}
      <p>
      @endif


      @if ($user->subject_taught)
      <h3>{{getPhrase('subject_taught')}}:</h3>
      <p>{{$user->subject_taught}}</p>
      @endif


      @if (isset($activities) && count($activities))
      <h3>{{getPhrase('extra_activities')}}:</h3>
      <ol>
      @foreach ($activities as $activity)
         <li>
            {{$activity->activity_description}}
         </li>
      @endforeach
      </ol>
      @endif

    
      <h3>{{getPhrase('personal_profile')}}:</h3>
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
      </p><strong>{{getPhrase('declaration')}}:</strong> 
    {!!  $user->declaration !!}</p>
      <br><br>
      <p>{{$user->name}}</p>
   </div>



<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
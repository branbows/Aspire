 <script src="{{JS}}ngStorage.js"></script>
<script src="{{JS}}angular-messages.js"></script>


<script >
  var app = angular.module('academia', ['ngMessages']);
</script>

@include('common.angular-factory',array('load_module'=> FALSE))

<script>
app.controller('prepareResumeData', function( $scope, $http, httpPreConfig) {


    $scope.work_exp_data=[];
    $scope.projects_data=[];
    $scope.academic_data=[];
    $scope.skills_data  =[];
    $scope.activities_data=[];



    $scope.popup_work_exp_data  =[];
    $scope.popup_projects_data  =[];
    $scope.popup_skills_data    =[];
    $scope.popup_activities_data=[];
    $scope.popup_academic_data  =[];




    $scope.initFunctions = function() 
    {
         //get work experience
         $scope.getUserResumeData();
    }

    $scope.getUserResumeData = function() {

        route = '{{URL_GET_USER_RESUME_DATA}}',
        data= {_method: 'post',
                 '_token':httpPreConfig.getToken()
          };

          httpPreConfig.webServiceCallPost(route, data).then(function(result){

          $scope.work_exp_data = result.data.work_experience;
          $scope.projects_data = result.data.projects_data;
          $scope.academic_data = result.data.academic_data;
          $scope.skills_data    = result.data.skills_data;
          $scope.activities_data = result.data.activities_data;

          
         if ($scope.work_exp_data)
         {
            for ($j=0;$j<$scope.work_exp_data.length;$j++)
            {
               $scope.popup_work_exp_data.push({ 'popup_work_experience':$scope.work_exp_data[$j].work_experience,'popup_from_date':$scope.work_exp_data[$j].from_date,'popup_to_date':$scope.work_exp_data[$j].to_date});
            }
         }



        
         if ($scope.projects_data)
         {
            for ($j=0;$j<$scope.projects_data.length;$j++)
            {
                $scope.popup_projects_data.push({'popup_project_title':$scope.projects_data[$j].project_title,'popup_project_description':$scope.projects_data[$j].project_description,});
            }
         }


         if ($scope.skills_data)
         {
            for ($j=0;$j<$scope.skills_data.length;$j++)
            {
                $scope.popup_skills_data.push({'popup_skill_type':$scope.skills_data[$j].skill_type,'popup_skills_known':$scope.skills_data[$j].skills_known});
            }
         }


         if ($scope.activities_data)
         {
            for ($j=0;$j<$scope.activities_data.length;$j++)
            {
                $scope.popup_activities_data.push({'popup_activity_description':$scope.activities_data[$j].activity_description});
            }
         }


         if ($scope.academic_data)
         {
            for ($j=0;$j<$scope.academic_data.length;$j++)
            {
                $scope.popup_academic_data.push({'popup_examination_passed':$scope.academic_data[$j].examination_passed,'popup_university':$scope.academic_data[$j].university,'popup_passed_out_year':$scope.academic_data[$j].passed_out_year,'popup_marks_obtained':$scope.academic_data[$j].marks_obtained,'popup_class':$scope.academic_data[$j].class});
            }
         }


          });
    }

      
      


    //experience script
    // $scope.workexperience = [];

    
   /* $scope.addExperience = function() { 
      $scope.popup_work_exp_data.push({ 'popup_work_experience':$scope.work_experience});
      $scope.work_experience='';
    }*/


  
    $scope.work_experience='';
    $scope.from_date='';
    $scope.to_date='';
    

   
   $(function() {
      $('#toggle-present').change(function() {

       var till_present=false;
       till_present = $('#toggle-present').prop('checked');

       if (till_present)
       {
          $("#work_to_date").val('Present');
          $scope.to_date='Present';
          $("#work_from_date").attr('disabled','disabled');
          $("#work_to_date").attr('disabled','disabled');
       }
       else 
       {
          $("#work_to_date").val('');
          $scope.to_date='';
          $("#work_from_date").removeAttr('disabled');
          $("#work_to_date").removeAttr('disabled');
       }

      })
   })



    $scope.popup_work_exp_data=[];
    $scope.addExperience = function() {


      // console.log($scope.work_experience+" "+$scope.from_date+" "+$scope.to_date);
       

        var popup_record={'popup_work_experience':'','popup_from_date':'','popup_to_date':''};

        if ($scope.work_experience!='' && $scope.work_experience!=null && $scope.from_date!='' && $scope.from_date!=null && $scope.to_date!='' && $scope.to_date!=null) {

          popup_record.popup_work_experience = $scope.work_experience;

          //if ($scope.from_date!='' && $scope.from_date!=null) {
            popup_record.popup_from_date = $scope.from_date;
         // }

          //if ($scope.to_date!='' && $scope.to_date!=null) {
            popup_record.popup_to_date = $scope.to_date;
          //}

            $scope.popup_work_exp_data.push(popup_record);

            $scope.work_experience='';
            $scope.from_date='';
            $scope.to_date='';

            $('#toggle-present').bootstrapToggle('off');

        }
    }


    $scope.removeExperience = function(name){        
      var index = -1;   
      var comArr = eval( $scope.popup_work_exp_data );
      for( var i = 0; i < comArr.length; i++ ) {
        if( comArr[i].popup_work_experience === name ) {
          index = i;
          break;
        }
      }
      if( index === -1 ) {
        alert( "Something gone wrong" );
      }
      $scope.popup_work_exp_data.splice( index, 1 );    
    }


    

   
  $scope.saveExperience = function() {
    var comArr = eval( $scope.popup_work_exp_data );

    
    $scope.work_exp_data=[];
   

     if (comArr.length) {
      
        for( var i = 0; i < comArr.length; i++ ) {

          var record={'work_experience':'','from_date':'','to_date':''};
         

          if (comArr[i].popup_work_experience!='' && comArr[i].popup_work_experience!=null) {

            record.work_experience = comArr[i].popup_work_experience;
            
            if (comArr[i].popup_from_date!='' && comArr[i].popup_from_date!=null) {
              record.from_date = comArr[i].popup_from_date;
            }

            if (comArr[i].popup_to_date!='' && comArr[i].popup_to_date!=null) {
              record.to_date = comArr[i].popup_to_date;
            }

            $scope.work_exp_data.push(record);
           
          }

        }
    }
   

	// console.log($scope.work_exp_data);
    // $scope.wrk_exp_save = $scope.work_exp_data;
    $("#expModal").modal('hide');
  }
  //experience script          
    





   //projects&works done script
    $scope.addProject = function() {   
      $scope.popup_projects_data.push({ 'popup_project_title':$scope.project_title,'popup_project_description':$scope.project_description});
        $scope.project_title='';
        $scope.project_description='';
      
    }


    $scope.removeProject = function(name){        
      var index = -1;   
      var comArr = eval( $scope.popup_projects_data );
      for( var i = 0; i < comArr.length; i++ ) {
        if( comArr[i].popup_project_title === name ) {
          index = i;
          break;
        }
      }
      if( index === -1 ) {
        alert( "Something gone wrong" );
      }
      $scope.popup_projects_data.splice( index, 1 );    
    }


    
  
   $scope.saveProject = function() {

     var comArr = eval( $scope.popup_projects_data );

     $scope.popup_projects_data=[];
     $scope.projects_data=[];

     if (comArr.length) {
     
      	for( var i = 0; i < comArr.length; i++ ) {

      		var record = {'project_title':'','project_description':''};

          var popup_record={'popup_project_title':'','popup_project_description':''};

        	if (comArr[i].popup_project_title!='' && comArr[i].popup_project_title!=null) {
        		record.project_title = comArr[i].popup_project_title;
            popup_record.popup_project_title = comArr[i].popup_project_title;

        		if (comArr[i].popup_project_description!='' && comArr[i].popup_project_description!=null) {
        			record.project_description = comArr[i].popup_project_description;
              popup_record.popup_project_description = comArr[i].popup_project_description;
        		}

          	$scope.projects_data.push(record);
            $scope.popup_projects_data.push(popup_record);

        	}

      	}
  	}
    $("#projectsModal").modal('hide');
  }
  //projects&works done script
  





  //technical skills script
    
    $scope.addSkill = function() {   
      $scope.popup_skills_data.push({ 'popup_skill_type':$scope.skill_type,'popup_skills_known':$scope.skills_known});
      
      $scope.skill_type='';
      $scope.skills_known='';
     
    }

    $scope.removeSkill = function(name){        
      var index = -1;   
      var comArr = eval( $scope.popup_skills_data );
      for( var i = 0; i < comArr.length; i++ ) {
        if( comArr[i].popup_skill_type === name ) {
          index = i;
          break;
        }
      }
      if( index === -1 ) {
        alert( "Something gone wrong" );
      }
      $scope.popup_skills_data.splice( index, 1 );    
    }



   $scope.saveSkill = function() {
    
     var comArr = eval( $scope.popup_skills_data );

     if (comArr.length) {

     	$scope.skills_data = [];
      $scope.popup_skills_data=[];


      	for( var i = 0; i < comArr.length; i++ ) {

      		var record = {'skill_type':'','skills_known':''};
          var popup_record = {'popup_skill_type':'', 'popup_skills_known':''};

        	if (comArr[i].popup_skill_type!='' && comArr[i].popup_skill_type!=null) {

        		record.skill_type = comArr[i].popup_skill_type;
            popup_record.popup_skill_type = comArr[i].popup_skill_type;

        		if (comArr[i].popup_skills_known!='' && comArr[i].popup_skills_known!=null) {
        			record.skills_known = comArr[i].popup_skills_known;

              popup_record.popup_skills_known = comArr[i].popup_skills_known;
        		}

        		$scope.skills_data.push(record);


            $scope.popup_skills_data.push(popup_record);
        	}
      }
      
  	}

   
    // console.log(" PROJECTS TITLES  "+$scope.projects_titles_save);

    $("#skillsModal").modal('hide');
  }
  //technical skills






  //extra curricular activities script
   
    $scope.addActivity = function() {   
      $scope.popup_activities_data.push({ 'popup_activity_description':$scope.activity_description});
      
      $scope.activity_description='';
    }


    $scope.removeActivity = function(name){        
      var index = -1;   
      var comArr = eval( $scope.popup_activities_data );
      for( var i = 0; i < comArr.length; i++ ) {
        if( comArr[i].popup_activity_description === name ) {
          index = i;
          break;
        }
      }
      if( index === -1 ) {
        alert( "Something gone wrong" );
      }
      $scope.popup_activities_data.splice( index, 1 );    
    }


   
   $scope.saveActivity = function() {

   
     var comArr = eval( $scope.popup_activities_data );

     $scope.popup_activities_data=[];
     $scope.activities_data=[];


      if (comArr.length) {
      	

      	for( var i = 0; i < comArr.length; i++ ) {

      		var record={'activity_description':''};

          var popup_record = {'popup_activity_description':''};

        	if (comArr[i].popup_activity_description!='' && comArr[i].popup_activity_description!=null) {

          		record.activity_description = comArr[i].popup_activity_description;
              popup_record.popup_activity_description = comArr[i].popup_activity_description;


          		$scope.activities_data.push(record);
              $scope.popup_activities_data.push(popup_record);
        	}
      }
    
  	}
    $("#activitiesModal").modal('hide');
  }
  //extra curricular activities






	//academic profile script
    $scope.addAcademicProfile = function() {   
      $scope.popup_academic_data.push({ 'popup_examination_passed':$scope.examination_passed, 'popup_university':$scope.university,'popup_passed_out_year':$scope.passed_out_year,'popup_marks_obtained':$scope.marks_obtained,'popup_class':$scope.class});
      

      $scope.examination_passed	  ='';
      $scope.university			      ='';
      $scope.passed_out_year	    ='';
      $scope.marks_obtained	      ='';
      $scope.class				        ='';
    }


    $scope.removeAcademicProfile = function(name){        
      var index = -1;   
      var comArr = eval( $scope.popup_academic_data );
      for( var i = 0; i < comArr.length; i++ ) {
        if( comArr[i].popup_examination_passed === name ) {
          index = i;
          break;
        }
      }
      if( index === -1 ) {
        alert( "Something gone wrong" );
      }
      $scope.popup_academic_data.splice( index, 1 );    
    }



 
   $scope.saveAcademicProfile = function() {

     var comArr = eval( $scope.popup_academic_data );

     $scope.academic_data=[];
     $scope.popup_academic_data=[];

      if (comArr.length) {

      	for( var i = 0; i < comArr.length; i++ ) {

          var record={'examination_passed':'','university':'','passed_out_year':'','marks_obtained':'','class':''};
          var popup_record={'popup_examination_passed':'','popup_university':'','popup_passed_out_year':'','popup_marks_obtained':'','popup_class':''};


              	if (comArr[i].popup_examination_passed!='' && comArr[i].popup_examination_passed!=null) {
                		record.examination_passed = comArr[i].popup_examination_passed;
                    popup_record.popup_examination_passed = comArr[i].popup_examination_passed;
                }

                if (comArr[i].popup_university!='' && comArr[i].popup_university!=null) {
                    record.university = comArr[i].popup_university;
                    popup_record.popup_university = comArr[i].popup_university;
                }

                if (comArr[i].popup_passed_out_year!='' && comArr[i].popup_passed_out_year!=null) {
                    record.passed_out_year = comArr[i].popup_passed_out_year;
                    popup_record.popup_passed_out_year = comArr[i].popup_passed_out_year;
                }

                if (comArr[i].popup_marks_obtained!='' && comArr[i].popup_marks_obtained!=null) {
                    record.marks_obtained = comArr[i].popup_marks_obtained;
                    popup_record.popup_marks_obtained = comArr[i].popup_marks_obtained;
                }

                if (comArr[i].popup_class!='' && comArr[i].popup_class!=null) {
                    record.class = comArr[i].popup_class;
                    popup_record.popup_class = comArr[i].popup_class;
                }

          		$scope.academic_data.push(record);
              $scope.popup_academic_data.push(popup_record);
      }
     
  	}

    $("#academicModal").modal('hide');
  }
  //academic profile activities

 
});





 
</script>
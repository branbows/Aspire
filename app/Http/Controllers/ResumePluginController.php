<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use Exception;
use Schema;
use DB;


class ResumePluginController extends Controller
{
    
  public function addResumeBuilder()
  {
  	  

  	  DB::beginTransaction();

      try { 
            
            // Table1
      	    $query =   "CREATE TABLE `academicprofiles` (
						  `id` int(11) NOT NULL,
						  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
						  `examination_passed` varchar(512) NOT NULL,
						  `university` varchar(512) NOT NULL,
						  `passed_out_year` varchar(4) NOT NULL,
						  `marks_obtained` varchar(50) NOT NULL,
						  `class` varchar(100) NOT NULL,
						  `created_at` datetime DEFAULT NULL,
						  `updated_at` datetime DEFAULT NULL
						)"; DB::statement($query);

		      $query  = "ALTER TABLE `academicprofiles` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`)";  
		                 DB::statement($query);

		      $query  = "ALTER TABLE `academicprofiles` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";  
		                 DB::statement($query);

		       $query  = "ALTER TABLE `academicprofiles` ADD CONSTRAINT `academicprofiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)";  
		                 DB::statement($query);

            //Table2
		    $query =   "CREATE TABLE `activities` (
						  `id` int(11) NOT NULL,
						  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
						  `activity_description` text,
						  `created_at` datetime DEFAULT NULL,
						  `updated_at` datetime DEFAULT NULL
						)"; DB::statement($query);

		      $query  = "ALTER TABLE `activities` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`)";  
		                 DB::statement($query);

		      $query  = "ALTER TABLE `activities` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";  
		                 DB::statement($query);

		$query  = "ALTER TABLE `activities` ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)";  
		                 DB::statement($query);

		     //Table3
		    $query =   "CREATE TABLE `projects` (
					  `id` int(11) NOT NULL,
					  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
					  `project_title` varchar(512) NOT NULL,
					  `project_description` text,
					  `project_from_date` date DEFAULT NULL,
					  `project_to_date` date DEFAULT NULL,
					  `created_at` datetime DEFAULT NULL,
					  `updated_at` datetime DEFAULT NULL
					)"; DB::statement($query);

		      $query  = "ALTER TABLE `projects` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`)";  
		                 DB::statement($query);

		      $query  = "ALTER TABLE `projects` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";  
		                 DB::statement($query);

		    $query  = "ALTER TABLE `projects` ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)";  
		                 DB::statement($query); 


		     //Table4
		    $query =   "CREATE TABLE `resumetemplates` (
						  `id` int(11) NOT NULL,
						  `title` varchar(100) NOT NULL,
						  `resume_key` varchar(100) NOT NULL,
						  `slug` varchar(50) NOT NULL,
						  `status` enum('0','1') DEFAULT NULL,
						  `is_default` enum('0','1') DEFAULT NULL,
						  `image` varchar(50) NOT NULL,
						  `created_at` datetime DEFAULT NULL,
						  `updated_at` datetime DEFAULT NULL
						)"; DB::statement($query);

		      $query  = "INSERT INTO `resumetemplates` (`id`, `title`, `resume_key`, `slug`, `status`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
					(1, 'White Template', 'white_template', 'white-template-3', '1', '0', '1_white-template.jpeg', '2017-12-16 04:58:13', '2018-08-04 06:25:19'),
					(2, 'Green Resume', 'green_template', 'green-template-3', '1', '1', '2_green-resume-1.jpeg', '2017-12-16 05:24:57', '2018-08-04 06:25:19'),
					(6, 'Yellow Template', 'yellow_template', 'yellow-template-3', '1', '0', '6-yellow-template-3.jpeg', '2017-12-16 06:28:49', '2017-12-29 12:31:23')"; 

		                 DB::statement($query);

		      $query  = "ALTER TABLE `resumetemplates` ADD PRIMARY KEY (`id`)";  
		                 DB::statement($query);

		      $query  = "ALTER TABLE `resumetemplates` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";  
		                 DB::statement($query);


		    //Table5
		    $query =   "CREATE TABLE `technicalskills` (
						  `id` int(11) NOT NULL,
						  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
						  `skill_type` varchar(100) NOT NULL,
						  `skills_known` varchar(512) NOT NULL,
						  `created_at` datetime DEFAULT NULL,
						  `updated_at` datetime DEFAULT NULL
						)"; DB::statement($query);
						

		      $query  = "ALTER TABLE `technicalskills` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`)";  
		                 DB::statement($query);

		      $query  = "ALTER TABLE `technicalskills` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";  
		                 DB::statement($query);

		    $query  = "ALTER TABLE `technicalskills` ADD CONSTRAINT `technicalskills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)";  
		                 DB::statement($query); 


		   
		   //Table6
		    $query =   "CREATE TABLE `workexperience` (
						  `id` int(11) NOT NULL,
						  `user_id` bigint(20) UNSIGNED NOT NULL,
						  `work_experience` text,
						  `from_date` varchar(20) DEFAULT NULL,
						  `to_date` varchar(20) DEFAULT NULL,
						  `created_at` datetime DEFAULT NULL,
						  `updated_at` datetime DEFAULT NULL
						)"; DB::statement($query);
						

		      $query  = "ALTER TABLE `workexperience` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`)";  
		                 DB::statement($query);

		      $query  = "ALTER TABLE `workexperience` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";  
		                 DB::statement($query);

		    $query  = "ALTER TABLE `workexperience` ADD CONSTRAINT `workexperience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)";  
		                 DB::statement($query); 

             // Table7
		     $query  = "ALTER TABLE `users`  ADD `qualification` VARCHAR(255) NULL DEFAULT NULL  AFTER `updated_at`, 
						ADD `department` VARCHAR(255) NULL DEFAULT NULL  AFTER `qualification`, 
						ADD `college_name` VARCHAR(255) NULL DEFAULT NULL  AFTER `department`,  
						ADD `college_place` VARCHAR(255) NULL DEFAULT NULL  AFTER `college_name`, 
						ADD `state` VARCHAR(255) NULL DEFAULT NULL  AFTER `college_place`,  
						ADD `country` VARCHAR(255) NULL DEFAULT NULL  AFTER `state`, 
						ADD `field_of_interest` TEXT NULL DEFAULT NULL  AFTER `country`,  
						ADD `subject_taught` TEXT NULL DEFAULT NULL  AFTER `field_of_interest`, 
						ADD `gender` ENUM('Male','Female') NULL DEFAULT NULL  AFTER `subject_taught`, 
						ADD `dob` DATE NULL DEFAULT NULL  AFTER `gender`,  
						ADD `marital_status` ENUM('Married','Unmarried') NULL DEFAULT NULL  AFTER `dob`,  
						ADD `nationality` VARCHAR(255) NULL DEFAULT NULL  AFTER `marital_status`, 
						ADD `father_name` VARCHAR(255) NULL DEFAULT NULL  AFTER `nationality`, 
						ADD `linguistic_ability` VARCHAR(255) NULL DEFAULT NULL  AFTER `father_name`, 
						ADD `passport_number` VARCHAR(255) NULL DEFAULT NULL  AFTER `linguistic_ability`,  
						ADD `present_address` VARCHAR(255) NULL DEFAULT NULL  AFTER `passport_number`,  
						ADD `personal_strength` VARCHAR(255) NULL DEFAULT NULL  AFTER `present_address`, 
						ADD `roll_no` VARCHAR(255) NULL DEFAULT NULL  AFTER `personal_strength`";  

		                DB::statement($query);                                           


           DB::commit();
           flash('success','resume_builder_plugin_added_successfully', 'overlay');
      }

       catch ( Exception $e ) {

            DB::rollBack();
              // dd($e->getMessage());
            flash('success','resume_builder_plugin_added_successfully', 'overlay');
             
        }

        return redirect( URL_HOME );
  }

}
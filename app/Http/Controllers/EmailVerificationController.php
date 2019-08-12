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


class EmailVerificationController extends Controller
{
   

   public function userVerification()
   {
   	   
   	    DB::beginTransaction();

      try { 
              $query  = "ALTER TABLE `users` ADD `is_verified` TINYINT(2) NOT NULL DEFAULT '0' AFTER `updated_at`, ADD `activation_code` VARCHAR(255) NULL DEFAULT NULL AFTER `is_verified`";  
                        DB::statement($query);

              $query  = "UPDATE users SET is_verified = 1";  
                        DB::statement($query);


      	      DB::commit();
              flash('success','email_verification_feature_added_successfully','success');    
       }

        catch ( Exception $e ) {

            DB::rollBack();
              // dd($e->getMessage());
            flash('success','email_verification_feature_added_successfully', 'overlay');
             
        }

        return redirect( URL_HOME );

   }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\QuestionBank;
use Exception;
use Schema;
use DB;


class UpdatesController extends Controller
{
    //  public function __construct()
    // {
     
    //      $this->middleware('auth');
    
    // }



    public function updateDatabase()
    {
      
      // if(!checkRole(getUserGrade(1)))
      // {
      //   prepareBlockUserMessage();
      //   return back();
      // }  

       DB::beginTransaction();

      try { 
             

              $query =   "CREATE TABLE `examlanguages` (
                          `id` bigint(20) NOT NULL,
                          `title` varchar(50) DEFAULT NULL,
                          `created_at` datetime DEFAULT NULL,
                          `updated_at` datetime DEFAULT NULL 
                          )"; DB::statement($query);

               $query = "INSERT INTO `examlanguages` (`id`, `title`, `created_at`, `updated_at`) VALUES
                          (1, 'Telugu', NULL, NULL),
                          (2, 'Hindi', NULL, NULL),
                          (3, 'Tamil', NULL, NULL)"; DB::statement($query);

               $query  = "ALTER TABLE `examlanguages`ADD PRIMARY KEY (`id`)";  DB::statement($query);

               $query = "ALTER TABLE `examlanguages`MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4";          
                DB::statement($query);

               $query =   "CREATE TABLE `examtypes` (
                            `code` varchar(20) NOT NULL,
                            `title` varchar(50) DEFAULT NULL,
                            `description` text,
                            `status` tinyint(2) NOT NULL DEFAULT '1',
                            `created_at` datetime DEFAULT NULL,
                            `updated_at` datetime DEFAULT NULL
                          )"; DB::statement($query);

               $query = "INSERT INTO `examtypes` (`code`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
                        ('NSNT', 'No Section No Timer', 'No section and no timer will be shown', 1, NULL, NULL),
                        ('SNT', 'Section with No Timer', 'Section with no timer', 1, NULL, NULL),
                        ('ST', 'Section with Timer', 'Section with Timer', 1, NULL, NULL)"; DB::statement($query);

               $query  = "ALTER TABLE `examtypes`ADD PRIMARY KEY (`code`)";  DB::statement($query);  

              $query   =  "ALTER TABLE `messenger_messages` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`";
                         DB::statement($query);

               $query  = "ALTER TABLE `quizzes` ADD `show_in_front` TINYINT(2) NOT NULL DEFAULT '0' AFTER `updated_at`, ADD `exam_type` VARCHAR(20) NOT NULL DEFAULT 'NSNT' AFTER `show_in_front`, ADD `section_data` TEXT NULL DEFAULT NULL AFTER `exam_type`, ADD `has_language` TINYINT(2) NOT NULL DEFAULT '0' AFTER `section_data`"; 
                DB::statement($query);  


                 $query = "INSERT INTO `settings` (`title`, `key`, `slug`, `image`, `settings_data`, `description`, `created_at`, `updated_at`) VALUES
              ('Site Pages', 'site_pages', 'site-pages-11', NULL, '', 'This setting holds the static pages in the site', '2017-12-18 12:23:10', '2018-02-04 18:08:43'),
             ('Recaptcha Settings', 'recaptcha_settings', 'recaptcha-settings', NULL, '{\r\n\r\n  \"enable_rechaptcha\": {\r\n    \"value\": \"no\",\r\n    \"type\": \"select\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"no\": \"No\",\r\n       \"yes\": \"Yes\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Make yes to active reChaptcha while in login and registration\"\r\n },\r\n\r\n  \"nocaptcha_secret\": {\r\n   \"value\": \"YourSecretKey\",\r\n   \"type\": \"text\",\r\n   \"extra\": \"\",\r\n    \"tool_tip\": \"Enter Your Rechaptcha Secret Key\"\r\n  },\r\n  \"nocaptcha_sitekey\": {\r\n    \"value\": \"YourSiteKey\",\r\n   \"type\": \"text\",\r\n   \"extra\": \"\",\r\n    \"tool_tip\": \"Enter Your Rechaptcha Site Key\"\r\n  }\r\n\r\n}', 'Plese update your Rechaptcha Site Key and SECRET Key.', NULL, '2018-03-15 00:04:47')"; DB::statement($query);

          
       $record                 = App\Settings::where('slug', 'site-settings')->first();
       $settings_data          = (array) json_decode($record->settings_data);

       // $values = array(
       //                  'type'=>'text', 
       //                  'value'=>'$', 
       //                  'extra'=>'',
       //                  'tool_tip'=>'Enter currency symbol'
       //                 );

        $values1 = array(
                        'type'=>'text', 
                        'value'=>'https:\/\/www.facebook.com\/', 
                        'extra'=>'',
                        'tool_tip'=>'Face Book'
                       ); 

        $values2 = array(
                        'type'=>'text', 
                        'value'=>'https:\/\/plus.google.com\/up\/accounts\/upgrade\/?continue=https:\/\/plus.google.com\/people', 
                        'extra'=>'',
                        'tool_tip'=>'Google Plus Login'
                       ); 

       // $settings_data['currency_code']     = $values;
       $settings_data['facebook_login']    = $values1;
       $settings_data['google_plus_login'] = $values2;
       $record->settings_data              = json_encode($settings_data);
       $record->save();

      $site_pages_settings = App\Settings::where('key','=','site_pages')->first();
      if($site_pages_settings)
      {
         
         $site_pages_settings->settings_data = '{"privacy-policy":{"value":"   <section class=\"terms-conditon\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12 mps-common\">\r\n                <h1 class=\"text-center\">Privacy and Policy<\/h1>\r\n                <div class=\"row\">\r\n                    <div class=\"col-md-12 mps-common\">\r\n                        <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n                        <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n                        <p>A more sophisticated version of this document is available on website: <a href=\"javascript:void(0);\">privacy and cookies policy.<\/a><\/p>\r\n                        \r\n                    <\/div>\r\n                    <div class=\"col-md-12 mps-common\">\r\n                        <h4>More Information About Privacy Policies:<\/h4>\r\n                        <p><i class=\"fa fa-check-square-o\" aria-hidden=\"true\"><\/i> categories of personal information collected by the website<\/p>\r\n                        <p><i class=\"fa fa-check-square-o\" aria-hidden=\"true\"><\/i> categories of personal information collected by the website<\/p>\r\n                        <p><i class=\"fa fa-check-square-o\" aria-hidden=\"true\"><\/i> categories of personal information collected by the website<\/p>\r\n                        <p><i class=\"fa fa-check-square-o\" aria-hidden=\"true\"><\/i> categories of personal information collected by the website<\/p>\r\n                        <p><i class=\"fa fa-check-square-o\" aria-hidden=\"true\"><\/i> categories of personal information collected by the website<\/p>\r\n                        <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n                        <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n                        \r\n                        \r\n                       <!-- <p class=\"dual-btns\"> <a href=\"#\" class=\"btn-demo\">Download<\/a> <a href=\"#\" class=\"btn-buy\">Get Licence<\/a> <\/p>-->\r\n                        <p><strong>Note:<\/strong>If you use the free privacy policy, you must retain the credit for OES. However, if you purchase the equivalent document on website, you will get access to a copy of the document that omits the credit.<\/p>\r\n                        \r\n                    <\/div>\r\n                <\/div>\r\n            <\/div>\r\n        <\/div>\r\n    <\/div>\r\n<\/section>","type":"textarea","extra":"","tool_tip":"Privacy Policy Page"},"terms-conditions":{"value":" <section class=\"terms-conditon\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n           <div class=\"col-md-12 mps-common\">\r\n              <h1 class=\"text-center\">Terms and Conditions<\/h1>  \r\n                <div class=\"row\">\r\n                   <div class=\"col-md-12 mps-common\">\r\n                        \r\n                    <h4>General<\/h4>\r\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n\r\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n\r\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\"<\/p>\r\n                \r\n               <\/div>\r\n               \r\n               <div class=\"col-md-12 mps-common\">\r\n                        \r\n                    <h4>Services<\/h4>\r\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n\r\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n\r\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\"<\/p>\r\n                \r\n               <\/div>\r\n               \r\n               \r\n               <div class=\"col-md-12 mps-common\">\r\n                        \r\n                    <h4>Service Fees \/ Payments \/ Invoices<\/h4>\r\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n\r\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n\r\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\"<\/p>\r\n                \r\n               <\/div>\r\n               \r\n               <div class=\"col-md-12 mps-common\">\r\n                        \r\n                    <h4>Termination \/ Plan Change \/ Refund Policy<\/h4>\r\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n\r\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n\r\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\"<\/p>\r\n                \r\n               <\/div>\r\n               \r\n               <div class=\"col-md-12 mps-common\">\r\n                        \r\n                    <h4>Subscriber Responsibility<\/h4>\r\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n\r\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n\r\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\"<\/p>\r\n                \r\n               <\/div>\r\n               \r\n               <div class=\"col-md-12 mps-common\">\r\n                        \r\n                    <h4>Entire Agreement<\/h4>\r\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\/p>\r\n\r\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\/p>\r\n\r\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\"<\/p>\r\n                \r\n               <\/div>\r\n            <\/div>\r\n          <\/div>      \r\n        <\/div>      \r\n      <\/div>\r\n    <\/section>","type":"textarea","extra":"","tool_tip":"Terms & Conditions page"},"banner_title":{"value":"Multipurpose Menorah Online Examination System","type":"text","extra":"","tool_tip":"Banner title on homepage"},"banner_sub_title":{"value":"Automatic - Insightful - Efficient ","type":"text","extra":"","tool_tip":"Home page banner sub title"},"copyrights":{"value":" Copyright \u00a9 2009 - 2017 Conquerors Software Technologies Pvt. Ltd. All Rights Reserved","type":"text","extra":"","tool_tip":"Copy Rights Information"},"facebook":{"value":"https:\/\/www.facebook.com\/pages\/Conquerors-Technologies\/491500414250284","type":"text","extra":"","tool_tip":"Facebook Social Link"},"twitter":{"value":"https:\/\/twitter.com\/ConquerorsTechs","type":"text","extra":"","tool_tip":"Twitter Social Link"},"linkedin":{"value":"https:\/\/www.linkedin.com\/company\/conquerors-technologies","type":"text","extra":"","tool_tip":"Linkedin Social Link"},"google":{"value":"https:\/\/plus.google.com\/+ConquerorstechNet1","type":"text","extra":"","tool_tip":"Google plus URL"},"banner_image1":{"value":"qTLX0VHGXekOBy0.jpg","type":"file","extra":"","tool_tip":"Banner Image 1"},"banner_image2":{"value":"JKvgeLpiZOF2XKt.jpg","type":"file","extra":"","tool_tip":"Banner Image 2"},"banner_image3":{"value":"SuLMVZLdmoZk1tV.jpg","type":"file","extra":"","tool_tip":"Banner Image 3"},"banner_image4":{"value":"lTK53K2dNLHSvhi.jpg","type":"file","extra":"","tool_tip":"Banner Image 4"}}';
      
           $site_pages_settings->save();


      }

      $query =   "CREATE TABLE `themes` (
                  `id` bigint(20) UNSIGNED NOT NULL,
                  `title` varchar(250) DEFAULT NULL,
                  `slug` varchar(250) NOT NULL,
                  `theme_title_key` varchar(250) NOT NULL,
                  `settings_data` text NOT NULL,
                  `description` text,
                  `is_active` tinyint(4) NOT NULL DEFAULT '0',
                  `created_at` datetime NOT NULL,
                  `updated_at` datetime NOT NULL
                )"; 

          $query = "ALTER TABLE `themes` ADD `theme_color` VARCHAR(50) NULL DEFAULT NULL AFTER `is_active`";
                  DB::statement($query);      

      DB::statement($query);

        $query  = "ALTER TABLE `themes`ADD PRIMARY KEY (`id`)";  DB::statement($query);

        $query = "ALTER TABLE `themes`MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4";          
                DB::statement($query);

        $query = "INSERT INTO `themes` (`id`, `title`, `slug`, `theme_title_key`, `settings_data`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
            (1, 'Default', 'default', 'default', NULL, NULL, 0, '2018-03-24 00:00:00', '2018-04-02 04:35:58'),
            (2, 'Theme One', 'theme_one', 'themeone', NULL, NULL, 1, '2018-03-24 00:00:00', '2018-04-02 04:35:59')";

            DB::statement($query);       

           $default_theme = App\SiteTheme::where('theme_title_key','=','default')->first();
            if($default_theme)
            {
              $default_theme->settings_data  = '{
                  "banner_title": {
                    "value": " Multi Purpose Menorah OES",
                    "type": "text",
                    "extra": "",
                    "tool_tip": "Home Page title"
                  },
                  "banner_sub_title": {
                    "value": "We make your success",
                    "type": "text",
                    "extra": "",
                    "tool_tip": "Home Page Subtitle"
                  },
                  "home_page_facebook_link": {
                    "value": "https:\/\/www.facebook.com\/",
                    "type": "text",
                    "extra": "",
                    "tool_tip": "Home Page Title"
                  },
                  "home_page_twitter_link": {
                    "value": "https:\/\/twitter.com\/login?lang=en",
                    "type": "text",
                    "extra": "",
                    "tool_tip": "Home Page Title"
                  },
                  "home_page_googleplus_link": {
                    "value": "https:\/\/plus.google.com\/discover",
                    "type": "text",
                    "extra": "",
                    "tool_tip": "Home Page Title"
                  },
                  "copyrights": {
                    "value": " Copyright \u00a9 2009 - 2018 Test Software Technologies Pvt. Ltd. All Rights Reserved",
                    "type": "text",
                    "extra": "",
                    "tool_tip": "Copy Rights Information"
                  },
                  "privacy-policy": {
                    "value": "",
                    "type": "textarea",
                    "extra": "",
                    "tool_tip": "Privacy Policy Page"
                  },
                  "terms-conditions": {
                    "value": "",
                    "type": "textarea",
                    "extra": "",
                    "tool_tip": "Terms & Conditions page"
                  }
                }';

               $default_theme->save(); 
            }

             $themeone = App\SiteTheme::where('theme_title_key','=','themeone')->first();
            if($themeone){
              $themeone->settings_data = '{
                      "home_page_title": {
                        "value": "Menorah OES",
                        "type": "text",
                        "extra": "",
                        "tool_tip": "Home Page Title"
                      },
                      "home_page_link": {
                        "value": "",
                        "type": "text",
                        "extra": "",
                        "tool_tip": "Home Page Link"
                      },
                      "home_page_image": {
                        "value": "MxpUqSM4H0AIo2X.jpg",
                        "type": "file",
                        "extra": "",
                        "tool_tip": "Background image at front end before login"
                      },
                      "home_page_background_image": {
                        "value": "qfOuNvGvWX5BzJG.jpg",
                        "type": "file",
                        "extra": "",
                        "tool_tip": "Background image at front end before login"
                      },
                      "home_page_facebook_link": {
                        "value": "https:\/\/www.facebook.com\/",
                        "type": "text",
                        "extra": "",
                        "tool_tip": "Home Page Title"
                      },
                      "home_page_twitter_link": {
                        "value": "https:\/\/twitter.com\/login?lang=en",
                        "type": "text",
                        "extra": "",
                        "tool_tip": "Home Page Title"
                      },
                      "home_page_googleplus_link": {
                        "value": "https:\/\/plus.google.com\/discover",
                        "type": "text",
                        "extra": "",
                        "tool_tip": "Home Page Title"
                      },
                      "copyrights": {
                        "value": " Copyright \u00a9 2009 - 2018  Test Software Technologies Pvt. Ltd. All Rights Reserved",
                        "type": "text",
                        "extra": "",
                        "tool_tip": "Copy Rights Information"
                      },
                      "courses": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "Courses"
                      },
                      "pattren": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "pattren"
                      },
                      "pricing": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "pricing"
                      },
                      "syllabus": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "Syllabus"
                      },
                      "about-us": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "About Us Page"
                      },
                      "privacy-policy": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "Privacy Policy Page"
                      },
                      "terms-conditions": {
                        "value": "",
                        "type": "textarea",
                        "extra": "",
                        "tool_tip": "Terms & Conditions page"
                      }
                    }';


                     $themeone->save(); 
            }


  $query = "CREATE TABLE `site_user_subscription` (
            `id` bigint(20) NOT NULL,
            `email` varchar(200) DEFAULT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime NOT NULL
          )";

  DB::statement($query);

  $query = "ALTER TABLE `quizzes` ADD `image` VARCHAR(250) NULL DEFAULT NULL AFTER `record_updated_by`, ADD `language_name` VARCHAR(50) NULL DEFAULT NULL AFTER `image`";

  DB::statement($query);

  $query  = "ALTER TABLE `lmsseries` ADD `show_in_front` TINYINT(2) NOT NULL DEFAULT '0' AFTER `end_date";
  DB::statement($query);

        DB::commit();

           flash('success','application_updated_successfully','success');    
       }

        catch ( Exception $e ) {

            DB::rollBack();
              // dd($e->getMessage());
            flash('success','application_updated_successfully', 'overlay');
             
        }

        return redirect( URL_USERS );

    }



}

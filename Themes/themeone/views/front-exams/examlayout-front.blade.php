<!DOCTYPE html>

<html lang="en" dir="{{ (App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr' }}">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="{{getSetting('meta_description', 'seo_settings')}}">

    <meta name="keywords" content="{{getSetting('meta_keywords', 'seo_settings')}}">

        <meta name="csrf_token" content="{{ csrf_token() }}">


    <link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />

    <title>@yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>

    <!-- Bootstrap Core CSS -->

 @yield('header_scripts')

   

     <link href="{{themes('site/css/main.css')}}" rel="stylesheet">
     <link href="{{themes('css/notify.css')}}" rel="stylesheet">
     <link href="{{themes('css/angular-validation.css')}}" rel="stylesheet">

 <!-- Bootstrap Core CSS -->
   
    <!--FontAwesome-->

    
    <link href="{{CSS}}sweetalert.css" rel="stylesheet" type="text/css">

     <link href="{{themes('css/front-exam.css')}}" rel="stylesheet">


     <link href="{{themes('css/plugins/morris.css')}}" rel="stylesheet">



    <link href="{{CSS}}materialdesignicons.css" rel="stylesheet" type="text/css">


  

    

    
</head>





<body ng-app="academia">

     @include('site.header')

    

 @yield('custom_div')

 <?php 

 $class = '';

 if(!isset($right_bar))

    $class = 'no-right-sidebar';

$block_class = '';

if(isset($block_navigation))

    $block_class = 'non-clickable';

 ?>

    <div id="wrapper" class="{{$class}} mt-150 " >

        <!-- Navigation -->

        <nav role="navigation">
            
        


        </nav>

         

        
        @if(isset($right_bar))

            

        <aside class="right-sidebar mt-50" id="rightSidebar">

            {{-- <button class="sidebat-toggle" id="sidebarToggle" href='javascript:'><i class="mdi mdi-menu"></i></button> --}}

            <?php $right_bar_class_value = ''; 

            if(isset($right_bar_class))

                $right_bar_class_value = $right_bar_class;

            ?>

            <div class="panel panel-right-sidebar {{$right_bar_class_value}}">

            <?php $data = '';

            if(isset($right_bar_data))

                $data = $right_bar_data;

            ?>

                @include($right_bar_path, array('data' => $data))

            </div>

        </aside>

        

    @endif

        @yield('content')

    </div>

    @include('site.footer')

     <script src="{{themes('site/js/jquery-3.1.1.min.js')}}"></script>
      <script src="{{themes('site/js/bootstrap.min.js')}}"></script>
      <script src="{{themes('site/js/slider/slick.min.js')}}"></script>
      <script src="{{themes('site/js/bootstrap.offcanvas.js')}}"></script>
      <script src="{{themes('site/js/jRate.min.js')}}"></script>
      <script src="{{themes('site/js/wow.min.js')}}"></script>
      <script src="{{themes('site/js/main.js')}}"></script>
      <script src="{{themes('js/notify.js')}}"></script>

    {{-- <script src="{{JS}}main.js"></script> --}}

    <script src="{{JS}}sweetalert-dev.js"></script>
    <script src="{{JS}}mousetrap.js"></script>

     <script src="{{JS}}landing-js/all.js"></script>
    

    
    
    <script>
            var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 600000); // 1 hour 

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            setInterval(refreshToken, 600000); // 1 hour 

        </script>

    

    @include('common.alertify')

    

    @yield('footer_scripts')

    @include('errors.formMessages')

    @yield('custom_div_end')
    {!!getSetting('google_analytics', 'seo_settings')!!}
</body>



</html>
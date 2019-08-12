<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />
    <title>@yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="{{themes('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
     <link href="{{themes('front/css/bootstrap.offcanvas.css')}}" rel="stylesheet">
    <!--Owl Carousel-->
     <link href="{{themes('front/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
     <link href="{{themes('front/vendor/owl.carousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
     <link href="{{themes('front/vendor/owl.carousel/assets/owl.theme.green.min.css')}}" rel="stylesheet">
   
    <!-- Custom CSS -->
     <link href="{{themes('front/fonts/proxima-nova/proximanova.css')}}" rel="stylesheet">
     <link href="{{themes('front/css/style.css')}}" rel="stylesheet">
    
    <!--FontAwesome-->
     <link href="{{themes('front/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">


    <!-- RESPONSIVE STYLES -->
     <link href="{{themes('css/landing-css/responsive.css')}}" rel="stylesheet">
     <link href="{{themes('css/landing-css/colors.css')}}" rel="stylesheet">
     <link href="{{themes('css/landing-css/custom.css')}}" rel="stylesheet">
     <link href="{{themes('css/landing-css/style.css')}}" rel="stylesheet">
   
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!--Testimonies css-->
<link href="{{themes('site/css/testimonies/normalize.min.css')}}" rel="stylesheet">
<link href="{{themes('site/css/testimonies/owl.carousel.min.css')}}" rel="stylesheet">
<link href="{{themes('site/css/testimonies/owl.theme.default.min.css')}}" rel="stylesheet">
<link href="{{themes('site/css/testimonies/style.css')}}" rel="stylesheet">
<!--Testimonies css-->

@yield('home_css_scripts')
  
  
</head>
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top">
    <!-- Navigation -->


    <!-- NAVIGATION -->
    <nav class="navbar navbar-default st-navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand page-scroll" href="{{ URL_HOME }}"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}"></a>
                <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas">
                    <span class="sr-only">Toggle navigation</span>
                    <span>
                        <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </span>
                </button>
            </div>
            <div class="navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">
                <ul class="nav navbar-nav navbar-right">

                    <li> 
                        <a

                        @if($active_class=='home')
                            class="page-scroll active" 
                        @else
                            class="page-scroll" 
                        @endif

                        href="{{ URL_HOME }}"> {{getPhrase('home')}} </a> 
                    </li>


                     <li> 
                        <a

                        @if($active_class=='exams')
                            class="page-scroll active" 
                        @else
                            class="page-scroll" 
                        @endif

                        href="{{URL_FRONTEND_EXAMS_LIST}}">{{getPhrase('practice_exams')}}</a> 
                    </li>

                    <li> 
                        <a 
                        @if($active_class=='terms-conditions')
                            class="page-scroll active" 
                        @else
                            class="page-scroll" 
                        @endif

                        href="{{SITE_PAGES_TERMS}}"> {{getPhrase('terms_and_conditions')}}
                        </a> 
                    </li>
                    <li> 
                        <a 
                        @if($active_class=='privacy-policy')
                            class="page-scroll active" 
                        @else
                            class="page-scroll" 
                        @endif
                        href="{{SITE_PAGES_PRIVACY}}"
                        >  {{getPhrase('privacy_policy')}}
                    </a> </li>
                    




                      @php
                    $pages = \App\Page::where('status', 1)->get();
                    @endphp
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{getPhrase('more')}} <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                        @if (count($pages)>0)
                            @foreach ($pages as $page)
                                <li><a href="{{URL_PAGE}}{{$page->slug}}" alt="{{$page->name}}"> {{$page->name}} </a></li>
                            @endforeach
                        @endif


                        <li><a href="{{URL_HOME_BLOGS}}" alt="Blogs"> {{getPhrase('blogs')}} </a></li>

                        <li><a href="{{URL_FAQS}}" alt="FAQs"> {{strtoupper(getPhrase('faqs'))}} </a></li>


                        

                        </ul>
                    </li>









                    <li> 

                        <a 

                        @if($active_class=='login')
                            class="page-scroll active" 

                        @else
                            class="page-scroll" 
                            
                        @endif
                         href="{{URL_USERS_LOGIN}}"> {{getPhrase('login')}} </a> </li>


                    <li> 
                        <a 

                        @if($active_class=='register')
                            class="page-scroll active" 

                        @else
                            class="page-scroll" 

                        @endif href="{{URL_USERS_REGISTER}}"> {{getPhrase('register')}} </a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- /NAVIGATION -->
    

    @yield('content')
 
 

   
    <div class="st-copyright-section footer">
        <div class="container">
            <div class="clearfix text-center">
                 <?php 
                         $current_theme  =  getDefaultTheme();  
                         $face_book      =  getThemeSetting('home_page_facebook_link',$current_theme);
                         $twitter        =  getThemeSetting('home_page_twitter_link',$current_theme);
                         $google_plus    =  getThemeSetting('home_page_googleplus_link',$current_theme);
                         $copyrights     =  getThemeSetting('copyrights',$current_theme);
                    ?>

                <div class="st-copyright">{{ $copyrights }}</div>

                <div class="st-social-links"> 
                   
                    <a href="{{$face_book}}" target="_blank" ><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                    <a href="{{$twitter}}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                    <a href="{{$google_plus}}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true">
                  
                    </i></a> 
                </div>
            </div>
        </div>
    </div>
    <!--scroll to top-->
    <a href="javascript:void(0);" class="st-scrollToTop"><i class="fa fa-angle-up"></i></i></a>
    <!-- /scroll to top-->
    <!-- jQuery -->
      <script src="{{themes('front/js/jquery.min.js')}}"></script>
      <script src="{{themes('front/js/jquery.easing.min.js')}}"></script>
      <script src="{{themes('front/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{themes('front/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
      <script src="{{themes('front/js/bootstrap.offcanvas.js')}}"></script>
      <script src="{{themes('front/js/main.js')}}"></script>
      <script src="{{themes('js/landing-js/all.js')}}"></script>
      <script src="{{themes('js/landing-js/custom.js')}}"></script>
      <script src="{{themes('js/landing-js/mason_03.js')}}"></script>

{{-- <script type="text/javascript">
  $(document).ready(function() {
    var docHeight = $(window).height();
    var footerHeight = $('.footer').height();
    var footerTop = $('.footer').position().top + footerHeight;

    if (footerTop < docHeight) {
        $('.footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
    }
});
</script> --}}

     @yield('footer_scripts')
    
    
</body>

</html>
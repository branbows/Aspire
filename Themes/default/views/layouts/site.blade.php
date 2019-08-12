<!DOCTYPE html>

<html lang="en" dir="{{ (App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr' }}">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="{{getSetting('meta_description', 'seo_settings')}}">

	<meta name="keywords" content="{{getSetting('meta_keywords', 'seo_settings')}}">

	 

	<link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />

	

	<title>{{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>



	@yield('header_scripts')

	<!-- Bootstrap Core CSS -->

    <link href="{{themes('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{themes('css/sb-admin.css')}}" rel="stylesheet">
    <link href="{{themes('front/fonts/proxima-nova/proximanova.css')}}" rel="stylesheet">
    <link href="{{themes('css/custom-fonts.css')}}" rel="stylesheet">
    <link href="{{themes('css/materialdesignicons.css')}}" rel="stylesheet">
    <link href="{{themes('css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{themes('css/')}}" rel="stylesheet">
    <link href="{{themes('css/')}}" rel="stylesheet">

    <link href="{{CSS}}plugins/morris.css" rel="stylesheet">

    <link href="{{FONTAWSOME}}font-awesome.min.css" rel="stylesheet" type="text/css">


	
<style>
.active {
    color: red;
}
</style>

</head>

{{-- class="login-screen" background="bgimage.jpg" --}}


<body class="login-screen" background="{{IMAGE_PATH_SETTINGS.getSetting('background_image','site_settings')}}" ng-app="academia" >

 <!-- NAVIGATION -->
 <div class="login-nav">
    <nav class="navbar navbar-default st-navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand page-scroll" href="{{URL_HOME}}"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}"></a>
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

                        href="{{URL_HOME}}">{{getPhrase('home')}}</a> 
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

                        href="{{SITE_PAGES_TERMS}}">Terms and Conditions
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
                        >Privacy and Policy
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

                    	<a  @if($active_class =='login')
                              class="page-scroll active" 
                               style="color: #0870b5;" 
                          @else
                            class="page-scroll" 
                            @endif
                             href="{{URL_USERS_LOGIN}}">Login</a>
                              </li>
                    <li> <a 
                         @if($active_class=='register')
                            class="page-scroll active" 
                             style="color: #0870b5;" 
                        @else
                            class="page-scroll" 
                        @endif
                         href="{{URL_USERS_REGISTER}}">Register</a> 
                     </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
    <!-- /NAVIGATION --> 


	@yield('content')

	



		<!-- /#wrapper -->

		<!-- jQuery -->
        <script src="{{themes('js/jquery-1.12.1.min.js')}}"></script>
        <script src="{{themes('js/bootstrap.min.js')}}"></script>
        <script src="{{themes('js/main.js')}}"></script>
        <script src="{{themes('js/sweetalert-dev.js')}}"></script>

		{{--  <script src="{{JS}}jquery-1.12.1.min.js"></script>

         <script src="{{JS}}bootstrap.min.js"></script>

        <script src="{{JS}}main.js"></script>

		<script src="{{JS}}sweetalert-dev.js"></script> --}}

		@include('errors.formMessages')

		@yield('footer_scripts')
		
		{!!getSetting('google_analytics', 'seo_settings')!!}
</body>



</html>
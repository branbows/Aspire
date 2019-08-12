 <!-- NAVIGATION -->
    <nav class="navbar navbar-default pw-navbar-default navbar-fixed-top">
        <!-- /TOP BAR -->
        <div class="cs-topbar">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{PREFIX}}"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="logo" class="cs-logo" class="img-responsive"></a>
                </div>
               
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{URL_USERS_REGISTER}}" class="cs-nav-btn visible-lg"> {{getPhrase('create_account')}}</a></li>
                    <li><a href="{{URL_USERS_LOGIN}}" class="cs-nav-btn cs-responsive-menu"><span>{{getPhrase('sign_in')}}</span><i class="icon icon-User " aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- /TOP BAR -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" style="float:left;">
                    <span class="sr-only">Toggle navigation</span>
                    <span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                </button>
            </div>
            <div class="navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">
                <ul class="nav navbar-nav navbar-left navbar-main">

                    <li><a href="#">All Items </a></li>
                    <li><a href="#">Worpress</a></li>
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">Mareketing</a></li>
                    <li><a href="#">Ecommerce</a></li>
                    <li><a href="#">Freebie</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- /NAVIGATION -->
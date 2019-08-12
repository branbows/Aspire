 <!-- NAVIGATION -->
    <nav class="navbar navbar-default pw-navbar-default navbar-fixed-top">
        <!-- /TOP BAR -->
        <div class="cs-topbar">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo e(URL_HOME); ?>"><img src="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')); ?>" alt="logo" class="cs-logo" class="img-responsive" style="height: 40px;"></a>
                </div>
               
                <ul class="nav navbar-nav navbar-right" style="margin-top: 5px;">
                    <?php if(Auth::check()): ?>

                    <li><a href="<?php echo e(PREFIX); ?>" class="cs-nav-btn visible-lg"> <?php echo e(getPhrase('dashboard')); ?></a></li>
                    <li><a href="<?php echo e(URL_USERS_LOGOUT); ?>" class="cs-nav-btn visible-lg"> <?php echo e(getPhrase('logout')); ?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo e(URL_USERS_REGISTER); ?>" class="cs-nav-btn visible-lg"> <?php echo e(getPhrase('create_account')); ?></a></li>
                    <li><a href="<?php echo e(URL_USERS_LOGIN); ?>" class="cs-nav-btn cs-responsive-menu"><span><?php echo e(getPhrase('sign_in')); ?></span><i class="icon icon-User " aria-hidden="true"></i></a></li>
                    <?php endif; ?>
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

                <ul class="nav navbar-nav navbar-left navbar-main myheader">

                    <li <?php echo e(isActive($active_class, 'home')); ?> ><a href="<?php echo e(URL_HOME); ?>"><?php echo e(getPhrase('home')); ?></a></li>
                    <li <?php echo e(isActive($active_class, 'practice_exams')); ?> > <a href="<?php echo e(URL_VIEW_ALL_PRACTICE_EXAMS); ?>"><?php echo e(getPhrase('practice_exams')); ?></a></li>
                    <li <?php echo e(isActive($active_class, 'lms')); ?> ><a href="<?php echo e(URL_VIEW_ALL_LMS_CATEGORIES); ?>">LMS</a></li>
                    <li <?php echo e(isActive($active_class, 'courses')); ?> ><a href="<?php echo e(URL_VIEW_SITE_COURSES); ?>"><?php echo e(getPhrase('courses')); ?></a></li>
                    <li <?php echo e(isActive($active_class, 'pattren')); ?> ><a href="<?php echo e(URL_VIEW_SITE_PATTREN); ?>"><?php echo e(getPhrase('pattern')); ?></a></li>
                    <li <?php echo e(isActive($active_class, 'pricing')); ?> ><a href="<?php echo e(URL_VIEW_SITE_PRICING); ?>"><?php echo e(getPhrase('pricing')); ?></a></li>
                    <li <?php echo e(isActive($active_class, 'syllabus')); ?> ><a href="<?php echo e(URL_VIEW_SITE_SYALLABUS); ?>"><?php echo e(getPhrase('syllabus')); ?></a></li>
                    
                    <li <?php echo e(isActive($active_class, 'about-us')); ?> ><a href="<?php echo e(SITE_PAGES_ABOUT_US); ?>"><?php echo e(getPhrase('about_us')); ?></a></li>

                    <li <?php echo e(isActive($active_class, 'contact-us')); ?> ><a href="<?php echo e(URL_SITE_CONTACTUS); ?>"><?php echo e(getPhrase('contact_us')); ?></a></li>

                    <?php
                    $pages = \App\Page::where('status', 1)->get();
                    ?>

                    
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo e(getPhrase('more')); ?> <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                        <?php if(count($pages)>0): ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(URL_PAGE); ?><?php echo e($page->slug); ?>" alt="<?php echo e($page->name); ?>"> <?php echo e($page->name); ?> </a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>


                        <li><a href="<?php echo e(URL_HOME_BLOGS); ?>" alt="Blogs"> <?php echo e(getPhrase('blogs')); ?> </a></li>

                        <li><a href="<?php echo e(URL_FAQS); ?>" alt="FAQs"> <?php echo e(strtoupper(getPhrase('faqs'))); ?> </a></li>


                        

                        </ul>
                    </li>
                    
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- /NAVIGATION -->
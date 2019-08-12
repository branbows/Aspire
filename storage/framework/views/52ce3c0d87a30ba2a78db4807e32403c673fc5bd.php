
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div >
                        <img src="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')); ?>" alt="logo" class="img-responsive" style="height: 75px;">
                    </div>
                    
                    <h4 class="cs-footer-title"><?php echo e(getPhrase('follow_us_on')); ?></h4>
                    <?php 
                         $current_theme  = getDefaultTheme();  
                         $face_book      =  getThemeSetting('home_page_facebook_link',$current_theme);
                         $twitter        =  getThemeSetting('home_page_twitter_link',$current_theme);
                         $google_plus    =  getThemeSetting('home_page_googleplus_link',$current_theme);
                    ?>
                    <ul class="cs-social-share">
                        <li><a href="<?php echo e($face_book); ?>" target="_blank" class="brand-facebook"><i class="fa brand-color fa-facebook"></i></a></li>
                        <li><a href="<?php echo e($twitter); ?>" target="_blank" class="brand-twitter"><i class="fa brand-color fa-twitter"></i></a></li>
                        <li><a href="<?php echo e($google_plus); ?>" target="_blank" class="brand-pinterest"><i class="fa brand-color fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <h4 class="cs-footer-title">Need Help?</h4>
                            <ul class="cs-footer-links">
                                <li><a href="<?php echo e(URL_VIEW_ALL_PRACTICE_EXAMS); ?>"><?php echo e(getPhrase('practice_exams')); ?></a></li>
                                <li><a href="<?php echo e(URL_VIEW_ALL_LMS_CATEGORIES); ?>">LMS</a></li>
                                <li><a href="<?php echo e(SITE_PAGES_ABOUT_US); ?>"><?php echo e(getPhrase('about_us')); ?></a></li>
                                <li><a href="<?php echo e(URL_SITE_CONTACTUS); ?>"><?php echo e(getPhrase('contact_us')); ?></a></li>
                                <li><a href="<?php echo e(SITE_PAGES_TERMS); ?>"><?php echo e(getPhrase('terms_and_conditions')); ?></a></li>
                                <li><a href="<?php echo e(SITE_PAGES_PRIVACY); ?>"><?php echo e(getPhrase('privacy_and_policy')); ?></a></li>
                            </ul>
                        </div>
                      
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">

                    <h4 class="cs-footer-title">Email Newsletter</h4>
                   
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address" id="email1" required>
                        </div>

                    <button class="btn btn-primary btn-shadow btn-block" onclick="showSubscription()" ><?php echo e(getPhrase('subscribe')); ?></button>
                   
                </div>
            </div>
        </div>
    </footer>
    <div class="cs-copyrights">
        <div class="container">
            &copy; <?php echo e(getThemeSetting('copyrights',$current_theme)); ?>.
        </div>
    </div>
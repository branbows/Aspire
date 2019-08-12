<?php $__env->startSection('content'); ?>
 <!-- Hero Header -->
    <header class="hero-header" style="background: url(<?php echo e(IMAGE_PATH_SETTINGS.$home_back_image); ?>) center center no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="hero-content">
                        <h1 class="cs-hero-title"><?php echo e($home_title); ?></h1>
                        <div><a href="<?php echo e($home_link); ?>" class="btn btn-primary btn-hero" target="_blank">Get Started</a></div>
                    </div>
                </div>
                <div class="col-md-7">
                    

                        <img src="<?php echo e(IMAGE_PATH_SETTINGS.$home_image); ?>" alt="" class="animated fadeInUp img-responsive wow" data-wow-duration="900ms" data-wow-delay="300ms"  >

                      
                       
                   
                </div>
            </div>
        </div>
    </header>
    <!-- Hero Header -->

    <!-- Call to action -->
   
    <!-- Call to action -->

    
    <section class="cs-gray-bg">
        <div class="container">
            <div class="cs-row">
                <div class="row">
                    <div class="col-sm-12 text-center clearfix">
                        <h2 class="cs-section-head"><?php echo e(getPhrase('practice_exams_and_exam_categories')); ?></h2>

                        <ul class="nav nav-pills cs-nav-pills text-center">

                           <?php if(count($categories)): ?>

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                               <li><a href="<?php echo e(URL_VIEW_ALL_EXAM_CATEGORIES.'/'.$category->slug); ?>"><?php echo e($category->category); ?></a></li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           <?php else: ?>
                             <h4><?php echo e(getPhrase('no_practice_exams_are_available')); ?></h4> 

                           <?php endif; ?>  
                          
                        </ul>

                    </div>
                </div>





                <?php if(!empty($quizzes)): ?>
                <div class="row">


                    <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <div class="col-md-3 col-sm-6">

                        <!--Single EXAM-->
                            <div class="cs-product cs-animate">


                            <div class="info-box ribbon_box same_height">
                                <?php if($quiz->is_paid): ?>
                                <div class="ribbon green"><span> Premium Exam  </span></div>
                                <?php else: ?>
                               <div class="ribbon yellow"><span> Free Exam </span></div>
                                <?php endif; ?>  


                            <a href="">
                                <div class="cs-product-img">
                                    <?php if($quiz->image): ?>
                                    <img src="<?php echo e(IMAGE_PATH_EXAMS.$quiz->image); ?>" alt="exam" class="img-responsive">
                                    <?php else: ?>
                                    <img src="<?php echo e(IMAGE_PATH_EXAMS_DEFAULT); ?>" alt="exam" class="img-responsive">
                                    <?php endif; ?>
                                </div>
                            </a>


                            <div class="cs-product-content">
                             <a href="" class="cs-product-title text-center"><?php echo e(ucfirst($quiz->title)); ?></a>


                              <ul class="cs-card-actions mt-0">
                                    <li>
                                        <a href="#">Marks : <?php echo e((int)$quiz->total_marks); ?></a>
                                    </li>

                                    <li>  </li>

                                   
                                    <li class="cs-right">
                                        <a href="#"><?php echo e($quiz->dueration); ?> mins</a>

                                    </li>


                                </ul>


                                <div class="text-center mt-2">

                                    <?php if( $quiz->is_paid == 1): ?>
                                        
                                         <a href="<?php echo e(URL_START_EXAM_AFTER_LOGIN.$quiz->id); ?>" class="btn btn-blue btn-sm btn-radius"><?php echo e(getPhrase('start_exam')); ?></a>
                                          <?php if($quiz->is_paid): ?>

                                      <a href="#" style="float: right;"><?php echo e(getPhrase('price')); ?> : <?php echo e(getCurrencyCode()); ?> <?php echo e((int)$quiz->cost); ?>

                                      </a>

                                      <?php endif; ?>

                                      <?php else: ?>
                                       
                                       <a href="<?php echo e(URL_FRONTEND_START_EXAM.$quiz->slug); ?>" class="btn btn-blue btn-sm btn-radius"><?php echo e(getPhrase('start_exam')); ?></a>

                                     <?php endif; ?>
                                </div>


                            </div>


                            </div>

                        </div>
                        <!--Single EXAM-->





                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                   
                </div>
                 <?php endif; ?>  
              







              <?php if(count($categories)): ?>
                <div class="row text-center">
                    <ul class="list-inline top40">
                        <li><a href="<?php echo e(URL_VIEW_ALL_EXAM_CATEGORIES); ?>" class="btn btn-primary btn-shadow"><?php echo e(getPhrase('Browse_all_exams')); ?></a></li>
                    </ul>
                </div>
               <?php endif; ?> 
            </div>
        </div>
    </section>
    <!-- /End Quizzes -->

    

     <section class="cs-gr-bg">
        <div class="container">
            <div class="cs-row">
                <div class="row">
                    <div class="col-sm-12 text-center clearfix">
                        <h2 class="cs-section-head">LMS <?php echo e(getPhrase('categories')); ?></h2>

                        <ul class="nav nav-pills cs-nav-pills lms-cats text-center">
                           <?php if(isset($lms_cates)): ?>

                            <?php $__currentLoopData = $lms_cates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lms_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                               <li><a href="<?php echo e(URL_VIEW_ALL_LMS_CATEGORIES.'/'.$lms_category->slug); ?>"><?php echo e($lms_category->category); ?></a></li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           <?php else: ?>

                             <h4><?php echo e(getPhrase('no_categories_are_available')); ?></h4> 

                           <?php endif; ?>  
                          
                        </ul>

                    </div>
                </div>




                <div class="row">

                       <?php if(isset($lms_series)): ?>

                        <?php $__currentLoopData = $lms_series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $series): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                          <div class="col-md-3 col-sm-6">
                        <!-- Product Single Item -->
                       <div class="cs-product cs-animate">

                          <div class="info-box ribbon_box same_height">
                                    <?php if($series->is_paid): ?>
                                    <div class="ribbon green"><span> Paid Series  </span></div>
                                    <?php else: ?>
                                   <div class="ribbon yellow"><span> Free Series </span></div>
                                    <?php endif; ?> 

                            <a href="<?php echo e(URL_VIEW_LMS_CONTENTS.$series->slug); ?>">
                                <div class="cs-product-img">
                                    <?php if($series->image): ?>
                                    <img src="<?php echo e(IMAGE_PATH_UPLOAD_LMS_SERIES.$series->image); ?>" alt="exam" class="img-responsive">
                                    <?php else: ?>
                                    <img src="<?php echo e(IMAGE_PATH_EXAMS_DEFAULT); ?>" alt="exam" class="img-responsive">
                                    <?php endif; ?>
                                </div>
                            </a>
                            <ul class="cs-product-content mt-0">

                               
                           <li>  <a href="<?php echo e(URL_VIEW_LMS_CONTENTS.$series->slug); ?>" class="cs-product-title"><?php echo e(ucfirst($series->title)); ?></a></li>

                                    
                              <?php if($series->is_paid): ?>

                                      <li><a href="#" style="float: right;"><?php echo e(getPhrase('price')); ?> : <?php echo e(getCurrencyCode()); ?> <?php echo e((int)$series->cost); ?>

                                      </a></li>

                                      <?php endif; ?>

                                         <li>Total Items : <?php echo e($series->total_items); ?></li>

                               <div class="text-center mt-2">
                                 <a href="<?php echo e(URL_VIEW_LMS_CONTENTS.$series->slug); ?>" class=" btn btn-blue btn-sm btn-radius">View </a>
                            </div>
                            </ul>

                            </div>
                            
                        </div>
                        <!-- /Product Single Item -->
                    </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>  
                   
                </div>







                <?php if(isset($lms_cates)): ?>

                <div class="row text-center">
                    <ul class="list-inline top40">
                        <li><a href="<?php echo e(URL_VIEW_ALL_LMS_CATEGORIES); ?>" class="btn btn-primary btn-shadow"><?php echo e(getPhrase('Browse_all_categories')); ?></a></li>
                    </ul>
                </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

    





    <!--Testmonies-->
<?php if($testimonies): ?>
    <!-- TESTIMONIALS -->
<section class="testimonials">
    <div class="container">

        <div class="cs-row">
            <div class="row">
                <div class="col-sm-12 text-center clearfix">
                   <h2 class="cs-section-head">Hear it Directly from our Students</h2>
                </div>
            </div>

      <div class="row">
        <div class="col-sm-12">

            

          <div id="customers-testimonials" class="owl-carousel">


            <!--TESTIMONIAL 1 -->
            <?php $__currentLoopData = $testimonies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testmony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
              <div class="shadow-effect">
                <img class="img-circle" src="<?php echo e(getProfilePath($testmony->image, 'thumb')); ?>" alt="<?php echo e($testmony->name); ?>">
                <p><?php echo e($testmony->description); ?></p>
              </div>
              <div class="testimonial-name"><?php echo e($testmony->name); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--END OF TESTIMONIAL 1 -->

          </div>
        </div>
      </div>


      </div>


      </div>
    </section>
    <!-- END OF TESTIMONIALS -->
<?php endif; ?>
    <!--Testmonies-->









        <!-- Info Boxes -->
    <section class="cs-gray-bg">
        <div class="container">
            <div class="row cs-row">
                <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <!-- Info Box  Centered Single Item -->
                    <div class="cs-info-box-center">
                        <img src="<?php echo e(IMAGES); ?>icn-cup.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h4><?php echo e(getPhrase('free_exams')); ?></h4>
                        
                    </div>
                    <!-- /Info Box Centered  Single Item -->
                </div>
                <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <!-- Info Box  Centered Single Item -->
                    <div class="cs-info-box-center">
                        <img src="<?php echo e(IMAGES); ?>icn-computer.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="600ms">
                        <h4><?php echo e(getPhrase('paid_exams')); ?></h4>
                        
                    </div>
                    <!-- /Info Box Centered  Single Item -->
                </div>
                <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
                    <!-- Info Box  Centered Single Item -->
                    <div class="cs-info-box-center">
                        <img src="<?php echo e(IMAGES); ?>icn-sett.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="900ms">
                        <h4><?php echo e(getPhrase('learning_management_system')); ?></h4>
                       
                    </div>
                    <!-- /Info Box Centered  Single Item -->
                </div>
            </div>
        </div>
    </section>
    <!-- /Info Boxes -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
 

<script>
  $(".cs-nav-pills li").first().addClass("active");
  $(".lms-cats li").first().addClass("active");
</script>


<script src="<?php echo e(themes('site/js/testimonies/jquery.min.js')); ?>"></script>
<script src="<?php echo e(themes('site/js/testimonies/owl.carousel.min.js')); ?>"></script>

<script>
jQuery(document).ready(function($) {
    "use strict";
    //  TESTIMONIALS CAROUSEL HOOK
    $('#customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots:true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1170: {
            items: 3
          }
        }
    });
});
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.sitelayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
@extends('layouts.sitelayout')

@section('content')
 <!-- Hero Header -->
    <header class="hero-header" style="background: url({{IMAGE_PATH_SETTINGS.$home_back_image}}) center center no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="hero-content">
                        <h1 class="cs-hero-title">{{$home_title}}</h1>
                        <div><a href="{{$home_link}}" class="btn btn-primary btn-hero" target="_blank">Get Started</a></div>
                    </div>
                </div>
                <div class="col-md-7">
                    

                        <img src="{{IMAGE_PATH_SETTINGS.$home_image}}" alt="" class="animated fadeInUp img-responsive wow" data-wow-duration="900ms" data-wow-delay="300ms"  >

                      {{--   <img src="{{{{IMAGES}}hero-img1.png}}" alt="" class="animated fadeInUp hero-img1 wow" data-wow-duration="900ms" data-wow-delay="300ms">
                        <img src="{{IMAGES}}hero-img2.png" alt="" class="animated fadeInUp hero-img2 wow" data-wow-duration="900ms" data-wow-delay="600ms"> --}}
                       
                   
                </div>
            </div>
        </div>
    </header>
    <!-- Hero Header -->

    <!-- Call to action -->
   {{--  <section class="cs-primary-bg cs-call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <h2>Get our latest update or inspiration directly in your inbox</h2>
                </div>
                <div class="col-md-7 col-sm-6">

                    <div class="form-inline">

                        <div class="form-group ">

                            <input type="email" class="form-control" id="email" placeholder="Your email address" required>
                        </div>

                        <button class="btn btn-secondary" onclick="showSubscription('yes')">{{getPhrase('subscribe')}}</button>

                    </div>

                </div>
            </div>
        </div>
    </section> --}}
    <!-- Call to action -->

    {{-- Quizzes --}}
    <section class="cs-gray-bg">
        <div class="container">
            <div class="cs-row">
                <div class="row">
                    <div class="col-sm-12 text-center clearfix">
                        <h2 class="cs-section-head">{{getPhrase('practice_exams_and_exam_categories')}}</h2>

                        <ul class="nav nav-pills cs-nav-pills text-center">

                           @if(count($categories))

                            @foreach($categories as $category)

                               <li><a href="{{URL_VIEW_ALL_EXAM_CATEGORIES.'/'.$category->slug}}">{{$category->category}}</a></li>

                            @endforeach

                           @else
                             <h4>{{getPhrase('no_practice_exams_are_available')}}</h4> 

                           @endif  
                          
                        </ul>

                    </div>
                </div>





                @if(!empty($quizzes))
                <div class="row">


                    @foreach($quizzes as $quiz) 
                    <div class="col-md-3 col-sm-6">

                        <!--Single EXAM-->
                            <div class="cs-product cs-animate">


                            <div class="info-box ribbon_box same_height">
                                @if($quiz->is_paid)
                                <div class="ribbon green"><span> Premium Exam  </span></div>
                                @else
                               <div class="ribbon yellow"><span> Free Exam </span></div>
                                @endif  


                            <a href="">
                                <div class="cs-product-img">
                                    @if($quiz->image)
                                    <img src="{{IMAGE_PATH_EXAMS.$quiz->image}}" alt="exam" class="img-responsive">
                                    @else
                                    <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="exam" class="img-responsive">
                                    @endif
                                </div>
                            </a>


                            <div class="cs-product-content">
                             <a href="" class="cs-product-title text-center">{{ucfirst($quiz->title)}}</a>


                              <ul class="cs-card-actions mt-0">
                                    <li>
                                        <a href="#">Marks : {{(int)$quiz->total_marks}}</a>
                                    </li>

                                    <li>  </li>

                                   
                                    <li class="cs-right">
                                        <a href="#">{{$quiz->dueration}} mins</a>

                                    </li>


                                </ul>


                                <div class="text-center mt-2">

                                    @if( $quiz->is_paid == 1)
                                        
                                         <a href="{{ URL_START_EXAM_AFTER_LOGIN.$quiz->id }}" class="btn btn-blue btn-sm btn-radius">{{getPhrase('start_exam')}}</a>
                                          @if($quiz->is_paid)

                                      <a href="#" style="float: right;">{{getPhrase('price')}} : {{getCurrencyCode()}} {{(int)$quiz->cost}}
                                      </a>

                                      @endif

                                      @else
                                       
                                       <a href="{{ URL_FRONTEND_START_EXAM.$quiz->slug }}" class="btn btn-blue btn-sm btn-radius">{{getPhrase('start_exam')}}</a>

                                     @endif
                                </div>


                            </div>


                            </div>

                        </div>
                        <!--Single EXAM-->





                    </div>
                    @endforeach
                    
                   
                </div>
                 @endif  
              







              @if(count($categories))
                <div class="row text-center">
                    <ul class="list-inline top40">
                        <li><a href="{{URL_VIEW_ALL_EXAM_CATEGORIES}}" class="btn btn-primary btn-shadow">{{getPhrase('Browse_all_exams')}}</a></li>
                    </ul>
                </div>
               @endif 
            </div>
        </div>
    </section>
    <!-- /End Quizzes -->

    {{-- LMS Categories --}}

     <section class="cs-gr-bg">
        <div class="container">
            <div class="cs-row">
                <div class="row">
                    <div class="col-sm-12 text-center clearfix">
                        <h2 class="cs-section-head">LMS {{getPhrase('categories')}}</h2>

                        <ul class="nav nav-pills cs-nav-pills lms-cats text-center">
                           @if(isset($lms_cates))

                            @foreach($lms_cates as $lms_category)

                               <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$lms_category->slug}}">{{$lms_category->category}}</a></li>

                            @endforeach

                           @else

                             <h4>{{getPhrase('no_categories_are_available')}}</h4> 

                           @endif  
                          
                        </ul>

                    </div>
                </div>




                <div class="row">

                       @if(isset($lms_series))

                        @foreach($lms_series as $series) 
                          <div class="col-md-3 col-sm-6">
                        <!-- Product Single Item -->
                       <div class="cs-product cs-animate">

                          <div class="info-box ribbon_box same_height">
                                    @if($series->is_paid)
                                    <div class="ribbon green"><span> Paid Series  </span></div>
                                    @else
                                   <div class="ribbon yellow"><span> Free Series </span></div>
                                    @endif 

                            <a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}">
                                <div class="cs-product-img">
                                    @if($series->image)
                                    <img src="{{IMAGE_PATH_UPLOAD_LMS_SERIES.$series->image}}" alt="exam" class="img-responsive">
                                    @else
                                    <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="exam" class="img-responsive">
                                    @endif
                                </div>
                            </a>
                            <ul class="cs-product-content mt-0">

                               
                           <li>  <a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}" class="cs-product-title">{{ucfirst($series->title)}}</a></li>

                                    
                              @if($series->is_paid)

                                      <li><a href="#" style="float: right;">{{getPhrase('price')}} : {{getCurrencyCode()}} {{(int)$series->cost}}
                                      </a></li>

                                      @endif

                                         <li>Total Items : {{$series->total_items}}</li>

                               <div class="text-center mt-2">
                                 <a href="{{URL_VIEW_LMS_CONTENTS.$series->slug}}" class=" btn btn-blue btn-sm btn-radius">View </a>
                            </div>
                            </ul>

                            </div>
                            
                        </div>
                        <!-- /Product Single Item -->
                    </div>

                        @endforeach
                     @endif  
                   
                </div>







                @if(isset($lms_cates))

                <div class="row text-center">
                    <ul class="list-inline top40">
                        <li><a href="{{URL_VIEW_ALL_LMS_CATEGORIES}}" class="btn btn-primary btn-shadow">{{getPhrase('Browse_all_categories')}}</a></li>
                    </ul>
                </div>

                @endif

            </div>
        </div>
    </section>

    {{-- End LMS Categories --}}





    <!--Testmonies-->
@if ($testimonies)
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
            @foreach ($testimonies as $testmony)
            <div class="item">
              <div class="shadow-effect">
                <img class="img-circle" src="{{ getProfilePath($testmony->image, 'thumb') }}" alt="{{$testmony->name}}">
                <p>{{$testmony->description}}</p>
              </div>
              <div class="testimonial-name">{{$testmony->name}}</div>
            </div>
            @endforeach
            <!--END OF TESTIMONIAL 1 -->

          </div>
        </div>
      </div>


      </div>


      </div>
    </section>
    <!-- END OF TESTIMONIALS -->
@endif
    <!--Testmonies-->









        <!-- Info Boxes -->
    <section class="cs-gray-bg">
        <div class="container">
            <div class="row cs-row">
                <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <!-- Info Box  Centered Single Item -->
                    <div class="cs-info-box-center">
                        <img src="{{IMAGES}}icn-cup.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h4>{{getPhrase('free_exams')}}</h4>
                        
                    </div>
                    <!-- /Info Box Centered  Single Item -->
                </div>
                <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <!-- Info Box  Centered Single Item -->
                    <div class="cs-info-box-center">
                        <img src="{{IMAGES}}icn-computer.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="600ms">
                        <h4>{{getPhrase('paid_exams')}}</h4>
                        
                    </div>
                    <!-- /Info Box Centered  Single Item -->
                </div>
                <div class="col-sm-4 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
                    <!-- Info Box  Centered Single Item -->
                    <div class="cs-info-box-center">
                        <img src="{{IMAGES}}icn-sett.png" alt="" class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="900ms">
                        <h4>{{getPhrase('learning_management_system')}}</h4>
                       
                    </div>
                    <!-- /Info Box Centered  Single Item -->
                </div>
            </div>
        </div>
    </section>
    <!-- /Info Boxes -->

@stop

@section('footer_scripts')
 

<script>
  $(".cs-nav-pills li").first().addClass("active");
  $(".lms-cats li").first().addClass("active");
</script>


<script src="{{themes('site/js/testimonies/jquery.min.js')}}"></script>
<script src="{{themes('site/js/testimonies/owl.carousel.min.js')}}"></script>

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

@stop


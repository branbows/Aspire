@extends('layouts.sitelayout')

@section('content')

   <div class="cs-gray-bg" style="margin-top: 101px;">
        <div class="container">
            <div class="row cs-row">
                <!-- Side Bar -->
                <div class="col-md-3">
                    <!-- Icon List  -->
                    <ul class="cs-icon-list">

                    @if(count($categories))

                         @foreach($categories as $category)

                          <li id={{$category->slug}}><a href="{{URL_VIEW_ALL_EXAM_CATEGORIES.'/'.$category->slug}}">{{$category->category}}</a></li>

                          @endforeach

	                   @else

	                     <h4>No Exams Are Available</h4> 

	               @endif 
                       
                    </ul>
                    <!-- /Icon List  -->
                </div>




                <!-- Main Section -->
            @if(count($quizzes))

                <div class="col-md-9">

                    <!--search-->
                    <div class="row">
                        <div class="col-sm-12">
                           <form action="{{URL_VIEW_ALL_EXAM_CATEGORIES}}/{{$quiz_slug}}" method="GET" role="search">
                                
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search_term"
                                        placeholder="Search Exams.." value="{{$search_term}}" onfocus="this.value=''"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--search-->







                    <!-- Product Filter Bar -->
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="cs-filter-bar clearfix">
                                <li class="active"><a href="#">{{$title}} {{getPhrase('exams')}}</a></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>



                    <!-- Products Grid -->
                    <div class="row">
                  
                    @foreach($quizzes as $quiz)	

                        <div class="col-md-4 col-sm-6">
                        <!-- Product Single Item -->
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
                        <!-- /Product Single Item -->
                    </div>

                     @endforeach 
                       
                    </div>






                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-sm-12">
                            <ul class="pagination cs-pagination ">
                                {{ $quizzes->links() }}
                            </ul>
                        </div>
                    </div>
                    <!-- /Pagination -->
                </div>
                @else

                <div class="col-sm-9">
                    <h4 class="text-center search-no">No Quizzes Available..</h4>
                </div>
                @endif
            </div>
        </div>
    </div>


@stop

@section('footer_scripts')
<script>
	var my_slug  = "{{$quiz_slug}}";

	if(!my_slug){

        $(".cs-icon-list li").first().addClass("active");
    }
    else{

    	$("#"+my_slug).addClass("active");
    }
</script>
@stop
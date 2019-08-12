@extends('layouts.sitelayout')

 @section('content')
     
      <div class="page-title section lb">
            <div class="container">
                <div class="clearfix">
                    <div class="title-area pull-left">
                        <h2>Category <small>Online Exam is to enhance their subject skills to come out with flying colors from the cut-throat competition.</small></h2> </div>
                    <!-- /.pull-right -->
                    <div class="pull-right hidden-xs">
                        <div class="bread">
                            <ol class="breadcrumb">
                                <li><a href="{{PREFIX}}">Home</a></li>
                                <li class="active">Category</li>
                            </ol>
                        </div>
                        <!-- end bread -->
                    </div>
                    <!-- /.pull-right -->
                </div>
                <!-- end clearfix -->
            </div>
        </div>
        <!-- end page-title -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 st-majorr">
                        <nav class="portfolio-filter text-center">

                            <ul class="list-inline">
                                <li><a class="btn btn-default st-mocks" href="#" data-filter="*"><span class="oi hidden-xs" data-glyph="grid-three-up"></span> All</a></li>
                                <?php $i = 1; $j =1; ?>

                                @foreach($categories as $category)
                               

                                <li><a class="btn btn-default st-mocks" data-toggle="tooltip" data-placement="top" title="" href="#" data-filter=".cat{{$i++}}" data-original-title="{{App\Quiz::where('category_id',$category->id)
                                ->where('show_in_front',1)->where('is_paid',0)->get()->count()}}">{{$category->category}}</a></li>

                                @endforeach

                            
                            </ul>
                        </nav>
                    </div>
                </div>
                <hr class="invis">
                <div class="portfolio isotope">

                    @foreach($categories as $category)

                    <?php

                
                      $quizzes  = App\Quiz::where('category_id',$category->id)
                                            ->where('show_in_front',1)
                                            ->where('total_marks', '!=', 0)
                                            ->where('start_date', '<=', date('Y-m-d'))
                                            ->where('end_date' ,'>=' ,date('Y-m-d') )
                                            ->get();

                    ?>

                    @foreach($quizzes as $quiz)

                    <div class="pitem gallery-item item-w1 item-h1 cat{{$j}} isotope-item" >
                        <div class="video-wrapper course-widget clearfix">
                             <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                    <h4>{{$category->category}}</h4>
                                    <table class="table table-striped st-border-table table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Name of Exam</th>
                                                <th class="text-center">No. of Questions</th>
                                                <th class="text-center">Maximum Marks</th>
                                                <th class="text-center">Duration</th>
                                                <th class="text-center">Start</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">{{$quiz->title}}</td>
                                                <td class="text-center">{{$quiz->total_questions}}</td>
                                                <td class="text-center">{{$quiz->total_marks}}</td>
                                                <td class="text-center">{{$quiz->dueration}}</td>

                                                <td class="text-center"><a type="button" class="btn btn-success btn-xs" href="{{URL_FRONTEND_START_EXAM.$quiz->slug}}" style="border-radius: 10px; ">Take Exam</a></td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                       @endforeach

                       <?php $j++; ?>

                    @endforeach

                    
                </div>
                
               
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
     


 @stop


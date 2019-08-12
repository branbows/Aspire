@extends('layouts.examlayout')

@section('content')



<div onload="noback();" onpageshow="if (event.persisted) noBack();" id="page-wrapper" ng-model="academia" ng-controller="instructions">
			<div class="container-fluid">
				
				<!-- /.row -->
				
	<div class="panel panel-custom col-lg-12" >
					<div class="panel-heading">
						<h1>{{getPhrase('Instructions')}} <span class="pull-right text-italic">{{getPhrase('please_read_the_instructions_carefully')}}</span></h1>

					</div>
					<div class="panel-body instruction no-arrow">

						<div class="row">
							<div class="col-md-12">
								<h2>{{getPhrase('exam_name')}}:   {{$record->title}} </h2>
								@if($instruction_data=='')	
								<h3>{{getPhrase('general_instructions')}}:</h3>
								@else
								<h3>{{$instruction_title}}:</h3>
								@endif
								@if($instruction_data=='')			
								<ol>
									<li>Total of {{$record->dueration}} minutes duration will be given to attempt all the questions.</li>
									<li>The clock has been set at the server and the countdown timer at the top right corner of your screen will display the time remaining for you to complete the exam. When the clock runs out the exam ends by default - you are not required to end or submit your exam.</li>
									<li>The question palette at the right of screen shows one of the following statuses of each of the questions numbered:</li>
								</ol>
								@else 
								{!! $instruction_data !!}
								@endif

								<ul class="guide">
									<li>
										<span class="answer"><i class="mdi mdi-check"></i></span> You have answered the question.
									</li>
									<li>
										<span class="notanswer"><i class="mdi mdi-close"></i></span> You have not answered the question.
									</li>
									<li>
										<span class="marked"><i class="mdi mdi-eye"></i></span> You have answered the question but have marked the question for review.
									</li>
									<li>
										<span class="notvisited"><i class="mdi mdi-eye-off"></i></span> You have not visited the question yet.
									</li>
								</ul>

							</div>

						</div>


						<hr>
					
						<div class="form-group row">
						{!! Form::open(array('url' => 'frontend/start-exam/'.$record->slug, 'method' => 'POST')) !!}
							<div class="col-md-12">

								<input type="checkbox" name="option" id="free" checked="" ng-model="agreeTerms">
								<label for="free" > <span class="fa-stack checkbox-button"> <i class="mdi mdi-check active"></i> </span> The computer provided to me is in proper working condition. I have read and understood the instructions given above. </label>
								
								<br><span class="text-danger" ng-show="!agreeTerms">{{ getPhrase('please_accept_terms_and_conditions')}}</span> 

								<div class="text-center">
									
                                      <button ng-if="agreeTerms" class="btn button btn-lg btn-success">{{getPhrase('start_exam')}}</button>

								</div>

							</div>
					{!! Form::close() !!}

						</div>


					</div>
				</div>
			</div>

		</div>
		
        
       
@endsection
@section('footer_scripts')
  <script src="{{JS}}angular.js"></script>

  <script>

 var app = angular.module('academia', []);
app.controller('instructions', function($scope, $http) {
	
});
</script>

@stop

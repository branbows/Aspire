 @extends($layout)
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 
							<li>{{ $title}}</li>
						</ol>
					</div>
				</div>
				 <div class="row">
			
 
		 			<div class="col-md-4 col-sm-6">
 		<div class="media state-media box-ws">
 			<div class="media-left">
 				<a href="{{URL_STUDENT_EXAM_CATEGORIES}}"><div class="state-icn bg-icon-info"><i class="fa fa-list-alt"></i></div></a>
 			</div>
 			<div class="media-body">
 				<h4 class="card-title">{{ count(App\User::getUserSeleted('categories'))}}</h4>
				<a href="{{URL_STUDENT_EXAM_CATEGORIES}}">{{ getPhrase('quiz_categories')}}</a>
 			</div>
 		</div>
 	</div>    
 	<div class="col-md-4 col-sm-6">
 		<div class="media state-media box-ws">
 			<div class="media-left">
 				<a href="{{URL_STUDENT_EXAM_ALL}}"><div class="state-icn bg-icon-pink"><i class="fa fa-desktop"></i></div></a>
 			</div>
 			<div class="media-body">
 				<h4 class="card-title">{{ App\User::getUserSeleted('quizzes') }}</h4>
				<a href="{{URL_STUDENT_EXAM_ALL}}">{{ getPhrase('quizzes')}}</a>
 			</div>
 		</div>
 	</div> 
 	<div class="col-md-4 col-sm-6">
 		<div class="media state-media box-ws">
 			<div class="media-left">
 				<a href="{{URL_PARENT_CHILDREN}}"><div class="state-icn bg-icon-purple"><i class="fa fa-user-circle"></i></div></a>
 			</div>
 			<div class="media-body">
 				<h4 class="card-title">{{ App\User::where('parent_id', '=', $user->id)->get()->count()}}</h4>
				<a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('children')}}</a>
 			</div>
 		</div>
 	</div>
 	

				 
				</div>
				<div class="row">
					<div class="col-md-6">
					     <div class="panel panel-custom">
					      <div class="panel-heading">{{getPhrase('latest_quizzes')}}</div>
					      @if(!count($latest_quizzes))
					      <br>
					 		 <p> &nbsp;&nbsp;&nbsp;{{getPhrase('no_quizzes_available')}}</p>
					 		 <p> &nbsp;&nbsp;&nbsp; <a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}">{{getPhrase('click_here')}}</a> {{getPhrase('to_change_your_settings')}}</p>
					 	 @else

					    	<table class="table">	
					    	<thead>
					    		<tr>
					    			<th>{{getPhrase('title')}}</th>
					    			<th>{{getPhrase('type')}}</th>
					    			<th>{{getPhrase('Action')}}</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    	@foreach($latest_quizzes as $quiz)
					 			<tr>
					 				<td>{{$quiz->title}}</td>
					 				<td>
					 				@if($quiz->is_paid)
					 					<span class="label label-danger">{{getPhrase('paid')}}
					 					</span>
				 					@else
				 					<span class="label label-success">{{getPhrase('free')}}
					 					</span>
				 					@endif
					 				</td>
					 				<td>
					 				@if($quiz->is_paid)
					 					<a class="btn btn-smoke" href="{{URL_PAYMENTS_CHECKOUT.'exam/'.$quiz->slug}}">{{getPhrase('buy_now')}}</a> 
				 					@else
				 					-
				 					@endif
					 				</td>
					 			</tr>
					 		@endforeach

					    	</tbody>
					    	</table>  
					    @endif
					     
					    </div>
					 
					 	
					 
					</div>

						<div class="col-md-6">
					     <div class="panel panel-custom">
					      <div class="panel-heading">{{getPhrase('latest')}} LMS {{getPhrase('series')}}</div>
					      @if(!count($latest_series))
					      <br>
					 		 <p> &nbsp;&nbsp;&nbsp;{{getPhrase('no_series_available')}}</p>
					 		 <p> &nbsp;&nbsp;&nbsp; <a href="{{URL_USERS_SETTINGS.Auth::user()->slug}}">{{getPhrase('click_here')}}</a> {{getPhrase('to_change_your_settings')}}</p>
					 	 @else

					    	<table class="table">	
					    	<thead>
					    		<tr>
					    			<th>{{getPhrase('title')}}</th>
					    			<th>{{getPhrase('type')}}</th>
					    			<th>{{getPhrase('Action')}}</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    	@foreach($latest_series as $series)
					 			<tr>
					 				<td>{{$series->title}}</td>
					 				<td>
					 				@if($series->is_paid)
					 					<span class="label label-danger">{{getPhrase('paid')}}
					 					</span>
				 					@else
				 					<span class="label label-success">{{getPhrase('free')}}
					 					</span>
				 					@endif
					 				</td>
					 				<td>
					 				@if($series->is_paid)
					 					<a class="btn btn-smoke" href="{{URL_PAYMENTS_CHECKOUT.'lms/'.$series->slug}}">{{getPhrase('buy_now')}}</a> 
				 					@else
				 					-
				 					@endif
					 				</td>
					 			</tr>
					 		@endforeach

					    	</tbody>
					    	</table>  
					    @endif
					     
					    </div>
					 
					 	
					 
					</div>

					 

				 
				</div>
				 
			 
			</div>
			<!-- /.container-fluid -->
</div>
		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')
  
@stop
@extends('front-exams.examlayout-front')

@section('header_scripts')

@stop

@section('content')

<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->

				<div class="row">

					<div class="col-lg-12">

						<ol class="breadcrumb">

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

							 <li class="active"> {{$title}} </li>

						</ol>

					</div>

				</div>

				<!-- /.row -->

				<div class="panel panel-custom">

					<div class="panel-heading">

						<h1>{{getPhrase('result_for'). ' '.$title}}</h1></div>

					<div class="panel-body">

							

						<hr>
 

						<div class="panel-body">

						<ul class="library-statistic">

							<li class="total-books">

								{{getPhrase('score') }} <span>{{$marks_obtained}} / {{$total_marks}}</span>

							</li>

							<li class="total-journals">

								{{getPhrase('percentage')}} <span><?php echo sprintf('%0.2f', $percentage); ?></span>

							</li>

							<li class="digital-items">

							<?php $grade_system = getSettings('general')->gradeSystem; ?>

								{{ getPhrase('result')}} <span>{{  ucfirst($exam_status) }}</span>

							</li>

						</ul>

				 

					<div class="row" >

					<div class="col-md-6">

					 
						 @if(isset($marks_data))

	 						<div class="row">

						

							<?php $ids=[];?>

							@for($i=0; $i<count($marks_data); $i++)

							<?php 

							$newid = 'myMarksChart'.$i;

							$mark_ids[] = $newid; ?>

							

							 

								<canvas id="{{$newid}}" width="100" height="60"></canvas>

							 



							@endfor

							</div>

						@endif



					</div>

					<div class="col-md-6">

						

					@if(isset($time_data))

	 						<div class="row">

						

							<?php $ids=[];?>

							@for($i=0; $i<count($time_data); $i++)

							<?php 

							$newid = 'myTimeChart'.$i;

							$time_ids[] = $newid; ?>

								<canvas id="{{$newid}}" width="100" height="60"></canvas>

							@endfor

							</div>

						@endif



					</div>

					</div>

					<br/>
					 
					<div class="row">

						<div class="col-lg-12 text-center">

							{{-- <a onClick="setLocalItem('{{PREFIX}}')" href="javascript:void(0);" class="btn t btn-primary">{{ getPhrase('close') }}</a> --}}

								<a href="{{PREFIX}}" class="btn t btn-primary">{{ getPhrase('close') }}</a>

						</div>

					</div>	
					 
					</div>





					</div>



				</div>

			</div>

			<!-- /.container-fluid -->

		</div>

		<!-- /#page-wrapper -->

	</div>

	<!-- /#wrapper -->

	 

@stop



@section('footer_scripts')

   <script src="{{JS}}chart-vue.js"></script>



@if(isset($marks_data))

	@include('common.chart', array('chart_data'=>$marks_data,'ids' => $mark_ids))

@endif

@if(isset($time_data))

	@include('common.chart', array('chart_data'=>$time_data,'ids' => $time_ids))

@endif

<script>
function setLocalItem(url) {
	localStorage.setItem('redirect_url',url);
	window.close();
}
</script>

@stop
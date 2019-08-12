@extends('layouts.admin.adminlayout')

 @section('custom_div')

 <div ng-controller="prepareQuestions">

 @stop

@section('content')

<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->

				<div class="row">

					<div class="col-lg-12">

						<ol class="breadcrumb">

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

							<li><a href="{{URL_QUIZZES}}">{{ getPhrase('quizzes')}}</a></li>

							<li class="active">{{isset($title) ? $title : ''}}</li>

						</ol>

					</div>

				</div>

					@include('errors.errors')
					
				<?php $settings = ($record) ? $settings : ''; ?>

				<div class="panel panel-custom" ng-init="initAngData({{$settings}});" >

					<div class="panel-heading">

						<div class="pull-right messages-buttons">

							<a href="{{URL_QUIZZES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>

						</div>

					<h1>{{ $title }}  </h1>

					</div>

					<div class="panel-body" >

					<?php $button_name = getPhrase('create'); ?>

					 		<div class="row">
					 		<div class="col-md-6">

							<fieldset class="form-group col-md-6">

								{{ Form::label('subject', getphrase('subjects')) }}

								<span class="text-red">*</span>

								{{Form::select('subject', $subjects, null, ['class'=>'form-control', 'ng-model' => 'subject_id', 

								'placeholder' => 'Select', 'ng-change'=>'subjectChanged(subject_id)' ])}}

							</fieldset>



							 

								<fieldset class="form-group col-md-6">

								{{ Form::label('difficulty', getphrase('difficulty')) }}

								

								

								<select ng-model="difficulty" class="form-control" >

								<option value="">{{getPhrase('select')}}</option>	

								<option value="easy">{{getPhrase('easy')}}</option>	

								<option value="medium">{{getPhrase('medium')}}</option>	

								<option value="hard">{{getPhrase('hard')}}</option>	

								</select>

								</fieldset>



								<fieldset class="form-group col-md-6">

								{{ Form::label('question_type', getphrase('question_type')) }}

								<select ng-model="question_type" class="form-control" >

									<option selected="selected" value="">{{getPhrase('select')}}</option>

									<option value="radio">{{getPhrase('single_answer')}}</option>

									<option value="checkbox">{{getPhrase('multi_answer')}}</option>


									<option value="blanks">{{getPhrase('fill_in_the_blanks')}}</option>

									<option value="match">{{getPhrase('match_the_following')}}</option>

									<option value="para">{{getPhrase('paragraph')}}</option>

									<option value="video">{{getPhrase('video')}}</option>

								</select>

								</fieldset>

								<!-- <fieldset class="form-group col-md-6">

								{{ Form::label('show_in_front_end', getphrase('show_in_front_end')) }}

								<select ng-model="show_in_front_end" class="form-control" >

									<option selected="selected" value="">{{getPhrase('select')}}</option>

									<option value="1">{{getPhrase('yes')}}</option>

									<option value="0">{{getPhrase('no')}}</option>


									

								</select>

								</fieldset> -->



								<!-- <fieldset class="form-group col-md-6">

								{{ Form::label('searchTerm', getphrase('search_term')) }}

								{{ Form::text('searchTerm', $value = null , $attributes = array('class'=>'form-control', 

						'placeholder' => getPhrase('enter_search_term'),

						'ng-model'=>'searchTerm')) }}

								</fieldset> -->


								<fieldset class="form-group col-md-6">

								{{ Form::label('question_model', 'Enter search term') }}

								{{ Form::text('question_model', $value = null , $attributes = array('class'=>'form-control', 

						'placeholder' => getPhrase('enter_search_term'),

						'ng-model'=>'question_model')) }}

								</fieldset>

							{{-- 
								CODES USED WITH EXAM TYPE
								NSNT==> NO SECTION NO TIMER 
								SNT==> SECTION WITH NO TIMER 
								ST==> SECTION WITH TIMER 
							--}}
						 
							@if($record->exam_type!='NSNT')
							
								<fieldset class="form-group col-md-6">

								{{ Form::label('section_name', 'Section Name') }}

								{{ Form::text('section_name', $value = null , $attributes = array('class'=>'form-control', 

						       'placeholder' => 'Section name',

						        'ng-model'=>'section_name')) }}

								</fieldset>

								@endif


							  @if($record->exam_type != 'NSNT' && $record->exam_type != 'SNT')	

								<fieldset class="form-group col-md-6">

								{{ Form::label('section_time', 'Section Time In Minutes') }}

								{{ Form::text('section_time', $value = null , $attributes = array('class'=>'form-control', 

									'placeholder' => 'Section Time',

									'ng-model'=>'section_time')) }}

								</fieldset>

								@endif

							

								

								{{-- <a ng-click="subjectChanged()"><i class="fa fa-refresh pull-right text-info"></i></a> --}}

								<div class="col-md-12" ng-show="contentAvailable">



								

							<div ng-if="subjectQuestions!=''" class="vertical-scroll" >

						

								<h4 class="text-success">Questions @{{ subjectQuestions.length }} </h4>



								<table  

								  class="table table-hover">

  									 

									<th >{{getPhrase('subject')}}</th>

									<th>{{getPhrase('question')}}</th>

									<th>{{getPhrase('difficulty')}}</th>

									<th>{{getPhrase('type')}}</th>

									<th>{{getPhrase('marks')}}</th>	

									<th>{{getPhrase('action')}}</th>	

								
									<tr ng-repeat="question in subjectQuestions | filter: { difficulty_level:difficulty, question_type:question_type, show_in_front_end:show_in_front_end , topic_id:topic, sub_topic_id:sub_topic } | filter: question_model track by $index ">

										 

										<td>@{{subject.subject_title}}</td>

										<td title="@{{subjectQuestions[$index].question}}" ng-bind-html="trustAsHtml(question.question)">

										
										</td>

										

										<td>@{{question.difficulty_level | uppercase}}</td>

										<td>@{{question.question_type | uppercase}}</td>

										<td>@{{question.marks}}</td>

										<td><a 

										 

										ng-click="addQuestion(question, subject);" class="btn btn-primary" >{{getPhrase('add')}}</a>

									  		

										  </td>

										

									</tr>

								</table>

								</div>	

							



					 			</div>



					 		</div>

					 			 <div class="col-md-6">
					 			 	@include('exams.quiz.questions-selection-block')
					 			 </div>
					 		</div>

					 

					</div>



				</div>

			</div>

			<!-- /.container-fluid -->

		</div>

		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')

@include('exams.quiz.scripts.js-scripts', ['quiz_record' => $record])
@include('common.alertify')

@stop

 

@section('custom_div_end')

 </div>

@stop
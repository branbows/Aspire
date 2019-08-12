

	

	<div class="crearfix selected-questions-details">

		<span class="pull-left" ng-if="is_have_section==0">{{getPhrase('saved_questions')}} (@{{savedQuestions.length}})</span>
		<span class="pull-left" ng-if="is_have_section==1">Total Sections (@{{keys.length}})
 
		</span>

		<span class="pull-right">{{getPhrase('total_marks')}}: @{{ totalMarks }}</span>

	</div>	
 


	{!! Form::open(array('url' => URL_QUIZ_UPDATE_QUESTIONS.$record->slug, 'method' => 'POST')) !!}

					 	<input ng-if="is_have_section==0" type="hidden" name="saved_questions" value="@{{savedQuestions}}">
					 	<input ng-if="is_have_section==1" type="hidden" name="saved_questions" value="@{{final_questions}}">

	<div class="panel-body">

		<div class="row">

			<div class="col-md-12 clearfix">

				<div class="vertical-scroll" >

					 				

					 				{{-- <a class="remove-all-questions text-red" style="cursor: pointer;" ng-click="removeAll()">{{getPhrase('remove_all')}}</a> --}}

					 				<table  
									ng-if="is_have_section==0"
								  class="table table-hover">

								  <thead>

								  <tr>

									<th>{{getPhrase('subject')}}</th>

									<th>{{getPhrase('question')}}</th>

									<th>{{getPhrase('marks')}}</th>	

									<th></th>	

									</tr>

									</thead>

									<tbody>

										<tr ng-repeat="i in savedQuestions track by $index">

										<td>@{{ savedQuestions[$index].subject_title}}</td>

										<td title="@{{ savedQuestions[$index].question}}">@{{ savedQuestions[$index].question  }}</td>

										<td>@{{ savedQuestions[$index].marks}}</td>

										<td><a ng-click="removeQuestion(i)" style="cursor: pointer;" class="btn-outline btn-close text-red"><i class="fa fa-close"></i></a></td>

										</tr>

									</tbody>

									</table>
									

									<div ng-if="is_have_section==1"> 
										
									<ul class="list-unstyled">
										<li  ng-repeat="key in keys" >
															
								            <span class="text-primary"><input type="text" name="add_section_names[]" value="@{{ savedQuestions[key].section_name}}">

									       <span ng-if="type_exam == 'ST' "><strong><input type="text" name="add_section_times[]" value="@{{savedQuestions[key].section_time}}">( mins )</strong></span>

										</span>

								  <table class="table table-hover">

								  <thead>

								  <tr>

									<th>{{getPhrase('subject')}}</th>

									<th>{{getPhrase('question')}}</th>

									<th>{{getPhrase('marks')}}</th>	

									<th></th>	

									</tr>

									</thead>

									<tbody>

										<tr ng-repeat="j in savedQuestions[key].questions">
											
										
										<td>@{{j.subject_title}}</td>

										<td title="@{{ j.question}}" ng-bind-html="trustAsHtml(j.question )"></td>

										<td>@{{j.marks}}</td>

										<td ng-if="is_have_section==0"><a ng-click="removeQuestion(j)" style="cursor: pointer;" class="btn-outline btn-close text-red"><i class="fa fa-close"></i></a></td>
										
										<td ng-if="is_have_section==1"><a ng-click="removeQuestionWithKey(j, key)" style="cursor: pointer;" class="btn-outline btn-close text-red"><i class="fa fa-close"></i></a></td>

										</tr>

									</tbody>

									</table>	

										</li>
									</ul>

									

					 			</div>

					 			</div>



					 			<div class="buttons text-center" >

							<button class="btn btn-lg btn-success button">{{getPhrase('update')}}</button>

						</div>

			</div>

		</div>

	</div>



{!! Form::close() !!}



	 

	 


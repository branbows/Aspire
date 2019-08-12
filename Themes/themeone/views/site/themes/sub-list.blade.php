@extends('layouts.admin.adminlayout')
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
							<li><a href="{{URL_THEMES_LIST}}">{{ getPhrase('themes')}}</a>  </li>
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom col-lg-12">
					<div class="panel-heading">
						
					<div class="pull-right messages-buttons">
								 
							 
						</div>
						<h1>{{ $title }}

						</h1>

					</div>
					<div class="panel-body packages">
				
					{!! Form::open(array('url' => URL_UPDATE_THEME_SUBSETTINGS.$record->slug, 'method' => 'POST', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}
						<div class="row"> 
						<ul class="list-group">
						@if(count($settings_data))

						@foreach($settings_data as $key=>$value)
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						 {{-- {{dd($value)}} --}}
						@include(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								)

							
								
						  @endforeach

						  @else
							  <li class="list-group-item">{{ getPhrase('no_settings_available')}}</li>
						  @endif
						</ul>

						@if($record->slug == 'theme_one')
                        
						<div class="row">
							 <div class="col-md-6">
							 	<img src="{{IMAGES}}blue-header.jpg">
							 	<p>{{getPhrase('blue_header')}}</p>
								<img src="{{IMAGES}}blue-navbar.jpg">
							 	<p>{{getPhrase('blue_navigationbar')}}</p>
							 </div>
								
							<div class="col-md-6">
								<img src="{{IMAGES}}dark-header.jpg">
							 	<p>{{getPhrase('dark_header')}}</p>
								<img src="{{IMAGES}}dark-theme.jpg">
							 	<p>{{getPhrase('dark_theme')}}</p>
							</div>
					   </div>
					   @endif	

						</div>

						@if(count($settings_data))
						<div class="buttons text-center clearfix">
							<button class="btn btn-lg btn-success button" ng-disabled='!formTopics.$valid'
							>{{ getPhrase('update') }}</button>
						</div>
						@endif
							{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
@endsection
 

@section('footer_scripts')
  
   @include('common.editor')

  <script src="{{themes('js/bootstrap-toggle.min.js')}}"></script>

@stop

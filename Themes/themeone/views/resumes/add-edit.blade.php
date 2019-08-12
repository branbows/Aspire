@extends('layouts.admin.adminlayout')
 

@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->


				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_RESUME_TEMPLATES}}">{{ getPhrase('resume_templates') }}</a> </li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
				@include('errors.errors')	
			 <div class="panel panel-custom col-lg-6 col-lg-offset-3">				<div class="panel-heading">						<div class="pull-right messages-buttons">
							<a href="{{URL_RESUME_TEMPLATES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
					<h1>{{ $title }}  </h1>
					</div>
					<div class="panel-body  form-auth-style" >
					<?php $button_name = getPhrase('create'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_RESUME_TEMPLATES_EDIT.'/'.$record->slug, 
						'method'=>'patch','novalidate'=>'','name'=>'formEmails', 'files'=>true)) }}
					@else
						{!! Form::open(array('url' => URL_RESUME_TEMPLATES_ADD, 'method' => 'POST', 'files' => true,'novalidate'=>'','name'=>'formEmails')) !!}
					@endif

					 @include('resumes.form_elements', 
					 array('button_name'=> $button_name),
					 array('record' => $record))
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')

@include('common.validations')

<script src="{{JS}}datepicker.min.js"></script>
<script src="{{JS}}bootstrap-toggle.min.js"></script>   
 <script>
	var file = document.getElementById('image_input');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':

     
            break;
        default:
               alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
@stop
 
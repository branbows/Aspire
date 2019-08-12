@extends($layout)
@section('content')<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<ol class="breadcrumb">
<li class="active">{{$title}}</li>
</ol>
</div>
</div>
@include('errors.errors')
<!-- /.row -->

<div class="panel panel-custom col-lg-6  col-lg-offset-3">
<div class="panel-heading">
<h1>{{ $title }} </h1>
</div>


<div class="panel-body form-auth-style">
<small>send push notification to students</small>

<?php $button_name = getPhrase('send'); ?>

{!! Form::open(array('url' => URL_FCM_NOTIFICATION, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ')) !!}

@include('fcm.form_elements', array('button_name'=> $button_name))

{!! Form::close() !!}
</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('footer_scripts')
@include('common.validations')
@include('common.alertify')
@stop
@extends('layouts.admin.adminlayout')
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div> 
						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
							<thead>
								<tr>
									 
									<th><b>{{ getPhrase('Type')}}</b></th>
									<th><b>{{ getPhrase('description')}}</b></th>
									<th><b>{{ getPhrase('Status')}}</b></th>
									<th><b>{{ getPhrase('action')}}</b></th>
								  
								</tr>
							</thead>
							<tbody>
								@foreach($exam_types as $type)
								<tr>
									<td>{{$type->title}}</td>
									<td>{{$type->description}}</td>
									@if($type->status == 1)
									<td><span class="label label-success">Active</span></td>
									@else
									<td><span class="label label-info">In Active</span></td>
									@endif
									<td><a href="{{URL_EDIT_EXAM_TYPE.$type->code}}" class="btn btn-primary btn-sm">{{getPhrase('edit')}}</a></td>
								</tr>
								@endforeach
							</tbody>
							 
						</table>
						</div>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
@endsection
 



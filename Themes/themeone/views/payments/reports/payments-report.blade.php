@extends($layout)
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li>{{ $title}}</li>
						</ol>
					</div>
				</div>

				 <div class="row">

				<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							all"
							><div class="state-icn bg-icon-info"><i class="fa fa-money"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ $payments->all}}</h4>
								<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							all"
							>
								{{ getPhrase('payments')}}</a>
				 			</div>
				 		</div>
				 	</div>

				 	<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							success"
							><div class="state-icn bg-icon-success"><i class="fa fa-check"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ $payments->success}}</h4>
								<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							success"
							>
								{{ getPhrase('success')}}</a>
				 			</div>
				 		</div>
				 	</div>

				 		<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							pending"
							><div class="state-icn bg-icon-purple"><i class="fa fa-spinner"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ $payments->pending}}</h4>
								<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							pending"
							>
								{{ getPhrase('pending')}}</a>
				 			</div>
				 		</div>
				 	</div>


	<div class="col-md-3 col-sm-6">
				 		<div class="media state-media box-ws">
				 			<div class="media-left">
				 				<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							cancelled"
							><div class="state-icn bg-icon-pink"><i class="fa fa-remove"></i></div></a>
				 			</div>
				 			<div class="media-body">
				 				<h4 class="card-title">{{ $payments->cancelled}}</h4>
								<a
							href="@if($payment_mode=='online')
							{{URL_ONLINE_PAYMENT_REPORT_DETAILS}}
							@else {{URL_OFFLINE_PAYMENT_REPORT_DETAILS}}
							@endif
							cancelled"
							>
								{{ getPhrase('cancelled')}}</a>
				 			</div>
				 		</div>
				 	</div>
					 
			</div>
			<!-- /.container-fluid -->
			<div class="row">
				<div class="col-md-6">
  				  <div class="panel panel-primary dsPanel">
				    <div class="panel-heading">{{getPhrase('payment_statistics')}}</div>
				    <div class="panel-body" >
				    	<canvas id="payments_chart" width="100" height="60"></canvas>
				    </div>
				  </div>
				</div>

				<div class="col-md-6">
  				  <div class="panel panel-primary dsPanel">
				    <div class="panel-heading">{{getPhrase('payment_monthly_statistics')}}</div>
				    <div class="panel-body" >
				    	<canvas id="payments_monthly_chart" width="100" height="60"></canvas>
				    </div>
				  </div>
				</div>

				
			</div>
 
</div>
		<!-- /#page-wrapper -->

@stop

@section('footer_scripts')
 
 @include('common.chart', array('chart_data'=>$payments_chart_data,'ids' =>array('payments_chart'), 'scale'=>TRUE))
 @include('common.chart', array('chart_data'=>$payments_monthly_data,'ids' =>array('payments_monthly_chart'), 'scale'=>true))
 
 

@stop

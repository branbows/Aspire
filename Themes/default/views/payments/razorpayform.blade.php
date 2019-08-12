@extends($layout)

@section('content')

  {!! Form::open(array('url'=>URL_RAZORPAY_SUCCESS, 'method'=>'POST', 'id'=>'paymentform')) !!}

   <button id="rzp-button1" class="btn btn-primary" style="display: none;">Pay</button>

   <input type="hidden" name="_token" value="{!!csrf_token()!!}">    

   <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">  

    <input type="hidden" name="item_name" id="item_name" ng-model="item_name" value="{{$slug}}">
       
    <input type="hidden" name="type" ng-model="item_type" value="{{$type}}" >

    <input type="hidden" name="is_coupon_applied" id="is_coupon_applied"  value="{{$request->is_coupon_applied}}" >

    <input type="hidden" name="coupon_id" id="coupon_id"  value="{{$request->coupon_id}}" >

    <input type="hidden" name="actual_cost" id="actual_cost" value="{{$request->actual_cost}}" >

    <input type="hidden" name="discount_availed" id="discount_availed"  value="{{$request->discount_availed}}" >

    <input type="hidden" name="after_discount" id="after_discount" value="{{$request->after_discount}}" >

     <input type="hidden" name="parent_user" value="{{$request->parent_user}}" >  
     
     <input type="hidden" name="selected_child_id" value="{{$request->selected_child_id}}" >  

  {!! Form::close() !!}

@stop



@section('footer_scripts')



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
   

<script>
	
     var options = {

     "key"       : "{{ env('RAZORPAY_APIKEY') }}",
    "amount"     : "{{ $request->after_discount * 100 }}", // 2000 paise = INR 20
    "name"       : "{{ $user->name }}",
    "description": "{{ $title }}",
    
    "handler": function (response){
        // alert(response.razorpay_payment_id);
        $('#razorpay_payment_id').val(response.razorpay_payment_id);
        $('#paymentform').submit();
    },
    "prefill": {
        "name": "{{$user->name}}",
        "email": ""
    },
    "notes": {
        "address": "{{$user->address}}"
    },
    "theme": {
        "color": "#2397c7"
    },
    "modal": {
        "ondismiss": function(){

            $(location).attr('href', '{{URL_PAYMENTS_CHECKOUT.$type.'/'.$slug}}')

        }
    }
};

var rzp1 = new Razorpay(options);

$(document).ready(function(){
  
    $("#rzp-button1").click();

});

$(document).on('click','#rzp-button1',function(e) {

	  rzp1.open();
	  e.preventDefault();
});



</script>


@stop


@extends('layouts.sitelayout')

@section('home_css_scripts')
<link rel="stylesheet" href="{{themes('site/css/faqs/style.css')}}">
@endsection

@section('content')

<!-- Page Banner -->
<section class="cs-primary-bg cs-page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="cs-page-banner-title">{{strtoupper($title)}}</h2>
            </div>
        </div>
    </div>
</section>
<!-- /Page Banner -->



@if ($categories)
<div class="container">

  <div class="col-md-4">
    <ul class="list-group help-group">
      <div class="faq-list list-group nav nav-tabs">
        @php $i=1;@endphp

        @foreach ($categories as $category)

        @php 
            $cls='';
            if ($i==1)
            $cls = 'active';
        @endphp
        <a href="#tab{{$category->id}}" class="list-group-item {{$cls}}" role="tab" data-toggle="tab">{{$category->category}}</a>
        
        @php $i++; @endphp
        @endforeach
      </div>
    </ul>
  </div>





    <div class="col-md-8">
    <div class="tab-content panels-faq">


        @php $k=1;@endphp
        @foreach ($categories as $category)

        @php 
            $cls='';
            if ($k==1)
            $cls = 'active';
        @endphp

        <?php 
        $faqs=[];
        
        
        $faqs = $category->getFaqs()->where('status', 1)->get(); 

        ?>
        <div class="tab-pane {{$cls}}" id="tab{{$category->id}}">
             <div class="panel-group" id="help-accordion-{{$category->id}}">

                @if ($faqs)

                @foreach ($faqs as $faq)
                    <div class="panel panel-default panel-help">
                        <a href="#opret-{{$faq->id}}" data-toggle="collapse" data-parent="#help-accordion-1">
                          <div class="panel-heading">
                            <h2>{{$faq->question}}</h2>
                          </div>
                        </a>
                        <div id="opret-{{$faq->id}}" class="collapse">
                          <div class="panel-body">
                            <p>{!! $faq->answer !!}</p>
                          </div>
                        </div>
                    </div>
                @endforeach

                @endif

             </div>
        </div>

        @php $k++; @endphp
        @endforeach


    </div>
    </div>

  


       
 </div>

@else
<h2 class="text-center">No FAQs Available...</h2> 
@endif

@stop

@section('footer_scripts')
<script>
    $(function() {
    // Since there's no list-group/tab integration in Bootstrap
    $('.list-group-item').on('click',function(e){
          var previous = $(this).closest(".list-group").children(".active");
          previous.removeClass('active'); // previous list-item
          $(e.target).addClass('active'); // activated list-item
    });
});
</script>
@endsection

@extends('layouts.sitelayout')

@section('home_css_scripts')
<link rel="stylesheet" href="{{themes('site/css/blogs/style.css')}}">
@endsection


@section('content')

 <!-- Page Banner -->
    <section class="cs-primary-bg cs-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title">{{ ucfirst($title) }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Banner -->

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-content">

            <div class="">    
                <h4 class="card-title"> {{$blog->title}} </h4>

                <h6>{{$blog->tags}} | {{getPhrase('posted_on')}} {{DATE_FORMAT($blog->updated_at, 'd M Y')}}</h6> 
            </div>

            @if ($blog->image)
            <img src="{{getBlogImgPath($blog->image, 'blog')}}" alt="{{$blog->title}}" class="img-responsive blog-img"/>
            @endif
                        

            <div class="card-content">
             {!! $blog->content !!}
            </div>

            </div>
        </div>
    </div>
</div>
@stop
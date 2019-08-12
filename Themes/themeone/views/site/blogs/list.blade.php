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



<section class="wrapper">
    <div class="container-fostrap">
        
        @if ($blogs)
        <div class="content">
            <div class="container">

                <?php $i=0;?>
                @foreach ($blogs as $blog)

                <?php $i++;
                
                ?>


                @if ($i/9==0)
                <div class="row">
                @endif

                <div class="col-xs-12 col-sm-4">
                    <div class="card">
                        <a class="img-card" href="{{URL_BLOG_VIEW}}{{$blog->slug}}">
                        <img src="{{getBlogImgPath($blog->image)}}" alt="{{$blog->title}}" class="img-responsive"/>
                      </a>
                        <div class="card-content">
                            <h4 class="card-title">
                                <a href="{{URL_BLOG_VIEW}}{{$blog->slug}}">
                                 {{$blog->title}}
                              </a>
                            </h4>
                            <p class="">
                                {!! \Illuminate\Support\Str::words($blog->content, 10,'....')  !!}
                            </p>
                        </div>
                        <div class="card-read-more">
                            <a href="{{URL_BLOG_VIEW}}{{$blog->slug}}" class="btn btn-link btn-block">
                                {{getPhrase('read_more')}}
                            </a>
                        </div>
                    </div>
                </div>

                @if ($i/9==0)
                </div>
                @endif

                @endforeach



              

                <div class="row">
                    <div class="col-xs-12">
                        {{ $blogs->links() }}
                    </div>
                </div>


            </div>
        </div>


        @else
        <h2 class="text-center">No FAQs Available...</h2>
        @endif



    </div>
</section>



@stop






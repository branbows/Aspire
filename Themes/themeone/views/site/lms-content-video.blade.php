@extends('layouts.sitelayout')

@section('content')

    <!-- Page Banner -->
    <section class="cs-primary-bg cs-page-banner" style="margin-top: 110px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title">{{$content_record->title}}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Banner -->

    <!-- Video Play Section  -->
    <div class="container" ng-controller = "frontVideo">
        <div class="row cs-row">

               <div class=" col-md-3">
              <div class="panel-group" id="accordion">

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" ng-click="getContents({{$first_series->id}},'yes')">
                    {{$first_series->title}}</a>
                  </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                  <div class="panel-body">

                    <div ng-repeat ="content in contents" ng-if="contents.length > 0">

                      <p ng-if="content.content_type == 'file'"><a href="{{URL_DOWNLOAD_LMS_CONTENT}}@{{content.slug}}">@{{ content.title }}</a></p>

                       <p ng-if="content.content_type == 'url' || content.content_type == 'video_url' || content.content_type == 'audio_url' "><a href="@{{content.file_path}}" target="_blank">@{{content.title }}</a></p>

                        <p ng-if="content.content_type == 'iframe'"><a href="{{URL_LMS_VIDEO_CONTENT}}@{{content.slug}}/{{$first_series->id}}">@{{ content.title }}</a></p>
                        
                    </div>

                      <div ng-if="contents.length == 0">
                        <p>{{getPhrase('no_contents_are_available')}}</p>
                     </div>
                  
                
                
                  </div>
                </div>
              </div>

             @if(count($all_series) > 0)

               @foreach($all_series as $series)

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" ng-click="getContents({{$series->id}},'no')">
                    {{$series->title}}</a>
                  </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                   <div class="panel-body">

                    <div ng-repeat ="content in all_contents" ng-if="all_contents.length > 0">

                      <p ng-if="content.content_type == 'file'"><a href="{{URL_DOWNLOAD_LMS_CONTENT}}@{{content.slug}}">@{{ content.title }}</a></p>

                       <p ng-if="content.content_type == 'url' || content.content_type == 'video_url' || content.content_type == 'audio_url' "><a href="@{{content.file_path}}" target="_blank">@{{content.title }}</a></p>

                        <p ng-if="content.content_type == 'iframe'"><a href="{{URL_LMS_VIDEO_CONTENT}}@{{content.slug}}/{{$first_series->id}}">@{{ content.title }}</a></p>
                        
                    </div>

                     <div ng-if="all_contents.length == 0">
                        <p>{{getPhrase('no_contents_are_available')}}</p>
                     </div>



                  </div>
                </div>
              </div>
              @endforeach

             @endif 

            </div>
      </div>

            <div class=" col-md-9">
              
                <div class="cs-video-frame">
                    <div class="embed-responsive embed-responsive-16by9">

                         <iframe class="embed-responsive-item" src="{{$video_src}}" allowfullscreen=""></iframe> 
                     </div>
                </div>
                <div class="cs-video-frame">
                    <div class="cs-video-card-content">
                        <a href="#" class="cs-video-card-title">{{$content_record->title}}<span class="cs-video-card-duration"></a>
                        <p><span  class="cs-video-card-date">{{getPhrase('posted_on')}} {{$content_record->created_at}}</span></p>
                    </div>
                    <p class="cs-video-description">
                      {!! $content_record->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop   

@section('footer_scripts')
 
 @include('site.scripts.front-video')

@endsection
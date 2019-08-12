@extends('layouts.sitelayout')

@section('content')

 <!-- Page Banner -->
    <section class="cs-primary-bg cs-page-banner" style="margin-top: 110px;margin-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title">{{ ucfirst($title) }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Banner -->

<?php 
   
   $current_theme = getDefaultTheme();
   
   $page_content  = getThemeSetting($key,$current_theme); 
    // dd($page_content);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div style="padding: 0 15px">
 {!! $page_content !!}
</div>
</div>
</div>
</div>
@stop
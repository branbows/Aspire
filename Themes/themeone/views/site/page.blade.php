@extends('layouts.sitelayout')

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

<?php 
   
   $current_theme = getDefaultTheme();
   
  
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-content">
             {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@stop
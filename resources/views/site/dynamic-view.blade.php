@extends('layouts.sitelayout')

@section('content')

 <!-- Page Banner -->
    <section class="cs-primary-bg cs-page-banner" style="margin-top: 300px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title">{{getPhrase('contact_our_experts_now')}}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /Page Banner -->

<?php 

   $page_content = getSetting($key,'site_pages'); 
    // dd($page_content);
?>

 {!! $page_content !!}

@stop
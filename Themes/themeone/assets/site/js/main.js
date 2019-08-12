/*
Copyright (c) 2017
[Custom JS Script]
Theme Name : Author Shop
Version    : 1.0
Author     : Sumo Connect Team
Author URI : https://sumoconnect.com
Support    : sumoconnect@gmail.com
*/
/*jslint browser: true*/
/*global $, jQuery, alert*/

/*--------------------------------------------------------------
TABLE OF CONTENTS:
----------------------------------------------------------------
# Document Ready
## Vars
## JRATE Star Rating
## Testimonial Slider
## Initiat WOW JS

--------------------------------------------------------------*/


/* Document Ready */
jQuery(document).ready(function () {
    "use strict";


    /* JRATE Star Rating -- SVG based Rating jQuery plugin -- for docs rafy-fa plugin -- http://jacob87.github.io/raty-fa/ */
    if ($('.startRate').length) {
        $('.startRate').raty({
            score: 3
        });
    }

    //Testimonial Slider
    if ($('.cs-testimonial-slider').length) {
        $('.cs-testimonial-slider').slick({
            dots: true,
            arrows: false,
            infinite: false,
            centerPadding: '10px',
            autoplay:true,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 2,

            responsive: [

                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ]
        });
    }

    //Initiat WOW JS
    new WOW().init();

    if ($('.cs-animate').length) {
        var wow = new WOW({
            boxClass: 'cs-animate', // default
            animateClass: 'wow animated fadeInUp', // default
            offset: 0, // default
            mobile: true, // default
            live: true // default
        });
        wow.init();
    }



});

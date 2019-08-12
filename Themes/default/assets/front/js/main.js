$(document).ready(function() {
    "use strict";
    
    

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });


    var heroheader = $('.st-heroheader-carousel');
    heroheader.owlCarousel({
        loop: true,
        nav: false,
        items: 1,
        autoplay: true,
        autoplayTimeout: 2000,
        touchDrag  : true,
        mouseDrag  : true

    });

    var tslider = $('.testimonial-slider');
    tslider.owlCarousel({
        loop: true,
        nav: false,
        items: 1,
        autoplay: true,
        autoplayTimeout: 4000,
        touchDrag  : true,
        mouseDrag  : true

    });
   
    //Click event to scroll to top
    $('.st-scrollToTop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    
    /*sticky sidebar between header and footer*/
    $(function () {

        var msie6 = $.browser == 'msie' && $.browser.version < 7;

        if (!msie6 && $('.leftsidebar').offset()!=null) {
            var top = $('.leftsidebar').offset().top - parseFloat($('.leftsidebar').css('margin-top').replace(/auto/, 0));
            var height = $('.leftsidebar').height() + 80;
            var winHeight = $(window).height(); 
            var footerTop = $('#footer').offset().top - parseFloat($('#footer').css('margin-top').replace(/auto/, 0));
            var gap = 7;
            $(window).scroll(function (event) {
                // what the y position of the scroll is
                var y = $(this).scrollTop();

                // whether that's below the form
                if (y+winHeight >= top+ height+gap && y+winHeight<=footerTop) {
                    // if so, ad the fixed class
                    $('.leftsidebar').addClass('leftsidebarfixed').css('top',winHeight-height-gap +'px');
                } 
                else if (y+winHeight>footerTop) {
                    // if so, ad the fixed class
                    $('.leftsidebar').addClass('leftsidebarfixed').css('top',footerTop-height-y-gap+'px');
                } 
                else    
                {
                    // otherwise remove it
                    $('.leftsidebar').removeClass('leftsidebarfixed').css('top','0px');
                }
            });
        }  
    });
    
    /*Dashboard Profile Button - Worked as offcanvas menu icon when responsive */
    $('.offcanvas-btn').on('click', function (e) {
        $('.sidebar-offcanvas').toggleClass('active');
        /*Offcanvas menu effect  - When offcanvas menu triggers breadcrumb have opacity */
        $(".pb-breadcrumb,.dashboard-panel").toggleClass("ad-opacity");
    });

    /* close menu while outside of this container*/
    $(document).mouseup(function (e)
                        {
        var container = $(".sidebar-offcanvas");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.sidebar-offcanvas').removeClass('active');
            $(".pb-breadcrumb,.dashboard-panel").removeClass("ad-opacity");
        }
    });
    /*heroheader.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            heroheader.trigger('next.owl');
        } else {
            heroheader.trigger('prev.owl');
        }
        e.preventDefault();
    });*/

    /*if ($(window).width() > 990) {
        $('ul.nav li.dropdown').hover(function() {
            $(this).closest('ul').find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).closest('ul').find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    }*/

  

});
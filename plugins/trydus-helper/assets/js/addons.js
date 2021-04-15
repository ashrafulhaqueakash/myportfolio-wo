(function ($) {

    "use strict";



    var navMenu = function ($scope, $) {
        $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i class="fas fa-angle-down"></i></span>');
        function navMenu() {
            
        if(jQuery('.trydus-main-menu-wrap').hasClass('menu-style-inline')){
            if( jQuery(window).width() < 960 ){
                jQuery('.trydus-main-menu-wrap').addClass('menu-style-flyout');
                jQuery('.trydus-main-menu-wrap').removeClass('menu-style-inline');
            } else{
                jQuery('.trydus-main-menu-wrap').removeClass('menu-style-flyout');
                jQuery('.trydus-main-menu-wrap').addClass('menu-style-inline');
            }
    
            $(window).resize(function(){
                if( jQuery(window).width() < 960 ){
                    jQuery('.trydus-main-menu-wrap').addClass('menu-style-flyout');
                    jQuery('.trydus-main-menu-wrap').removeClass('menu-style-inline');
                } else{
                    jQuery('.trydus-main-menu-wrap').removeClass('menu-style-flyout');
                    jQuery('.trydus-main-menu-wrap').addClass('menu-style-inline');
                }
            })
        }
        
        
            if ($(window).width() < 960 || $('.trydus-main-menu-wrap').hasClass('menu-style-flyout') ) {
                // main menu toggleer icon (Mobile site only)
                $('[data-toggle="navbarToggler"]').on("click", function (e) {
                    $('.navbar').toggleClass('active');
                    $('.navbar-toggler-icon').toggleClass('active');
                    $('body').toggleClass('offcanvas--open');
                    e.stopPropagation();
                    e.preventDefault();
    
                });
                $('.navbar-inner').on("click", function (e) {
                    e.stopPropagation();
                });
        
                // Remove class when click on body
                $('body').on("click", function () {
                    $('.navbar').removeClass('active');
                    $('.navbar-toggler-icon').removeClass('active');
                    $('body').removeClass('offcanvas--open');
                });
                $('.main-navigation ul.navbar-nav li.menu-item-has-children>a').on("click", function (e) {
                    e.preventDefault();
                    $(this).siblings('.sub-menu').toggle();
                    $(this).parent('li').toggleClass('dropdown-active');
                })
        
                $(".trydus-mega-menu> ul.sub-menu > li > a").unbind('click');            // Navbar moved up
    
                var $stickyNav = $(".navbar-sticky");
                $(window).on("scroll load", function () {
                    var scroll = $(window).scrollTop();
                    if (scroll >= 120) {
                        $stickyNav.addClass("navbar-sticky--moved-up");
                    } else {
                        $stickyNav.removeClass("navbar-sticky--moved-up");
                    }
                    // apply transition
                    if (scroll >= 250) {
                        $stickyNav.addClass("navbar-sticky--transitioned");
                    } else {
                        $stickyNav.removeClass("navbar-sticky--transitioned");
                    }
                    // sticky on
                    if (scroll >= 500) {
                        $stickyNav.addClass("navbar-sticky--on");
                    } else {
                        $stickyNav.removeClass("navbar-sticky--on");
                    }
        
                });
            }
            
        }
        navMenu();
    }


    
    var sliderJS = function ($scope, $) {

        var slider_settings = $scope.find('.trydus-hero-slider-wrap').data().sliderSetting;

        $('.trydus-hero-slider').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: [slider_settings.prev_icon ,slider_settings.next_icon ],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });

    }
    
    $(window).on("elementor/frontend/init", function () {

        elementorFrontend.hooks.addAction("frontend/element_ready/trydus-menu.default", navMenu);
        elementorFrontend.hooks.addAction("frontend/element_ready/trydus-slider.default", sliderJS);
        
    });
})(jQuery);
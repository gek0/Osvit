/**
 * main JS file
 */

;(function () {
    'use strict';

    // iPad and iPod detection
    var isiPad = function(){
        return (navigator.platform.indexOf("iPad") != -1);
    };

    var isiPhone = function(){
        return (
            (navigator.platform.indexOf("iPhone") != -1) ||
            (navigator.platform.indexOf("iPod") != -1)
        );
    };

    // Parallax
    var parallax = function() {
        $(window).stellar();
    };

    // Burger Menu
    var burgerMenu = function() {

        $('body').on('click', '.js-osvit-nav-toggle', function(event){

            event.preventDefault();

            if ( $('#navbar').is(':visible') ) {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }
        });
    };

    // Page Nav
    var clickMenu = function() {

        $('#navbar a:not([class="external"])').click(function(event){
            var section = $(this).data('nav-section'),
                navbar = $('#navbar');

            if ( $('[data-section="' + section + '"]').length ) {
                $('html, body').animate({
                    scrollTop: $('[data-section="' + section + '"]').offset().top
                }, 500);
            }

            if ( navbar.is(':visible')) {
                navbar.removeClass('in');
                navbar.attr('aria-expanded', 'false');
                $('.js-osvit-nav-toggle').removeClass('active');
            }

            event.preventDefault();
            return false;
        });

        $('a.feature-menu-anchor').click(function(event){
            var section = $(this).data('nav-section'),
                navbar = $('#navbar');

            if ( $('[data-section="' + section + '"]').length ) {
                $('html, body').animate({
                    scrollTop: $('[data-section="' + section + '"]').offset().top
                }, 500);
            }
            event.preventDefault();
            return false;
        });

    };

    // Reflect scrolling in navigation
    var navActive = function(section) {

        var $el = $('#navbar > ul');
        $el.find('li').removeClass('active');
        $el.each(function(){
            $(this).find('a[data-nav-section="'+section+'"]').closest('li').addClass('active');
        });

    };

    var navigationSection = function() {
        var $section = $('section[data-section]');

        $section.waypoint(function(direction) {
            if (direction === 'down') {
                navActive($(this.element).data('section'));
            }
        }, {
            offset: '150px'
        });

        $section.waypoint(function(direction) {
            if (direction === 'up') {
                navActive($(this.element).data('section'));
            }
        }, {
            offset: function() { return -$(this.element).height() + 155; }
        });
    };

    // Window Scroll
    var windowScroll = function() {
        var lastScrollTop = 0;

        $(window).scroll(function(event){
            var header = $('#osvit-header'),
                scrlTop = $(this).scrollTop();

            if ( scrlTop > 500 && scrlTop <= 2000 ) {
                header.addClass('navbar-fixed-top osvit-animated slideInDown');
            } else if ( scrlTop <= 500) {
                if ( header.hasClass('navbar-fixed-top') ) {
                    header.addClass('navbar-fixed-top osvit-animated slideOutUp');
                    setTimeout(function(){
                        header.removeClass('navbar-fixed-top osvit-animated slideInDown slideOutUp');
                    }, 100 );
                }
            }
        });
    };

    var homeAnimate = function() {
        if ( $('#osvit-home').length > 0 ) {
            $('#osvit-home').waypoint( function( direction ) {
                if( direction === 'down' && !$(this.element).hasClass('animated') ) {
                    setTimeout(function() {
                        $('#osvit-home .to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );
                        });
                    }, 200);
                    $(this.element).addClass('animated');
                }
            } , { offset: '80%' } );

        }
    };

    var introAnimate = function() {
        if ( $('#osvit-intro').length > 0 ) {
            $('#osvit-intro').waypoint( function( direction ) {
                if( direction === 'down' && !$(this.element).hasClass('animated') ) {
                    setTimeout(function() {
                        $('#osvit-intro .to-animate').each(function( k ) {
                            var el = $(this);
                            setTimeout ( function () {
                                el.addClass('fadeInRight animated');
                            },  k * 200, 'easeInOutExpo' );
                        });
                    }, 1000);
                    $(this.element).addClass('animated');
                }
            } , { offset: '80%' } );
        }
    };

    var galleryAnimate = function() {
        if ( $('#osvit-gallery').length > 0 ) {
            $('#osvit-gallery').waypoint( function( direction ) {
                if( direction === 'down' && !$(this.element).hasClass('animated') ) {
                    setTimeout(function() {
                        $('#osvit-gallery .to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );

                        });
                    }, 200);

                    $(this.element).addClass('animated');
                }
            } , { offset: '80%' } );

        }
    };

    var aboutAnimate = function() {
        var about = $('#osvit-about');
        if ( about.length > 0 ) {
            about.waypoint( function( direction ) {
                if( direction === 'down' && !$(this.element).hasClass('animated') ) {
                    setTimeout(function() {
                        about.find('.to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );

                        });
                    }, 200);
                    $(this.element).addClass('animated');
                }
            } , { offset: '80%' } );
        }
    };

    var countersAnimate = function() {
        var counters = $('#osvit-counters');
        if ( counters.length > 0 ) {

            counters.waypoint( function( direction ) {

                if( direction === 'down' && !$(this.element).hasClass('animated') ) {

                    var sec = counters.find('.to-animate').length,
                        sec = parseInt((sec * 200) + 400);

                    setTimeout(function() {
                        counters.find('.to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );

                        });
                    }, 200);

                    setTimeout(function() {
                        counters.find('.js-counter').countTo({
                            formatter: function (value, options) {
                                return value.toFixed(options.decimals);
                            },
                        });
                    }, 400);

                    setTimeout(function() {
                        counters.find('.to-animate-2').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('bounceIn animated');
                            },  k * 200, 'easeInOutExpo' );

                        });
                    }, sec);

                    $(this.element).addClass('animated');

                }
            } , { offset: '80%' } );

        }
    };

    var galleryCountersAnimate = function() {
        var counters = $('#gallery-counters');
        if ( counters.length > 0 ) {

            counters.waypoint( function( direction ) {

                if( direction === 'down' && !$(this.element).hasClass('animated') ) {

                    var sec = counters.find('.to-animate').length,
                        sec = parseInt((sec * 200) + 400);

                    setTimeout(function() {
                        counters.find('.to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );

                        });
                    }, 200);

                    setTimeout(function() {
                        counters.find('.js-counter').countTo({
                            formatter: function (value, options) {
                                return value.toFixed(options.decimals);
                            },
                        });
                    }, 400);

                    setTimeout(function() {
                        counters.find('.to-animate-2').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('bounceIn animated');
                            },  k * 200, 'easeInOutExpo' );

                        });
                    }, sec);

                    $(this.element).addClass('animated');

                }
            } , { offset: '80%' } );

        }
    };

    var contactAnimate = function() {
        var contact = $('#osvit-contact');
        if ( contact.length > 0 ) {

            contact.waypoint( function( direction ) {

                if( direction === 'down' && !$(this.element).hasClass('animated') ) {

                    setTimeout(function() {
                        contact.find('.to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );
                        });
                    }, 200);
                    $(this.element).addClass('animated');
                }
            } , { offset: '80%' } );
        }
    };

    var locationsAnimate = function() {
        var contact = $('#osvit-locations');
        if ( contact.length > 0 ) {

            contact.waypoint( function( direction ) {

                if( direction === 'down' && !$(this.element).hasClass('animated') ) {

                    setTimeout(function() {
                        contact.find('.to-animate').each(function( k ) {
                            var el = $(this);

                            setTimeout ( function () {
                                el.addClass('fadeInUp animated');
                            },  k * 200, 'easeInOutExpo' );
                        });
                    }, 200);
                    $(this.element).addClass('animated');
                }
            } , { offset: '80%' } );
        }
    };

    // Document on load.
    $(function(){
        parallax();
        burgerMenu();
        clickMenu();
        windowScroll();
        navigationSection();

        // Animations
        homeAnimate();
        introAnimate();
        galleryAnimate();
        aboutAnimate();
        countersAnimate();
        galleryCountersAnimate();
        contactAnimate();
        locationsAnimate();
    });
}());

jQuery(document).ready(function(){
    /**
     *   add lazy loading to images out of screen viewport
     */
    $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });

    /**
     *  email ajax script for main contact form
     */
    $("#contact-form").submit(function (event) {
        event.preventDefault();
        var submitButton = $('#contactSubmit');

        // disable button for another submits
        // add spinning icon class
        submitButton.addClass('disabled');
        $('#contactSubmit i').addClass('fa-spin');

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        var token = $('#contact-form > input[name="_token"]').val();

        //user output
        var errorMsg = "";
        var successMsg = "<h4>E-mail s Vašim upitom je uspješno poslan</h4>";

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: {'X-CSRF-Token': token},
            data: {_token: token, formData: values},
            success: function (data) {
                //check status of validation and query
                if (data.status === 'success') {
                    swal({
                        title: successMsg,
                        type: 'success',
                        timer: 2500,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('Mail sent');
                            }
                        }
                    );

                    $(this).trigger('reset');
                }
                else {
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += value[i] + '<br>';
                        });
                    });

                    $('#contactSubmit i').removeClass('fa-spin');

                    swal({
                        title: 'Ispravite navedene greške',
                        html: errorMsg,
                        type: 'error',
                        timer: 5000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('Mail error');
                            }
                        }
                    );
                }
            }
        });

        //restore default class and reset captcha/form
        setTimeout(function(){
            var submitButton = $('#contactSubmit');

            submitButton.removeClass('disabled');
            $('#contactSubmit i').removeClass('fa-spin');
            grecaptcha.reset();
            $('#contact-form').trigger('reset');
        }, 5000);

    });

    /**
     * back to top animation
     */
    if ($('#back-to-top').length > 0) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

});

/**
* bootstrap checkbox icons
 */
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'fa fa-check-square-o'
                },
                off: {
                    icon: 'fa fa-square-o'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
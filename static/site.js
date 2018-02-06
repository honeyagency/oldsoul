jQuery(document).ready(function($) {
    var myLazyLoad = new LazyLoad({
        // example of options object -> see options section
        threshold: 500,
        throttle: 30,
        show_while_loading: false,
    });
    $trig = $('.menu--trigger');
    $trig.on('click touchstart', function(event) {
        event.preventDefault();
        $('body').toggleClass('navopen');
    });
    // appear({
    //     init: function init() {
    //     },
    //     // function to get all elements to track
    //     elements: function elements() {
    //         return document.getElementsByClassName('block--gift-card-wrap');
    //     },
    //     // function to run when an element is in view
    //     appear: function appear(el) {
    //         el.className += " show";
    //     },
    //     // function to run when an element is in view
    //     disappear: function disappear(el) {
    //         el.classList.remove("show");
    //     },
    //     reappear: true,
    // });
    // $('select').selectric();
    $va = $('.product-type-variable');
    $va.each(function() {
        if ($(this).hasClass('product_cat-featured')) {
            $(this).find('select').addClass('icon-arrow-down-green');
        } else {
            $(this).find('select').addClass('icon-arrow-down-black');
        }
    });
    if (window.matchMedia('(max-width: 767px)').matches) {
        var mob = true;
    } else {
        var mob = false;
    }
    if (mob == true) {
        // $('.section--home-cafe-grid').slick({
        //     infinite: false,
        //     speed:300, 
        //     slidesToShow: 1,
        //     slidesToScroll: 1
        // });
        $('.trigger--children').on('click touchstart', function(event) {
            event.preventDefault();
            $parent = $(this).parent();
            $child = $parent.find('.section--child-nav');
            $openChild = $('.section--child-nav.open');
            if ($parent.hasClass('children--visible')) {
                $parent.removeClass('children--visible');
                $child.removeClass('open');
            } else {
                $('.children--visible').removeClass('children--visible');
                $openChild.removeClass('open');
                $parent.addClass('children--visible');
                $child.addClass('open');
            }
        });
        if ($('.section--home-cafe-grid').length > 0) {
            $('.section--home-cafe-grid').flickity({
                // options
                lazyLoad: 2,
                cellAlign: 'left',
                contain: true,
                prevNextButtons: false,
                pageDots: false
            });
        }
        if ($('.section--single-product-header').length > 0) {
            $('.section--single-product-header').flickity({
                // options
                lazyLoad: 2,
                cellAlign: 'left',
                contain: true,
                cellSelector: '.block--single-image',
                prevNextButtons: true,
                pageDots: false
            });
        }
        if ($('.section--about-partners.slider').length > 0) {
            $('.section--about-partners.slider').flickity({
                // options
                lazyLoad: 5,
                cellAlign: 'left',
                contain: true,
                cellSelector: '.block--about-partner',
                prevNextButtons: false,
                pageDots: false
            });
        }
        $('.product-quantity').remove();
        $(document.body).on('updated_cart_totals', function() {
            $('.product-quantity').remove();
        });
    } else {
        if ($('.section--about-partners.slider').length > 0) {
            $('.section--about-partners').flickity({
                // options
                lazyLoad: 5,
                cellAlign: 'left',
                contain: true,
                cellSelector: '.block--about-partner',
                prevNextButtons: false,
                pageDots: false
            });
        }
        $('.mob-quant').remove();
        $(document.body).on('updated_cart_totals', function() {
            $('.mob-quant').remove();
        });
    }
    if (typeof mediumZoom == 'function') {
        mediumZoom(document.querySelectorAll('[data-action="zoom"]'));
    }
});
// Scroll so nice you'll click() it twice
jQuery(document).ready(function() {
    jQuery('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = jQuery(this.hash);
            target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                if ($('body').hasClass('open')) {
                    $('body').removeClass('open');
                }
                jQuery('html, body').animate({
                    scrollTop: target.offset().top
                }, 300, "swing");
                return false;
            }
        }
    });
});
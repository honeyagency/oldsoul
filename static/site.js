jQuery(document).ready(function($) {
    var myLazyLoad = new LazyLoad({
        // example of options object -> see options section
        threshold: 500,
        throttle: 30,
        show_while_loading: false,
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
    $va = $('.product-type-variable');
    $va.each(function() {
        if ($(this).hasClass('product_cat-featured')) {
            $(this).find('select').addClass('icon-arrow-down-green');
        } else {
            $(this).find('select').addClass('icon-arrow-down-black');
        }
    });
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
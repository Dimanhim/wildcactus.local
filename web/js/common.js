jQuery(document).ready(function () {
    var mView = jQuery(".m-view, .logo button");

    jQuery(".logo button").on("click", function () {
        if (mView.hasClass("active")) mView.removeClass("active");
        else mView.addClass("active");
    });

    function controlView() {
        if (jQuery(window).width() <= 991) mView.removeClass("active");
        else mView.addClass("active");
    }

    controlView();

    jQuery(window).resize(function () {
        controlView();
    });

    // top cover

    var topCover = jQuery(".top-cover");

        topCover.owlCarousel({
            loop:true,
            items: 1,
          nav: false,
          dots: false,
          autoplay: true,
          autoplayTimeout: 6000,
        });

        topCover.hover(function(){
            topCover.trigger('stop.owl.autoplay')
        }, function(){
          topCover.trigger('play.owl.autoplay',[3000])
        });
        // top cover

    var promo = jQuery(".promo");

    promo.owlCarousel({
        loop: true,
        items: 1,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000
    });

    promo.hover(function () {
        promo.trigger('stop.owl.autoplay')
    }, function () {
        promo.trigger('play.owl.autoplay', [3000])
    });


    // slider product

    jQuery('.slider-product').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            991: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });

    jQuery(".owl-tr.tr-prev").on("click", function (e) {
        var id = jQuery(this).attr("data-id-owl");
        e.preventDefault();
        jQuery("#" + id).trigger('prev.owl.carousel');
    });

    jQuery(".owl-tr.tr-next").on("click", function (e) {
        var id = jQuery(this).attr("data-id-owl");
        e.preventDefault();
        jQuery("#" + id).trigger('next.owl.carousel');
    });

    jQuery('.owl-stock').owlCarousel({
        loop: true,
        items: 1,
        nav: false,
        dots: false
    });

    // gallery product photos

    jQuery('.slick-carousel').slick({
        infinite: true,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: jQuery('.top-arrow'),
        nextArrow: jQuery('.bottom-arrow')
    });

    jQuery("body").on("click", ".wp-gallery-carousel img", function () {
        jQuery(".one-img-product a").attr("href", jQuery(this).attr("src"));
        jQuery(".one-img-product img").attr("src", jQuery(this).attr("src"));
    });


    // scroll
/*
    jQuery(window).on("load", function () {
        jQuery(".uls-select-c").mCustomScrollbar();
    });
*/
    jQuery('.b span').on('click', function () {
        jQuery('#select-c').modal('show');
        return false;
    });
    jQuery('.fancy-img').fancybox({
        //selector : '[data-fancybox="images"]',
        loop: true,
        smallBtn: true,
        buttons: [
            'slideShow',
            'fullScreen',
            'thumbs',
            'share',
            'download',
            'zoom',
            'close'
        ],
        arrows: true,

    });

    jQuery('#mail-btn').on('click', function () {
        jQuery('.mail-form').css('display', 'block');
        jQuery('.sdek').css('display', 'none');
    });
    jQuery('#sdek-btn').on('click', function () {
        jQuery('.mail-form').css('display', 'none');
        jQuery('.sdek').css('display', 'block');
    });


});
jQuery(document).ready(function () {
    if (jQuery(window).width() < 767) {
        //alert('df');
        jQuery('.top-nav ul.nav-ul li').on('click', function () {
            var height = jQuery('.nav-ul').height();
            jQuery(this).find('.sub-nav').css('top', (height + 10));
            jQuery(this).find('.sub-nav').slideToggle();
        });
    }
    jQuery('#btn-pay').on('click', function () {
        var amount = $('#amount').val();
        if((amount == null) || (amount == "")) {
            $('#city').css('border', '1px solid #f00').css('color', '#f00');
            return false;
        }
        
    });
    
});








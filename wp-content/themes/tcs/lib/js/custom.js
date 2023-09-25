jQuery(document).ready(function($) {

    /**sticky menu */
    $(window).scroll(function() {
        if ($(window).scrollTop() > 37) {
            $('body').addClass('sticky-content');
            $('.site-header').addClass('sticky');
        } else {
            $('body').removeClass('sticky-content');
            $('.site-header').removeClass('sticky');
        }
    });

    /*Sliders Gallery*/
    jQuery('.tcs-gallery-content').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 200,
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        cssEase: 'ease-in-out',
        nextArrow: '<i class="fas fa-angle-right"></i>',
        prevArrow: '<i class="fas fa-angle-left"></i>',
        // asNavFor: '.vertical-slider'
    });

    /**
     * Light Box
     */
    lc_lightbox('.gallery-portfolio', {
        wrap_class: 'lcl_fade_oc',
        gallery: true,
        thumb_attr: 'data-lcl-thumb',
        skin: 'dark',
        fullscreen: true,
        socials: true,
    });

    /**/
    $('.current-tab').on('click', function() {
        $('.dropdown-tabs').toggle(200);
        $(this).toggleClass('clicked');
    });
    $('.dropdown-tabs a.active').on('click', function(e) {
        e.preventDefault();
    });

    /**/
    $('.links-nav-registration a').on('click', function(e) {
        e.preventDefault();
        $('.links-nav-registration a').removeClass('active');
        $(this).addClass('active');
        if ($(this).hasClass('login')) {
            $('#customer_login .u-column1').show();
            $('#customer_login .u-column2').hide();
        } else {
            $('#customer_login .u-column1').hide();
            $('#customer_login .u-column2').show();
        }
    });
    $('a.become-member').on('click', function(e) {
        e.preventDefault();
        $('.links-nav-registration a').removeClass('active');
        $('.links-nav-registration a.register').addClass('active');
        $('#customer_login .u-column1').hide();
        $('#customer_login .u-column2').show();
    });

    /*Sliders Home*/
    jQuery('.testimonials-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        cssEase: 'ease-in-out'
            // asNavFor: '.vertical-slider'
    });

    /*About Accordion*/
    $('.collapsible').collapsible();

    /*Masonrty Library */
    $('.grid-acgs').masonry({
        itemSelector: '.grid-item',
        // columnWidth: 100,
        // isResizable: true,
        // percentPosition: true,
        gutter: 5
    });

    // lc_lightbox('.gallery-acgs', {
    //     wrap_class: 'lcl_fade_oc',
    //     gallery: true,
    //     thumb_attr: 'data-lcl-thumb',
    //     skin: 'dark',
    //     fullscreen: true,
    //     socials: true,
    // });

    /**
     * Binnacle detail modal show/close
     */
    $('a[id*="bi_detail_btn"]').click(function(e) {
        e.preventDefault();
        var target = $(this).attr('href');

        $(target).addClass('show');
    });

    $('.binnacle-modal').click(function(e) {
        if (!$(e.target).hasClass('m-dialog') && $(e.target).closest('.m-dialog').length == 0) {
            $(e.target).closest('.binnacle-modal').removeClass('show');
        }
    });

    /* 
     * Confirm binnacle remove modal
     */
    $('#modal_delete_binnacle').modal({
        startingTop: '20%'
    });

    $('a[data-binnacle-confirm-remove]').click(function(e) {
        e.preventDefault();
        var binid = $(this).attr('id'),
            text = $(this).attr('data-binnacle-confirm-remove');

        $('#modal_delete_binnacle [data-binnacle-remove]').attr('data-binnacle-remove', binid);
        $('#modal_delete_binnacle #confirm_delete_message').html('Confirm deletion of item ' + text);
    });

    // Replace Image 
    $('.tcs-page-content .gallery-item a img').click(function(e) {
        e.preventDefault();
        var img_src = $(this).attr('src');
        $('.tcs-page-content > p > img').attr('srcset', img_src);
        $(".tcs-page-content > p > img").attr("src", img_src);
    });
    // Hover side 
    // jQuery('.drop-menu .wp-megamenu-sub-menu .wp-megamenu-sub-menu .wpmm-type-widget > h4').click(function(e) {
    //     jQuery(this).toggleClass('arrow');
    //     jQuery(this).parent().find('div').slideToggle("fast");
    // });


    $('aside .menu .menu-item .sub-menu li.current_page_item').parent().parent().addClass("show", { duration: 400 });

    $('.widget_nav_menu .menu > .menu-item > a').click(function(e) {
       // e.preventDefault();
        var show = $(this).parent('.show').length;
        if (show == 0) {
            // $('aside .menu .menu-item').removeClass("current-menu-parent", { duration: 400 });
            // $('aside .menu .menu-item').removeClass("show", { duration: 400 });
            $(this).parent().addClass("show", { duration: 400 });
        } else {
            $(this).parent().removeClass("current-menu-parent", { duration: 400 });
            $(this).parent().removeClass("show", { duration: 400 });
        }

        // $('aside .menu .menu-item').removeClass("show", { duration: 500 });
        // $(this).parent().addClass("show", { duration: 500 });
    });

    // Play Video Landing Page
    var has_class_body = jQuery('body').hasClass('lp-thermal');
    var has_class_video = jQuery('div').hasClass('wp-video');

    if (has_class_body && has_class_video) {
        jQuery('.wp-video').parent().addClass('wrap-video');
    }
    jQuery('.mejs-overlay-button').click(function() {
        jQuery('.wrap-video img').css({
                "opacity": "0", 
                "z-index": "-1"
            });
        jQuery('.wrap-video').addClass('play-video');
    });
});
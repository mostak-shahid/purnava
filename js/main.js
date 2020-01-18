jQuery(document).ready(function($){
	// var pathname = window.location.pathname;
	// // console.log(pathname);
	// if(pathname.match('log-in') && $('body').hasClass('logged-in-user'))
	// 	window.location.href = window.location.origin + '/ePurnava/my-account/';
    // $("input[type='number']").InputSpinner({
    //     decrementButton: "<i class='fa fa-minus'></i>", // button text
    //     incrementButton: "<i class='fa fa-plus'></i>",
    // });
    function modalshow(){
        $('#exampleModal').modal('show')
    }
    $('#watch-video').click(function(event){
        var href = $(this).attr('href');
        alert(href);
        event.preventDefault();
    });
    $('.auth-form-wrapper .input-group-text').click(function(){
        var input = $(this).closest('.form-group').find('input');
        var intype = input.attr('type'); 
        if (intype === "password"){
            input.attr('type', 'text');
        } else{
            input.attr('type', 'password');
        }
    });
    $('<div class="share-title"><strong>Share this event</strong></div>').prependTo('.single-event-post .addtoany_content');
    var loader = $('#loader-status').val();
    if (loader == 1) {
        $('body').css({"height": "100%", "overflow": "hidden"})
        $(window).load(function() {
            // Animate loader off screen
            $('body').removeAttr("style");
            $(".se-pre-con").fadeOut("slow");
        });
    } 
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            //$('.scrollup').fadeIn();
            $('#main-header').addClass('tiny');
            $('.scrollup').fadeIn();
        } else {
            //$('.scrollup').fadeOut();
            $('#main-header').removeClass('tiny');
            $('.scrollup').fadeOut();
        }
    });
    
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    
    $('#menu-toggle').click(function(){
        $('.nav-part').slideToggle();
    });
    
    $('#section-widgets .widgets-two .widget-title,#section-widgets .widgets-three .widget-title').click(function(){
        $(this).next().slideToggle();
    });
    $(".navbar-nav > li:has('ul')").prepend("<span class='drop_down_icon fa fa-angle-down'></span>");
    
    $(".drop_down_icon").click(function() {
        $(this).siblings("ul").slideToggle();
    }); 
    $('#section-banner-owl').owlCarousel({
        loop: true,
        nav: true,
        dots: true,
        items:1,
        margin: 0,              
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
    $('#section-feature-owl').owlCarousel({
        loop:true,
        nav:true,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });
    $('#section-banner-owl .owl-prev').html('<i class="fa fa-angle-left"></i>');
    $('#section-banner-owl .owl-next').html('<i class="fa fa-angle-right"></i>');
    $('#section-feature .slider-part .owl-prev').html('<i class="fa fa-arrow-circle-left"></i>');
    $('#section-feature .slider-part .owl-next').html('<i class="fa fa-arrow-circle-right"></i>');

    /*$('.single-product-thumbnails').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: true,
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,
    });*/
    $('.single-product-thumbnails').owlCarousel({
        loop: true,
        nav: true,
        dots: false,        
        items:4,
        center:true,
    });
    $('.mos-embeded-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1, 
        dots: false,
        arrows: true, 
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true, 
        center:true,
        centerPadding: '100px 0px 0px', 
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerMode: true,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2, 
                    dots: true,                    
                }
            }
        ]    
    });
    $('.mos-event-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1, 
        dots: true,
        arrows: false, 
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,  
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerMode: true,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1, 
                    dots: true,
                    center:true,
                    centerPadding: '40px 0px 0px',
                }
            }
        ]    
    });
    $('.related-products').slick({
        slidesToShow: 4,
        slidesToScroll: 1, 
        dots: false,
        arrows: false, 
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,  
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1, 
                    dots: true,
                }
            }
        ]    
    });
    /*$('.ads-slick-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        // centerMode: true,
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    centerMode: true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                }
            }
        ]
    }); */
    $('.single-product-thumbnails img').click(function(){
        var img = (this).data('src');
        alert(img);
    });
    $('.remove-from-wishlist').click(function(e){
        e.preventDefault();
        var product_id = $(this).data('product_id');
        $(this).closest('.wishlist-wrapper').remove();
        remove_from_wishlist(product_id);
    });
    $('.wishlist-to-cart-button').click(function(e){
        e.preventDefault();
        var product_id = $(this).data('product_id');
        $(this).closest('.wishlist-wrapper').remove();
        remove_from_wishlist(product_id);
        var url = window.location.href + '??add-to-cart=' + product_id;
        window.location = url;
    });
    function remove_from_wishlist(product_id){
        var str = getCookie('wishlist_products');
        var array = str.split(",");
        var index = array.indexOf(product_id.toString());
        if (index > -1) {
            array.splice(index, 1);
        }
        var cvalue = array.toString();
        setCookie('wishlist_products',cvalue,30);
    }
    $("#account_image").change(function(){
        readURL(this, '#account_image_preview');
    });
    $('.address-unit.old-unit').click(function(){
        $(this).parent().siblings().find('.address-unit').removeClass('active');
        $(this).addClass('active');
        $(this).find('.custom-control-input').attr('checked', true);

        var fname = $(this).data('fname');
        var lname = $(this).data('lname');
        var phone = $(this).data('phone');
        var address = $(this).data('address');
        var city = $(this).data('city');
        var district = $(this).data('district');
        var post = $(this).data('post');

        $('#billing_first_name,#shipping_first_name').val(fname);
        $('#billing_last_name,#shipping_last_name').val(lname);
        $('#billing_address_1').val(address);
        $('#billing_city').val(city);
        $('#billing_state').val(district);
        $('#billing_phone').val(phone);
        $('#billing_postcode').val(post);
    });
    function readURL(input,output) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $(output).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

});
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
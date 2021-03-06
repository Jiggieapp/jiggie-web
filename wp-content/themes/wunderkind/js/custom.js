function not_use_iframe()
{
    try{
        if(self!=top)
        {
            try{
                var top_crossdomain=top.location.href;
                if(typeof top_crossdomain=="undefined"){
                    //Fix for ipad

                    var wlocation=window.location;
                    window.top.location=wlocation;
                }
            }catch(e){
                //Cross domain, redirect
                var wlocation=window.location;
                window.top.location=wlocation;
            }
            

        }
    }catch(e){
        console.log(e);

    }
}
function detectmob() { 
		 if( navigator.userAgent.match(/Android/i)
		 || navigator.userAgent.match(/webOS/i)
		 || navigator.userAgent.match(/iPhone/i)
		 || navigator.userAgent.match(/iPad/i)
		 || navigator.userAgent.match(/iPod/i)
		 || navigator.userAgent.match(/BlackBerry/i)
		 || navigator.userAgent.match(/Windows Phone/i)
		 ){
		    
		    return true;
		  }
		 else {
		    return false;
		  }
	} 
//Dont use iframe because iframe in ios has problem
not_use_iframe();

jQuery(document).ready(function($){

	"use strict";
	var is_mobile=false;

	if(detectmob()){
	    is_mobile=true;
	    $('body').addClass('is_mobile');
	}else
	{
	    is_mobile=false;
	}

	/* ==============================================
	Liquid Slider - Home Text Slider
	=============================================== */
	
	if(typeof wunderkind=='undefined' || typeof wunderkind.disable_slider_text=='undefined' || wunderkind.disable_slider_text==false)
	{
		
		 var speed_text = 4500;
		if($('#slider-home').data('duration')){
			speed_text = $('#slider-home').data('duration');
		}

	    //Enable Slider Text
	        $('#slider-home').liquidSlider({
	              autoSlide:          true,
	              autoSlideInterval:  speed_text,
	              autoSlideControls:  true,
	              forceAutoSlide: true,
	              dynamicArrows: false,
	            
	          slideEaseFunction:'animate.css',
	          slideEaseDuration:500,
	          heightEaseDuration:500,
	          animateIn:"bounceIn",
	          animateOut:"bounceOut",
	          callback: function() {
	            var self = this;
	            $('.slider-6-panel').each(function() {
	              $(this).removeClass('animated ' + self.options.animateIn);
	            });
	          }
	        });
	}

	/* ==============================================
	Liquid Slider - Quotes Slider
	=============================================== */
	if(typeof theme_slider !=='undefined' && theme_slider.length>0)
	{
	    $.each(theme_slider,function(index,value){
	        try{
	            var slide_speed=4500;

	            if($('#'+value).data('speed')){
	                slide_speed=$('#'+value).data('speed');
	            }
	            

	            $('#'+value).liquidSlider({
	                        autoSlide:          true,
	                        autoSlideDirection: 'right',
	                        autoSlideInterval:  slide_speed,
	                        autoSlideControls:  true,
	                        forceAutoSlide: true,
	                        autoHeight: false,
	                        dynamicArrows: true,
	                        slideEaseFunction:'animate.css',
	                        slideEaseDuration:500,
	                        heightEaseDuration:500,
	                        animateIn:"flipInX",
	                        animateOut:"fadeOut",
	                        callback: function() {
	                            var self = this;
	                            $('.slider-6-panel').each(function() {
	                                $(this).removeClass('animated ' + self.options.animateIn);
	                            });
	                        }
	            });
	        }catch(e){
	            console.log(e);
	        }
	    });
	}
	/* ==============================================
	 Liquid Slider - Quotes Slider
	 =============================================== */
	 try{

	    $('#shop-banner').liquidSlider({
	        autoSlide:          true,
	        autoSlideDirection: 'right',
	        autoSlideInterval:  4500,
	        autoSlideControls:  true,
	        forceAutoSlide: true,
	        autoHeight: false,
	        dynamicArrows: true,

	        slideEaseFunction:'animate.css',
	        slideEaseDuration:500,
	        heightEaseDuration:500,
	        animateIn:"fadeInX",
	        animateOut:"fadeOut",
	        callback: function() {
	            var self = this;
	            $('.slider-6-panel').each(function() {
	                $(this).removeClass('animated ' + self.options.animateIn);
	            });
	        }
	    });

	 }catch(e){
	    console.log(e);
	 }

	 //Check if menu is fixed
    if(typeof st_params.header_disable_fixed=="undefined" || st_params.header_disable_fixed==false)
    {
        var topSpacing=0;
        if($('#wpadminbar').length && $('#wpadminbar').css('position')=='fixed')
        {
            topSpacing=$('#wpadminbar').height();
        }
        
        $(".navbar").sticky({topSpacing:topSpacing});
    }

    var $header = $('.header-top');
    $(window).scroll(function () {
       if(scrollY <= 0){
           $header.animate({
                opacity: 0
           }, 300);
       }
       if(scrollY > 0 && $header.is(':not(:animated)')){
           $header.animate({
                opacity: 0.9999
           }, 300);
        }
     });

    /* ==============================================
	Navbar "hovernav" dropdown menu
	=============================================== */
	
	  /*
	    "Hovernav" navbar dropdown on hover
	    Delete this segment if you don't want it, and delete the corresponding CSS in style.css
	    */
	    var mq = window.matchMedia('(min-width: 768px)');
	  if (mq.matches) {
	    $('ul.navbar-nav li').addClass('hovernav');
	  } else {
	    $('ul.navbar-nav li').removeClass('hovernav');
	  };
	    /*
	    The addClass/removeClass also needs to be triggered
	  on page resize <=> 768px
	    */
	  if (matchMedia) {
	    var mq = window.matchMedia('(min-width: 768px)');
	    mq.addListener(WidthChange);
	    WidthChange(mq);
	  }
	    function WidthChange(mq) {
	    if (mq.matches) {
	      $('ul.navbar-nav li').addClass('hovernav');
	    } else {
	      $('ul.navbar-nav li').removeClass('hovernav');
	    }
	  };

	try
	{

		var wow = new WOW(
	      {
	        boxClass:     'wow',      // animated element css class (default is wow)
	        animateClass: 'animated', // animation css class (default is animated)
	        offset:       150,          // distance to the element when triggering the animation (default is 0)
	        mobile:       false        // trigger animations on mobile devices (true is default)
	      }
	    );
	    wow.init();  

	}catch(e)
	{
		console.log(e);
	}




	/* ==============================================
	Bootstrap Tooltip, Alert, Tabs
	=============================================== */

	$(function () { $("[data-toggle='tooltip']").tooltip();  
    	$(".alert").alert()
	});
	$(function () {
	    var active = true;
	    $('#collapse-init').click(function () {
	        if (active) {
	            active = false;
	            $('.panel-collapse').collapse('show');
	            $('.panel-title').attr('data-toggle', '');
	            $(this).text('Close All');
	        } else {
	            active = true;
	            $('.panel-collapse').collapse('hide');
	            $('.panel-title').attr('data-toggle', 'collapse');
	            $(this).text('Open All');
	        }
	    });
	    $('#accordion').on('show.bs.collapse', function () {
	        if (active) $('#accordion .in').collapse('hide');
	    });
	});
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});



	try{
        // $(".player").tubular();
        $(".player").mb_YTPlayer();
    }catch(e)
    {
        console.log(e);
    }

    if(!is_mobile)
	{
	    /* ==============================================
	    Skill Bars
	    =============================================== */
	    $('.skillbar').waypoint(function() {
	       jQuery('.skillbar').each(function(){
	            jQuery(this).find('.skillbar-bar').animate({
	                width:jQuery(this).attr('data-percent')
	            },2000);
	        });
	        
	        }, { offset: '100%' 
	    });
	}else
	{
	    jQuery('.skillbar').each(function(){
	            jQuery(this).find('.skillbar-bar').animate({
	                width:jQuery(this).attr('data-percent')
	            },2000);
	    });
	}



	if($('#preloader').length){
        jQuery("#preloader").delay(500).fadeOut(1000,function(){

            //after preload fade out, set up banner slider
            setupBannerSlider();

        });
    }
    else
    {
        setupBannerSlider();
    }
    jQuery(".preload-logo").addClass('fadeOutLeft');
    jQuery(".back-logo").addClass('fadeOutRight');
    jQuery(".preload-gif").addClass('fadeOutUp');


    /* ==============================================
	Counter Up
	=============================================== */
	if(!is_mobile)
	{
	    try
	    {
	        $('.counter').counterUp({
	            delay: 10,
	            time: 800
	        });
	    }catch(e){
	        console.log(e);
	    }

	}

	if(!is_mobile)
	{
	   
        var height_video = $(window).width();
        var height_responsive = (height_video / 1.78011) + 1;
        $('.video_slide').css("height",height_responsive);
        $(window).resize(function() {
        var height_video = $(window).width();
        var height_responsive = (height_video / 1.78011) + 1;
        $('.video_slide').css("height",height_responsive);
        });
	    
	}
	$(window).load(function() {
	  $('.flexslider').flexslider({
	    animation: "slide"
	  });
	    $('.shop-flexslider').flexslider({
	        animation: "slide",
	        controlNav: "thumbnails",
	    });
	});

	$.each($(".st_google_map"),function(i,value){
        var address,icon,v,saturation,lightness,gamma,map_config;
        v=$(value);
        address= v.data('address');
        icon= v.data('marker');
        saturation=v.data('saturation');
        lightness=v.data('lightness');
        gamma=v.data('gamma');

        map_config={ map:{
                        options:{
                            styles: [ {
                                stylers: [ { "saturation":v.data('saturation') }, { "lightness": v.data('lightness') }, { "gamma": v.data('gamma') }]}
                           ],
                            zoom: v.data('zoom'),
                            scrollwheel:false,
                            draggable: true }
                    }
                    
                };

        if(v.data('type')==1)
        {
            map_config.marker={
                address:v.data('address'),
                
            }
        }else
        {
            map_config.marker={
                latLng: [v.data('lat'), v.data('lng')],
                
            };
            map_config.map.options.center=[v.data('lat'), v.data('lng')];
        }
        map_config.marker.options={
        	icon:icon
        };
        console.log(map_config);
        v.gmap3(map_config);
    });


    /* ==============================================
	Back to Top
	=============================================== */
	$(window).scroll(function(){
	        if($(window).height() > 300){
	            $("#back-to-top").fadeIn(600);
	        } else{
	            $("#back-to-top").fadeOut(600);
	        }
	    });
	    
	    $('#back-to-top, .back-to-top').click(function() {
	          $('html, body').animate({ scrollTop:0 }, '1000');
	          return false;
	    });



	/* ==============================================
	Backstretch - v2.0.4
	=============================================== */
	function setupBannerSlider()
	{

	if(typeof wunderkind !=="undefined" && typeof wunderkind.slides!="undefined" && wunderkind.slides.length>0)
	{

	    //Show gallery instead of video on mobile
	    if(wunderkind.video_version==false || is_mobile)
	    {

	        var fade_time=700;
	        if(typeof wunderkind.fade!="undefined")
	        {
	            fade_time=wunderkind.fade;
	        }
	        var duration_time=4000;
	        if(typeof wunderkind.duration!="undefined")
	        {
	            duration_time=wunderkind.duration;
	        }
	        try{

	            $("#home-pattern").backstretch(wunderkind.slides, {
	                fade: fade_time,
	                duration: duration_time
	            });

	        }catch(e){
	            console.log(e);
	        }
	    }
	}

	} 


	/* ==============================================
	Portfolio
	=============================================== */
	(function ($, window, document, undefined) {
	    var gridContainer = $('#grid-container'),
	        filtersContainer = $('#filters-container');

	    try
	    {

	        gridContainer.cubeportfolio({
	        defaultFilter: '*',
	        animationType: 'flipOut',
	        gapHorizontal: 25,
	        gapVertical: 25,
	        gridAdjustment: 'responsive',
	        caption: 'overlayBottomReveal',
	        displayType: 'lazyLoading',
	        displayTypeSpeed: 100,
	        // lightbox
	        lightboxDelegate: '.cbp-lightbox',
	        lightboxGallery: true,
	        lightboxTitleSrc: 'data-title',
	        lightboxShowCounter: true,
	        // singlePage popup
	        singlePageDelegate: '.cbp-singlePage',
	        singlePageDeeplinking: true,
	        singlePageStickyNavigation: true,
	        singlePageShowCounter: true,
	        singlePageCallback: function (url, element) {
	            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
	            var t = this;
	            $.ajax({
	                url: url,
	                type: 'GET',
	                dataType: 'html',
	                timeout: 5000
	            })
	            .done(function(result) {
	                t.updateSinglePage(result);
	                $('.flexslider').flexslider();
	            })
	            .fail(function() {
	                t.updateSinglePage("Error! Please refresh the page!");
	            });
	        },
	        // single page inline
	        singlePageInlineDelegate: '.cbp-singlePageInline',
	        singlePageInlinePosition: 'above',
	        singlePageInlineShowCounter: true,
	        singlePageInlineInFocus: true,
	        singlePageInlineCallback: function(url, element) {
	            // to update singlePage Inline content use the following method: this.updateSinglePageInline(yourContent)
	        }
	    });

	        // add listener for filters click
	        filtersContainer.on('click', '.cbp-filter-item', function (e) {
	            var me = $(this), wrap;
	            // get cubeportfolio data and check if is still animating (reposition) the items.
	            if ( !$.data(gridContainer[0], 'cubeportfolio').isAnimating ) {
	                if ( filtersContainer.hasClass('cbp-l-filters-dropdown') ) {
	                    wrap = $('.cbp-l-filters-dropdownWrap');
	                    wrap.find('.cbp-filter-item').removeClass('cbp-filter-item-active');
	                    wrap.find('.cbp-l-filters-dropdownHeader').text(me.text());
	                    me.addClass('cbp-filter-item-active');
	                } else {
	                    me.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
	                }
	            }
	            // filter the items
	            gridContainer.cubeportfolio('filter', me.data('filter'), function () {});
	        });
	        // activate counters
	        gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'));
	        // add listener for load more click
	        $('.cbp-l-loadMore-button-link').on('click', function(e) {
	            e.preventDefault();
	            var clicks, me = $(this), oMsg;
	            if (me.hasClass('cbp-l-loadMore-button-stop')) return;
	            // get the number of times the loadMore link has been clicked
	            clicks = $.data(this, 'numberOfClicks');
	            clicks = (clicks)? ++clicks : 1;
	            $.data(this, 'numberOfClicks', clicks);
	            // set loading status
	            oMsg = me.text();
	            me.text('LOADING...');
	            // perform ajax request
	            $.ajax({
	                url: me.attr('href'),
	                data:{
	                  'paged':clicks
	                },
	                type: 'GET',
	                dataType: 'json'
	            })
	            .done( function (results) {
	            	me.text(oMsg);
	                var items, itemsNext,result;
	                result=results.content;
	                // find current container
	                items = $(result).filter( function () {
	                    return $(this).is('div' + '.cbp-loadMore-block' + clicks);
	                });
	                var cubeportfolioObj=me.parent().prev('.cbp');

	                cubeportfolioObj.cubeportfolio('appendItems', items.html(),
	                     function () {
	                        itemsNext=results.hasNext;
	                        if (itemsNext ==false) {
	                            me.text('NO MORE WORKS');
	                            me.addClass('cbp-l-loadMore-button-stop');
	                        }
	                     });
	            })
	            .fail(function() {
	                // error
	                me.text(oMsg);
	            });
	        });
	    }catch(e){
	        console.log(e);
	    }
	})(jQuery, window, document);




	//Scroll
	$('.btn-home a,.move a').bind('click', function(event) {
        var $anchor = $(this);
        var $next=$($anchor.attr('href'));
        if($next.length<=0) return;
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 70
        }, 1000);
        event.preventDefault();
    });




    /* ==============================================
	Smooth Scroll To Anchor
	=============================================== */
	//jQuery for page scrolling feature - requires jQuery Easing plugin
    $('#main-nav a').bind('click', function(event) {
        var $anchor = $(this);
        var url=$anchor.attr('href');
        var hash = url.substring(url.indexOf('#'));
        if($(hash).length)
        {
            $('html, body').stop().animate({
                scrollTop: $(hash).offset().top - 70
            }, 1000);
            event.preventDefault();
        }
    });
	    
	/* ==============================================
	Active Menu Item on Page Scroll
	=============================================== */   
	    
	var  nav = $('nav.navbar-static-top')
	  , nav_height = nav.outerHeight(),
	    find_rs,admin_bar_height;

	   admin_bar_height=0;


	   if($('#wpadminbar').length && $('#wpadminbar').css('position')=='fixed' )
	   {
	   		admin_bar_height=$('#wpadminbar').outerHeight();
	   }

	  if($('body').hasClass('page_boxed'))
	  {
	      var sections=$('body .main_wraper>section');
	  }else{
	      var sections = $('body>section');
	  }

	nav_height+=admin_bar_height;

	if(is_mobile==false)
	{
	    $(window).on('scroll', function () {
	      var cur_pos = $(this).scrollTop();
	     
	      sections.each(function() {
	        var top = $(this).offset().top - nav_height,
	            bottom = top + $(this).outerHeight();
	     
	        if (cur_pos >= top && cur_pos <= bottom) {
	          nav.find('a').removeClass('current');
	          sections.removeClass('current');
	          $(this).addClass('current');
	         
	            find_rs=nav.find('a[href$="#'+$(this).attr('id')+'"]');
	            if(find_rs.length)
	            {
	                find_rs.addClass('current');
	            }
	        }
	      });
	    });

	}
	    //Add button comment style
	    $('.comment-form input#submit').addClass('btn btn-primary').attr('id','');
	    $('td.product-add-to-cart .button').addClass('btn btn-primary').removeClass('button');
	    $('.price_slider_amount button[type=submit]').addClass('btn btn-primary pull-left').removeClass('button');
	    $('.alert a.button').addClass('btn btn-primary pull-right').removeClass('button');


	    //Add Parallax
	    try{
	        $('.st_parallax').each(function(i,v){

	            $(v).parallax("50%", 0.6);

	        });
	    }catch(e){
	        console.log(e);
	    } 
		
		

 
});

/* ==============================================
        Portfolio Fullwidth Calling
        =============================================== */

        (function ($, window, document, undefined) {

            var gridContainer = $('#grid-container-fullwidth'),
                filtersContainer = $('#filters-container-fullwidth');
            // init cubeportfolio
            gridContainer.cubeportfolio({
                defaultFilter: '*',
                animationType: 'slideDelay',
                gapHorizontal: 4,
                gapVertical: 4,
                gridAdjustment: 'responsive',
                caption: 'zoom',
                displayType: 'lazyLoading',
                displayTypeSpeed: 100,
                // lightbox
                lightboxDelegate: '.cbp-lightbox',
                lightboxGallery: true,
                lightboxTitleSrc: 'data-title',
                lightboxShowCounter: true,
                // singlePage popup
                singlePageDelegate: '.cbp-singlePage',
                singlePageDeeplinking: true,
                singlePageStickyNavigation: true,
                singlePageShowCounter: true,
                singlePageCallback: function (url, element) {
                    // to update singlePage content use the following method: this.updateSinglePage(yourContent)
                },
                // singlePageInline
                singlePageInlineDelegate: '.cbp-singlePageInline',
                singlePageInlinePosition: 'above',
                singlePageInlineShowCounter: true,
                singlePageInlineInFocus: true,
                singlePageInlineCallback: function(url, element) {
                    // to update singlePageInline content use the following method: this.updateSinglePageInline(yourContent)
                }
            });
            // add listener for filters click
            filtersContainer.on('click', '.cbp-filter-item', function (e) {
                var me = $(this), wrap;
                // get cubeportfolio data and check if is still animating (reposition) the items.
                if ( !$.data(gridContainer[0], 'cubeportfolio').isAnimating ) {
                    if ( filtersContainer.hasClass('cbp-l-filters-dropdown') ) {
                        wrap = $('.cbp-l-filters-dropdownWrap');
                        wrap.find('.cbp-filter-item').removeClass('cbp-filter-item-active');
                        wrap.find('.cbp-l-filters-dropdownHeader').text(me.text());
                        me.addClass('cbp-filter-item-active');
                    } else {
                        me.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
                    }
                }
                // filter the items
                gridContainer.cubeportfolio('filter', me.data('filter'), function () {});
            });
            // activate counter for filters
            gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'));
       


        })(jQuery, window, document);
    
 
 /* ==============================================
        Portfolio Masonry Calling
        =============================================== */

        (function ($, window, document, undefined) {

            var gridContainer = $('#grid-container-masonry'),
                filtersContainer = $('#filters-container-masonry');

            // init cubeportfolio
            gridContainer.cubeportfolio({
                defaultFilter: '*',
                animationType: 'slideDelay',
                gapHorizontal: 5,
                gapVertical: 5,
                gridAdjustment: 'responsive',
                caption: 'zoom',
                displayType: 'bottomToTop',
                displayTypeSpeed: 100,
                // lightbox
                lightboxDelegate: '.cbp-lightbox',
                lightboxGallery: true,
                lightboxTitleSrc: 'data-title',
                lightboxShowCounter: true,
                // singlePage popup
                singlePageDelegate: '.cbp-singlePage',
                singlePageDeeplinking: true,
                singlePageStickyNavigation: true,
                singlePageShowCounter: true,
                singlePageCallback: function (url, element) {
                    // to update singlePage content use the following method: this.updateSinglePage(yourContent)
                },
                // singlePageInline
                singlePageInlineDelegate: '.cbp-singlePageInline',
                singlePageInlinePosition: 'above',
                singlePageInlineShowCounter: true,
                singlePageInlineInFocus: true,
                singlePageInlineCallback: function(url, element) {
                    // to update singlePageInline content use the following method: this.updateSinglePageInline(yourContent)
                }
            });
            // add listener for filters click
            filtersContainer.on('click', '.cbp-filter-item', function (e) {
                var me = $(this), wrap;
                // get cubeportfolio data and check if is still animating (reposition) the items.
                if ( !$.data(gridContainer[0], 'cubeportfolio').isAnimating ) {
                    if ( filtersContainer.hasClass('cbp-l-filters-dropdown') ) {
                        wrap = $('.cbp-l-filters-dropdownWrap');
                        wrap.find('.cbp-filter-item').removeClass('cbp-filter-item-active');
                        wrap.find('.cbp-l-filters-dropdownHeader').text(me.text());
                        me.addClass('cbp-filter-item-active');
                    } else {
                        me.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
                    }
                }
                // filter the items
                gridContainer.cubeportfolio('filter', me.data('filter'), function () {});
            });
            // activate counter for filters
            gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'));
        })(jQuery, window, document);
		 
		 
   /* ==============================================
Owl Slider callings
=============================================== */

jQuery(document).ready(function() {

	jQuery("#popular-products-slider").owlCarousel({
		autoPlay : true,
		items: 4,
		pagination: false,
		navigation: true,
		navigationText: [
			"<i class='ion-chevron-left'></i>",
			"<i class='ion-chevron-right'></i>"
		],
	});

});
  /* ==============================================
Image Hover Effect
=============================================== */

jQuery(document).ready(function(){
	if (Modernizr.touch) {
		// show the close overlay button
		jQuery(".close-overlay").removeClass("hidden");
		// handle the adding of hover class when clicked
		jQuery(".img").click(function(e){
			if (!$(this).hasClass("hover")) {
				$(this).addClass("hover");
			}
		});
		// handle the closing of the overlay
		jQuery(".close-overlay").click(function(e){
			e.preventDefault();
			e.stopPropagation();
			if ($(this).closest(".img").hasClass("hover")) {
				$(this).closest(".img").removeClass("hover");
			}
		});
	} else {
		// handle the mouseenter functionality
		jQuery(".img").mouseenter(function(){
			jQuery(this).addClass("hover");
		})
		// handle the mouseleave functionality
		.mouseleave(function(){
			jQuery(this).removeClass("hover");
		});
	}
});

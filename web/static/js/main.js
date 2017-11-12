(function ($) {
 "use strict";
 
   /* jQuery MOBILEMenu */
   jQuery('nav#dropdown').meanmenu();
   /*---------------------
	 TOP Menu Stick
	--------------------- */
	var s = $("#sticker");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos > pos.top) {
		s.addClass("stick");
		} else {
			s.removeClass("stick");	
		}
	});
	/*-------------------------------
	 1. owl-carousel 
	--------------------------------*/
	$(".h-slider-1").owlCarousel({
		autoPlay: true,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 1, //1 items above 1000px browser width
		itemsDesktop : [1000,1], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,1], // betweem 900px and 601px
		itemsTablet: [767,1],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:true,
		navigation:true,
		navigationText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
	});
	/*-------------------------------
	 2. owl-carousel 
	--------------------------------*/
	$(".h14-products").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 4, //1 items above 1000px browser width
		itemsDesktop : [1000,4], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,1],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
	});
	/*-------------------------------
	 3. owl-carousel 
	--------------------------------*/
	$(".h1-al-testi").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 1, //1 items above 1000px browser width
		itemsDesktop : [1000,1], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,1], // betweem 900px and 601px
		itemsTablet: [767,1],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:true,
		navigation:false,
		navigationText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
	});
	/*-------------------------------
	 4. owl-carousel 
	--------------------------------*/
	$(".h1-all-blogs").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 3, //1 items above 1000px browser width
		itemsDesktop : [1000,2], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,2], // betweem 900px and 601px
		itemsTablet: [767,2],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 5. owl-carousel 
	--------------------------------*/
	$(".h2-products").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 3, //1 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,2], // betweem 900px and 601px
		itemsTablet: [767,2],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 6. owl-carousel 
	--------------------------------*/
	$(".h3-products").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 5, //1 items above 1000px browser width
		itemsDesktop : [1000,5], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,2], // betweem 900px and 601px
		itemsTablet: [767,2],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 7. owl-carousel 
	--------------------------------*/
	$(".h9-products").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 3, //1 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,3],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 8. owl-carousel 
	--------------------------------*/
	$(".cat-small-products").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 4, //1 items above 1000px browser width
		itemsDesktop : [1000,4], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,2],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 9. owl-carousel 
	--------------------------------*/
	$(".h5-new-design .h4-products").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 4, //1 items above 1000px browser width
		itemsDesktop : [1000,4], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,2], // betweem 900px and 601px
		itemsTablet: [767,2],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 10. owl-carousel 
	--------------------------------*/
	$(".h2-testimuial").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 1, //1 items above 1000px browser width
		itemsDesktop : [1000,1], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,1], // betweem 900px and 601px
		itemsTablet: [767,1],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:true,
		navigation:false,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});
	/*-------------------------------
	 11. owl-carousel 
	--------------------------------*/
	$(".h2-brand-logos").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 5, //1 items above 1000px browser width
		itemsDesktop : [1000,5], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,4],
		itemsMobile : [450,3], // itemsMobile disabled - inherit from itemsTablet option
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
	});

	/*-------------------------------
	 12. owl-carousel 
	--------------------------------*/
	$(".h-2-sliders").owlCarousel({
		autoPlay: false,
		center: true,
		slideSpeed : 2000,
		rewindSpeed : 2000,
		items : 1, //1 items above 1000px browser width
		itemsDesktop : [1000,1], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,1], // betweem 900px and 601px
		itemsTablet: [767,1],
		itemsMobile : [450,1], // itemsMobile disabled - inherit from itemsTablet option
		pagination:true,
		navigation:true,
		navigationText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
	});
	/*---------------------
	 scrollUp
	--------------------- */	
	$.scrollUp({
		scrollText: '<i class="fa fa-angle-up"></i>',
		easingType: 'linear',
		scrollSpeed: 900,
		animation: 'fade'
	});
	/*---------------------
	 Countdown
	--------------------- */	
	// To change date, simply edit: var endDate = August 20, 2017 12:40:00";
	  var endDate = "August 20, 2017 12:40:00";
	  $('.nrb-countdown .row').countdown({
		date: endDate,
		render: function(data) {
		  $(this.el).html('<div><div class="days"><span>' + this.leadingZeros(data.days, 2) + '</span><span>days</span></div><div class="hours"><span>' + this.leadingZeros(data.hours, 2) + '</span><span>hours</span></div></div><div class="nrb-countdown-ms"><div class="minutes"><span>' + this.leadingZeros(data.min, 2) + '</span><span>minutes</span></div><div class="seconds"><span>' + this.leadingZeros(data.sec, 2) + '</span><span>seconds</span></div></div>');
		}
	  });
	/*---------------------------------
	 price slider
	-----------------------------------*/
		$("#slider-range" ).slider({
			range: true,
			min: 0,
			max: 500,
			values: [ 15, 458 ],
			slide: function( event, ui ) {
				$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			}
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
			" - $" + $( "#slider-range" ).slider( "values", 1 ) );
   /*---------------------
	 Input Number Incrementer
	--------------------- */
	  $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');
	  $(".button").on("click", function() {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
		  var newVal = parseFloat(oldValue) + 1;
		} else {
		   // Don't allow decrementing below zero
		  if (oldValue > 0) {
			var newVal = parseFloat(oldValue) - 1;
			} else {
			newVal = 0;
		  }
		  }
		$button.parent().find("input").val(newVal);
	  });
    /*---------------------
	Single  product Zoom
	--------------------- */
	$('.simpleLens-big-image').simpleLens({
	    loading_image: 'demo/images/loading.gif'
	});
   /*-------------------------
	Active for fancybox
	--------------------------*/
	$('.fancybox').fancybox();
	$(".st-video").on("click", function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'			: 640,
			'height'		: 385,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});

		return false;
	});


})(jQuery);
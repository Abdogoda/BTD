(function ($) {

	'use strict';
	
 // SCROLL TO TOP
  
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 70) {
        $('.backtop').addClass('reveal');
    } else {
        $('.backtop').removeClass('reveal');
    }
});
 
var navlinks = $('header .nav-item');
 var dataTitle = $('body').attr('data-title').replace(/\s+/g, '');

 navlinks.each(function() {
     var navlink = $(this);
     if (navlink.attr('data-to') === dataTitle) {
         $('header .nav-item.active').removeClass('active');
         navlink.addClass('active');
     }
 });

	
	if ($('.portfolio-single-slider').length){
		$('.portfolio-single-slider').slick({
			infinite: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 2000

		});
	}

	if ($('.testimonial-wrap').length){
		$('.testimonial-wrap').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			dots: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 4000,
		});
	}

	if ($('.testimonial-wrap-2').length){
		$('.testimonial-wrap-2').slick({
			slidesToShow: 2,
			slidesToScroll: 2,
			infinite: true,
			dots: true,
			arrows:false,
			autoplay: true,
			autoplaySpeed: 6000,
			responsive: [
							{
									breakpoint: 1024,
									settings: {
											slidesToShow:2,
											slidesToScroll:2,
											infinite: true,
											dots: true
									}
							},
							{
									breakpoint: 900,
									settings: {
											slidesToShow: 1,
											slidesToScroll: 1
									}
							},{
									breakpoint: 600,
									settings: {
											slidesToShow: 1,
											slidesToScroll: 1
									}
							},
							{
									breakpoint: 480,
									settings: {
											slidesToShow: 1,
											slidesToScroll: 1
									}
							}
					
					]
		});
	}

	if ($('.doctor-reviews').length){
		$('.doctor-reviews').slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			infinite: true,
			dots: true,
			arrows:false,
			autoplay: true,
			autoplaySpeed: 6000,
			responsive: [
							{
									breakpoint: 600,
									settings: {
											slidesToShow: 2,
											slidesToScroll: 2
									}
							},
							{
									breakpoint: 480,
									settings: {
											slidesToShow: 1,
											slidesToScroll: 1
									}
							}
					
					]
		});
	}



	// Counter
	$('.counter-stat span').counterUp({
	      delay: 10,
	      time: 1000
	  });

		
 // Shuffle js filter and masonry
    if($('select[name="shuffle-filter"]').length){
					var Shuffle = window.Shuffle;
					var jQuery = window.jQuery;

					var myShuffle = new Shuffle(document.querySelector('.shuffle-wrapper'), {
									itemSelector: '.shuffle-item',
									buffer: 1
					});

					jQuery('select[name="shuffle-filter"]').on('change', function (evt) {
								var select = evt.currentTarget;
								var value = select.value;
								if (value) {
												myShuffle.filter(value);
								}
					});
				}

})(jQuery);

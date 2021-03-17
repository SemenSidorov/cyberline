jQuery(function($){
	$(document).mouseup(function (e){
		var div = $(".popup .window");
		if (!div.is(e.target)
		    && div.has(e.target).length === 0) {
			$('.popup').fadeOut();
		}
	});
});

$( function() {
	$( "#slider-range" ).slider({
		range: true,
		min: 1000,
		max: 50000,
		values: [ 1000, 25000 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( ui.values[ 0 ] );
			$( "#amount2" ).val( ui.values[ 1 ] );
		}
	});
	$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) );
	$( "#amount2" ).val( $( "#slider-range" ).slider( "values", 1 ) );
});

$(function () {
    var tabContainers = $('div.tabs > div');
    tabContainers.hide().filter(':first').show();
    $('div.tabs ul.tabNavigation a').click(function () {
        tabContainers.hide();
        tabContainers.filter(this.hash).show();
        $('div.tabs ul.tabNavigation a').removeClass('selected');
        $(this).addClass('selected');
        return false;
    }).filter(':first').click();
});

$(function(){
	$(window).scroll(function() {
		if($(this).scrollTop() > 300) {
			$('.footer .totop').addClass('opened');
		} else {
			$('.footer .totop').removeClass('opened');
		}
	});
	$('.popup .window .close').click(function() {
		$('.popup').fadeOut();
	});
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
	$('.catalog-page .list .filter-button').click(function() {
		$('.menubg').fadeIn();
		$('.catalog-page .filter').addClass('opened');
	});
	$('.catalog-page .filter form .item .n').click(function() {
		$(this).toggleClass('active');
		$(this).parent().find('.selected').toggle();
		$(this).next('.content').slideToggle();
	});
	$('.popup-catalog .close').click(function() {
		$('.popup-catalog').fadeOut();
	});
	$('.top-catalog-line .catalog-button').click(function() {
		$('.popup-catalog').fadeIn();
	});
	$('.popup .window .name a.a1').click(function() {
		$('.popup .window .name a').removeClass('active');
		$('.popup .window .name a.a2').addClass('active');
		$('.popup .window .content').removeClass('active');
		$('.popup .window .content.c2').addClass('active');
	});
	$('.popup .window .name a.a2').click(function() {
		$('.popup .window .name a').removeClass('active');
		$('.popup .window .name a.a1').addClass('active');
		$('.popup .window .content').removeClass('active');
		$('.popup .window .content.c1').addClass('active');
	});
	$('.header .flex .search-link').click(function() {
		$('.top-catalog-line').toggleClass('opened');
	});
	$('.menubg').click(function() {
		$('.menubg').fadeOut();
		$('.header ul').removeClass('opened');
		$('.catalog-page .filter').removeClass('opened');
	});
	$('.header .menu-button').click(function() {
		$('.menubg').fadeIn();
		$('.header ul').addClass('opened');
	});
	$('.totop').bind("click", function(e){
	  var anchor = $(this);
	  $('html, body').stop().animate({
		 scrollTop: $(anchor.attr('href')).offset().top
	  }, 1000);
	  e.preventDefault();
	});
	$('.index-page-slider').slick({
		dots: true
	});
	$('.index-middle-slider').slick({
		dots: true
	});
	$('.index-catalog2 .list2').slick({
	  arrows: false,
	  speed: 300,
	  slidesToShow: 1,
	  variableWidth: true
	});
	$('.catalog-page .list .catalog').slick({
	  arrows: false,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1430,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 575,
	      settings: {
	        slidesToShow: 2
	      }
	    }
	  ]
	});
	$('.slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  asNavFor: '.slider-nav'
	});
	$('.slider-nav').slick({
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  asNavFor: '.slider-for',
	  focusOnSelect: true,
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 769,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 760,
	      settings: {
	        slidesToShow: 3,
	        arrows: false
	      }
	    },
	    {
	      breakpoint: 575,
	      settings: {
	        slidesToShow: 3,
	        arrows: true
	      }
	    },
	    {
	      breakpoint: 508,
	      settings: {
	        slidesToShow: 4,
	        arrows: true
	      }
	    },
	    {
	      breakpoint: 400,
	      settings: {
	        slidesToShow: 3,
	        arrows: true
	      }
	    }
	  ]
	});
	$('.products-slider').slick({
	  speed: 300,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1430,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        slidesToShow: 2
	      }
	    }
	  ]
	});
	$('.index-brands').slick({
	  arrows: false,
	  speed: 300,
	  slidesToShow: 8,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1644,
	      settings: {
	        slidesToShow: 7
	      }
	    },
	    {
	      breakpoint: 1430,
	      settings: {
	        slidesToShow: 6
	      }
	    },
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 5
	      }
	    },
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 606,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 478,
	      settings: {
	        slidesToShow: 2
	      }
	    }
	  ]
	});
	$('.index-news').slick({
	  arrows: false,
	  speed: 300,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1430,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 606,
	      settings: {
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 400,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});
	$('.index-mob-catalog').slick({
	  arrows: false,
	  speed: 300,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 606,
	      settings: {
	        slidesToShow: 2
	      }
	    }
	  ]
	});
});
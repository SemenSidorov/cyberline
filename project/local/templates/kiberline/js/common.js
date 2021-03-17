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
		autoplay: true,
  		autoplaySpeed: 4000,
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
$(function(){

	// var basket_items_count = 0;
	// $('tr[data-entity=basket-item]').each(function(index){
	// 	basket_items_count += 1;
	// })
	// $('.basket_items_count').html('<div class="text" style="background: #f8f8f8;"><div class="name" style="font-size: 24px;margin-bottom: 15px;">В корзине</div><pstyle="color: #616161;margin-bottom: 15px;">' + basket_items_count + ' товара</p></div>');
	//
	// $('.basket-item-actions-remove').click(function(){
	// 	basket_items_count -= 1;
	// 	$('.basket_items_count').html('<div class="text" style="background: #f8f8f8;"><div class="name" style="font-size: 24px;margin-bottom: 15px;">В корзине</div><pstyle="color: #616161;margin-bottom: 15px;">' + basket_items_count + ' товара</p></div>');
	// });
	//
	// $('a[data-entity=basket-item-restore-button]').click(function(){
	// 	basket_items_count += 1;
	// 	$('.basket_items_count').html('<div class="text" style="background: #f8f8f8;"><div class="name" style="font-size: 24px;margin-bottom: 15px;">В корзине</div><pstyle="color: #616161;margin-bottom: 15px;">' + basket_items_count + ' товара</p></div>');
	// });

	// var basket_text = '';
	// if(!user_auth){
	// 	basket_text += '<div class="bottom-text" style="border-top: 1px solid #dadada; padding-top: 15px; margin-top: 10px;"><p>Если у вас уже есть клубная карта,<br> то <a class="button-user-login">авторизируйтесь</a> , чтобы воспользоваться.</p></div>'
	// }
	// $('div[data-entity=basket-total-block]').parent('div.row').html($('div[data-entity=basket-total-block]').html() + basket_text);

	$('.add-basket-to-favorites').click(function(){
		var btn = this;
		var items = [];
		$('tr.basket-items-list-item-container').each(function(index, el){
			items.push($(el).attr('data-id'));
		});
    $.ajax({
      type: "POST",
      url: "/local/templates/kiberline/ajax-favorite.php",
			data: {
				id_favorites: JSON.stringify(items),
				method: "add",
			},
      success: function(out){
				if(out == "success"){
          $(btn).addClass('active');
				}else {
					var data = JSON.parse(out);
					if(data.set !== 'undefined'){
						document.cookie = "UF_FAVORITES="+JSON.stringify(data.set)+"; path=/; max-age="+(60*60*24*365)+";"
            $(btn).addClass('active');
					}else{
						console.log(out);
					}
				}
      },
			error: function(errors){
				console.log(errors);
			}
  	});
	});

	$('.remove-basket').click(function(){
		$('.basket-item-actions-remove').each(function(index, el){
			$(el).click();
		});
		basket_items_count = 0;
		$('.basket_items_count').html('<div class="text" style="background: #f8f8f8;"><div class="name" style="font-size: 24px;margin-bottom: 15px;">В корзине</div><pstyle="color: #616161;margin-bottom: 15px;">' + basket_items_count + ' товара</p></div>');
	});

  $('#SubscriptionForm').on('submit', function(e) {
      e.preventDefault();
			var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
			var email = $('.emailSubscription');
			if(pattern.test(email.val())){
		    $.ajax({
	        type: "POST",
	        url: "/local/templates/kiberline/ajax-subscribe.php",
					data: {
						email: $(email).val(),
						test: $('.testSubscription').val()
					},
	        success: function(out){
						if(out == "success"){
							$('.errorSubscriptionForm').text('');
							$('.successSubscriptionForm').text('Спасибо! Вы успешно подписаны на новости сайта!');
							$('#SubscriptionForm').remove();
						}else{
							$(email).css({"border-color": "red", "color": "red"})
							$('.errorSubscriptionForm').text('Произошла непредвиденная ошибка! Возможно такой email уже зарегистрирован! Попробуйте ещё раз!');
						}
	        }
		    });
			}else{
				$(email).css({"border-color": "red", "color": "red"})
			}
	});

	$('.emailSubscription').click(function(){
		$(this).css({"border-color": "", "color": ""});
	});
	$('.emailSubscription').on("change", function(){
		$(this).css({"border-color": "", "color": ""});
	});

	$(".REGISTER-EMAIL").on('input', function(){
		$(".REGISTER-LOGIN").val($(this).val());
		console.log()
	});
	$(".select-sort").change(function(){
		$(location).attr('href', $(".select-sort option:selected").data("url"));
	});
	$(".label-consent").click(function(){
		if($('.checkbox-consent').attr("checked") == "checked"){
			$('.checkbox-consent').removeAttr("checked");
		}else{
			$('.checkbox-consent').attr("checked","checked");
		}
	});
	$(".button-user-login").click(function(){
		$(".popup.user").css('display', 'block');
	});
	$(".button-callback").click(function(){
		$(".popup.callback").css('display', 'block');
	});
	$(".button-question").click(function(){
		$(".popup.question").css('display', 'block');
	});
	$(".cart").click(function(){
			var btn = this;
			if(!$(btn).hasClass("active")){
			    $.ajax({
			        type: "POST",
			        url: "/local/templates/kiberline/ajax-basket.php",
							data: {
								product_id: $(btn).attr('data-add'),
								quantity: 1
							},
			        success: function(out){
			            $(btn).addClass('active');
			            $(btn).attr('href', '/personal/basket.php');
			        }
			    });
			}
	});
	$(".cart-item").click(function(){
			var btn = this;
			if(!$(btn).hasClass("active")){
			    $.ajax({
			        type: "POST",
			        url: "/local/templates/kiberline/ajax-basket.php",
							data: {
								product_id: $(btn).attr('data-add'),
				        quantity: $('input.item-quantity').val()
							},
			        success: function(out){
		            $(btn).replaceWith('<a href="/personal/basket.php" class="cart-item">Перейти в корзину</a>');
		            // $(btn).addClass('active');
			        }
			    });
			}
	});
	$(".add-favorite").click(function(){
		var btn = this;
		if(!$(btn).hasClass("active")){
	    $.ajax({
        type: "POST",
        url: "/local/templates/kiberline/ajax-favorite.php",
				data: {
					id_favorite: $(btn).attr('data-id'),
					method: "add",
				},
        success: function(out){
					if(out == "success"){
            $(btn).addClass('active');
					}else {
						var data = JSON.parse(out);
						if(data.set !== 'undefined'){
							document.cookie = "UF_FAVORITES="+JSON.stringify(data.set)+"; path=/; max-age="+(60*60*24*365)+";"
	            $(btn).addClass('active');
						}else{
							console.log(out);
						}
					}
        },
				error: function(errors){
					console.log(errors);
				}
    	});
		}else{
	    $.ajax({
        type: "POST",
        url: "/local/templates/kiberline/ajax-favorite.php",
				data: {
					id_favorite: $(btn).attr('data-id'),
					method: "remove",
				},
        success: function(out){
					if(out == "success"){
            $(btn).removeClass('active');
					}else {
						var data = JSON.parse(out);
						if(data.set !== 'undefined'){
							document.cookie = "UF_FAVORITES="+JSON.stringify(data.set)+"; path=/; max-age="+(60*60*24*365)+";"
	            $(btn).removeClass('active');
						}else{
							console.log(out);
						}
					}
        },
				error: function(errors){
					console.log(errors);
				}
    	});
		}
	});
});

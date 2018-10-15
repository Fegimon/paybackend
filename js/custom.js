(function() {
if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
var msViewportStyle = document.createElement("style");
msViewportStyle.appendChild(
document.createTextNode("@-ms-viewport{width:auto!important}")
);
document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
}
})();

$(window).load(function() {
   $("#loading").fadeOut(500);
})

$(document).ready(function() {
  var nice = $("html").niceScroll({cursorcolor:"#481e67", cursorwidth: "10px", cursorborder: "0 solid #fff"});
});

$(function() {
	$('#menu').mmenu({
		extensions	: [ 'effect-slide', 'pageshadow' ],
		header		: true,
		searchfield	: false,
		counters	: false
	});
});

$('.navbar-default .navbar-nav > li.dropdown').hover(function() {
		$('ul.dropdown-menu', this).stop(true, true).slideDown(370);
		$(this).addClass('open');
	}, function() {
		$('ul.dropdown-menu', this).stop(true, true).slideUp(370);
		$(this).removeClass('open');
   });


$('#services-slider').owlCarousel({
    loop:false,
    nav:true,
    dots:false,
    margin:0,
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        1000:{
            items:4
        }
    }
})
$('#works-slider').owlCarousel({
    loop:false,
    nav:true,
    dots:false,
    margin:0,
	themeClass: 'btn-theme2',
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        1000:{
            items:3
        },
        1920:{
            items:4
        }
    }
})
$('#testimonials-slider').owlCarousel({
    loop:false,
    nav:false,
    dots:true,
    margin:0,
    items: 1
})
$('#clients-slider').owlCarousel({
    loop:false,
    nav:false,
    dots:false,
    margin:0,
    responsiveClass:true,
    responsive:{
        0:{
            items:2
        },
        480:{
            items:3
        },
        1000:{
            items:6
        }
    }
})
$('#about-slider').owlCarousel({
    loop:false,
    nav:true,
    dots:false,
    margin:0,
    responsiveClass:true,
	themeClass: 'btn-theme3',
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        1000:{
            items:4
        }
    }
})

if (screen.width >= 768 || windowWidth >= 768) {
  var speed = 500;
  var header = 0;
  
  $(window).scroll(function(){
	  if($(document).scrollTop() > 0) {
		  if(header == 0) {
			 header = 1;
			  $('#header-inner').stop().animate({ marginTop:'0' }, speed);
			  $("#header-main").css({backgroundColor:'rgba(64,64,64,0.9)'}, speed);
			  $(".navbar-brand img").css({"max-width":'60%'}, speed);
			  $(".navbar-brand img").css({"height":'auto'}, speed);
			   $(".navbar-default").css({"height":'50px'}, speed);
			   $(".menuon-top").hide().animate({top: '250px'});
			  
		  }
		  
	  } else {
		  if(header == 1) {
			 header = 0;
			  $('#header-inner').stop().animate({ marginTop:'0px' },speed);
			  $("#header-main").css({backgroundColor:'transparent'}, speed);
			  $(".navbar-brand img").css({"max-width":'100%'}, speed);
		 $(".navbar-default").css({"height":'98px'}, speed);
		 $(".menuon-top").show().animate({top: '250px'});
		 
			  
		  }  
	  }
  });
}

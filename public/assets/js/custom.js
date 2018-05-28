
// Parallax background move on mouse over
/*$.fn.greenify = function ( resistance, mouse ) 
{
	$el = $( this );
	TweenLite.to( $el, 0.2, 
	{
		x : -(( mouse.clientX - (window.innerWidth/2) ) / resistance ),
		y : -(( mouse.clientY - (window.innerHeight/2) ) / resistance )
	});

};

$( document ).mousemove( function( e ) {
			$( '.background' ).greenify( -30, e );
});
*/

$(document).ready(function(){
	
var owl = $('.left-carousal .owl-carousel');
owl.owlCarousel({
    loop: true,
               margin: 0,
				 dots:false,
				 autoPlay:true,
                itemsCustom : [
          [0, 1],
          [450, 1],
          [600, 1],
          [700, 1],
          [1000, 1],
          [1200, 1],
          [1400, 1],
          [1600, 1]
        ],
		pagination : false,
        navigation : false,
})


$('#instagram-gallery.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
	pagination : false,
	navigation : true,
    responsiveClass:true,
    itemsCustom : [
          [0, 2],
          [450, 3],
          [600, 4],
          [700, 5],
          [1000, 4],
          [1200, 5],
          [1400, 6],
        ],
})


$('.hotelSlider1').owlCarousel({
    loop:true,
    margin:0,
    autoPlay:true,
	autoPlayTimeout:3000,
    dots:false,
    nav:true,
	pagination:true,
    navigation:true,
	mouseDrag: false,
    itemsCustom : [
          [0, 1],
          [450, 1],
          [600, 1],
          [700, 1],
          [1000, 1],
          [1200, 1],
          [1400, 1],
          [1600, 1]
        ]
})
$( ".owl-prev").html('<i class="glyphicon glyphicon-menu-left"></i>');
 $( ".owl-next").html('<i class="glyphicon glyphicon-menu-right"></i>');

$('.hotelSlider2').owlCarousel({
    loop:true,
    margin:0,
     autoPlay:true,
	autoPlayTimeout:3000,
    dots:false,
    nav:true,
    navigation:true,
	mouseDrag: false,
    itemsCustom : [
          [0, 1],
          [450, 1],
          [600, 1],
          [700, 1],
          [1000, 1],
          [1200, 1],
          [1400, 1],
          [1600, 1]
        ]
})
$( ".owl-prev").html('<i class="glyphicon glyphicon-menu-left"></i>');
 $( ".owl-next").html('<i class="glyphicon glyphicon-menu-right"></i>');


$('.hotelSlider3').owlCarousel({
    loop:true,
    margin:0,
     autoPlay:true,
	autoPlayTimeout:3000,
    dots:false,
    nav:true,
    navigation:true,
	mouseDrag: false,
    itemsCustom : [
          [0, 1],
          [450, 1],
          [600, 1],
          [700, 1],
          [1000, 1],
          [1200, 1],
          [1400, 1],
          [1600, 1]
        ]
})
$( ".owl-prev").html('<i class="glyphicon glyphicon-menu-left"></i>');
 $( ".owl-next").html('<i class="glyphicon glyphicon-menu-right"></i>');
 





// Responsive left nav js
/* $("#header .block-content.togglenav").click(function(){
	$(this).toggleClass("active");
	$(".left-sidebar, body").toggleClass("open");
	});*/
	
	
	
	
// Responsive JS for mobile nav


var removeClass = true;
$(".sidefixednav .block-content.togglenav").click(function () {
    $(".mobilemenu").addClass('open');
	$(".page-container").addClass('overflowClass');
	$(".whiteoverlay").fadeIn();
	//$("body").css("overflow","hidden");
    removeClass = false;
});

$(".mobilemenu").click(function() {
    removeClass = false;
});

$(".mobilenavclosebtn, html").click(function () {
    if (removeClass) {
        $(".mobilemenu").removeClass('open');
	    $(".page-container").removeClass('overflowClass');
		$(".whiteoverlay").fadeOut();
		//$("body").css("overflow","visible");
    }
    removeClass = true;
});



$(function() {
  $(".login-user").on("click", function(e) {
    $(".user-setting").toggleClass("opensetting");
    e.stopPropagation()
  });
  $(document).on("click", function(e) {
    if ($(e.target).is(".user-setting") === false) {
      $(".user-setting").removeClass("opensetting");
    }
  });
});

// User login js




/*

$(".searchourcollectonlink").click(function(){
	$(".mobilemainnav, .searchbydatenav, .selectdestinationnav, .searchourcollecton").removeClass("openmobilemenu");
	$(".searchourcollectonnav").addClass("openmobilemenu");
})

$("#searchbydate").click(function(){
	$(".mobilemainnav, .searchourcollectonnav, .selectdestinationnav, .searchourcollectonnav, .selectexperiencenav").removeClass("openmobilemenu");
	$(".searchbydatenav").addClass("openmobilemenu");
})

$(".backtohomelink").click(function(){
	$(".mobilemainnav").addClass("openmobilemenu");
	$(".searchbydatenav, .searchourcollectonnav, .selectdestinationnav, .searchourcollectonnav, .selectexperiencenav, .companynav, .selectafricanav, .restaurantnav, .searchbyfilternav, .destinationresultnav").removeClass("openmobilemenu");
})

$("#selectdestination").click(function(){
	$(".mobilemainnav, .searchbydatenav, .searchourcollectonnav, .searchourcollectonnav, .selectexperiencenav").removeClass("openmobilemenu");
	$(".selectdestinationnav").addClass("openmobilemenu");
})

$("#selectafrica").click(function(){
	$(".selectafricanav").addClass("openmobilemenu");
	$(".mobilemainnav, .searchbydatenav, .searchourcollectonnav, .selectdestinationnav, .selectexperiencenav").removeClass("openmobilemenu");
})

$("#selectafricanavchild").click(function(){
	$(".selectafricanavchild").addClass("openmobilemenu");
	$(".mobilemainnav, .searchbydatenav, .searchourcollectonnav, .selectdestinationnav, .selectexperiencenav, .selectafricanav").removeClass("openmobilemenu");
})

$("#selectexperience").click(function(){
	$(".mobilemainnav, .searchbydatenav, .searchourcollectonnav, .selectdestinationnav, .selectafricanav").removeClass("openmobilemenu");
	$(".selectexperiencenav").addClass("openmobilemenu");
})

$("#companynav").click(function(){
	$(".mobilemainnav, .searchbydatenav, .searchourcollectonnav, .selectdestinationnav, .selectexperiencenav, .selectafricanav").removeClass("openmobilemenu");
	$(".companynav").addClass("openmobilemenu");
})

$(".searchbyfilter").click(function(){
	$(".mobilemainnav, .searchbydatenav, .searchourcollectonnav, .selectdestinationnav, .selectexperiencenav, .selectafricanav").removeClass("openmobilemenu");
	$(".searchbyfilternav").addClass("openmobilemenu");
})

$(".backtodestinationnav").click(function(){
	$(".selectdestinationnav").addClass("openmobilemenu");
	$(".searchbydatenav, .selectafricanav").removeClass("openmobilemenu");
})

$(".backtoselectafricanav").click(function(){
	$(".selectafricanav").addClass("openmobilemenu");
	$(".searchbydatenav, .selectafricanavchild").removeClass("openmobilemenu");
})*/
// RESTAURANT NAV 

$(".restaurantnavlink").click(function(){
	$(".restaurantnav").addClass("openmobilemenu");
	$(".mobilemainnav").removeClass("openmobilemenu");
})

$("#destinationsresult").click(function(){
	$(".destinationresultnav").addClass("openmobilemenu");
	$(".mobilemainnav").removeClass("openmobilemenu");
})



$("ul li.calander a").click(function(){
	$(".header-content").toggleClass("showsearch");
})

/* Desktop Left nav */
$(".searchourcollectonlink").click(function(){
//	$(".mobilemainnav, .searchbydatenav, .selectdestinationnav, .searchourcollecton").removeClass("openmobilemenu");
	$(".searchourcollectonnav").addClass("openmobilemenu");
	$(".mobilemenu").addClass("open");
})

if ($(window).width() < 1025) {

   $(".closenavlink").click(function(){
	$(".mobilemenu").removeClass("open");
	$(".whiteoverlay").fadeOut();
	$(".page-container").removeClass('overflowClass');
})
}
else {
  
};


// Select all links with hashes smooth scroll js
// Smoothscroll js
		$(function() {
	  $('a.scrollpage').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 500);
	        return false;
	      }
	    }
	  });
	});
	
	$(".scrollpage").click(function(){
		$(".scrollpage").removeClass("active");
		$(this).addClass("active");
	})
	
// Cookie Policy page popup js
$(".open-cookie-bar-page").click(function(){
	$(".cookie-bar-page").fadeIn();
})

$(".close-btn-align").click(function(){
	$(".cookie-bar-page").fadeOut();
})
//Cookie bar hidden code
$(".cookie-bar-hide-btn").click(function () {
        $(".bootom-cookie-bar-outer").hide();
    });

	
 /**** Filter search left nav ****/
// $(document).mouseup(function (){
// $('#search').focus(function(){
// 	$('#filtersearchpopup').slideDown();
// });

// $('#search').blur(function(){
// 	$('#filtersearchpopup').slideUp();
// });
// });
/*
jQuery("#search").focus(function() {
   jQuery('#filtersearchpopup').slideDown(300);
}).blur(function() {
   jQuery('#filtersearchpopup').slideUp(300);
});*/
/*****************************************/
	


// Custom Scrollbar
if ($(window).width() > 767) {

   (function($){
			$(window).on("load",function(){
				
				$(".mobilemenu-inner").mCustomScrollbar({
					theme:"dark-3"
				});
			});
		})(jQuery);
}
else {
  
};

// Navigation js

jQuery("#main-nav-show").click(function() {
  jQuery("#menu").toggleClass("active");
});

jQuery("#close").click(function() {
  jQuery("#menu").toggleClass("active");
});
			jQuery("#menu li").click(function(){
	jQuery("#menu").removeClass('active');
});

// Mutlilever left menu

$(".show-submenu").click(function(){
	$(this).next().slideToggle();
	});
	
	
// slide popup
$(".loginSignPopupButton .clicktologin").click(function() {
    $('.popupMainDiv').addClass('openPopup');
$('body').css('overflow','hidden')
});
$(".mainPopupClose").click(function(){
	$('.popupMainDiv').removeClass('openPopup');
	$('body').css('overflow','auto')
});
$(".logInPopupButton").click(function() {
    $('.logInPopup').addClass('openPopup');
    $('.signInPopup').removeClass('openPopup');
    $('.forgetPassPopup').removeClass('openPopup');
});
$(".signInPopupButton").click(function() {
    $('.signInPopup').addClass('openPopup');
    $('.logInPopup').removeClass('openPopup');
    $('.forgetPassPopup').removeClass('openPopup');
});
$(".forgetPassBtn").click(function() {
    $('.forgetPassPopup').addClass('openPopup');
    $('.logInPopup').removeClass('openPopup');
    $('.signInPopup').removeClass('openPopup');
});
$(".loginPopupCloseButton").click(function(){
	$(this).parent().removeClass('openPopup');
});

$(".loginSecForMob").click(function() {
    $('.popupMainDiv').addClass('openPopup');
    $('.logInPopup').addClass('openPopup');
    $('.signInPopup').removeClass('openPopup');
    $('.forgetPassPopup').removeClass('openPopup');
});
$(".registerSecForMob").click(function() {
    $('.popupMainDiv').addClass('openPopup');
    $('.signInPopup').addClass('openPopup');
    $('.logInPopup').removeClass('openPopup');
    $('.forgetPassPopup').removeClass('openPopup');
});


$(".searchOurCollectonButton").click(function(){
	$('.searchOurCollectonpopup').addClass('openPopup');
});
$(".searchByDateButton").click(function(){
	 $('.searchByDatePopup').addClass('openPopup');
});
$(".yourdestinationpopupButton").click(function(){
	$('.yourdestinationpopup').addClass('openPopup');
});
$(".yourexperiencepopupButton").click(function(){
	$('.yourexperiencepopup').addClass('openPopup');
});
$(".galleryImgBtn").click(function(){
  $('.galleryImgPopup').addClass('openPopup');
});
$(".showMoreSec, .moreButtonPopup").click(function(){
  $('.showMorePopup').addClass('openPopup');
});
$(".termAndConditionBtn").click(function(){
  $('.termAndConditionPopUp').addClass('openPopup');
});
});

 /*********Emotion Slider********/
$('.emotionSlider').owlCarousel({
    loop:true,
    margin:0,
    autoPlay:true,
    autoPlayTimeout:5000,
    dots:false,
    nav:true,
    navigation:false,
    animateOut: 'fadeIn',
  animateIn: 'fadeout',
    itemsCustom : [
          [0, 1],
          [450, 1],
          [600, 1],
          [700, 1],
          [1000, 1],
          [1200, 1],
          [1400, 1],
          [1600, 1]
        ]
})


/*********ROOM SUIT SLIDERS**********/
$('.terraceSuiteSlider').carousel({
    interval: 0,
}); 
$('.prevClick').click(function(){
    $(this).parent().parent().parent().parent().find('.leftSlider .left').click();
    $(this).parent().parent().parent().parent().find('.rightSlider .left').click();
})
$('.nextClick').click(function(){
    $(this).parent().parent().parent().parent().find('.leftSlider .right').click();
    $(this).parent().parent().parent().parent().find('.rightSlider .right').click();
})

// back to top scroll jQuery
if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
};

// Restaurant Contact form 
$("body").on("click",".contactPopupOne",function(){
        
     $("#contactPopupSection").modal("show");
      $('.modal-backdrop').appendTo('#restaurant1');   
      $('body').removeClass("modal-open")
      $('body').css("padding-right","");     
  });

$("body").on("click",".contentCirsclePopupBtn",function(){
        
     $("#contentCirsclePopup").modal("show");
      $('.modal-backdrop').appendTo('#contentCirsclePopup');   
      $('body').removeClass("modal-open")
      $('body').css("padding-right","");     
  });


// Next Previous hover image thumb
$(".showprevnextimage").hover(function(){
	$(this).find(".nextprevshow").stop().fadeIn();
},
 function () {
    $(".nextprevshow").stop().fadeOut();
})


//date picker
$('#js-date').datepicker();


/*********Video Poster Play********/
/*var v = document.getElementById('videoPoster');
v.addEventListener(
    'play', 
    function() { 
        v.play();
    }, 
    false);

v.onclick = function() {
    if (v.paused) {
        v.play();
    } else {
        v.pause();
    }

    return false;
};

*/

/*

// Range slider js
var slider = document.getElementById("myRange");
var output = document.getElementById("pricevalue");
if(slider){
  output.innerHTML = slider.value;

  
slider.oninput = function() {
  output.innerHTML = this.value;
}
}





*/

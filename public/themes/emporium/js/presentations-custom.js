jQuery(document).ready(function($){
  var contentSections = $('.cd-section'),
    navigationItems = $('#cd-vertical-nav a');

  updateNavigation();
  $(window).on('scroll', function(){
    updateNavigation();
  });

  navigationItems.on('click', function(event){
        event.preventDefault();
        smoothScroll($(this.hash));
    });
    $('.cd-scroll-down').on('click', function(event){
        event.preventDefault();
        smoothScroll($(this.hash));
    });

    $('.touch .cd-nav-trigger').on('click', function(){
      $('.touch #cd-vertical-nav').toggleClass('open');
  
    });
    $('.touch #cd-vertical-nav a').on('click', function(){
      $('.touch #cd-vertical-nav').removeClass('open');
    });

  function updateNavigation() {
    contentSections.each(function(){
      $this = $(this);
      var activeSection = $('#cd-vertical-nav a[href="#'+$this.attr('id')+'"]').data('number') - 1;
      if ( ( $this.offset().top - $(window).height()/2 < $(window).scrollTop() ) && ( $this.offset().top + $this.height() - $(window).height()/2 > $(window).scrollTop() ) ) {
        navigationItems.eq(activeSection).addClass('is-selected');
      }else {
        navigationItems.eq(activeSection).removeClass('is-selected');
      }
    });
  }

  function smoothScroll(target) {
    $('body,html').animate(
      {'scrollTop':target.offset().top},
      1200
    );
  }
});

 // on scroll move to next section
 (function() {
  var delay = false;

  $(document).on('mousewheel DOMMouseScroll', function(event) {
    event.preventDefault();
    if(delay) return;

    delay = true;
    setTimeout(function(){delay = false},1200)

    var wd = event.originalEvent.wheelDelta || -event.originalEvent.detail;

    var section= document.getElementsByTagName('section');
    if(wd < 0) {
      for(var i = 0 ; i < section.length ; i++) {
        var t = section[i].getClientRects()[0].top;
        if(t >= 40) break;
      }
    }
    else {
      for(var i = section.length-1 ; i >= 0 ; i--) {
        var t = section[i].getClientRects()[0].top;
        if(t < -20) break;
      }
    }
    
    if(i >= 0 && i < section.length) {
      $('html,body').animate({
        scrollTop: section[i].offsetTop
      }, '1200');
    }
  });
})();
console.clear();


//  on click move to perticuller section

$(function() {
  $('a.scrollToSection').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, '1500');
        return false;
      }
    }
  });
});


// accordian jQuery
$('.accordianHeading').click(function(){
  $(this).parent().find('.accordianContent').slideDown('slow');
  $(this).parent().find('.iconSec').css('opacity', '0');
})

$(window).scroll(function() {
  var height = $(window).scrollTop();
  if(height  > 100) {
    $("#cd-vertical-nav").fadeIn(200);
    $(".logoTopSec").fadeIn(200);
  } else{
    $("#cd-vertical-nav").fadeOut(50);
    $(".logoTopSec").fadeOut(50);
  }
});




/*****/
$(".mCustomScrollbar").mCustomScrollbar({
  theme:"dark-3"
});
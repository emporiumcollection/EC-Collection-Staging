(function($) {
  debugTextOnIOS = function(slider){
    var sliderWidth = (slider.find('.slide-0').width());
    
    //Debug slider text for MAC
    slider.find('.field-name-field-slide-text').css('width', sliderWidth);
    slider.find('.field-name-field-slide-link').css('width', sliderWidth);
    
    // Set correct ratio height for videos slide
    var slideVideos = slider.find('video');
    var slideImages = slider.find('.field-name-field-slide-image');
    
    if (slideImages.length > 0){
      slideVideos.each(function()
      {
        var correctHeight = slideImages.height();
        $(this).css('height', correctHeight);
      });
    }else{
      slideVideos.each(function()
      {
        var initialWidth = $(this).attr('width');
        var initialHeight = $(this).attr('height');
        var ratio = initialHeight / initialWidth;
        var currentWidth = $(window).width() * 0.90;
        $(this).css('height', Math.round(currentWidth * ratio));
      });
    }
  }
  
  
  initSlider = function(params){
    // This method may be called for each slider.
    var sliderOptions = params['sliderOptions'];
    var sliderContainer = (params['sliderContainer'] ? params['sliderContainer'] : $('#node-slider-' + params['sliderId']));


    // On Before
    try {
      sliderOptions['old_before'] = eval(sliderOptions['before']);
    } catch (e) {
      sliderOptions['old_before_name'] = sliderOptions['before'];
      sliderOptions['old_before'] = function(){
        console.log("function '"+sliderOptions['old_before_name']+"' is not defined.");
      };
    }
    sliderOptions['before'] = function(slider){
      // On arrête les video qui pourraient être entrain de jouer.
      var slide = slider.slides.eq(slider.currentSlide);
      if( slide.children().is(".node-details-slide-video") ){
        
        var targetVideo = slide.find('video').attr('id');
        var vjsPlayer = videojs(targetVideo);
        vjsPlayer.pause();
      }

      // Puis on execute le "before" définit dans la config du slider.
      if (sliderOptions['old_before'] != undefined){
    	  sliderOptions['old_before'](slider);
      }
    };


    // On After
    try {
      sliderOptions['old_after'] = eval(sliderOptions['after']);
    } catch (e) { 
      sliderOptions['old_after_name'] = sliderOptions['after'];
      sliderOptions['old_after'] = function(){
        console.log("function '"+sliderOptions['old_after_name']+"' is not defined.");
      };
    }
    sliderOptions['after'] = function(slider){
      // On arrête les video qui pourraient être entrain de jouer...
      var slide = slider.slides.eq(slider.currentSlide);
      if( slide.children().is(".node-details-slide-video.video-autoplay") ){
        var targetVideo = slide.find('video').attr('id');
        var vjsPlayer = videojs(targetVideo);
        vjsPlayer.play();
      }

      // Puis on execute le "after" définit dans la config du slider.
      if (sliderOptions['old_after'] != undefined){
    	  sliderOptions['old_after'](slider);
      }
    };


    // On Start
    try {
      sliderOptions['old_start'] = eval(sliderOptions['start']);
    } catch (e) {
      sliderOptions['old_start_name'] = sliderOptions['start'];
      sliderOptions['old_start'] = function(){
        sliderOptions['start'] = debugTextOnIOS(sliderContainer);
        console.log("function '"+sliderOptions['old_start_name']+"' is not defined.");
      };
    }
    sliderOptions['start'] = function(slider){
      // On arrête les video qui pourraient être entrain de jouer...
      var slide = slider.slides.eq(slider.currentSlide);
      if( slide.children().is(".node-details-slide-video.video-autoplay") ){
        var targetVideo = slide.find('video').attr('id');
        var vjsPlayer = videojs(targetVideo);
        vjsPlayer.play();
      }

      // Puis on execute le "start" définit dans la config du slider.
      if (sliderOptions['old_start'] != undefined){
    	  sliderOptions['old_start'](slider);
      }
    };


    sliderContainer.flexslider(sliderOptions);
    
    $(window).resize(function(){
      debugTextOnIOS(sliderContainer);
    });
  }
  
})(jQuery);

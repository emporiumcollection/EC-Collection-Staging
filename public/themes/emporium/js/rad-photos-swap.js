(function($) {
    
    //in image tag (data-imagessrc='[{"src":"http://example.com/imgage_link.jpg"},{"src":"http://example.com/imgage_link.png"}]')
    $.fn.photoSwapFun = function() {
        var imgObj = this;
        var imagessrc =  imgObj.data('imagessrc');
        imgObj.removeAttr('data-imagessrc');
        if(typeof imagessrc == 'string'){ imagessrc = $.parseJSON(imagessrc); }
        if(typeof imagessrc == 'object'){
            if(imagessrc.length > 0){
                var imageObjWidth = parseFloat(imgObj.width()).toFixed(2);
                var imageObjHeight = parseFloat(imgObj.height()).toFixed(2);
                
                var is_image_av = false;
                var slidehtml = '<div class="images-groups-parent">';
                        slidehtml += '<div class="rad-images-parent" style="width: '+imageObjWidth+'px; height: '+imageObjHeight+'px;">';
                            slidehtml += '<div class="rad-slide-row" style="left: 0;">';
                            var imgcnt = 0;
                            //slidehtml += '<span id="slide-'+imgcnt+'" class="rad-img-slides'+((imgcnt == 0)?' active':'')+'" style="left: 0%;"><img src="'+imgObj.attr('src')+'" width="100%" /></span>'; imgcnt++;
                            $.each(imagessrc, function(index, value){
                                if(typeof value['src'] != 'undefined'){
                                    //slidehtml += '<span id="slide-'+imgcnt+'" class="rad-img-slides'+((imgcnt == 0)?' active':'')+'" style="transform: translateX('+(0 * 100)+'%);width: '+imageObjWidth+'px; height: '+imageObjHeight+'px; background-image:url(\''+value['src']+'\')"></span>';
                                    slidehtml += '<span id="slide-'+imgcnt+'" class="rad-img-slides'+((imgcnt == 0)?' active':'')+'" style="left:'+((imgcnt == 0)?'0':'100')+'%; width: '+imageObjWidth+'px; height: '+imageObjHeight+'px; background-image:url(\''+value['src']+'\')"></span>';
                                    imgcnt++;
                                    is_image_av = true;
                                }
                            });
                            slidehtml += '</div>';
                        slidehtml += '</div>';
                slidehtml += '</div>';
                
                if((slidehtml.length > 0) && (is_image_av === true)){
                    imgObj.addClass('rad-main-outer-image');
                    imgObj.wrap('<div class="rad-slider-wrap"></div>');
                    imgObj.before( slidehtml );
                    var sendObj = imgObj.closest('.rad-slider-wrap').find('.rad-images-parent');
                    sendObj.photoOnMouseOver();
                    //console.log(imageObjWidth,' : ',imageObjHeight,' : ',imgObj.outerHtml);
                }
            }
        }
    },
    //End
    
    $.fn.photoFadeInOut = function(position) {
        var thisObj = this;
        
        thisObj.find('.rad-slide-row .rad-img-slides').removeClass('active');
        thisObj.find('.rad-slide-row').find("#slide-"+position).addClass('active');
    },
    
    $.fn.photoSlideEffect = function(position) {
        var thisObj = this;
        var itid = parseInt(thisObj.find('.rad-slide-row .rad-img-slides.active').attr('id').split("-").pop());
        var $movetype = 'left';
        if(itid > position){ $movetype = 'right'; }
        
        var currentActive = thisObj.find('.rad-slide-row').find("#slide-"+position);
        var previousActive = thisObj.find('.rad-slide-row .rad-img-slides.active');
        
        thisObj.find('.rad-slide-row .rad-img-slides').removeClass('active');
        currentActive.addClass('active');
        
        previousActive.css('z-index','0');
        currentActive.css('z-index','1');
        
        currentActive.stop();
        currentActive.clearQueue().finish();
        previousActive.stop();
        previousActive.clearQueue().finish();
        
        var timerEv = 300;
        previousActive.animate({left: (($movetype == 'left')?'-20':'20')+'%'}, timerEv, 'swing', function(){ previousActive.css('left',(($movetype == 'left')?'-100':'100')+'%'); });
        currentActive.animate({left: '0%'}, timerEv, 'linear');
    },
    
    
    $.fn.photoOnMouseOver = function() {
        var rObj = this;
        
        rObj.mouseout(function() {
            $(this).closest('.rad-slider-wrap').find('.rad-main-outer-image').css('opacity','1');
        })
        .mouseover(function() {
            $(this).closest('.rad-slider-wrap').find('.rad-main-outer-image').delay(1000).css('opacity','0');
        });
          
        rObj.on("mousemove", function(event) {
            var thisObj = $(this);
            var offset = $( this ).offset();
            var x = event.pageX - offset.left;
            x = Math.ceil(x);
            var y = event.pageY - offset.top;
            var containerWidth = thisObj.width();
            var numImages = thisObj.find('.rad-slide-row .rad-img-slides').length;
            numImages = ((numImages > 0)?numImages:1);
            if((numImages > 1) && (x > 0) && (containerWidth > 0)){
                var oneImagePortion = Math.ceil((containerWidth/numImages));
                var imgNum = Math.ceil(x/oneImagePortion);
                imgNum = (imgNum - 1);
                var position = ((imgNum < 0)?0:imgNum);
                var isanimate = true;
                var itid = parseInt(thisObj.find('.rad-slide-row .rad-img-slides.active').attr('id').split("-").pop());
                if(itid === position){ isanimate = false; }
                if(isanimate){
                    thisObj.photoSlideEffect(position);
                    /*thisObj.find('.rad-slide-row .rad-img-slides').removeClass('active');
                    thisObj.find('.rad-slide-row').find("#slide-"+position).addClass('active');
                    transformX = (position * 100);
                    var tobj = thisObj.find('.rad-slide-row');
                    tobj.stop();
                    tobj.clearQueue().finish();
                    tobj.css('-webkit-transform','translate3d(-'+transformX+'%)');
                    tobj.css('-moz-transform','translate3d(-'+transformX+'%)');
                    tobj.css('transform','translateX(-'+transformX+'%)');*/
                    //console.log(x,' : ',offset.left,' : ',containerWidth,' : ',numImages,' : ',oneImagePortion,' : ',position,' : ',itid,' : ',transformX,' ; ',tobj.html()); 
                }
                           
            }                    
        });
    },
    
    $.fn.preload = function(imageArray, index) {
        index = index || 0;
        var tooobj = this;
        if (imageArray && imageArray.length > index) {
            var thisObj = imageArray[index];
            var thisSrc = thisObj.data('src');
            
            $("<img/>")
            .on('load', function() { 
                thisObj.attr('src',$(this).attr('src'));
                thisObj.photoInitFun();
                if(index%9==0){
                    if(typeof $grid != 'undefined'){ $grid.masonry('layout'); }
                }
                tooobj.preload(imageArray, index + 1);
            })
            .on('error', function() { 
                thisObj.attr('src',noImg); thisObj.css('opacity','1'); 
                //thisObj.photoInitFun();
                if(index%9==0){
                    if(typeof $grid != 'undefined'){ $grid.masonry('layout'); }
                }
                tooobj.preload(imageArray, index + 1);
            })
            .attr("src", thisSrc);
            
        }else
        {
            if(typeof $grid != 'undefined'){ $grid.masonry('layout'); }
        }
    },
    
    $.fn.photoLoadAfterPageLoad = function(noImg) {
        var imag_cll = this;
        if(typeof $grid != 'undefined'){ $grid.masonry('layout'); }
        var totalHotelImg = imag_cll.length;
        var rri = 1;
        var temp_arr = new Array();
        if(totalHotelImg > 0){
            imag_cll.each(function(){
                var thisSrc = $(this).data('src');
                var thisObj = $(this);
                
                if(((typeof thisSrc) != undefined) && ((typeof thisSrc) != 'undefined')){
                
                    if(thisSrc.length > 0){
                        temp_arr.push(thisObj);
                        /*$("<img/>")
                        .on('load', function() { 
                            thisObj.attr('src',$(this).attr('src'));
                            thisObj.photoInitFun();             
                            if(totalHotelImg == rri){ if(typeof $grid != 'undefined'){ $grid.masonry('layout'); } }else{ rri++; }
                        })
                        .on('error', function() { 
                            thisObj.attr('src',noImg); thisObj.css('opacity','0'); 
                            //thisObj.photoInitFun();
                            if(totalHotelImg == rri){ if(typeof $grid != 'undefined'){ $grid.masonry('layout'); } }else{ rri++; }
                        })
                        .attr("src", thisSrc);*/
                    }else
                    {
                        thisObj.attr('src',noImg);
                        thisObj.css('display','block');
                    }
                    thisObj.removeAttr('data-src');
                }else
                {
                    thisObj.attr('src',noImg);
                    thisObj.css('display','block');
                }
                
                thisObj.removeClass('rad-img');
            });
        }
        if(typeof $grid != 'undefined'){ $grid.masonry('layout'); }
        if(temp_arr.length > 0){ this.preload(temp_arr); }
    },
    
    //in image tag data-ajax-link="http://sample.com/page" (FYI: return data in form of json ex. [{"src":"http://example.com/imgage_link.jpg"},{"src":"http://example.com/imgage_link.png"}])
    $.fn.photoInitFun = function() {
        var thisObj = this;
        
        if(typeof thisObj.data('ajax-link') != 'undefined'){
            var rurl = thisObj.data('ajax-link').trim();
            thisObj.removeAttr('data-ajax-link');
            if(rurl.length > 0){
                $.ajax({
                    type: 'POST',
                    url: rurl,
                    success: function(res){
                       thisObj.data('imagessrc',res);
                       thisObj.photoSwapFun();
                    },
                    error: function(e){}
                });   
            }
        }
        else if(typeof thisObj.data('imagessrc') != 'undefined'){ 
            thisObj.photoSwapFun();
        }
    }
    //End

}(jQuery));
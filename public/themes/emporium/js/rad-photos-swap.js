(function($) {

    $.fn.photoSwapFun = function() {
        var imgObj = this;
        var imagessrc =  imgObj.data('imagessrc');
        if(typeof imagessrc == 'object'){
            if(imagessrc.length > 0){
                var imageObjWidth = parseFloat(imgObj.width()).toFixed(2);
                var imageObjHeight = parseFloat(imgObj.height()).toFixed(2);
                
                var is_image_av = false;
                var slidehtml = '<div class="images-groups-parent">';
                        slidehtml += '<div class="rad-images-parent" style="width: '+imageObjWidth+'px; height: '+imageObjHeight+'px;">';
                            slidehtml += '<div class="rad-slide-row" style="left: 0;">';
                            var imgcnt = 0;
                            //slidehtml += '<span id="slide-'+imgcnt+'" class="rad-img-slides'+((imgcnt == 0)?' active':'')+'" style="transform: translateX(0%);"><img src="'+imgObj.attr('src')+'" width="100%" /></span>'; imgcnt++;
                            $.each(imagessrc, function(index, value){
                                if(typeof value['src'] != 'undefined'){
                                    slidehtml += '<span id="slide-'+imgcnt+'" class="rad-img-slides'+((imgcnt == 0)?' active':'')+'" style="transform: translateX('+(imgcnt * 100)+'%);width: '+imageObjWidth+'px; height: '+imageObjHeight+'px; background-image:url(\''+value['src']+'\')"></span>';
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
                    thisObj.find('.rad-slide-row .rad-img-slides').removeClass('active');
                    thisObj.find('.rad-slide-row').find("#slide-"+position).addClass('active');
                    transformX = (position * 100);
                    var tobj = thisObj.find('.rad-slide-row');
                    tobj.stop();
                    tobj.clearQueue().finish();
                    tobj.css('-webkit-transform','translate3d(-'+transformX+'%)');
                    tobj.css('-moz-transform','translate3d(-'+transformX+'%)');
                    tobj.css('transform','translateX(-'+transformX+'%)');
                    //console.log(x,' : ',offset.left,' : ',containerWidth,' : ',numImages,' : ',oneImagePortion,' : ',position,' : ',itid,' : ',transformX,' ; ',tobj.html()); 
                }
                           
            }                    
        });
    },
    
    $.fn.photoLoadAfterPageLoad = function(noImg) {
        var imag_cll = this;
        if(typeof $grid != 'undefined'){ $grid.masonry('layout'); }
        var totalHotelImg = imag_cll.length;
        var rri = 1;
        if(totalHotelImg > 0){
            imag_cll.each(function(){
                var thisSrc = $(this).data('src');
                var thisObj = $(this);
                if(((typeof thisSrc) != undefined) && ((typeof thisSrc) != 'undefined')){
                
                if(thisSrc.length > 0){
                    $("<img/>")
                    .on('load', function() { 
                        thisObj.attr('src',$(this).attr('src'));
                        if(typeof thisObj.data('imagessrc') != 'undefined'){  
                            thisObj.photoSwapFun();
                        }                
                        if(totalHotelImg == rri){ if(typeof $grid != 'undefined'){ $grid.masonry('layout'); } }else{ rri++; }
                    })
                    .on('error', function() { 
                        thisObj.attr('src',noImg); thisObj.css('opacity','0'); 
                        if(typeof thisObj.data('imagessrc') != 'undefined'){  
                            thisObj.photoSwapFun();
                        }
                        if(totalHotelImg == rri){ if(typeof $grid != 'undefined'){ $grid.masonry('layout'); } }else{ rri++; }
                    })
                    .attr("src", thisSrc);
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
    }

}(jQuery));
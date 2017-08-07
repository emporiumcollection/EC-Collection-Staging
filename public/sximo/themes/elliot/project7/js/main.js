$(document).ready(function(){
    folioid.start();
});

folioid = {

    start: function() {
        this.doBindings();
        this.setDimensions();
        this.masonry();
        this.masonryDetails();
        this.slider();
        $(document).ddTopNav();
        $( '#socialTrigger' ).oxFlyOutBox();
        $( '#languageTrigger' ).oxFlyOutBox();        
    },
    
    doBindings: function() {
        

        $(window).load(function(){
            folioid.setDimensions();
        });

        $(window).resize(function(){
            folioid.setDimensions();
        });

        $(document).keyup(function(e){
            if( 27 == e.keyCode ) {
                if($("#frontpage-login-layer").is(":visible"))
                    $("#frontpage-login-layer").hide();
                else 
                    folioid.hideLightbox();
            }
        });

        $("#frontpage-header-showmenu").click(function(){
            folioid.toggleMenu(); 
        });
        
        $("#frontpage-tiles").on("click", ".tile a", function(){
            folioid.loadDetail($(this).attr("href"));
            return false;
        });
        
        $("#frontpage-layer-header-close").click(function(){
            folioid.hideLightbox();
        });
        
        $("#frontpage-layer-header-logo").click(function(){
            folioid.hideLightbox();
            return false;
        });
        
        $("#frontpage-login-layer").click(function(e){
            if($(e.target).is("#frontpage-login-layer"))
                $("#frontpage-login-layer").toggle();            
        });
        
        $(".loggedout #frontpage-header-signup").click(function(){
            $("#frontpage-login-layer").toggle();
            return false; 
        });
        
        $(".frontpage-login-link-cancel").click(function(){
            $("#frontpage-login-layer").hide();
            return false; 
        });
        
        $("#frontpage-login-form").submit(function(){
            var valid = true;
            $(this).find(".frontpage-login-form-input-text").each(function(){
                if($(this).val() == "")
                    valid = false; 
            });
            return valid;
        });
        
    },
    
    setDimensions: function() {
        var $layer = $("#frontpage-layer, #frontpage-detail-content");  
            $layer.css({
                minHeight: $(window).height()
            });
        var $loginLayer = $("#frontpage-login-layer");
            $loginLayer.css({
                minHeight: $("html").height()
            });
        
        var $slidesContainer = $("#frontpage-detail-slider-slides");
        var slidesContainerWidth = $("#frontpage-detail-slider-slides").parent().width();
        var $slides = $(".frontpage-detail-slider-slide");
        var $slidesInner = $(".frontpage-detail-slider-slide-inner");
            $slidesContainer.css({
                width: slidesContainerWidth * $slides.length
            });
            $slides.css({
                width: slidesContainerWidth,
                height: $slidesContainer.height()
            });
            $slidesInner.css({
                height: $slidesContainer.height()
            });
            $(".frontpage-detail-slider-control").css({
                height: $slidesContainer.height(),
                top: $("#frontpage-detail-slider-thumbs").height()
            });
    },
    
    loadDetail: function(href) {
        folioid.showLightbox();
        $("<div/>").load(href + " #frontpage-detail-content", function() {
            var $html = $(this).find("#frontpage-detail-content").html();
            $("#frontpage-layer-content").html($html);
            $("body").addClass("layerloaded"); 
            folioid.masonryDetails();
            folioid.slider();
        });  
    },
    
    showLightbox: function() {
        var $content = $("#frontpage-content");
        var headerHeight = $("#frontpage-header").height();
        $content.css({
            top: -1* $(document).scrollTop() + headerHeight,
        }).find("#frontpage-tiles").infinitescroll("pause");

    },
    
    hideLightbox: function() {
        var $content = $("#frontpage-content");
        var $layerContent = $("#frontpage-layer-content");
        var headerHeight = $("#frontpage-header").height();
        var scrollTop = -1*parseInt($content.css("top"))+headerHeight;
        $layerContent.html("");
        $content.css({
            top: false,
        }).find("#frontpage-tiles").infinitescroll("resume");

        $(document).scrollTop(scrollTop);
    },
    
    toggleMenu: function() {

        var $header = $("#frontpage-header");
        var $menu = $("#top_nav_wrapper");
        var $content = $("#frontpage-content, #frontpage-detail-content");
        var isVisible = $menu.is(":visible");
        if( ! isVisible ) {
            $menu.slideDown(function(){
                $("body").addClass("showmenu");
            });
            $header.animate({
                height: 190
            }); 
            if( ! Modernizr.csspositionsticky )
                $content.animate({
                    top: parseInt($content.css("top"))+70 
                });
        }
        else {
            $("body").removeClass("showmenu");
            $menu.slideUp();
            $header.animate({
                height: 120
            });
            if( ! Modernizr.csspositionsticky )
                $content.animate({
                    top: parseInt($content.css("top"))-70 
                });
        }
    },
    
    slider: function() {
        $(".frontpage-detail-slider-thumb").first().addClass("frontpage-detail-slider-thumb-active");
        $("#frontpage-detail-slider").slider({
            slidesContainer: $("#frontpage-detail-slider-slides"),
            slidesControlPrev: $(".frontpage-detail-slider-control-prev"),
            slidesControlNext: $(".frontpage-detail-slider-control-next"),
            slidesThumbs: $(".frontpage-detail-slider-thumb"),
            slidesActiveThumbClass: "frontpage-detail-slider-thumb-active",
            autoPlay: false,
            imageClick : true,
            enableKeyboard: true,
            thumbClick: false,
            easingDuration: Modernizr.touch ? 200 : 700
        });  
    },
    
    masonry: function() {
        var $tilesContainer = $("#frontpage-tiles");
        $tilesContainer.imagesLoaded(function(){
            folioid.setDimensions();
            $tilesContainer.packery({itemSelector: '.tile'}).css({backgroundImage: 'none'}).find(".tile").css({visibility: 'visible'});  
            folioid.infiniteScroll();
        });
    },
    
    masonryDetails: function() {
        var $tilesContainer = $("#frontpage-detail-tiles");
        $tilesContainer.imagesLoaded(function(){
            folioid.setDimensions();
            $tilesContainer.packery({itemSelector: '.detail-tile'}).css({backgroundImage: 'none'}).find(".detail-tile").css({visibility: 'visible'});  
        });
    },
    
    infiniteScroll: function() {
        $(".frontpage-tiles-nav").css({
            visibility: 'hidden' 
        });
        $("#frontpage-tiles").infinitescroll(
            {
                navSelector  : '.frontpage-tiles-nav',    // selector for the paged navigation 
                nextSelector : '.frontpage-tiles-nav-next',  // selector for the NEXT link (to page 2)
                itemSelector : '.tile',     // selector for all items you'll retrieve
                bufferPx: Modernizr.touch ? 100 : 40,
                prefill: true,
                infid: 0,
                loading: {
                    finishedMsg: folioid.infiniteScrollFinished,
                    msgText: folioid.infiniteScrollLoading,
                    img: 'data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH+GkNyZWF0ZWQgd2l0aCBhamF4bG9hZC5pbmZvACH5BAAKAAAAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQACgABACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkEAAoAAgAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkEAAoAAwAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkEAAoABAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQACgAFACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQACgAGACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAAKAAcALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA=='
                }
            },
            function( newElements ) {
/*                 alert("new elems"); */
                var $newElems = $( newElements ).css({ visibility: 'hidden' });
                $newElems.imagesLoaded(function(){
                    $newElems.css({ visibility: 'visible' });
                    $("#frontpage-tiles").packery( 'appended', $newElems, true ); 
                    folioid.setDimensions();
                });
            }
        );
    }   
};
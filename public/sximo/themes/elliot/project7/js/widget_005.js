( function( $ ) {

    ddLightbox = {

        _create: function(){
            this.attachLightboxes();

        },
        
        attachLightboxes: function() {

		 	$('.asLightbox:not(.cboxElement)').each(function() {
	 			var that = $(this);
	 			var href = that.attr('href');
				if (href.indexOf('?') != -1) {
					if (href.indexOf('asLightbox') == -1)
						that.attr('href', href + '&asLightbox');
				} else {
					that.attr('href', href + '?asLightbox');
				}
			});

			$(".asLightbox.default").colorbox({iframe:true, innerHeight:'270px', innerWidth:'327px'});
			$(".asLightbox.lightbox_email").colorbox({iframe:true, innerHeight:'300px', innerWidth:'350px'});
			$(".asLightbox.videolightbox").colorbox({iframe:true, innerHeight:'700', innerWidth:'1200'});
			$(".asLightbox.adminLightbox").colorbox({iframe:true, innerHeight:'1200', innerWidth:'1600'});
			

        }
    }

    $.widget( "ui.ddLightbox", ddLightbox );

} )( jQuery );

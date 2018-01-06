/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @link      http://www.oxid-esales.com
 * @package   out
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop PE
 * @version   SVN: $Id: oxflyoutbox.js 35529 2011-05-23 07:31:20Z vilma $
 */
( function( $ ) {

    oxFlyOutBox = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;



            $(document).click( function( e ){
                if( $(e.target).parents("div").hasClass("topPopList") ){
                }else{
                    $("div.flyoutBox").hide();
                }
            });

            $(document).keydown( function( e ) {
               if( e.which == 27) {
                    $("div.flyoutBox").hide();
               }
            });

            el.mouseenter(function(){
                $("div.flyoutBox").hide();
                $(this).nextAll("div.flyoutBox").show();
                
                $(this).mouseleave(function(){
					$(this).find(".flyoutBox").hide();
                });
                return false;
            });

			$(".topPopList").live("mouseleave", function() {
				if ($(this).find(".flyoutbox:visible").length > 0) {
					$(this).find(".flyoutbox").hide();
				}
			});

			$(".topPopList").live("mouseleave", function() {
				$(".flyoutBox").hide();
			});


        }
    }

    $.widget( "ui.oxFlyOutBox", oxFlyOutBox );

} )( jQuery );
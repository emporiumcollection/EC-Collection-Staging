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
 * @version   SVN: $Id: oxinnerlabel.js 35529 2011-05-23 07:31:20Z vilma $
 */
( function( $ ) {

    oxInnerLabel = {

        options: {
                sDefaultValue : 'innerLabel'
        },

        _create: function(){

            var self = this,
                options = self.options,
                input = self.element,
                label = $("label[for='"+input.attr('id')+"']");

            var pos = input.position();
            label.css( { "left": (pos.left) + "px", "top":(pos.top) + "px" } );

            input.focus(function() {
                label.hide();
            });

            input.blur(function() {
                if ( $.trim(input.val()) == ''){
                    label.show();
                }
            });

            if ($.trim(input.val()) != '') {
                label.hide();
            }
            input.delay(500).queue(function(){
                if ($.trim(input.val()) != '') {
                    label.hide();
                }
            });
       }
    }

    $.widget( "ui.oxInnerLabel", oxInnerLabel );

} )( jQuery );
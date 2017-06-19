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
 * @version   SVN: $Id: oxpromocategory.js 35529 2011-05-23 07:31:20Z vilma $
 */
( function( $ ) {

    oxCenterElementOnHover = {

        _create: function(){

            var self = this;
            var el   = self.element;

             el.hover(function(){
                  var targetObj = $(".viewAllHover", el);
                  var targetObjWidth = targetObj.outerWidth() / 2;
                  var parentObjWidth = el.width() / 2;

                  targetObj.css("left", parentObjWidth - targetObjWidth + "px");
                  targetObj.show();
              }, function(){
                  $(".viewAllHover", el).hide();
              });
        }
    }

    $.widget( "ui.oxCenterElementOnHover", oxCenterElementOnHover );

} )( jQuery );

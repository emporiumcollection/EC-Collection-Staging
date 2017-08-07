$ = jQuery;
// JavaScript Document
var popupOpen = 0;

function createBanner (){
  $('body').append('<div id="privacy-cookie"><div id="privacy-contenuto"><p>Utilizziamo i cookie per assicurarti la migliore esperienza possibile sul nostro sito. Navigandolo accetti <a href="#" onclick="openAll()" >Termini e condizioni</a><br><a id="privacy-button" href="#" onclick="setCookie(\' '+dominio+' \', 1, 365)">Accetta</a></p></div></div>');

}

function createPopup (){
  if(popupOpen == 1) {return;}
  $('body').append('<div class="md-overlay" onclick="closeAll()"></div>');
  $('body').append('<div class="md-modal md-effect-1" id="modal-1" onclick="closeAll()" ><div id="md-contenuto" class="md-content" onclick="closeAll()"><div><button class="md-close">X</button></div></div></div>');
  ifrm = document.createElement("IFRAME"); 
  ifrm.setAttribute("src", "http://www.awdagency.com/privacy/privacy.php?intestazione="+ intestazione +"&piva="+ piva +"&indirizzo="+ indirizzo +"&dominio="+ dominio +"&email="+ email ); 
  ifrm.style.width = "100%"; 
  ifrm.style.height = "100%"; 
  document.getElementById("md-contenuto").appendChild(ifrm);
  

 }

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
    
    $('#privacy-cookie').remove();
}

function checkCookie() {
    var show=getCookie(dominio);
    // alert(show);
    if (show!="") {
        // Il cookie è già stato salvato
    }else{
        // visualizzo la barra
        createBanner();
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

// JavaScript Document
$(document).ready(function($){
createPopup();
checkCookie();

});
function openAll(){
  $("#modal-1").css("display","block");
  $("#modal-1").addClass("md-show");
  $(".md-overlay").css({"opacity":"1","visibility":"visible"});
  popupOpen = 1 ;
  $('html').css('overflow','hidden');
}
function closeAll() {

  $("#modal-1").removeClass("md-show");
  $(".md-overlay").css({"opacity":"0","visibility":"hidden"});
setTimeout(function(){
  $("#modal-1").css("display","none");
},1000);
  popupOpen = 0;

  $('html').css('overflow','auto');
 }



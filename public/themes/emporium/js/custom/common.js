$(document).ready(function () {
    /*
     * For Confirm for reading Confidential Data
     */
    checkCookie();

    $(document).on('click','.cookie-bar-hide-btn',function () {
        $('.bootom-cookie-bar-outer').hide();
    });


    /*
     * For Select Collection of Left Sidebar
     */
    $(document).on('click', 'a[data-action="select-collection"]', function () {
        alert('asd');
        hideAllOption();
    });
});

/*
 * For Hide All Option on Left Side Bar
 */
function hideAllOption() {
    $('[data-option="home"]').addClass('hide');
    $('[data-option="global"]').addClass('hide');
    $('[data-option="search-bar"]').addClass('hide');
    $('[data-option="selected-option-list"]').addClass('hide');
    $('[data-option="search-by-date"]').addClass('hide');
    $('[data-option="search-our-collection"]').addClass('hide');
}

/*
 * For Set and Check Cookies for Confidential Data
 */
//Set Cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
//Check Cookie
function checkCookie() {
    var username = getCookie("cookie-bar");

    if (username == "") {
        setCookie('cookie-bar', '1', 1);
        $(".bootom-cookie-bar-outer").show();
    } else {
        $(".bootom-cookie-bar-outer").hide();
    }
}
//Get Cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
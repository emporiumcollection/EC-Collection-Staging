$(document).ready(function () {
    /*
     * For Confirm for reading Confidential Data
     */
    checkCookie();

    $(document).on('click', '.cookie-bar-hide-btn', function () {
        $('.bootom-cookie-bar-outer').hide();
    });


    $(document).on('click', '.open-cookie-bar-page', function () {
        $(".cookie-bar-page").fadeIn();
    });


    $(document).on('click', '.close-btn-align', function () {
        $(".cookie-bar-page").fadeOut();
    });


    /*
     * For Select Collection of Left Sidebar
     */
    $(document).on('click', '[data-action="select-collection"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Search Our Collection';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        openCollection();

    });

    /*
     * For Select By Date of Left Sidebar
     */
    $(document).on('click', '[data-action="search-by-date"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Search By Date';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        openSearchByDate();


    });

    /*
     * For Select By Date of Left Sidebar
     */
    $(document).on('click', '[data-option-action="back"][data-option-action-type="home"]', function () {
        hideAllOption();
        openAllHomeOption();
    });

});

/*
 * For Hide All Option on Left Side Bar
 */
function hideAllOption() {
    $('[data-option="home"]').addClass('hide');
    $('[data-option="global"]').addClass('hide');
    $('[data-option="child-global"]').addClass('hide');
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

/*
 * For put data dynamically
 */

function putDataOnLeft(data){
    $('[data-option="child-global"] [data-option-title="global"]').html(data.main_title);
    $('[data-option="child-global"] [data-option-action="back"] span').html(data.sub_title);
    $('[data-option="child-global"] [data-option-action="back"]').attr('data-id',data.id);
    $('[data-option="child-global"] [data-option-action="back"]').attr('data-id',data.id);
}
/*
 * For open collection options
 */
function openCollection(){
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="search-our-collection"]').removeClass('hide');
}
/*
 * For open search-by-date options
 */
function openSearchByDate(){
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="search-by-date"]').removeClass('hide');
}
/*
 * For open all home options
 */
function openAllHomeOption(){
    $('[data-option="home"]').removeClass('hide');
    $('[data-option="global"]').removeClass('hide');
}

	
/*
|--------------------------------------------------------------------------
	Style-1 - With Dropdown and Date Format: MM-DD-YYYY
|--------------------------------------------------------------------------
*/
	$('.reservationdate').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY',
			daysOfWeek: [
				"SUN",
				"MON",
				"TUE",
				"WED",
				"THU",
				"FRI",
				"SAT"
			],
			monthNames: [
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December"
			],
			firstDay: 0
		},
		showDropdowns: true,
		singleDatePicker: true,
		startDate: todayDate
	});
/*
|--------------------------------------------------------------------------
	DateRange - Multipurpose Responsive Date Range Picker Main JS
	Author: MGScoder
	Author URL: https://codecanyon.net/user/mgscoder
|--------------------------------------------------------------------------
*/
document.addEventListener("touchstart", function() {},false);
(function ($) {
	"use strict";

	function addDays(dateObj, numDays) {
	   dateObj.setDate(dateObj.getDate() + numDays);
	   return dateObj;
	}
	
	var todayDate = moment();
	var nextDay = moment().add(1, 'days');
	var nextWeek = moment().add(7, 'days');
	var nextMonth = moment().add(30, 'days');
	var next3days = moment().add(3, 'days');
	var next5days = moment().add(5, 'days');
	var next10days = moment().add(10, 'days');
	var next15days = moment().add(15, 'days');
	
	var dt = new Date();
	var cy = dt.getFullYear();
	var minDates = '1 December, ' + cy;
	var maxDates = '31 December, ' + cy;
	
	
/*
|--------------------------------------------------------------------------
	Style-1 - With Dropdown and Date Format: MM-DD-YYYY
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate"]').daterangepicker({
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
		startDate: todayDate,
		endDate: next3days
	});
	
/*
|--------------------------------------------------------------------------
	Style-1-2 - Without Dropdown and Short Calendar Label Text - Date Format: DD MMMM, YYYY
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate1"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY'
		},
		startDate: todayDate,
		endDate: next3days
	});
	
/*
|--------------------------------------------------------------------------
	Style-2 - Without Dropdown and All Past/Previous Days Disable
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate2"]').daterangepicker({
		locale: {
			format: 'YYYY-MM-DD',
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
		startDate: next3days,
		endDate: next5days,
		minDate: todayDate
	});
		
/*
|--------------------------------------------------------------------------
	Style-3 - Show Alert Box for Selected date
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate3"]').daterangepicker({
		locale: {
			format: 'YYYY/MM/DD',
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
		startDate: todayDate,
		endDate: nextWeek
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('YYYY/MM/DD') + ' to ' + end.format('YYYY/MM/DD'));
		}
	);
		
/*
|--------------------------------------------------------------------------
	Style-4 - Set minDate - Active Date from the Next Week
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate4"]').daterangepicker({
		locale: {
			format: 'MM/DD/YYYY',
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
		endDate: nextMonth,
		minDate: nextWeek
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('MM/DD/YYYY') + ' to ' + end.format('MM/DD/YYYY'));
		}
	);
		
/*
|--------------------------------------------------------------------------
	Style-5 - Date Format: MMMM DD, YYYY and set minDate
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate5"]').daterangepicker({
		locale: {
			format: 'MMMM DD, YYYY',
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
		endDate: nextMonth,
		minDate: nextWeek
	});
		
/*
|--------------------------------------------------------------------------
	Style-6 - Limited Time Offer - Set minDate and maxDate
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate6"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY',
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
		endDate: maxDates,
		minDate: minDates,
		maxDate: maxDates
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('DD MMMM, YYYY') + ' to ' + end.format('DD MMMM, YYYY'));
		}
	);
		
/*
|--------------------------------------------------------------------------
	Style-6-2 - Limited Time Offer - Set minDate and maxDate
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate6-2"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY',
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
		endDate: '20 September, 2027',
		minDate: '20 August, 2027',
		maxDate: '20 September, 2027'
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('DD MMMM, YYYY') + ' to ' + end.format('DD MMMM, YYYY'));
		}
	);
		
/*
|--------------------------------------------------------------------------
	Style-7 - Predefined Ranges
|--------------------------------------------------------------------------
*/
	var start = moment().subtract(10, 'days');
    var end = moment();
	
    function drv(start, end) {
        $('input[name="reservationdate7"]').val(start.format('DD MMMM, YYYY') + ' - ' + end.format('DD MMMM, YYYY'));
	}
	
    $('input[name="reservationdate7"]').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY HH:mm',
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
		autoUpdateInput: false,
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'Next 7 Days': [moment(), moment().add(7, 'days')],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, drv);
	drv(start, end);
	
/*
|--------------------------------------------------------------------------
	Style-8 - All Past Day Disable and Short Calendar Label Text with Selected Date Alert
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate8"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY'
		},
		showDropdowns: true,
		startDate: next3days,
		endDate: next5days,
		minDate: todayDate
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('DD MMMM, YYYY') + ' to ' + end.format('DD MMMM, YYYY'));
		}
	);
	
/*
|--------------------------------------------------------------------------
	Style-9 - All Past Day & Apply Button Disable
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate9"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY',
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
		autoApply: true,
		startDate: next3days,
		endDate: next5days,
		minDate: todayDate
	});
	
/*
|--------------------------------------------------------------------------
	Style-10 - All Past Day & Apply Button Disable with Selected Date Alert
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate10"]').daterangepicker({
		locale: {
			format: 'MMMM DD, YYYY',
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
		autoApply: true,
		startDate: next3days,
		endDate: next5days,
		minDate: todayDate
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('MMMM DD, YYYY') + ' to ' + end.format('MMMM DD, YYYY'));
		}
	);
	
/*
|--------------------------------------------------------------------------
	Style-11 - Show Week Numbers
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate11"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY',
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
		showWeekNumbers: true,
		startDate: next3days,
		endDate: next5days
	});
	
/*
|--------------------------------------------------------------------------
	Style-12 - Date Limit (Limit maximum number of selected date: here 10 Days)
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate12"]').daterangepicker({
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
		dateLimit: {
			days: 10
		},
		showDropdowns: true,
		startDate: next5days,
		endDate: next15days
	});
	
/*
|--------------------------------------------------------------------------
	Style-13 - TimePicker 12Hour
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate13"]').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY h:mm A',
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
		dateLimit: {
			days: 10
		},
		showDropdowns: true,
		timePicker: true,
		startDate: next5days,
		endDate: next15days
	});
	
/*
|--------------------------------------------------------------------------
	Style-13-2 - TimePicker 24Hour
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate13-2"]').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY H:mm',
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
		dateLimit: {
			days: 10
		},
		showDropdowns: true,
		timePicker: true,
		timePicker24Hour: true,
		startDate: next5days,
		endDate: next15days
	});
	
/*
|--------------------------------------------------------------------------
	Style-14 - Calendar in French Date Format: DD/MM/YYYY
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate14"]').daterangepicker({
		locale: {
			format: 'DD/MM/YYYY',
			daysOfWeek: [
				"Dim",
				"Lun",
				"Mar",
				"Mer",
				"Jeu",
				"Ven",
				"Sam"
			],
			monthNames: [
				"Janvier",
				"Février",
				"Mars",
				"Avril",
				"Mai",
				"Juin",
				"Juillet",
				"Août",
				"Septembre",
				"Octobre",
				"Novembre",
				"Décembre"
			],
			firstDay: 0
		},
		showDropdowns: true,
		startDate: next5days,
		endDate: next10days
	});
	
/*
|--------------------------------------------------------------------------
	Style-14 - Calendar in French Date Format: DD MMMM, YYYY
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate14-2"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY',
			daysOfWeek: [
				"Dim",
				"Lun",
				"Mar",
				"Mer",
				"Jeu",
				"Ven",
				"Sam"
			],
			monthNames: [
				"Janvier",
				"Février",
				"Mars",
				"Avril",
				"Mai",
				"Juin",
				"Juillet",
				"Août",
				"Septembre",
				"Octobre",
				"Novembre",
				"Décembre"
			],
			firstDay: 0
		},
		showDropdowns: true,
		startDate: next5days,
		endDate: next10days
	});
	
	
})(jQuery);

/*
|--------------------------------------------------------------------------
	End
|--------------------------------------------------------------------------
*/
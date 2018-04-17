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
		startDate: todayDate,
		minDate : todayDate
	});
	
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
		singleDatePicker: true,
		startDate: todayDate
	});
	
/*
|--------------------------------------------------------------------------
	Style-1-2 - Without Dropdown and Short Calendar Label Text - Date Format: MM-DD-YYYY
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate1"]').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY'
		},
		singleDatePicker: true,
		startDate: todayDate
	});
	
/*
|--------------------------------------------------------------------------
	Style-2 - All Future Date Disable - Date Format: MMMM DD, YYYY
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate2"]').daterangepicker({
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
		singleDatePicker: true,
		startDate: todayDate,
		maxDate: todayDate
	});
		
/*
|--------------------------------------------------------------------------
	Style-3 - With Dropdown and Date Format: YYYY/MM/DD
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
		singleDatePicker: true,
		startDate: todayDate
	});
		
/*
|--------------------------------------------------------------------------
	Style-3-2 - Without Dropdown and Date Format: YYYY/MM/DD
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate3-2"]').daterangepicker({
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
		singleDatePicker: true,
		startDate: todayDate
	});
		
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
		showDropdowns: true,
		singleDatePicker: true,
		minDate: nextWeek
	});
		
/*
|--------------------------------------------------------------------------
	Style-5 - Format: MMMM DD, YYYY and set minDate
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
		singleDatePicker: true,
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
		singleDatePicker: true,
		minDate: minDates,
		maxDate: maxDates
	});
		
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
		singleDatePicker: true,
		minDate: '20 August, 2027',
		maxDate: '20 September, 2027'
	});
		
/*
|--------------------------------------------------------------------------
	Style-7 - Set Specific Date as like for Event Date Registration
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate7"]').daterangepicker({
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
		singleDatePicker: true,
		minDate: '20 August, 2018',
		maxDate: '20 August, 2020'
	});
	
/*
|--------------------------------------------------------------------------
	Style-8 - All Past Day Disable as like for Card Expired Date
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate8"]').daterangepicker({
		locale: {
			format: 'DD MMMM, YYYY'
		},
		showDropdowns: true,
		singleDatePicker: true,
		startDate: next3days,
		minDate: todayDate
	});
	
/*
|--------------------------------------------------------------------------
	Style-9 - All Past Day Disable as like for Card Expired Date
|--------------------------------------------------------------------------
*/
	$('input[name="reservationdate9"]').daterangepicker({
		locale: {
			format: 'MMMM, YYYY',
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
		startDate: next3days,
		minDate: todayDate
	});
	
/*
|--------------------------------------------------------------------------
	Style-10 - All Past Day Disable with Selected Date Alert
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
		singleDatePicker: true,
		startDate: next3days,
		minDate: todayDate
		}, function(start, end, label) {
			alert("Your chosen date: " + start.format('MMMM DD, YYYY'));
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
		singleDatePicker: true,
		showWeekNumbers: true,
		startDate: next3days
	});
	
/*
|--------------------------------------------------------------------------
	Style-12 - Set Start Date after 15 Days
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
		showDropdowns: true,
		singleDatePicker: true,
		minDate: next15days
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
		singleDatePicker: true,
		timePicker: true,
		startDate: next5days
	});
	
/*
|--------------------------------------------------------------------------
	Style-13-2 - TimePicker 12Hour
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
		singleDatePicker: true,
		timePicker: true,
		timePicker24Hour: true,
		startDate: next5days
	});
	
/*
|--------------------------------------------------------------------------
	Style-14 - Calendar in French
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
		singleDatePicker: true,
		startDate: next5days
	});
	
	
})(jQuery);

/*
|--------------------------------------------------------------------------
	End
|--------------------------------------------------------------------------
*/
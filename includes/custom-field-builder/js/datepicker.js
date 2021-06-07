/*-------------------------------------------*/
/*	datepicker
/*-------------------------------------------*/
jQuery(document).ready(function($){
	 //datepickerというinputタグにDatepicker
	 $('.datepicker').datepicker({
		// showOn: 'button',
		// buttonImage: '/images/calendar.gif',
		// buttonImageOnly: true,
		dateFormat: 'yy/mm/dd',
		// changeMonth: true,
		// changeYear: true,
		// yearRange: '1960:2009',
		// showMonthAfterYear: false,
		firstDay: 1
	});
});

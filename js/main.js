/*
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
*/

/*
Uses rome.js to check input_from and input_to, to make sure the from, and to dates
 to validate range with dateValidator function. Check to assure
  the input_from date is less than or equal to the input_to date.
  time:boolean used to return result. 
*/
$(function() {

  rome(input_from, {
	  dateValidator: rome.val.beforeEq(input_to),
	  time: false
	});

	rome(input_to, {
	  dateValidator: rome.val.afterEq(input_from),
	  time: false
	});


});
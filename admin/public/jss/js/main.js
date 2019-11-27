/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
// Wait for the DOM to be ready

	// Initialize form validation on the registration form.
	// It has the name attribute "registration"
	$("form[name='register']").validate({
	  // Specify validation rules
	  rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		name: "required",
		
		email: {
		  required: true,
		  // Specify that email should be validated
		  // by the built-in "email" rule
		  email: true
		},
		password: {
		  required: true,
		  minlength: 5
		}
	  },
	  // Specify validation error messages
	  messages: {
		name: "Please enter your firstname",
		password: {
		  required: "Please provide a password",
		  minlength: "Your password must be at least 5 characters long"
		},
		email: "Please enter a valid email address"
	  },
	  // Make sure the form is submitted to the destination defined
	  // in the "action" attribute of the form when valid
	  submitHandler: function(form) {
		form.submit();
	  }
	});
  
  
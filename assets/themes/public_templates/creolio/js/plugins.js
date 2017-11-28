/* *********************************************************************************************************************
 * Multiple dropdown menu
 */
jQuery.fn.multipleDropDown = function() {

	var nav = this;

	// Check all menu items
	nav.children('li').each(function() {

		// If exist child ul
		if ( $(this).find('ul').length > 0  ) {

			$(this).children('a').click(function(e){
				if ($(this).attr('href') == '#'){
					e.preventDefault();
				}
			});

			// Add arrow for current parent
			var currItem = $(this).children('a');
			currItem.addClass('sub');

			// Show 1st level submenu
			var currChild = $(this).children('ul');
			var hasActive = false;

			// Offset for sub sub level
			var csspos = $(this).find('ul');

			csspos.css({
				'margin-left': -1 * csspos.width() +  $(this).width(),
				'padding-top': 10
			});

			// If exists active child mark all parents active
			if ( $(this).find('.active').length > 0  ) {
				$(this).addClass('active');
			}

			// Over
			currItem.parent().hover(function() {

				if ( currItem.parent().hasClass('active') ) {
					hasActive = true;
				}
				else {
					currItem.parent().addClass('active');
				}

				currChild.stop().fadeIn(200);

			}, function() {
				if ( !hasActive ){
					currItem.parent().removeClass('active');
				}

				currChild.stop().fadeOut(200);

				hasActive = false;
			});
		}
	});

};



/* *********************************************************************************************************************
 * Hide default form fields value on focus
 */
jQuery.fn.inputDefaultValue = function () {

	var mess = new Array();

	$(this).each(function(idx) {
		mess[idx] = $(this).attr("value");

		$(this).focus(function() {
			if ( $(this).attr("value") == mess[idx] ) $(this).attr("value", "");
		}).blur(function() {
				if ( $(this).attr("value") == "") $(this).attr("value", mess[idx]);
			});
	});

};



/* *********************************************************************************************************************
 * Initialization of google maps
 */

jQuery.fn.initGoogleMaps = function () {

	// LOAD GOOGLE MAPS JS
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "http://maps.googleapis.com/maps/api/js?sensor=true&callback=initialize";
	document.body.appendChild(script);

};
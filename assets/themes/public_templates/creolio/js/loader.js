/*
 * Define path to vendor (3rd party) js files
 */
var jspathVendor = jspath;



yepnope([
	/*
	 * Load Flexslider if .slides exist
	 */
	{
		test: $('.slides').length,
		yep: jspathVendor + 'jquery.flexslider-min.js'
	},

	/*
	 * Load Isotope if .isotope exist
	 */
	{
		test: $('.isotope').length,
		yep: jspathVendor + 'jquery.isotope.min.js'
	},

	/*
	 * Load InfiniteScroll if .isotope-loading exist
	 */
	{
		test: $('.isotope-loading').length,
		yep: jspathVendor + 'jquery.infinitescroll.min.js'
	},

    /*
     * Load Isotope BBQ if .isotope exist
     */
    {
        test: $('.isotope').length,
        yep: jspathVendor + 'jquery.ba-bbq.min.js'
    },

	/*
	 * Load LiveTwitter if .widget-twitter exist
	 */
	{
		test: $('div[class^="tweets-"]').length,
		yep: jspathVendor + 'tweetMachine.js'
	},

	/*
	 * Load jRibbble if .dribbble-widget exist
	 */
	{
		test: $('.dribbble-widget').length,
		yep: jspathVendor + 'jquery.jribbble.js'
	},

	/*
	 * Load Validate if .validate exist
	 */
	{
		test: $('.validate').length,
		yep: jspathVendor + 'jquery.validate.min.js'
	},

	/*
	 * Load main user file always
	 */
	{
		load: [
			jspathVendor + 'selectnav.min.js',    // Responsive select menu
            'ie8!' + jspathVendor + 'respond.js',   // Load respond.js only when IE8
			jspath + 'plugins.js',      // All user's jQuery.fn plugins
			jspath + 'main.js',      // Main js file with all user's definitions
			'assets/user/user.js'      // User JS file with all user's definitions
		]
	}
]);
<!doctype html>

<html>

	<head>
		<meta charset="utf-8">

		<title><?php echo $seo_page_title; ?></title>

		<meta name="description" content="<?php echo $seo_meta_description; ?>">
		<meta name="keywords" content="<?php echo $seo_meta_keywords; ?>">

		<meta name="author" content="Zorzis Varkaris">

		<!-- Facebook meta -->
		<!--
		<meta property="og:title" content="">
		<meta property="og:description" content="">
		<meta property="og:image" content="">
		<meta property="og:url" content="">
		<meta property="og:site_name" content="">
		-->

		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png (72x72) in the root directory -->
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/public/haze_template/favicon.ico">
		<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/themes/public/haze_template/apple-touch-icon.png">

		<!--DONE Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- HTML5 enabling script -->
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


		<!-- Loads the CSS, JS and META informations to the view -->
		<?php
		  foreach($css as $file){
		    echo "\n\t\t";
		    ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
		  } echo "\n\t";

		?>
		  <!-- END Loading the CSS, JS and META informations to the view -->

		<!-- DONE Google Web fonts -->
		<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
		
        <!--[if IE 8]><link rel="stylesheet" href="assets/core/libs/css/ie8.css"><![endif]-->
	</head>
	<body class="theme2">

		<header class="onerow color2">
			<div class="onepcssgrid-1200">
				<div class="col4">

					<?php if (!empty($settings)) {?>
					
						<a href='<?php echo base_url(); ?>'><img src="<?php echo base_url(); ?>uploads/<?php echo $settings->logo_image; ?>" alt="haze.gr" width="50px" height="50px"></a>
					
					<?php }?>

				</div>

				<?php echo $this->load->get_section('header'); ?>

				<div class="arrow"></div>
			</div>
		</header>

		<?php echo $output;?>

		<footer class="onerow full color2">
			<div class="onepcssgrid-1200">

				<?php echo $this->load->get_section('footer'); ?>
				
			</div>
		</footer>

		<!-- Starts Loading JS to the view -->
		<?php

			foreach($js as $file){
					      echo "\n\t\t";
					      ?><script src="<?php echo $file; ?>"></script><?php
					  } echo "\n\t";


		?>
		<!-- END Loading the JS to the view -->

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/public_templates/creolio/js/yepnope.1.5.4-min.js"></script>
		<script>
			/*
			 * Define path to js files
			 */
			var jspath = "<?php echo base_url(); ?>assets/themes/public_templates/creolio/js/";

			/*
			 * Yepnope dependency calls
			 */
			yepnope([

				/*
				 * Load jQuery CDN || local
				 */
				{
					load: 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js',
					complete: function () {
						if (!window.jQuery) {
							yepnope( jspath + 'jquery.min.js' );
						}
					}
				},

				/*
				 * Load loader.js - main dispatcher for all loaded scripts
				 */
				{
					load: jspath + 'loader.js'
				}

			]);
		</script>

		<!-- Google analytics.js Start -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create','<?php echo $settings->google_analytics_tracking_id?>', 'auto');
		  ga('send', 'pageview');

		</script>
		<!-- Google analytics.js Start -->

	</body>

</html>

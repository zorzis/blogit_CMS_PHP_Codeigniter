<!DOCTYPE html>
<html lang="en" class="app">
<head>

  <meta charset="utf-8" />
  <title><?php echo $this->lang->line('cms_title');?></title>
  <!--Meta description goes here -->
  <meta name="description" content="" />

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 

  <!-- Loads the CSS, JS and META informations to the view -->
<?php

  if(!empty($meta))
  foreach($meta as $name=>$content){
    echo "\n\t\t";
    ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
       }
  echo "\n";

  if(!empty($canonical))
  {
    echo "\n\t\t";
    ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

  }
  echo "\n\t";

  foreach($css as $file){
    echo "\n\t\t";
    ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
  } echo "\n\t";

  foreach($js as $file){
  echo "\n\t\t";
  ?><script src="<?php echo $file; ?>"></script><?php
  } echo "\n\t";

?>



<!-- END Loading the CSS, JS and META informations to the view -->

  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
  
</head>
<body>
  <section class="vbox"><!-- Starts the vbox first section -->
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">

      <?php echo $this->load->get_section('header'); ?>
      
    </header>
    <section><!-- Starts the main section with nav and content area -->
      <section class="hbox stretch"><!-- Starts hbox strectch section -->

      <?php echo $this->load->get_section('navigation'); ?>

        <section id="content"><!-- Starts Content Section - Main App area -->

          <?php echo $output;?>

        </section><!-- Ends Content Section - Main App area -->
      </section><!-- Ends hbox strectch section -->
    </section><!-- Ends the main section with nav and content area -->
  </section><!-- Ends the vbox first section -->  
  

<script>
    CKEDITOR.replace('editor1' ,{
    filebrowserImageBrowseUrl : '<?php echo base_url('filemanager/index.html');?>'
  });
</script>



<!-- Google analytics.js Start -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create','UA-65969807-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Google analytics.js Start -->

</body>
</html>
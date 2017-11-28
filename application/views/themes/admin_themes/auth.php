<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title><?php echo $this->lang->line('login_to_admin');?></title>
  <meta name="description" content="" />
  <meta name="viewport" content="" /> 
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
  
  <?php echo $output;?>  

</body>
</html>
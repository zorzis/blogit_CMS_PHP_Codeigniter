<!-- *****************************************************************************************************************
	 TESTIMONIALS
	 ***************************************************************************************************************** -->
	 <div id="twrap">
	 	<div class="container centered">
	 		<div class="row">
	 			<div class="col-lg-8 col-lg-offset-2">
	 			<i class="fa fa-comment-o"></i>

	 			<?php foreach ($images_and_captions_per_module as $image_and_caption): ?>

		 			<p><?php echo $image_and_caption->image_caption ?></p>
		 			<h4><br/><?php echo $module->title ?></h4>

				<?php endforeach; ?>

	 			</div>
	 		</div><!--/row -->
	 	</div><!--/container -->
	 </div><!--/twrap -->

<style>
/* Testimonials Wrap */
#twrap {
	background: url(<?php echo base_url() . $image_and_caption->image_path ?>) no-repeat center top;
	margin-top: 0px;
	padding-top:60px;
	text-align:center;
	background-attachment: relative;
	background-position: center center;
	min-height: 450px;
	width: 100%;
	
    -webkit-background-size: 100%;
    -moz-background-size: 100%;
    -o-background-size: 100%;
    background-size: 100%;

    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
</style>
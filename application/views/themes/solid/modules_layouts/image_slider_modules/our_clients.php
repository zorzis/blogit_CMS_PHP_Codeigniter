<!-- *****************************************************************************************************************
	 OUR CLIENTS
	 ***************************************************************************************************************** -->
	 <div id="cwrap">
		 <div class="container">
		 	<div class="row centered">
			 	<h3>

			 		<?php echo $module->title ?>

			 	</h3>

			 	<?php foreach ($images_and_captions_per_module as $image_and_caption): ?>

				 	<div class="col-lg-3 col-md-3 col-sm-3">
				 		<img src="<?php echo base_url() . $image_and_caption->image_path ?>" class="img-responsive">
				 	</div>

			 	<?php endforeach; ?>

		 	</div><!--/row -->
		 </div><!--/container -->
	 </div><!--/cwrap -->

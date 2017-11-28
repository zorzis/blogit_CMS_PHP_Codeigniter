<!-- *****************************************************************************************************************
	 HEADERWRAP
	 ***************************************************************************************************************** -->	
	<div id="headerwrap">
	    <div class="container">
			<div class="row">
			
			
			<?php foreach ($images_and_captions_per_module as $image_and_caption): ?>

				<div class="col-lg-8 col-lg-offset-2">

					<h3> <?php echo $module->title; ?> </h3>
					<h1><?php echo $image_and_caption->image_caption ?></h1>

				</div>

				

					<div class="col-lg-8 col-lg-offset-2 himg">

						<img src="<?php echo base_url() . $image_and_caption->image_path ?>" class="img-responsive" alt="<?php echo $image_and_caption->image_path ?>">
					
					</div>

			<?php endforeach; ?>



			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /headerwrap -->
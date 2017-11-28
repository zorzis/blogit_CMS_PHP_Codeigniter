		<!-- SLIDER BEGIN -->
		<div class="slides col12 color3">
			<div class="slides_container">

				<?php foreach ($images_and_captions_per_module as $image_and_caption): ?>

					<div>
						<img src="<?php echo base_url() . $image_and_caption->image_path ?>" width="1187" height="450" alt="<?php echo $image_and_caption->image_path ?>">
						<h1 class="caption"><?php echo $image_and_caption->image_caption ?></h1>
					</div>

				<?php endforeach; ?>

			</div>
		</div>
		<!-- SLIDER END -->
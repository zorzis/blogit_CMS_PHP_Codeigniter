
	<!--Starts the new selected images from file browser modal window-->
	<?php if (!empty($media_details_from_ajax_post)) { ?>

		<?php foreach($media_details_from_ajax_post as $key => $value) { ?>

			<?php $media_path = $value['value']; ?>


			<?php if(is_file($media_path)) { ?>	

				<div class="thumb-lg">

					<input type="hidden" name="avatar"  id="avatar" value="<?php echo set_value('avatar',$media_path);?>" class="form-control input-sm">

					<img src="<?php echo base_url() . $media_path ?>" class="img-circle">
				</div>

			<?php } ?>

		<?php } ?>



<?php } ?>

	
<!--Ends the new selected images from file browser modal window-->




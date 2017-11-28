<div id="ajax_images">

	<!--Starts the new selected images from file browser modal window-->
	<?php if (!empty($media_details_from_ajax_post)) { ?>

		<?php foreach($media_details_from_ajax_post as $key => $value) { ?>

			<?php $media_path = $value['value']; ?>


			<?php if(is_file($media_path)) { ?>	

			<script>
				function removeElement(ajax_images, childDiv){
					if (childDiv == ajax_images) {
						alert("The parent div cannot be removed.");
					}
					else if (document.getElementById(childDiv)) {     
						var child = document.getElementById(childDiv);
						var parent = document.getElementById(ajax_images);
						parent.removeChild(child);
					}
					else {
						alert("Child div has already been removed or does not exist.");
						return false;
					}
				}
			</script>
	        
	        <div id="<?php echo $media_path ?>">

				<section class="panel clearfix bg-dark lter">
					<div class="panel-body">
						<a href="<?php echo base_url() . $media_path ?>" class="thumb pull-left m-r">

							<img src="<?php echo base_url() . $media_path ?>" >

						</a>
						<div class="clear">

							<input type="hidden" name="slider_image_path[]"  id="slider_image_path" value="<?php echo set_value('slider_image_path', $media_path); ?>" class="form-control input-sm">

							<div class="input-group">
								<input type="text" placeholder="Enter Image Caption" name="image_caption[]"  id="image_caption" value="<?php echo set_value('image_caption');  ?>" class="form-control input-lg">
								<span class="input-group-btn">
									<button type="button" onClick="removeElement('ajax_images', '<?php echo $media_path ?>');" class="btn btn-dark btn-lg" title=""> 
										<i class="fa fa-trash-o text-danger"></i>
									</button>
								</span>
							</div>


						</div>
					</div>
				</section>

			</div>

			<?php } ?>

		<?php } ?>

</div><!--Ends parentDiv -->


<?php } else { ?>

	<div class="col-sm-12 text-center">
		<ul class="list-group">
			<li class="list-group-item">
				<h4>Nope!</h4>
				<div class="progress progress-sm progress-striped active">
					<div class="progress-bar progress-bar-danger" style="width: 100%"></div>
				</div>
				<h1 >No Images Selected Yet</h1>
				<h2>Please Select Some Images</h2>

			</li>
		</ul>
	</div>

<?php } ?>
<!--Ends the new selected images from file browser modal window-->




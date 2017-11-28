<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->
	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3><?php echo $article->title ?></h3>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /blue -->

	 
	<!-- *****************************************************************************************************************
	 BLOG CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">
	 	
	 		<!-- SINGLE POST -->
	 		<div class="col-lg-8">
	 			<!-- Blog Post 1 -->

	 			<?php foreach($articles_media as $media): ?>

					<?php if ($media->article_id == $article->id): ?>

				 		<p>
				 			<img class="img-responsive" src="<?php echo base_url() . $media->image_path ?>" alt="<?php echo $media->image_path ?>" title="<?php echo $media->image_caption ?>" >

				 		</p>

					<?php endif; ?>

				<?php endforeach; ?>

		 		<h3 class="ctitle">

		 			<?php echo $article->title;?>

		 		</h3>

		 		<p><csmall>Posted: <?php echo $article->created ?>.</csmall> | <csmall2>By: <?php echo $article->upro_first_name.' '.$article->upro_last_name; ?></csmall2> | <csmall> Category: <?php echo $article->category_title ?> </csmall></p>

		 		<p>
		 			
		 			<?php echo $article->body;?>

		 		</p>

		 		<div class="spacing"></div>
		 		
		 		
			</div><!--/col-lg-8 -->
	 		
	 		
	 		<!-- SIDEBAR -->
	 		<div class="col-lg-4">
	 		
<?php echo $this->load->get_section('right_sidebar'); ?>
		 		
	 		</div>
	 	</div><!--/row -->
	 </div><!--/container -->
<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->

<?php echo $this->load->get_section('after_header_2_blue_wrap'); ?>

	<!-- *****************************************************************************************************************
	 BLOG CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">
	 	
	 		<!-- BLOG POSTS LIST -->
	 		<div class="col-lg-8">

				<?php foreach ($articles as $article): ?>

					<?php foreach($articles_media as $media): ?>


						<?php if ($media->article_id == $article->id): ?>

							<a href="<?php echo site_url(); ?><?php echo $page->slug; ?>/<?php echo $article->category_slug ?>/article/<?php echo $article->id; ?>/<?php echo $article->slug; ?>">

								<p><img class="img-responsive" src="<?php echo base_url() . $media->image_path ?>"></p>

							</a>

						<?php endif; ?>

					<?php endforeach; ?>							
		 		
						<a href="<?php echo site_url(); ?><?php echo $page->slug; ?>/<?php echo $article->category_slug ?>/article/<?php echo $article->id; ?>/<?php echo $article->slug; ?>">
					 		
					 		<h3 class="ctitle">

								<?php echo $article->title;?>

					 		</h3>
				 		</a>
				 		<p>
				 			<csmall>

				 				Posted: <?php echo $article->created ?>

				 			</csmall>

				 			<csmall2>

				 				| By: <?php echo $article->upro_first_name.' '.$article->upro_last_name; ?>

				 			</csmall2>

				 			<csmall>

				 				| Category: <?php echo $article->category_title ?>
				 			
				 			</csmall> 

				 		</p>
						
						<p>	
							<?php 

								$string = word_limiter($article->body, 70);
								echo $string;

							?>

						</p>

				 		<p>
							<a href="<?php echo site_url(); ?><?php echo $page->slug; ?>/<?php echo $article->category_slug ?>/article/<?php echo $article->id; ?>/<?php echo $article->slug; ?>">
				 				[Read More]
				 			</a>
				 		</p>
				 		<div class="hline"></div>
				 		
				 		<div class="spacing"></div>

			<?php endforeach; ?>							

		 		
	 			
		 		
			</div><!--/col-lg-8 -->
	 		
	 		
	 		<!-- SIDEBAR -->
	 		<div class="col-lg-4">

<?php echo $this->load->get_section('right_sidebar'); ?>
		 		
		 		
	 		</div>
	 	</div><!--/row -->
	 </div><!--/container -->

		<section class="onerow full color3 tagline">
			<div class="onepcssgrid-1200">

				<?php echo $this->load->get_section('after_header_tagline_1'); ?>
				
				<div class="arrow"></div>
			</div>
		</section>

		<section class="onerow full color1">
			<div class="onepcssgrid-1200">	

				<div class="col8">

					<?php foreach ($articles as $article): ?>
						
						<div class="slides">
	                        <div class="slides_container">

								<?php foreach($articles_media as $media): ?>

									<?php if ($media->article_id == $article->id): ?>


		                        			<div>
												<a href="<?php echo site_url(); ?><?php echo $page->slug; ?>/<?php echo $article->category_slug ?>/article/<?php echo $article->id; ?>/<?php echo $article->slug; ?>">
															
													<img src="<?php echo base_url() . $media->image_path ?>" width="780" alt="<?php echo $media->image_path ?>" title="<?php echo $media->image_caption ?>" >
		                                    		<h3 class="caption"><?php echo $media->image_caption ?></h3>

												</a>
											</div>

											
									<?php endif; ?>

								<?php endforeach; ?>

							</div>
						</div>

						
						<br>

						<div class="iconic icon-tags">

							<h2 class="ic">
								<a href="<?php echo site_url(); ?><?php echo $page->slug; ?>/<?php echo $article->category_slug ?>/article/<?php echo $article->id; ?>/<?php echo $article->slug; ?>">

									<?php echo $article->title;?>

								</a>
							</h2>

							<p>

								<?php 

									$string = word_limiter($article->body, 70);
									echo $string;

								?>

							</p>

							<div class="clearfix">
								<ul class="tags icon-time left">
									<li><h3>Published at: <?php echo $article->created ?> </h3></li>
									<li><h3> - Author: <?php echo $article->upro_first_name.' '.$article->upro_last_name; ?></h3></li>
									<li><h3> - Category: <?php echo $article->category_title ?></h3></li>
								</ul>
							</div>
						</div><!-- end of iconic class -->
						<div class="divider"></div>

					<?php endforeach; ?>

					<div class="pagination">

						<?php echo $this->pagination->create_links(); ?>

					</div> <!-- pagination links -->

				</div> <!--end of col8-->

				<div class="col4 last">

					<?php echo $this->load->get_section('right_column'); ?>

				</div> <!-- end col4-->

				<div class="arrow"></div>

			</div>
			
		</section>

		<section class="onerow full color2 tagline">
			<div class="onepcssgrid-1200">

				<?php echo $this->load->get_section('pre_footer_tagline'); ?>

			</div>
		</section>

		<section class="onerow full color3">
			<div class="onepcssgrid-1200">

				<?php echo $this->load->get_section('pre_footer'); ?>


				<div class="arrow"></div>
			</div>
		</section>


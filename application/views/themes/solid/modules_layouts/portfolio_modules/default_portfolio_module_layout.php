<!-- *****************************************************************************************************************
	 PORTFOLIO SECTION
	 ***************************************************************************************************************** -->
	 <div id="portfoliowrap">
		<h3>

		<?php echo $module->title;?>

		</h3>

        <div class="portfolio-centered">
            <div class="recentitems portfolio">
            <?php foreach ($projects as $project): ?>

				<div class="portfolio-item graphic-design">
					<div class="he-wrap tpl6">

						<?php foreach($projects_media as $media): ?>

							<?php if ($media->project_id == $project->id): ?>

								<img src="<?php echo base_url() . $media->image_path ?>" alt="<?php echo $media->image_path ?>" title="<?php echo $media->image_caption ?>">

								<div class="he-view">
									<div class="bg a0" data-animate="fadeIn">
		                                <h3 class="a1" data-animate="fadeInDown"><?php echo $project->project_title ?></h3>
		                                <a data-rel="prettyPhoto" href="<?php echo base_url() . $media->image_path ?>" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
		                                <a href="<?php echo site_url(); ?><?php echo $portfolio_page_slug; ?>/<?php echo $project->category_slug ?>/project/<?php echo $project->id; ?>/<?php echo $project->project_slug; ?>" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-link"></i></a>
		                        	</div><!-- he bg -->
								</div><!-- he view -->	

							<?php endif; ?>

						<?php endforeach; ?>	

					</div><!-- he wrap -->
				</div><!-- end col-12 -->

			<?php endforeach; ?>	

                           
                    
            </div><!-- portfolio -->
        </div><!-- portfolio container -->
	 </div><!--/Portfoliowrap -->

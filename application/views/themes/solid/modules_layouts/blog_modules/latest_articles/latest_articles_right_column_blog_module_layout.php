			<h4><?php echo $module->title ?></h4>
		 		<div class="hline"></div>
					<ul class="popular-posts">

					<?php foreach ($latest_articles_per_module as $latest_article): ?>

		                <li>

		                <?php foreach ($latest_articles_media as $media): ?>

		                	<?php if ($media->article_id == $latest_article->id): ?>

								<a href="<?php echo site_url(); ?><?php echo $blog_page_slug ?>/<?php echo $latest_article->category_slug ?>/article/<?php echo $latest_article->id ?>/<?php echo $latest_article->slug ?>" title=""> 
			                    	<img width="90px" src="<?php echo base_url() . $media->image_path ?>" alt="<?php echo $media->image_caption ?>">
			                    </a>

							<?php endif; ?>

		            	<?php endforeach; ?>

		                    <p>
								<a href="<?php echo site_url(); ?><?php echo $blog_page_slug ?>/<?php echo $latest_article->category_slug ?>/article/<?php echo $latest_article->id ?>/<?php echo $latest_article->slug ?>" title=""> 
		                    		<?php echo $latest_article->title ?>
		                    	</a>
		                    </p>

		                    <em><?php echo $latest_article->created ?></em>

		                </li>

		            <?php endforeach; ?>

		            </ul>
		            
		 		<div class="spacing"></div>
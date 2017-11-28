<div class="iconic icon-time">
	<h1 class="ic"><?php echo $module->title;?></h1>
	<nav>
		<ul class="categories">

			<?php foreach ($latest_articles_per_module as $latest_article): ?>

			<p class="title"><a href="<?php echo site_url(); ?><?php echo $page->slug ?>/<?php echo $latest_article->category_slug ?>/article/<?php echo $latest_article->id ?>/<?php echo $latest_article->slug ?>" title=""> <?php echo $latest_article->title ?></a></p>

			<?php endforeach; ?>

		</ul>
	</nav>
</div>

<div class="divider"></div>
<div class="iconic icon-time">
	<h1 class="ic"><?php echo $module->title;?></h1>
	<nav>
		<ul class="categories">

			<?php foreach ($popular_articles_per_module as $popular_article): ?>

			<p class="title"><a href="<?php echo site_url(); ?><?php echo $page->slug ?>/<?php echo $popular_article->category_slug ?>/article/<?php echo $popular_article->id ?>/<?php echo $popular_article->slug ?>" title=""> <?php echo $popular_article->title ?></a></p>

			<?php endforeach; ?>

		</ul>
	</nav>
</div>

<div class="divider"></div>
	<ul class="nav navbar-nav">

		<?php if (!empty($menu_items)) : ?>

		
			<?php foreach ($menu_items as $menu_item) :?>

				<?php if($menu_item->page_type == 3) :?>

					<li><a class="external_urls" title="<?php echo $menu_item->title;?>" href="<?php echo $menu_item->external_url;?>" target="_blank"><?php echo $menu_item->title;?></a> </li>
				
				<?php else :?>	

					<li><a href="<?php echo base_url();?><?php echo $menu_item->slug?>"><?php echo $menu_item->title;?></a></li>
					

				<?php endif ?>



			<?php endforeach ?>

		<?php endif ?>

					</ul>
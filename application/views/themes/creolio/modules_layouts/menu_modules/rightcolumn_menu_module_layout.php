<div class="iconic icon-time">
	<h1 class="ic"><?php echo $module->title;?></h1>
	<nav>
		<ul id="mainnav">

			<?php if (!empty($menu_items)) { ?>

				<?php foreach ($menu_items as $menu_item) {?>

					<?php if($menu_item->page_type == 3) {?>

						<li><a class="external_urls" title="<?php echo $menu_item->title;?>" href="<?php echo $menu_item->external_url;?>" target="_blank"><?php echo $menu_item->title;?></a> </li>
					
					<?php } else {?>	


						<?php if(empty($this->uri->segment(1)) && $menu_item->is_home == 1 ) {?>
								
							<li><a class="active" href="<?php echo base_url();?>"><?php echo $menu_item->title;?></a></li>

						<?php } elseif ($this->uri->segment(1) == $menu_item->slug) {?>

								
							<li><a class="active" href="<?php echo base_url();?>"><?php echo $menu_item->title;?></a></li>
							

						<?php } else {?>

							<li><a href="<?php echo base_url();?><?php echo $menu_item->slug?>"><?php echo $menu_item->title;?></a></li>
						
						<?php } ?>

					<?php } ?>



				<?php } ?>

			<?php } ?>
		
		</ul>
	</nav><br><br>

</div>
<div class="divider"></div>
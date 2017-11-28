          <section class="vbox">

          	<header class="header bg-white b-b b-light">
              <p><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('modules');?></p>
              <div class="btn-group pull-right">
				<a href="<?php echo base_url(); ?>admin/modules/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('modules');?></a>
              	<a href="<?php echo base_url(); ?>admin/modules/trashed_modules/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_modules');?></a>
              
                <div class="btn-group">
                	<button class="btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> New Module?</button>
		            <button class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-2x"></i></button>
              			<ul class="dropdown-menu">
		                	<li><a href="<?php echo base_url(); ?>admin/modules/create_custom_module">Custom HTML Module</a></li>
		                    <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/modules/create_menu_module">Menu Module</a></li>
		   		            <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/modules/create_latest_articles_module">Latest Articles Module</a></li>
		                    <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/modules/create_popular_articles_module">Popular Articles Module</a></li>
		                    <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/modules/create_images_slider_module">Image Slider Module</a></li>
		                    <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/modules/create_portfolio_module">Portfolio Module</a></li>
		                 </ul>
              	</div>

              </div>
            </header>

            <section class="scrollable wrapper">

              <!-- Codeigniter Flash Messages Area -->
              
              <?php if (! empty($message)) { ?>

                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">Close ×</button>
                    <i class="fa fa-info-sign"></i>
                    <strong>
                    <?php echo $message; ?>
                  </strong>
                </div>

              <?php } ?>

              <!-- Codeigniter Flash Messages Area -->

              <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_modules');?></h3>
              </div>
				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <?php echo $this->lang->line('modules');?>
				                </header>
				                <div class="row wrapper">
				                 <!-- Filter form -->

				                  <div class="col-sm-5 m-b-xs">

				                  </div>
				                  <!--End filter form -->

				                  <div class="col-sm-4 m-b-xs">

				                  </div>

				                  <div class="col-sm-3">
               
				                  </div>

				                </div>

				                 <?php echo form_open(current_url());?>

				                <div class="table-responsive">
				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
										<th width="20"><input type="checkbox"></th>
										<th width="20">ID</th>
				                        <th><?php echo $this->lang->line('module_title');?></th>
				                        <th><?php echo $this->lang->line('module_type');?></th>
				                        <th><?php echo $this->lang->line('template_position');?></th>
				                        <th><?php echo $this->lang->line('module_status');?></th>
				                        <th><?php echo $this->lang->line('module_created_date');?></th>
				                        <th><?php echo $this->lang->line('module_updated_date');?></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($modules)) { ?>

				                    <tbody>

				                    	<?php foreach ($modules as $module) { ?>

										<tr>

											<td><input type="checkbox" name="" value=""></td>

											<td>

												<?php  if($module->module_type == 'custom_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_custom_module/<?php echo $module->id ?>"><?php echo $module->id ?></a>

												<?php } ?>
												

												<?php if($module->module_type == 'menu_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_menu_module/<?php echo $module->id ?>"><?php echo $module->id ?></a>

												<?php } ?>

												<?php if($module->module_type == 'latest_blog_articles_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_latest_articles_module/<?php echo $module->id ?>"><?php echo $module->id ?></a>

												<?php } ?>

												<?php if($module->module_type == 'popular_blog_articles_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_popular_articles_module/<?php echo $module->id ?>"><?php echo $module->id ?></a>

												<?php } ?> 

												<?php if($module->module_type == 'image_slider_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_image_slider_module/<?php echo $module->id ?>"><?php echo $module->id ?></a>

												<?php } ?> 

												<?php if($module->module_type == 'portfolio_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_portfolio_module/<?php echo $module->id ?>"><?php echo $module->id ?></a>

												<?php } ?> 

											</td>

											<td>
												
												<?php  if($module->module_type == 'custom_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_custom_module/<?php echo $module->id ?>"><?php echo $module->title ?></a>

												<?php } ?>
												

												<?php if($module->module_type == 'menu_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_menu_module/<?php echo $module->id ?>"><?php echo $module->title ?></a>

												<?php } ?>

												<?php if($module->module_type == 'latest_blog_articles_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_latest_articles_module/<?php echo $module->id ?>"><?php echo $module->title ?></a>

												<?php } ?>

												<?php if($module->module_type == 'popular_blog_articles_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_popular_articles_module/<?php echo $module->id ?>"><?php echo $module->title ?></a>

												<?php } ?> 

												<?php if($module->module_type == 'image_slider_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_image_slider_module/<?php echo $module->id ?>"><?php echo $module->title ?></a>

												<?php } ?>


												<?php if($module->module_type == 'portfolio_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_portfolio_module/<?php echo $module->id ?>"><?php echo $module->title ?></a>

												<?php } ?> 

											</td>

											<td>

												<?php if($module->module_type == 'custom_module') { ?>

												<span class="label bg-warning"><i class="fa fa-code"></i> Custom </span>

												<?php }?>	

												<?php if($module->module_type == 'menu_module') { ?>

													<span class="label bg-primary"><i class="fa fa-list"></i> Menu </span>

												<?php }?>

												<?php if($module->module_type == 'latest_blog_articles_module') { ?>

												<span class="label bg-dark"><i class="fa fa-coffee"></i> Latest Articles </span>

												<?php }?>

												<?php if($module->module_type == 'popular_blog_articles_module') { ?>

												<span class="label bg-dark"><i class="fa fa-coffee"></i> Popular Articles </span>

												<?php }?>

												<?php if($module->module_type == 'image_slider_module') { ?>

												<span class="label bg-danger"><i class="fa fa-code"></i> Image Slider </span>

												<?php }?> 

												<?php if($module->module_type == 'portfolio_module') { ?>

													<span class="label bg-info"><i class="fa fa-briefcase"></i> Portfolio </span>

												<?php }?> 

											</td>

											<td>

                          						<span> <?php echo $module->position ;?> </span>

											</td>

											<td>

												<span class="label <?php echo ($module->is_published == 1) ? "bg-success" : "bg-danger";?>"> <?php echo ($module->is_published == 1) ? "Published" : "Unpublished";?> </span>
											
											</td>

											<td>

												<?php echo $module->created; ?>

											</td>

											<td>

												<?php echo $module->modified; ?>

											</td>
											
											<td>

												<?php  if($module->module_type == 'custom_module') { ?>

												<a href="<?php echo base_url(); ?>admin/modules/edit_custom_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>

												<?php } ?>


												<?php if($module->module_type == 'menu_module') { ?>

												<a href="<?php echo base_url(); ?>admin/modules/edit_menu_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>

												<?php } ?>

												<?php if($module->module_type == 'latest_blog_articles_module') { ?>

												<a href="<?php echo base_url(); ?>admin/modules/edit_latest_articles_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>

												<?php } ?>

												<?php if($module->module_type == 'popular_blog_articles_module') { ?>

												<a href="<?php echo base_url(); ?>admin/modules/edit_popular_articles_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>

												<?php } ?>  

												<?php if($module->module_type == 'image_slider_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_image_slider_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>

												<?php } ?>  

												<?php if($module->module_type == 'portfolio_module') { ?>
												
												<a href="<?php echo base_url(); ?>admin/modules/edit_portfolio_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>

												<?php } ?>                       							

											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/modules/publish_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-circle text-success"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/modules/unpublish_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Unpublish"><i class="fa fa-circle text-danger"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/modules/delete_module/<?php echo $module->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fa fa-trash-o text-warning"></i></a>
											</td>

										</tr>

									   	<?php } ?>	

				                    </tbody>

				                    <?php } else { ?>

										<tbody>
											<tr>
												<td colspan="12" class="msgboard">
													<div class="col-sm-4">
													</div>
													<div class="col-sm-4">
														<ul class="list-group">
    														<li class="list-group-item">
    															<h4>Nope!</h4>
																<div class="progress progress-sm progress-striped active">
		    														<div class="progress-bar progress-bar-danger" style="width: 100%"></div>
																</div>
																<h1><?php echo $this->lang->line('no_modules_found');?></h1>
															</li>
														</ul>
													</div>
													<div class="col-sm-4">
													</div>
												</td>
											</tr>
										</tbody>

									<?php } ?>

				                  </table>
				                </div>

				                <footer class="panel-footer">
				                  <div class="row">

				                  	

				                    <div class="col-sm-4 text-left">
				                      <span> <h4><?php echo $this->lang->line('total_modules');?><span class="badge bg-dark"><?php echo $total_modules; ?></span> </h4></span>
				                    </div>

				                    <div class="col-sm-4 text-center-xs">                
				                      <ul class="pagination pagination-sm m-t-none m-b-none">

										<?php echo $this->pagination->create_links(); ?>				                        
				                      
				                      </ul>
				                    </div>

				                    <div class="col-sm-4">
				                    </div>

				                    

				                  </div>
				                </footer>



				                <?php echo form_close();?>

				            </section>
				        </section>
				    </section>



          <section class="vbox">

          	<header class="header bg-white b-b b-light">
              <p><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('templates');?></p>
              <div class="btn-group pull-right">
				<a href="<?php echo base_url(); ?>admin/templates/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('templates');?></a>
              	<a href="<?php echo base_url(); ?>admin/templates/trashed_templates/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_templates');?></a>
                <a href="<?php echo base_url(); ?>admin/templates/create_template/" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('create_template');?></a>                
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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_templates');?></h3>
              </div>
				<section class="panel panel-default">
				                <header class="panel-heading">
				                   <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('templates');?> </i>
				                </header>

				                 <?php echo form_open(current_url());?>

				                <div class="table-responsive">
				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
										<th width="20"><input type="checkbox"></th>
										<th width="20">ID</th>
				                        <th><?php echo $this->lang->line('template_title');?></th>
				                        <th><?php echo $this->lang->line('template_is_default');?></th>
				                        <th><?php echo $this->lang->line('template_exists');?></th>
				                        <th><?php echo $this->lang->line('template_status');?></th>
				                        <th><?php echo $this->lang->line('template_created_date');?></th>
				                        <th><?php echo $this->lang->line('template_updated_date');?></th>
				         				<th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($templates)) { ?>

				                    <tbody>

				                    	<?php foreach ($templates as $template) { ?>

										<tr>

											<td><input type="checkbox" name="" value=""></td>

											<td>
												<a href="<?php echo base_url(); ?>admin/templates/update_template/<?php echo $template->id ?>">
													
													<?php echo $template->id ?>

												</a>
											</td>

											<td>
												<a href="<?php echo base_url(); ?>admin/templates/update_template/<?php echo $template->id ?>">
													
													<?php echo $template->title ?>

												</a>
											</td>

											<td>
												<span class="label bg-dark"> <i class="fa fa-tint <?php echo ($template->default == 1) ? "text-success" : "text-danger";?>"> <?php echo ($template->default == 1) ? "Default Template" : "Nope";?></i></span>

											</td>

											<td>

									            <?php 
									            	$template_path = APPPATH .'views/themes/';
									            
									            	$template_folder = $template->title; 
												?>

									            <?php if (file_exists($template_path . $template_folder) AND 
									            	file_exists($template_path . $template_folder . '/main.php') AND
									            	file_exists($template_path . $template_folder . '/templates/frontend_blog_content.php') AND
									            	file_exists($template_path . $template_folder . '/templates/frontend_custom_content.php') AND
									            	file_exists($template_path . $template_folder . '/templates/frontend_single_article.php')
									            	)
									            {?>

									            	<span 
									            		class="label bg-success" 
									            		data-toggle="tooltip" 
									            		data-placement="top" 
									            		title="Template files are setup correctly inside theme folder!"
									            	>
									            		<i class="fa fa-check-circle-o"> 
									            			All setup correctly 
									            		</i>

									            	</span>

									            	<?php } else {?>

									            	<span 
									            		class="label bg-danger" 
									            		data-toggle="tooltip" 
									            		data-placement="top" 
									            		title="Check that all necessary files are located in your template folder with the right structure"
									            	>
									            		<i class="fa fa-flash"> 
									            			No 
									            		</i>
									            	<span>

									    		<?php } ?>	

											</td>

											<td>

												<span class="label <?php echo ($template->is_published == 1) ? "bg-success" : "bg-danger";?>"> <?php echo ($template->is_published == 1) ? "Published" : "Unpublished";?> </span>
											
											</td>

											<td>

												<?php echo $template->created; ?>

											</td>

											<td>

												<?php echo $template->modified; ?>

											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/templates/set_default_template/<?php echo $template->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Set Default Template"><i class="fa fa-tint text-success"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/templates/update_template/<?php echo $template->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/templates/delete_template/<?php echo $template->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fa fa-trash-o text-warning"></i></a>
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
																<h1><?php echo $this->lang->line('no_templates_found');?></h1>
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
				                      <span> <h4><?php echo $this->lang->line('total_templates');?> <span class="badge bg-dark"><?php echo $total_templates; ?></span> </h4></span>
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



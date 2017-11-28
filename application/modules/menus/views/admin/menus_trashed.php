          <section class="vbox">

          	<header class="header bg-white b-b b-light">
              <p><i class="fa fa-list-alt"></i> <?php echo $this->lang->line('menus');?></p>
              <div class="btn-group pull-right">
				<a href="<?php echo base_url(); ?>admin/menus/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('menus');?></a>
              	<a href="<?php echo base_url(); ?>admin/menus/trashed_menus/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_menus');?></a>
                <a href="<?php echo base_url(); ?>admin/menus/create_menu" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('create_menu');?></a>                
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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_trashed_menus');?></h3>
              </div>
				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('menus');?></i>
				                </header>
				                
				                 <?php echo form_open(current_url());?>

				                <div class="table-responsive">
				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
										<th width="20"><input type="checkbox"></th>
										<th width="20">ID</th>
				                        <th><?php echo $this->lang->line('menu_title');?></th>
				                        <th><?php echo $this->lang->line('is_global');?></th>
				                        <th><?php echo $this->lang->line('menu_status');?></th>
				                        <th><?php echo $this->lang->line('menu_created_date');?></th>
				                        <th><?php echo $this->lang->line('menu_updated_date');?></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($menus)) { ?>

				                    <tbody>

				                    	<?php foreach ($menus as $menu) { ?>

										<tr>

											<td><input type="checkbox" name="" value=""></td>

											<td>
												<a href="<?php echo base_url(); ?>admin/menus/edit_menu/<?php echo $menu->id ?>">
													
													<?php echo $menu->id ?>

												</a>
											</td>

											<td>
												<a href="<?php echo base_url(); ?>admin/menus/edit_menu/<?php echo $menu->id ?>">
													
													<?php echo $menu->title ?>

												</a>
											</td>

											<td>

												<span> <?php echo ($menu->is_global == 1) ? "Yes" : "No";?> </span>

											</td>

											<td>
												<span class="label <?php echo ($menu->deleted == 1) ? "bg-dark" : "";?>"> <?php echo ($menu->deleted == 1) ? "Trashed" : "";?> </span>
											
											</td>

											<td>

												<?php echo $menu->created; ?>

											</td>

											<td>

												<?php echo $menu->modified; ?>

											</td>
											
											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/menus/edit_menu/<?php echo $menu->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/menus/publish_menu/<?php echo $menu->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-circle text-success"></i></a>
											</td>

											<td>
				                        		<a onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" href="<?php echo base_url(); ?>admin/menus/delete_trashed_menu/<?php echo $menu->id ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
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
																<h1><?php echo $this->lang->line('no_menus_found');?></h1>
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
				                      <span> <h4><?php echo $this->lang->line('total_menus');?><span class="badge bg-dark"><?php echo $total_menus; ?></span> </h4></span>
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



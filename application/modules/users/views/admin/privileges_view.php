          <section class="vbox">
            
            <?php echo $this->load->get_section('users_menu_header'); ?>

            <section class="scrollable wrapper">

              <!-- Codeigniter Flash Messages Area -->

              <?php if (! empty($message)) { ?>

                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-info-sign"></i>
                    <strong>
                    <?php echo $message; ?>
                  </strong>
                </div>

              <?php } ?>

              <!-- Codeigniter Flash Messages Area -->
              
              <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_privileges');?></h3>
              </div>

				<?php echo form_open(current_url());?>


				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <?php echo $this->lang->line('privileges');?>
				                </header>
				                <div class="row wrapper">
				               
				                  <div class="col-sm-5 m-b-xs">
				                    
				                  </div>

				                  <div class="col-sm-4 m-b-xs">
									<a href="<?php echo base_url(); ?>admin/users/insert_privilege" class="btn btn-bg btn-success"><i class="fa fa-key"></i> <?php echo $this->lang->line('create_privilege');?></a>
				                  </div>

				                  <div class="col-sm-3">

									<?php $disable = (! $this->flexi_auth->is_privileged('Delete Privileges')) ? 'disabled' : NULL;?>
										
									<button onclick="return confirm('You are about to delete multiple records. This cannot be undone. Are you sure?');" type="submit" class="btn btn-sm btn-danger <?php echo $disable; ?>" name="delete_privilege" value="delete_privilege"> Delete Selected Privileges</button>
                             
				                  </div>

				                </div>

				                <div class="table-responsive">


				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
				                        <th width="20"><input type="checkbox"></th>
				                        <th>#ID</th>
				                        <th><?php echo $this->lang->line('privilege_name');?></th>
				                        <th><?php echo $this->lang->line('privilege_description');?></th>
				                        <th>Privilege Usage</th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($privileges)) { ?>

				                    <tbody>

				                    	<?php foreach ($privileges as $privilege) { ?>

										<tr>
											<td>

												<input type="checkbox" name="selected_privileges[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>]" value="">

											</td>


											<td>
												<a href="<?php echo base_url(); ?>admin/users/update_privilege/<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>">
													
													<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>
												
												</a>
											</td>

											<td>
												<a href="<?php echo base_url(); ?>admin/users/update_privilege/<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>">
													
													<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'name')];?>
												
												</a>
											</td>


											<td>

												<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'description')];?>

											</td>

											<td>
											<?php if ($privilege[$this->flexi_auth->db_column('user_privileges', 'is_frontend_priv')] == 0 ) :?>
												
												<span class="label bg-warning">Core Privilege</span>

											<?php else :?>

												<span class="label bg-info">Frontend Privilege</span>

											<?php endif;?>

											</td>
											
											
											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/users/update_privilege/<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Update Privilege"><i class="fa fa-eye"></i></a>
											</td>
											<td>
												<button onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" type="submit" name="delete_privilege_one_by_one" value="<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Privilege"><i class="fa fa-trash-o"></i></button>
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
																<h1><?php echo $this->lang->line('no_privileges_found');?></h1>
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
				               
				                </footer>
				            </section>

				            <?php echo form_close();?>

				        </section>
				    </section>



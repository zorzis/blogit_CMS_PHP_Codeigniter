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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_users_groups');?></h3>
              </div>

				<?php echo form_open(current_url());?>


				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <?php echo $this->lang->line('usergroups');?>
				                </header>
				                <div class="row wrapper">
				               
				                  <div class="col-sm-5 m-b-xs">
				                    
				                  </div>

				                  <div class="col-sm-4 m-b-xs">

				                  </div>

				                  <div class="col-sm-3 pull-left">

					                <?php $disable = (! $this->flexi_auth->is_privileged('Delete User Groups')) ? 'disabled' : NULL;?>
										
									<button onclick="return confirm('You are about to delete multiple records. This cannot be undone. Are you sure?');" type="submit" class="btn btn-sm btn-danger <?php echo $disable; ?>" name="delete_group" value="delete_group"> Delete Selected Usergroups</button>
              
				                  </div>

				                </div>

				                <div class="table-responsive">

				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
				                        <th><input type="checkbox"></th>
				                        <th>#ID</th>
				                        <th><?php echo $this->lang->line('group_name');?></th>
				                        <th><?php echo $this->lang->line('group_description');?></th>
				                        <th><?php echo $this->lang->line('is_admin_group');?></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($user_groups)) { ?>

				                    <tbody>

				                    	<?php foreach ($user_groups as $group) { ?>

										<tr>
											<td>

												<input type="checkbox" name="selected_groups[<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>]" value="">

											</td>

											<td>
												<a href="<?php echo base_url(); ?>admin/users/update_user_group/<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>">
													
													<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>
												
												</a>
											</td>

											<td>
												<a href="<?php echo base_url(); ?>admin/users/update_user_group/<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>">
													
													<span class="label bg-dark">
													
														<?php echo $group[$this->flexi_auth->db_column('user_group', 'name')];?>
												
													</span>

												</a>
											</td>

											<td>

												<?php echo $group[$this->flexi_auth->db_column('user_group', 'description')];?>

											</td>
											
											<td>

												<?php if($group[$this->flexi_auth->db_column('user_group', 'admin')] == 1) { ?>

												<span class="label bg-success" data-toggle="tooltip" data-placement="top" title="Usergroup assigned users can loggin to backend(administration area)."><i class="fa fa-check-circle-o"></i> Admin</span>

												<?php } elseif($group[$this->flexi_auth->db_column('user_group', 'admin')] == 0) { ?>

												<span class="label bg-warning" data-toggle="tooltip" data-placement="top" title="Usergroup assigned users cannot loggin to backend(administration area)."><i class="fa fa-times-circle"></i> Not Admin</span>

												<?php } ?>
										
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/users/update_user_group/<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Update Usergroup"> <i class="fa fa-users"></i></a>
											</td>
											<td>
												<a type="text" href="<?php echo base_url(); ?>admin/users/update_group_privileges/<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Manage Usergroup Privileges"> <i class="fa fa-key"></i></a>
											</td>
											<td>
												<button onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" type="submit" name="delete_user_group" value="<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Usergroup"><i class="fa fa-trash-o"></i></button>
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
																<h1><?php echo $this->lang->line('no_users_groups_found');?></h1>
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
					                    </div>

					                    <div class="col-sm-4 text-center-xs">   
					                    </div>

					                    <div class="col-sm-4 pull-left">

					                    </div>

				                    </div>
				                </footer>


				            </section>

				        <?php echo form_close();?>

				        </section>
				    </section>



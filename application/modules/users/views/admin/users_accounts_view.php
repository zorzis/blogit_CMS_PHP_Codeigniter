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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_users_accounts');?></h3>
              </div>

				<?php echo form_open(current_url());?>


				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <?php echo $this->lang->line('users_accounts');?>
				                </header>
				                <div class="row wrapper">
				                 <!-- Filter form -->

				                  <div class="col-sm-4 m-b-xs">
				                    <div class="input-group">

				                    <?php echo form_open(current_url());	?>

				                      <input name="search_query" id="text" type="text" value="<?php echo set_value('search_users',$search_query);?>" class="input-bg form-control" placeholder="<?php echo $this->lang->line('filter');?>:">
				                      <span class="input-group-btn">
				                        <button type="submit" name="search_users" value="Search" class="btn btn-bg btn-primary"><?php echo $this->lang->line('filter_search_button');?></button>
				                        <a href="<?php echo base_url(); ?>admin/users"><button class="btn btn-bg btn-warning" type="button"><?php echo $this->lang->line('filter_reset_button');?></button></a>
				                      </span>

				                      <?php echo form_close();?>

				                    </div>
				                  </div>
				                  <!--End filter form -->

				                  <div class="col-sm-4 m-b-xs">

				                  </div>

				                  <div class="col-sm-4 m-b-xs">

										<select name="function_type" id="function_type" class="input-sm form-control input-s-sm inline v-middle">
					                      <option value="select_action">Select Action</option>
					                      <option name="delete" value="delete">Delete Selected Accounts</option>
					                      <option name="block" value="block">Block Selected Accounts</option>
					                      <option name="unblock" value="unblock">Unblock Selected Accounts</option>
					                    </select>

					                    <?php $disable = (! $this->flexi_auth->is_privileged('Suspend Users') && ! $this->flexi_auth->is_privileged('Delete Users')) ? 'disabled' : NULL;?>
										
										<button onclick="return confirm('You are about to delete multiple records. This cannot be undone. Are you sure?');" id="delete_multiple_users_button" type="submit" class="btn btn-sm btn-danger <?php echo $disable; ?>" name="delete_multiple_users_accounts" value="Delete Users"> Delete Users Accounts</button>
                						<button id="block_multiple_users_button" type="submit" class="btn btn-sm btn-warning <?php echo $disable; ?>" name="block_multiple_users_accounts" value="Block Users"> Block Users Accounts</button>
                						<button id="unblock_multiple_users_button" type="submit" class="btn btn-sm btn-success <?php echo $disable; ?>" name="unblock_multiple_users_accounts" value="Unblock Users"> Unblock Users Accounts</button>
                						<button id="no_action" class="btn btn-sm btn-dark disabled ?>" name="no_action" value="Choose Action"> Suspend / Delete</button>

				                    </div>

									<script>
										$(function() {
											$('#block_multiple_users_button').hide(); 
											$('#unblock_multiple_users_button').hide(); 
										    $('#delete_multiple_users_button').hide();
										    $('#no_action').show(); 


										    $('#function_type').change(function(){
										        if($('#function_type').val() == 'delete') {
										            $('#delete_multiple_users_button').show(); 
										            $('#block_multiple_users_button').hide();
										            $('#unblock_multiple_users_button').hide(); 
										            $('#no_action').hide(); 
 
										        }
										        else if($('#function_type').val() == 'block') {
										            $('#delete_multiple_users_button').hide(); 
										            $('#block_multiple_users_button').show();
										            $('#unblock_multiple_users_button').hide(); 
										            $('#no_action').hide(); 

										        }
										        else if($('#function_type').val() == 'unblock') {
										            $('#delete_multiple_users_button').hide(); 
										            $('#block_multiple_users_button').hide();
										            $('#unblock_multiple_users_button').show(); 
										            $('#no_action').hide(); 

										        }
										        else {
										            $('#delete_multiple_users_button').hide(); 
										            $('#suspend_multiple_users_button').hide();
										            $('#unblock_multiple_users_button').hide(); 
										            $('#no_action').show(); 
										        } 
										    });
										});
									</script>


				                </div>


				                <div class="table-responsive">
				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
				                      	<th><input type="checkbox"></th>
				                        <th>#ID</th>
				                        <th>Name</th>
				                        <th><?php echo $this->lang->line('user_email');?></th>
				                        <th><?php echo $this->lang->line('user_group');?></th>
				                        <th>Status</th>
				                        <th>Date Created</th>
				                        <th>Last Login</th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($users)) { ?>

				                    <tbody>

				                    	<?php foreach ($users as $user) { ?>

										<tr>
											<td>

												<input type="checkbox" name="selected_users_accounts[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>]" >

											</td>

											<td>

												<a href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>">

													<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>
											
												</a>

											</td>

											<td>

												<a href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>">

													<?php echo $user['upro_first_name'] .' '. $user['upro_last_name'];?>

												</a>

											</td>

											<td>

											<span class="label bg-warning">

												<a href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>">
													
													<?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')];?>

												</a>

											</span>

											</td>

											<td>
												<span class="label bg-dark">
													<a href="<?php echo base_url(); ?>admin/users/update_user_group/<?php echo $user[$this->flexi_auth->db_column('user_group', 'id')];?>">
														<?php echo $user[$this->flexi_auth->db_column('user_group', 'name')];?>
													</a>
												</span>
											</td>

											<td>

												<?php if($user[$this->flexi_auth->db_column('user_acc', 'suspend')] == 1) { ?>

												<span class="label bg-danger" data-toggle="tooltip" data-placement="top" title="Blocking a user prevents them from logging into their account."><i class="fa fa-times-circle"></i> Blocked</span>


												<?php } else {?>

												<span class="label bg-success" data-toggle="tooltip" data-placement="top" title="User can loggin using account credentials."><i class="fa fa-check-circle-o"></i> Enabled</span>

												<?php }?>

											</td>

											<td>
												<span class="label bg-success">
													<?php echo $user[$this->flexi_auth->db_column('user_acc', 'date_added')];?>
												</span>
											</td>

											<td>
												<span class="label bg-warning">
													<?php echo $user[$this->flexi_auth->db_column('user_acc', 'last_login_date')];?>
												</span>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Update User Account"><i class="fa fa-user"></i></a>
											</td>
											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/users/update_user_privileges/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Change User Privileges"><i class="fa fa-key"></i></a>
											</td>
											<td>
												<button onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" type="submit" name="delete_user_account" value="<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete User Account"><i class="fa fa-trash-o"></i></button>
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
																<h1><?php echo $this->lang->line('no_users_found');?></h1>
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
				                      <span> <h4> Total users: <span class="badge bg-dark"><?php echo $pagination['total_users'];?></span> </h4></span>
				                    </div>

				                    <div class="col-sm-4 text-center-xs">   

					                    <?php if (! empty($pagination['links'])) { ?>
	             
					                      <ul class="pagination pagination-lg m-t-none m-b-none">

					                        <?php echo $pagination['links'];?>
					                        
					                      </ul>

					                    <?php } ?>

				                    </div>

				                    <div class="col-sm-4 pull-left">

										

				                  	</div>
				                </footer>




				            </section>

				                <?php echo form_close();?>


				        </section>
				    </section>



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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_user_privileges');?></h3>
              </div>

				<?php echo form_open(current_url());?>

              <div class="col-lg-4">
                  <section class="panel panel-default">
                    <div class="panel-body">
                      <div class="clearfix text-center m-t">

                      <div class="inline">
                        <div class="thumb-lg">

                        <?php if(!empty($user['upro_avatar'])) {?>

                          <img src="<?php echo base_url() . $user['upro_avatar']; ?>" class="img-circle">

                        <?php } else { ?>

                          <img src="<?php echo base_url(); ?>assets/themes/admin/images/default_avatar.png" class="img-circle">

                        <?php }?>
                        
                        </div>
                        <div class="h4 m-t m-b-xs"><?php echo $user['upro_first_name'].' '.$user['upro_last_name']; ?></div>
                        <small class="text-muted m-b"><?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')];?></small>
                      </div>                       
                      </div>
                    </div>
                    <footer class="panel-footer bg-info text-center">
                      <div class="row pull-out">
                        <div class="col-xs-4">
                          <div class="padder-v">
                        
                          </div>
                        </div>
                        <div class="col-xs-4 dk">
                          <div class="padder-v">
                            <span class="m-b-xs h2 block text-white">Group</span>
                            <small class="text-muted"><?php echo $user['ugrp_name']; ?></small>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="padder-v">

                          </div>
                        </div>
                      </div>
                    </footer>
                  </section>
                   <a href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>" class="btn btn-dark btn-lg btn-block"><i class="fa fa-user pull-left"></i> <?php echo $user['upro_first_name']; ?> <?php echo $this->lang->line('account');?></a>
                   <button type="submit" name="update_user_privilege" value="Update User Privileges" class="btn btn-info btn-lg btn-block"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('update');?> <?php echo $user['upro_first_name']; ?> <?php echo $this->lang->line('privileges');?></button>
             </div>

              <div class="col-lg-8">

                  <!-- Checks if settings allow user to has individual privilege from the usergroup belonging to.-->
                  <section class="panel bg-dark">
                    <div class="carousel slide carousel-fade panel-body" id="c-fade">
                        
                        <div class="carousel-inner">

                          <div class="item active">
                            <p class="text-center">

	                            <?php
				                    if (in_array('user', $privilege_sources))
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-check text-success"></i> User privileges are considered. </em><br>';
				                    }
				                    else
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-times text-danger"></i> User privileges are NOT considered.</em><br>';
				                    }
				                    if (in_array('group', $privilege_sources))
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-check text-success"></i> User Group privileges are considered.</em>';
				                    }
				                    else
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-times text-danger"></i> User Group privileges are NOT considered.</em>';
				                    }
				                ?>

                            </p>
                          </div>
                          
                        </div>
                    </div>
                  </section>
                  <!-- Checks if settings allow user to has individual privilege from the usergroup belonging to.-->

				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <i class="fa fa-key"></i>   <?php echo $user['upro_first_name']; ?> <?php echo $this->lang->line('privileges');?>
				                </header>

				                <div class="table-responsive">

				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
				                        <th><?php echo $this->lang->line('privilege_name');?></th>
				                        <th><?php echo $this->lang->line('privilege_description');?></th>
				                        <th><?php echo $this->lang->line('user_has_individual_privilege');?></th>
				                        <th><?php echo $this->lang->line('has_privilege_from_usergroup');?></th>
				                      </tr>
				                    </thead>
				                    <tbody>

				                    	<?php foreach ($privileges as $privilege) { ?>

										<tr>
											<td>
												<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>][id]" value="<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>"/>
												<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'name')];?>
											</td>
											<td>
												<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'description')];?>
											</td>
											<td>

												<?php 
													// Define form input values.
													$current_status = (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $user_privileges)) ? 1 : 0; 
													$new_status = (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $user_privileges)) ? 'checked="checked"' : NULL;
												?>

												<label class="switch">
												<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>][current_status]" value="<?php echo $current_status ?>"/>
												<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>][new_status]" value="0"/>
												
												<input type="checkbox" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>][new_status]" value="1" <?php echo $new_status ?>/>
												<span></span>
												</label>
											</td>
											<td class="text-center">
												<?php if (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $group_privileges)): ?>
											
													<span class="label bg-success"> Yes </span>


												<?php else: ?>
											
													<span class="label bg-danger"> No </span>

												<?php endif?>
											</td>
										</tr>

									  <?php } ?>

				                    </tbody>
				                  </table>
				                </div>
				                <footer class="panel-footer">
				                  <div class="row">
				                    <div class="col-sm-4 text-center">
				                    </div>
				                    <div class="col-sm-4 text-right text-center-xs">                
				                     
				                    </div>
				                  </div>
				                </footer>
				            </section>
				          </div>

				            <?php echo form_close();?>

				        </section>
				    </section>




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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_usergroup_privileges');?></h3>
              </div>

				<?php echo form_open(current_url());?>

              <div class="col-lg-4">
                  
                   <a href="<?php echo base_url(); ?>admin/users/update_user_group/<?php echo $group['ugrp_id']; ?>" class="btn btn-dark btn-lg btn-block"><i class="fa fa-users pull-left"></i> <?php echo $group['ugrp_name']; ?> <?php echo $this->lang->line('usergroup');?></a>
                   <button type="submit" name="update_group_privilege" value="Update Group Privileges" class="btn btn-info btn-lg btn-block"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('update');?> <?php echo $group['ugrp_name']; ?> <?php echo $this->lang->line('privileges');?></button>
             </div>

              <div class="col-lg-8">

                  <!-- Checks if settings allow user to has individual privilege from the usergroup belonging to.-->
                  <section class="panel bg-dark">
                    <div class="carousel slide carousel-fade panel-body" id="c-fade">
                        
                        <div class="carousel-inner">

                          <div class="item active">
                            <p class="text-center">

	                            <?php
				                    if (in_array('group', $privilege_sources))
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-check text-success"></i> User Group privileges are considered. </em><br>';
				                    }
				                    else
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-times text-danger"></i> User Group privileges are NOT considered.</em><br>';
				                    }
				                    if (in_array('user', $privilege_sources))
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-check text-success"></i> User privileges are considered.</em>';
				                    }
				                    else
				                    {
				                        echo '<em class="h4 text-mute"><i class="fa fa-times text-danger"></i> User privileges are NOT considered.</em>';
				                    }
				                ?>

                            </p>
                          </div>
                          
                        </div>
                    </div>
                  </section>
                  <!-- Checks if settings allow user to has individual privilege from the usergroup belonging to.-->

				<section class="panel panel-default">
				                <header class="panel-heading font-bold">
				                  <i class="fa fa-key"></i>   <?php echo $group['ugrp_name']; ?> <?php echo $this->lang->line('privileges');?>
				                </header>

				                <div class="table-responsive">

				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
				                        <th><?php echo $this->lang->line('privilege_name');?></th>
				                        <th><?php echo $this->lang->line('privilege_description');?></th>
				                        <th><?php echo $this->lang->line('user_has_privilege');?></th>
				                        
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
													$current_status = (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $group_privileges)) ? 1 : 0; 
													$new_status = (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $group_privileges)) ? 'checked="checked"' : NULL;
												?>

												<label class="switch">
												<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>][current_status]" value="<?php echo $current_status ?>"/>
												<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>][new_status]" value="0"/>
												
												<input type="checkbox" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')];?>][new_status]" value="1" <?php echo $new_status ?>/>
												<span></span>
												</label>
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




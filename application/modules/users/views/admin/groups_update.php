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
                <h3 class="m-b-none"><?php echo $this->lang->line('update_user_group');?></h3>
              </div>   

              <?php echo form_open(current_url()); ?>

              <div class="row"><!--Starts div raw -->

                <div class="col-lg-4"><!--Starts Groups Genereal Info and Links -->

                  <section class="panel panel-default">
                    <div class="panel-body">
                      <div class="clearfix text-center m-t">
                        <div class="inline">

                          <div class="h1 m-t m-b-xs text-dark"><?php echo $this->lang->line('user_group');?></div>

                          <span class="fa-stack fa-4x pull-center m-r-sm">
                            <i class="fa fa-circle fa-stack-2x text-dark"></i>
                            <i class="fa fa-users fa-stack-1x text-white"></i>
                          </span>

                          <div class="h1 m-t m-b-xs text-info"><?php echo $group['ugrp_name']; ?></div>
                        </div>                      
                      </div>
                    </div>
                    <footer class="panel-footer bg-dark text-center">
                      <div class="row pull-out">
                        <div class="col-xs-4">
                          <div class="padder-v">

                            <small class="text-muted"></small>

                            <span class="m-b-xs h4 block"> </span>

                          </div>
                        </div>
                        <div class="col-xs-4 dk">
                          <div class="padder-v">

                            <small class="text-muted"></small>

                            <span class="m-b-xs h4 block"> </span>

                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="padder-v">

                            <small class="text-muted m-b"> </small>

                            <span class="m-b-xs h4 block text-white"> </span>

                          </div>
                        </div>
                      </div>
                    </footer>
                  </section>

                  <a class="btn btn-lg btn-block btn-warning" href="<?php echo base_url();?>admin/users/update_group_privileges/<?php echo $group['ugrp_id']; ?>"> <?php echo $this->lang->line('privileges');?> of <?php echo $group['ugrp_name']; ?></a>

                </div><!--Ends Groups Genereal Info and Links -->

                <div class="col-lg-8">
                 <!--Group Information Form Panel -->
                 <section class="panel panel-default">
                  <header class="panel-heading font-bold"><?php echo $group['ugrp_name']; ?> <?php echo $this->lang->line('usergroup');?></header>
                  <div class="panel-body">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('group_name');?></label>
                      <input type="text" id="group" name="update_group_name" value="<?php echo set_value('update_group_name', $group[$this->flexi_auth->db_column('user_group', 'name')]);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_group_name');?>">
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label><?php echo $this->lang->line('group_description');?></label>
                      <textarea id="description" name="update_group_description" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_group_description');?>"><?php echo set_value('update_group_description', $group[$this->flexi_auth->db_column('user_group', 'description')]);?></textarea>
                    </div>

                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">

                    <?php if ($group['ugrp_id'] == 1) :?>

                      <section class="chat-body">
                        <div class="panel bg bg-warning text-sm m-b-none">
                          <div class="panel-body">
                            <span class="arrow right"></span>
                            <h4>
                              *
                              <br>
                              This is the default Public Usergroup.
                              <br>
                              No admin Access Rights granted from Usergroup Privileges.
                            </h4>
                          </div>
                        </div>
                      </section>

                    <?php elseif ($group['ugrp_id'] == 3) :?>

                      <section class="chat-body">
                        <div class="panel bg bg-warning text-sm m-b-none">
                          <div class="panel-body">
                            <span class="arrow right"></span>
                            <h4>
                              *
                              <br>
                              This is the default Administrators Usergroup.
                              <br>
                              All access privileges are granted from Usergroup Privileges.
                            </h4>
                          </div>
                        </div>
                      </section>




                    <?php else :?>

                     <?php $ugrp_admin = ($group[$this->flexi_auth->db_column('user_group', 'admin')] == 1) ;?>

                     <label class="col-sm-3 control-label"><?php echo $this->lang->line('is_admin_group');?></label>

                     <div class="col-sm-3">
                      <label class="switch">
                        <input type="checkbox" id="admin" name="update_group_admin" value="1" <?php echo set_checkbox('update_group_admin', 1, $ugrp_admin);?>>
                        <span></span>
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <span class="help-block m-b-none"><?php echo $this->lang->line('help_is_admin_group');?></span>
                    </div>

                  <?php endif; ?>


                  </div>

                </div>
              </section>
              <!--Ends Usergroup Informations Form Panel -->

              <section class="panel panel-default">
                <div class="panel-body">
                  <div class="btn-group pull-right">

                    <button type="submit" name="update_user_group" id="submit" value="Submit" class="btn btn-info btn-lg"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('update');?></button>

                  </div>
                </div>
              </section>

            </div><!--Ends div class = "col-lg-6-->

          </div><!--Ends div raw -->

          <?php echo form_close();?>

        </section><!--Ends scrollable padder -->
      </section><!--Ends vbox -->

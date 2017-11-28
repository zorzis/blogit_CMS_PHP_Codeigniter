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
                <h3 class="m-b-none"><?php echo $this->lang->line('update_user_account');?></h3>
              </div>   

              <?php echo form_open(current_url()); ?>

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
                  <footer class="panel-footer bg-dark text-center">
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

                <a class="btn btn-info btn-lg btn-block" href="#user_credentials" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  <?php echo $this->lang->line('form_user_credentials');?>
                </a>

                <a class="btn btn-info btn-lg btn-block" href="#personal_infos" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  <?php echo $this->lang->line('form_user_personal_information');?>
                </a>                

                <a class="btn btn-info btn-lg btn-block" href="#avatar_panel_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  <?php echo $this->lang->line('form_user_avatar');?>
                </a>

                <a href="<?php echo base_url(); ?>admin/users/update_user_privileges/<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')];?>" class="btn btn-warning btn-lg btn-block"><i class="fa fa-key pull-left"></i> <?php echo $user['upro_first_name']; ?> <?php echo $this->lang->line('privileges');?></a>


              </div><!--Ends col-lg-4 -->

              <div class="col-lg-8">
                
                <section>
                  <div class="panel-body">
                    <div class="tab-content"><!--Starts Tab Content -->  


                      <div class="tab-pane fade active in" id="user_credentials"><!-- Starts Credentials Panel -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('form_user_credentials');?> </i>
                          </header>
                        </section>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_email');?></label>
                          <input type="text" id="email_address" name="update_email_address" value="<?php echo set_value('update_email_address',$user[$this->flexi_auth->db_column('user_acc', 'email')]);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_email');?>">
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_username');?></label>
                          <input type="text" id="username" name="update_username" value="<?php echo set_value('update_username',$user[$this->flexi_auth->db_column('user_acc', 'username')]);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_username');?>">
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_password');?></label>
                          <input type="password" id="password" name="update_password" value="<?php echo set_value('update_password');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_password');?>. Minimum <?php echo $this->flexi_auth->min_password_length(); ?> characters ">
                        </div>
                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_confirm_password');?></label>
                          <input type="password" id="confirm_password" name="update_confirm_password" value="<?php echo set_value('update_confirm_password');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_confirm_password');?>">
                        </div>
                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_usergroup');?></label>
                          <select id="group" name="update_group" class="form-control input-lg m-b">

                            <?php foreach($groups as $group) { ?>
                            <?php $user_group = ($group[$this->flexi_auth->db_column('user_group', 'id')] == $user[$this->flexi_auth->db_column('user_acc', 'group_id')]) ? TRUE : FALSE;?>
                            
                            <option value="<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" <?php echo set_select('update_group', $group[$this->flexi_auth->db_column('user_group', 'id')], $user_group);?>>
                             
                              <?php echo $group[$this->flexi_auth->db_column('user_group', 'name')];?>
                              
                            </option>
                            
                            <?php } ?>
                            
                          </select>
                        </div>

                      </div><!-- Ends Credentials Panel -->

                      <div class="tab-pane fade" id="personal_infos"><!-- Starts Navigation Settings Panel -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('form_user_personal_information');?> </i>
                          </header>
                        </section>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_first_name');?></label>
                          <input type="text" id="first_name" name="update_first_name" value="<?php echo set_value('update_first_name',$user['upro_first_name']);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('user_first_name');?>">
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_last_name');?></label>
                          <input type="text" id="last_name" name="update_last_name" value="<?php echo set_value('update_last_name',$user['upro_last_name']);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('user_last_name');?>">
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label><?php echo $this->lang->line('user_phone_number');?></label>
                          <input type="text" id="phone_number" name="update_phone_number" value="<?php echo set_value('update_phone_number',$user['upro_phone']);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('user_phone_number');?>">
                        </div>

                      </div><!-- Ends Personal Infos Panel -->

                      <div class="tab-pane fade" id="avatar_panel_settings"><!-- Starts Avatar Panel -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('form_user_avatar');?> </i>
                          </header>
                        </section>

                        <section class="panel panel-default">
                          <div class="panel-body">
                            <div class="clearfix text-center m-t">

                              <div class="inline">

                                <div id="avatar"></div><!-- Show new avatar -->

                                <div id="avatar_empty">
                                  <div class="thumb-lg">

                                    <input type="hidden" name="avatar"  id="avatar" value="<?php echo set_value('avatar',$user['upro_avatar']);?>" class="form-control input-sm">
                                    
                                    <?php if(!empty($user['upro_avatar'])) {?>

                                      <img src="<?php echo base_url() . $user['upro_avatar']; ?>" class="img-circle">

                                    <?php } else { ?>

                                      <img src="<?php echo base_url(); ?>assets/themes/admin/images/default_avatar.png" class="img-circle">
                                    
                                    <?php }?>

                                  </div>
                                </div>

                                <div class="h4 m-t m-b-xs"><?php echo $user['upro_first_name'].' '.$user['upro_last_name']; ?></div>
                                <small class="text-muted m-b"><?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')];?></small>
                              </div>   

                            </div>
                          </div>
                          
                        </section>


                        <section class="panel panel-default">

                        <a href="#modal-form" class="btn btn-dark btn-block" data-toggle="modal"><i class="fa fa-youtube-play fa-2x pull-left"></i> <h4>File Browser</h4></a>
                        </section>

                        <!-- Starts Modal Containing Ajax File Browser -->
                        <div class="modal file_browser fade" id="modal-form">
                          <div class="file-browser">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <i class="fa fa-youtube-play fa-4x pull-left text-info"></i><h2 class="modal-title text-info">File Browser</h2>
                                </div>


                                <div class="modal-header">

                                  <button type="button" class="btn btn-sm btn-success" onclick="use_selected_media()"><i class="fa fa-mail-reply fa-2x"></i><span class="hidden-xs"> Use Selected Items</span></button>

                                </div>


                                <div class="modal-body">

                                  <!--Starts Media Files Browser AJAX -->
                                  <div id="ajax"> </div>
                                  <script>

                                    $(function() {
                                      $.post('<?php echo base_url(); ?>admin/media_manager/file_browser',function(data){
                                        $('#ajax').html(data);
                                      });

                                    });

                                  </script>
                                  <!--Ends Media Files Browser AJAX -->

                                  <style>
                                    .modal .file-browser .modal-dialog { width: 80%; }
                                  </style>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Ends Modal Containing Ajax File Browser -->

                      </div><!-- Ends Avatar Panel -->

                    </div><!--Ends Tab Content --> 
                  </div>
                  <!-- / right tab -->
                </section>

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="btn-group pull-right">

                      <button type="submit" name="update_users_account" id="submit" value="Submit" class="btn btn-info btn-lg btn-block"><i class="fa fa-check-circle pull-left"></i><?php echo $this->lang->line('update');?> <?php echo $user['upro_first_name']; ?> <?php echo $this->lang->line('account');?></button>

                    </div>
                  </div>
                </section>

              </div><!--Ends div class = "col-lg-8-->

              <?php echo form_close();?>

            </section><!--Ends scrollable padder -->
          </section><!--Ends vbox -->

<script>
  //Use Selected Media As Inputs
  function use_selected_media() 
  {
    var checked = $('#ajax input:checkbox').is(':checked');

    //We use serializeArray to get Objects and not a single string like serialize does
    var media_details = $('#ajax input[name="media_details[]"]').serializeArray();

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>admin/users/select_avatar',

      //We use {} to get array values as objects
      data: {media : media_details}, //The data your sending to some-page.php
      success: function(data)
      {

        $("#avatar").html(data);

        $("#modal-form").modal('hide');

        $('#avatar_empty').remove(); //hide box showing no image is selected yet
        
      },
      error:function()
      {
        console.log("AJAX request was a failure");

      }
    });
  }  
                                     
</script>

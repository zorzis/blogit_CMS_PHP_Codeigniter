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
                <h3 class="m-b-none"><?php echo $this->lang->line('create_user_account');?></h3>
              </div>   

              <?php echo form_open(current_url()); ?>

              <div class="col-lg-4">

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="clearfix text-center m-t">
                      <div class="inline">

                        <span class="fa-stack fa-4x pull-center m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-dark"></i>
                          <i class="fa fa-user fa-stack-1x text-white"></i>
                        </span>

                        <div class="h1 m-t m-b-xs text-info">New User</div>

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
                          <span class="m-b-xs h2 block text-white"></span>
                          <small class="text-muted"></small>
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
                        <input type="text" id="email_address" name="register_email_address" value="<?php echo set_value('register_email_address');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_email');?>">
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('user_username');?></label>
                        <input type="text" id="username" name="register_username" value="<?php echo set_value('register_username');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_username');?>">
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('user_password');?></label>
                        <input type="password" id="password" name="register_password" value="<?php echo set_value('register_password');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_password');?>. Minimum <?php echo $this->flexi_auth->min_password_length(); ?> characters ">
                      </div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('user_confirm_password');?></label>
                        <input type="password" id="confirm_password" name="register_confirm_password" value="<?php echo set_value('register_confirm_password');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('placeholder_user_confirm_password');?>">
                      </div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('user_usergroup');?></label>
                        <select id="group" name="register_group" class="form-control input-lg m-b">
                          <?php foreach($groups as $group) { ?>
                          <?php $user_group = ($group[$this->flexi_auth->db_column('user_group', 'id')] == $user[$this->flexi_auth->db_column('user_acc', 'group_id')]) ? TRUE : FALSE;?>
                          <option value="<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')];?>" <?php echo set_select('register_group', $group[$this->flexi_auth->db_column('user_group', 'id')], $user_group);?>>
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
                        <input type="text" id="first_name" name="register_first_name" value="<?php echo set_value('register_first_name');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('user_first_name');?>">
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('user_last_name');?></label>
                        <input type="text" id="last_name" name="register_last_name" value="<?php echo set_value('register_last_name');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('user_last_name');?>">
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('user_phone_number');?></label>
                        <input type="text" id="phone_number" name="register_phone_number" value="<?php echo set_value('register_phone_number');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('user_phone_number');?>">
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
                                    
                                    <span class="fa-stack fa-4x pull-center m-r-sm">
                                      <i class="fa fa-circle fa-stack-2x text-dark"></i>
                                      <i class="fa fa-user fa-stack-1x text-white"></i>
                                    </span>                                    

                                  </div>
                                </div>

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

                    <button type="submit" name="register_user" id="submit" value="Submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('create_new_account');?></button>

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
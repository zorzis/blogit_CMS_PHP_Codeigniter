          <section class="vbox">

            <header class="header bg-white b-b b-light">
              <p><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('modules');?></p>
              <div class="btn-group pull-right">
        <a href="<?php echo base_url(); ?>admin/modules/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('modules');?></a>
                <a href="<?php echo base_url(); ?>admin/modules/trashed_modules/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_modules');?></a>
              
                <div class="btn-group">
                  <button class="btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> New Module?</button>
                <button class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-2x"></i></button>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url(); ?>admin/modules/create_custom_module">Custom HTML Module</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/modules/create_menu_module">Menu Module</a></li>
                      <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/modules/create_latest_articles_module">Latest Articles Module</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/modules/create_popular_articles_module">Popular Articles Module</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/modules/create_images_slider_module">Image Slider Module</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/modules/create_portfolio_module">Portfolio Module</a></li>
                     </ul>
                </div>

              </div>
            </header>
            
            <section class="scrollable wrapper">

              <!-- Codeigniter Flash Messages Area -->

              <?php if (! empty($message)) { ?>

              <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">Close ×</button>
                <strong>
                  <?php echo $message; ?>
                </strong>
              </div>

              <?php } ?>
              
              <!-- Codeigniter Flash Messages Area -->

              <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $this->lang->line('update_image_slider_module');?></h3>
              </div>   

              <?php echo form_open(current_url()); ?>


              <div class="col-lg-4">

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="clearfix text-center m-t">
                      <div class="inline">

                        <div class="h1 m-t m-b-xs text-dark"><?php echo $this->lang->line('image_slider_module');?></div>

                        <span class="fa-stack fa-4x pull-center m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-dark"></i>
                          <i class="fa fa-picture-o fa-stack-1x text-info"></i>
                        </span>

                        <div class="h1 m-t m-b-xs text-info"><?php echo $module->title ?></div>
                      </div>                      
                    </div>
                  </div>
                  <footer class="panel-footer bg-dark text-center">
                    <div class="row pull-out">
                      <div class="col-xs-4">
                        <div class="padder-v">

                          <small class="text-muted">Module ID</small>

                          <span class="m-b-xs h4 block"> #<?php echo $module->id ?></span>
                          
                        </div>
                      </div>
                      <div class="col-xs-4 dk">
                        <div class="padder-v">

                          <small class="text-muted">Status:</small>

                          <span class="m-b-xs h4 block <?php echo ($module->is_published == 1) ? "text-success" : "text-danger";?>"><?php echo ($module->is_published == 1) ? "ON" : "OFF";?></span>

                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="padder-v">

                          <small class="text-muted m-b">Module Type:</small>

                        <?php  if($module->module_type == 'custom_module') { ?>
                        
                          <span class="m-b-xs h4 block text-white">Custom</span>

                        <?php } ?>
                        

                        <?php if($module->module_type == 'menu_module') { ?>
                        
                          <span class="m-b-xs h4 block text-white">Menu</span>

                        <?php } ?>

                        <?php if($module->module_type == 'latest_blog_articles_module') { ?>
                        
                          <span class="m-b-xs h4 block text-white">Latest</span>

                        <?php } ?>

                        <?php if($module->module_type == 'popular_blog_articles_module') { ?>
                        
                          <span class="m-b-xs h4 block text-white">Popular</span>

                        <?php } ?> 

                        <?php if($module->module_type == 'image_slider_module') { ?>
                        
                          <span class="m-b-xs h4 block text-white">Slider</span>

                        <?php } ?> 


                        <?php if($module->module_type == 'portfolio_module') { ?>
                        
                          <span class="m-b-xs h4 block text-white">Portfolio</span>

                        <?php } ?> 


                        </div>
                      </div>
                    </div>
                  </footer>
                </section>
                <a class="btn btn-info btn-lg btn-block" href="#module_content" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Module Content
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#module_media" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Module Media
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#module_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Module Options
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#template_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Assign Template Position
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#module_layout_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Module Layout
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#access_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Access settings
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#log_history" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Log History
                </a>

              </div> 

              <div class="col-lg-8"><!--Starts div class = "col-lg-8-->
                <section>
                  <div class="panel-body">
                    <div class="tab-content"><!--Starts Tab Content -->

                      <div class="tab-pane fade active in" id="module_content"><!--Starts Module Content Tab Content -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> Module Content</i>
                          </header>
                        </section>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('module_title');?></label>
                              <input type="text" id="title" name="title" value="<?php echo set_value('title',$module->title);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('module_title_placeholder');?>">
                        </div>

                      </div><!-- Ends Module Content Tab -->

                      <div class="tab-pane fade " id="module_media"><!--Starts Module Image Slider Tab -->
                      
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

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> Selected Images for Slider</i>
                          </header>
                        </section>

                        <!--Starts selected images-->  
                        <div id="selected_images">

                          <?php if (!empty($current_images_data)) { ?>

                            <?php foreach($current_images_data as $current_image_data) { ?>

                              <script>
                                function removeElement(selected_images, childDiv){
                                 if (childDiv == selected_images) {
                                  alert("The parent div cannot be removed.");
                                }
                                else if (document.getElementById(childDiv)) {     
                                  var child = document.getElementById(childDiv);
                                  var parent = document.getElementById(selected_images);
                                  parent.removeChild(child);
                                }
                                else {
                                  alert("Child div has already been removed or does not exist.");
                                  return false;
                                }
                              }
                            </script>

                            <div id="<?php echo $current_image_data->id ?>">

                              <section class="panel clearfix bg-dark lter">
                                <div class="panel-body">
                                  <a href="<?php echo base_url() . $current_image_data->image_path ?>" class="thumb pull-left m-r">

                                    <img src="<?php echo base_url() . $current_image_data->image_path ?>" >

                                  </a>
                                  <div class="clear">

                                    <input type="hidden" name="slider_image_path[]"  id="slider_image_path" value="<?php echo set_value('slider_image_path', $current_image_data->image_path); ?>" class="form-control input-sm">


                                    <div class="input-group">
                                      <input type="text" placeholder="Enter Image Caption" name="image_caption[]"  id="image_caption" value="<?php echo set_value('image_caption', $current_image_data->image_caption)  ?>" class="form-control input-lg">


                                      <span class="input-group-btn">
                                        <button type="button" onClick="removeElement('selected_images', '<?php echo $current_image_data->id?>');" class="btn btn-dark btn-lg" title=""> 
                                          <i class="fa fa-trash-o text-danger"></i>
                                        </button>
                                      </span>

                                    </div>
                                  </div>
                                </div>
                              </section>
                            </div>

                          <?php } ?>

                        <?php } else { ?>
                        <div id="no_images_found">
                          <div class="col-sm-12 text-center">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <h4>Nope!</h4>
                                <div class="progress progress-sm progress-striped active">
                                  <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                </div>
                                <h1 >No Images Selected Yet</h1>
                                <h2>Please Select Some Images</h2>

                              </li>
                            </ul>
                          </div>
                        </div>

                      <?php } ?>

                      </div><!--Ends parentDiv -->
                      <!--Ends selected images-->

                      <div id="media_values"> </div><!--Here we load the admin_images_slider view file-->

                      </div><!-- Ends Module Image Slider Tab -->

                      <div class="tab-pane fade" id="module_settings"><!--Starts Module Settings Tab Content -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> Module Options</i>
                          </header>
                        </section>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('module_show_title');?></label>
                          <div>
                            <label class="switch">
                                    <input type="checkbox" id="show_title" name="show_title" value="1" <?php echo set_checkbox('show_title',1,$module->show_title == 1);?> >
                              <span></span>
                            </label>
                          </div>
                          <div>
                            <span class="help-block m-b-none"><?php echo $this->lang->line('module_show_title_helper');?></span>
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('module_status');?></label>
                          <div>
                            <label class="switch">
                                    <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo set_checkbox('is_published',1,$module->is_published == 1);?> >
                              <span></span>
                            </label>
                          </div>
                          <div>
                            <span class="help-block m-b-none"><?php echo $this->lang->line('module_status_helper');?></span>
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>

                        <div class="form-group">
                          <label for="order"><?php echo $this->lang->line('module_order');?></label>
                            <input type="text" name="order" id="order" value="<?php echo set_value('order', $module->set_order);?>" class="form-control input-sm m-b" />
                          <p class="help-block"><?php echo $this->lang->line('module_order_helper');?></p>
                        </div> 

                      </div><!-- Ends Module Settings Tab -->

                      <div class="tab-pane fade" id="template_settings"><!-- Starts Access Settings Panel -->

                          <section class="panel panel-default">
                            <header class="panel-heading bg-warning lt no-border font-bold">
                              <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('module_position');?> </i>
                            </header>
                          </section>

                          <div class="form-group">

                            <label><?php echo $this->lang->line('choose_module_position');?></label>

                            <select name="module_position" id="module_position" class="form-control input-lg m-b">

                              <?php foreach ($template_positions as $position) : ?>
                              
                              <?php $position = basename($position,".php") ?>

                              <option value="<?php echo $position; ?>"

                                <?php if($position == $module->position) : ?>

                                selected

                              <?php endif; ?>

                              >

                              <?php echo $position; ?>

                            </option>

                          <?php endforeach; ?>
                        </select>
                        <span class="help-block m-b-none"><?php echo $this->lang->line('assign_module_to_template_position_helper');?></span>

                      </div>                           

                    </div><!-- Ends Template Settings Panel -->

                    <div class="tab-pane fade" id="module_layout_settings"><!-- Starts Access Settings Panel -->

                          <section class="panel panel-default">
                            <header class="panel-heading bg-warning lt no-border font-bold">
                              <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('module_layout');?> </i>
                            </header>
                          </section>

                          <div class="form-group">

                            <label><?php echo $this->lang->line('choose_module_layout');?></label>

                            <select name="module_layout" id="module_layout" class="form-control input-lg m-b">

                              <?php foreach ($image_slider_module_layouts as $image_slider_module_layout) : ?>

                              <option value="<?php echo $image_slider_module_layout; ?>"

                                <?php if($image_slider_module_layout == $module->module_layout) : ?>

                                selected

                              <?php endif; ?>

                              >

                              <?php echo $image_slider_module_layout ?>

                            </option>

                          <?php endforeach; ?>
                        </select>
                        <span class="help-block m-b-none"><?php echo $this->lang->line('module_layout_helper');?></span>

                      </div>                           

                    </div><!-- Ends Template Settings Panel -->
                    
                      <div class="tab-pane fade" id="access_settings"><!-- Starts Access Settings Panel -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> Access Privileges Settings </i>
                          </header>
                        </section>

                        <div class="form-group">

                          <label><?php echo $this->lang->line('access_privileges_menu_item');?></label>

                          <select name="module_access_level" id="module_access_level" class="form-control input-lg m-b">

                            <option value="0">Public</option>

                            <?php foreach ($privileges as $privilege) : ?>

                            <option value="<?php echo $privilege->upriv_id; ?>"

                              <?php if($privilege->upriv_id == $module->privilege_id) : ?>

                              selected

                            <?php endif; ?>

                            >

                            <?php echo $privilege->upriv_name; ?>

                          </option>

                        <?php endforeach; ?>
                      </select>
                      <span class="help-block m-b-none"><?php echo $this->lang->line('access_privileges_module_helper');?></span>

                    </div>                           

                  </div><!-- Ends Access Settings Panel -->

                      <div class="tab-pane fade" id="log_history"><!--Starts Log History Tab Content -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> Log History</i>
                          </header>
                        </section>

                          <div class="form-group">
                            <label for="seo_page_title"><i class="fa fa-credit-card fa-2x text-success"></i> <?php echo $this->lang->line('module_id');?></label>
                            <p class="help-block"><?php echo $module->id ?></p>
                          </div>

                          <div class="line line-dashed line-lg pull-in"></div>

                          <div class="form-group">
                            <label for="seo_page_title"><i class="fa fa-calendar-o fa-2x text-success"></i> <?php echo $this->lang->line('module_created_date');?></label>
                            <p class="help-block"><?php echo $module->created ?></p>
                          </div>

                          <div class="form-group">
                            <label for="seo_page_title"><i class="fa fa-user fa-2x text-success"></i> <?php echo $this->lang->line('module_created_by');?></label>
                            <p class="help-block"><?php echo $created_by->upro_first_name.' '.$created_by->upro_last_name; ?></p>
                          </div>

                          <div class="line line-dashed line-lg pull-in"></div>

                          <div class="form-group">
                            <label for="seo_page_title"><i class="fa fa-calendar-o fa-2x text-success"></i> <?php echo $this->lang->line('module_updated_date');?></label>
                            <p class="help-block"><?php echo $module->modified ?></p>
                          </div>

                          <div class="form-group">
                            <label for="seo_page_title"><i class="fa fa-user fa-2x text-success"></i> <?php echo $this->lang->line('module_updated_by');?></label>
                            <p class="help-block"><?php echo $modified_by->upro_first_name.' '.$modified_by->upro_last_name; ?></p>
                          </div>

                      </div><!--Ends Log History Tab Content -->

                    </div>
                  </div>
                </section>

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="btn-group pull-right">

                      <button type="submit" name="Save" id="submit" value="Save" class="btn btn-success btn-lg"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('save');?></button>

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
      url: '<?php echo base_url(); ?>admin/modules/images_slider_module/select_media',

      //We use {} to get array values as objects
      data: {media : media_details}, //The data your sending to some-page.php
      success: function(data)
      {

        $("#media_values").html(data);

        $("#modal-form").modal('hide');

        $('#no_images_found').hide(); //hide box showing no image is selected yet
        
      },
      error:function()
      {
        console.log("AJAX request was a failure");

      }
    });
  }  
                                     
</script>

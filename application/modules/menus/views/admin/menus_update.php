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
                <strong>
                  <?php echo $message; ?>
                </strong>
              </div>

              <?php } ?>
              
              <!-- Codeigniter Flash Messages Area -->

              <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $this->lang->line('update_menu');?></h3>
              </div>   

              <?php echo form_open(current_url()); ?>

              <div class="raw">

                <div class="col-lg-4">

                  <section class="panel panel-default">
                    <header class="panel-heading bg-info lt no-border font-bold h3">

                      <i class="fa fa-bars pull-left"></i>

                      <?php echo $this->lang->line('form_menu_details');?>
                      
                    </header>
                    <div class="panel-body">

                      <div class="form-group">
                        <label><?php echo $this->lang->line('menu_title');?></label>
                        <input type="text" id="title" name="title" value="<?php echo set_value('title', $menu->title);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('menu_title_placeholder');?>">
                      </div>
                    </div>
                  </section>

                  <div class="panel panel-default">
                    <div class="panel-heading bg-info lt no-border font-bold h3">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">

                      <i class="fa fa-bars pull-left"></i>

                        <?php echo $this->lang->line('access_options_menu');?>

                      </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                      <div class="panel-body text-lg">

                        <div class="form-group">

                          <label><?php echo $this->lang->line('access_privileges_menu');?></label>

                          <select name="privilege" id="privilege" class="form-control input-lg m-b">

                            <option value="0">Public</option>
                            
                            <?php foreach ($privileges as $privilege) : ?>

                            <option value="<?php echo $privilege->upriv_id; ?>"

                              <?php if($privilege->upriv_id == $menu->privilege_id) : ?>

                              selected

                            <?php endif; ?>

                            >

                            <?php echo $privilege->upriv_name; ?>
                            
                          </option>

                        <?php endforeach; ?>

                      </select>
                      <span class="help-block m-b-none"><?php echo $this->lang->line('access_privileges_menu_helper');?></span>

                    </div>                   


                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading bg-info lt no-border font-bold h3">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">

                      <i class="fa fa-bars pull-left"></i>

                    <?php echo $this->lang->line('menu_status_options');?>

                  </a>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body text-sm">

                    <div class="form-group">
                      <div class="col-lg-6">
                        <label><?php echo $this->lang->line('menu_status_published');?></label>
                      </div>
                      <div class="col-sm-6">
                        <label class="switch">
                          <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo set_checkbox('is_published',1,$menu->is_published == 1);?> >
                          <span></span>
                        </label>
                      </div>
                      <div class="col-sm-12">
                        <span class="help-block m-b-none"><?php echo $this->lang->line('menu_status_helper');?></span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

        </div><!--Ends div class = "col-lg-3-->

        <div class="col-lg-8">
          <a href="#modal-form" class="btn btn-warning btn-block" data-toggle="modal"><i class="fa fa-bars fa-2x pull-left"></i> <h4>Assign More Pages</h4></a>
        </div>
        <div class="col-lg-8"><!--Starts div class = "col-lg-8-->
          <section>
            <h2>Order pages</h2>
            <p class="alert alert-info">Drag to order pages and then click 'Save'</p>
            <div id="orderResult"></div>
            <input type="button" id="save" name="Order Assigned Pages" value="Click here to Order Assigned Pages " class="btn btn-primary" />
          </section>

          <script>
          $(function() {
            $.post('<?php echo base_url(); ?>admin/menus/order_ajax/<?php echo $menu->id ?>', {}, function(data){
              $('#orderResult').html(data);
            });

            $('#save').click(function(){
              oSortable = $('.sortable').nestedSortable('toArray');

              $('#orderResult').slideUp(function(){
                $.post('<?php echo base_url(); ?>admin/menus/order_ajax/<?php echo $menu->id ?>', { sortable: oSortable }, function(data){
                  $('#orderResult').html(data);
                  $('#orderResult').slideDown();
                });
              });
              
            });
          });
          </script>

        </div><!--Ends div class = "col-lg-8-->

      </div><!--Ends div class = "raw-->

      <div class="col-lg-12">
        <section class="panel panel-default">
          <div class="panel-body">
            <div class="btn-group pull-right">

              <button type="submit" name="Save" id="submit" value="Save" class="btn btn-success btn-lg"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('save');?></button>
              <a  class="btn btn-danger btn-lg" href="<?php echo base_url(); ?>admin/menus/"><i class="fa fa-times pull-left"></i> <?php echo $this->lang->line('close');?></a>

            </div>
          </div>
        </section>
      </div>

      <?php $this->load->view('menus/admin/includes/admin_assign_pages_to_menu'); ?>

      <?php echo form_close();?>

    </section><!--Ends scrollable padder -->
  </section><!--Ends vbox -->


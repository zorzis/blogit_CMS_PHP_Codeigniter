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
                <h3 class="m-b-none"><?php echo $this->lang->line('create_menu');?></h3>
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
                        <input type="text" id="title" name="title" value="<?php echo set_value('title');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('menu_title_placeholder');?>">
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

                            <option value="<?php echo $privilege->upriv_id; ?>">

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
                            <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo set_checkbox('is_published',1);?> >
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

            <div class="col-lg-8"><!--Starts div class = "col-lg-9-->

              <section class="panel panel-default">

                <header class="panel-heading bg-warning lt no-border font-bold">
                  <i class="fa fa-bars fa-2x"> Assign Menu Pages </i>
                </header>

                <div class="table-responsive">

                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>

                        <th>Page</th>
                        <th>Assign page to menu</th>

                      </tr>
                    </thead>

                    <?php if (!empty($pages)) { ?>

                    <tbody>

                      <?php foreach ($pages as $page) { ?>

                      <tr>

                        <td>
                          
                          <?php echo $page->title ?>

                        </td>

                        <td>
                          <label class="switch">
                            <input type="checkbox" id="page" name="page[]" value="<?php echo $page->id;?>">
                            <span></span>
                          </label>
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
                                <h1><?php echo $this->lang->line('no_pages_found');?></h1>
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
                    <div class="col-sm-4 text-center">
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                

                    </div>
                  </div>
                </footer>
              </section>

            </div><!--Ends div class = "col-lg-9-->

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
          
          <?php echo form_close();?>

        </section><!--Ends scrollable padder -->
      </section><!--Ends vbox -->

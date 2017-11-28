          <section class="vbox">

            <header class="header bg-white b-b b-light">
              <p><i class="fa fa-file-o"></i> <?php echo $this->lang->line('pages');?></p>
              <div class="btn-group pull-right">
        <a href="<?php echo base_url(); ?>admin/pages/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('pages');?></a>
                <a href="<?php echo base_url(); ?>admin/pages/trashed_pages/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_pages');?></a>
                
                <div class="btn-group">
                  <button class="btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> New Page?</button>
                <button class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-2x"></i></button>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url(); ?>admin/pages/create_custom_page">Custom HTML Page</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/pages/create_blog_page">Blog Page</a></li>
                      <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/pages/create_portfolio_page">Portfolio Page</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/pages/create_external_url_page">Link to external URL</a></li>
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


              <?php echo form_open(current_url()); ?>

              <div class="col-lg-4">

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="clearfix text-center m-t">
                      <div class="inline">

                        <span class="fa-stack fa-4x pull-center m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-dark"></i>
                          <i class="fa fa-chain fa-stack-1x text-white"></i>
                        </span>

                        <div class="h1 m-t m-b-xs text-info"><?php echo $this->lang->line('create_external_url_page');?></div>
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

                <a class="btn btn-info btn-lg btn-block" href="#page_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>

                  <?php echo $this->lang->line('external_url_page_settings');?>  

                </a>
                <a class="btn btn-info btn-lg btn-block" href="#access_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Access settings
                </a>
              </div> 

              <div class="col-lg-8">  
                <section>
                  <div class="panel-body">
                    <div class="tab-content"><!--Starts Tab Content -->             
                      <div class="tab-pane fade active in" id="page_settings">

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('external_url_page_settings');?></i>
                          </header>
                        </section>

                        <!--Category Information Form Panel -->
                        <div class="form-group">
                          <label><?php echo $this->lang->line('page_title');?></label>
                          <input type="text" id="page_title" name="page_title" value="<?php echo set_value('page_title');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('page_title_placeholder');?>">
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('page_slug');?></label>
                          <input type="text" id="page_slug" name="page_slug" value="<?php echo set_value('page_slug');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('page_slug_placeholder');?>">
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>

                        <div class="form-group">
                          <label><?php echo $this->lang->line('external_url');?></label>
                          <input type="text" id="external_url" name="external_url" value="<?php echo set_value('external_url');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('external_url_placeholder');?>">
                        </div>
                        <!--Ends Article Informations Form Panel -->

                      </div>

                      <div class="tab-pane fade" id="access_settings"><!-- Starts Access Settings Panel -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> Access Privileges Settings </i>
                          </header>
                        </section>

                        <div class="form-group">

                          <label><?php echo $this->lang->line('access_privileges_menu_item');?></label>

                          <select name="page_access_level" id="page_access_level" class="form-control input-lg m-b">

                            <option value="0">Public</option>

                            <?php foreach ($privileges as $privilege) : ?>

                            <option value="<?php echo $privilege->upriv_id; ?>">

                              <?php echo $privilege->upriv_name; ?>

                            </option>

                          <?php endforeach; ?>

                        </select>
                        <span class="help-block m-b-none"><?php echo $this->lang->line('access_privileges_page_helper');?></span>

                      </div>                           

                    </div><!-- Ends Access Settings Panel -->

              </div><!--Ends Tab Content --> 
            </div>
            <!-- / right tab -->
          </section>
        </div><!-- Ends Col-lg-8 -->


        <div class="col-lg-12">
          <section class="panel panel-default">
            <div class="panel-body">
              <div class="btn-group pull-right">

                <button type="submit" name="Save" id="submit" value="Save" class="btn btn-success btn-lg"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('save');?></button>

              </div>
            </div>
          </section>
        </div>


        <?php echo form_close();?>

      </section><!--Ends scrollable padder -->
          </section><!--Ends vbox -->
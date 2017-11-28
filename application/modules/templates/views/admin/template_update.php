          <section class="vbox">

           <header class="header bg-white b-b b-light">
            <p><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('templates');?></p>
            <div class="btn-group pull-right">
              <a href="<?php echo base_url(); ?>admin/templates/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('templates');?></a>
              <a href="<?php echo base_url(); ?>admin/templates/trashed_templates/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_templates');?></a>
              <a href="<?php echo base_url(); ?>admin/templates/create_template/" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('create_template');?></a>                
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
            <h3 class="m-b-none"><?php echo $this->lang->line('templates');?></h3>
          </div>   

          <?php echo form_open_multipart(current_url()); ?>

          <div class="col-lg-4">

            <section class="panel panel-default">
              <div class="panel-body">
                <div class="clearfix text-center m-t">
                  <div class="inline">

                    <div class="h1 m-t m-b-xs text-dark"><?php echo $this->lang->line('templates');?></div>

                    <span class="fa-stack fa-4x pull-center m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-dark"></i>
                      <i class="fa fa-tint fa-stack-1x text-white"></i>
                    </span>

                    <div class="h2 m-t m-b-xs text-info"><?php echo $template->title ?></div>

                  </div>                      
                </div>
              </div>
              <footer class="panel-footer bg-dark text-center">
               <div class="row pull-out">
                 <div class="col-xs-4">
                   <div class="padder-v">

                     <small class="text-muted">Default Template?</small>

                     <span class="m-b-xs h4 block <?php echo ($template->default == 1) ? "text-success" : "text-danger";?>"><?php echo ($template->default == 1) ? "Yes" : "Nope";?></span>

                   </div>
                 </div>
                 <div class="col-xs-4 dk">
                  <div class="padder-v">

                    <small class="text-muted">Assigned Positions</small>

                    <span class="m-b-xs h4 block text-warning">

                      <?php if (!empty($template_positions)) { ?>

                        <?php echo count($template_positions) ?>

                      <?php } else { ?>

                        Nope

                      <?php }?>

                    </span>

                  </div>
                </div>
                <div class="col-xs-4">
                 <div class="padder-v">

                   <small class="text-muted m-b"> Template Files Setup</small>

                   <span class="m-b-xs h4 block text-white">

                        <?php 
                                $template_path = APPPATH .'views/themes/';
                              
                                $template_folder = $template->title; 
                        ?>

                              <?php if (file_exists($template_path . $template_folder) AND 
                                file_exists($template_path . $template_folder . '/main.php') AND
                                file_exists($template_path . $template_folder . '/templates/frontend_blog_content.php') AND
                                file_exists($template_path . $template_folder . '/templates/frontend_custom_content.php') AND
                                file_exists($template_path . $template_folder . '/templates/frontend_single_article.php')
                                )
                              {?>

                                
                                  <i class="fa fa-check-circle-o text-success "> All Ok</i>

                              <?php } else {?>

                                  <i class="fa fa-flash text-danger"> Not Ok </i>

                          <?php } ?>  

                    </span>

                 </div>
               </div>
             </div>
           </footer>
         </section>

         <a class="btn btn-info btn-lg btn-block" href="#logo_settings" data-toggle="tab">
           <i class="fa fa-bars pull-left"></i>
           <?php echo $this->lang->line('template_options');?>
         </a>
         <a class="btn btn-warning btn-lg btn-block" href="#template_positions_settings" data-toggle="tab">
           <i class="fa fa-bars pull-left"></i>
           <?php echo $this->lang->line('template_positions');?>
         </a>


       </div> 


       <div class="col-lg-8">
        <!--Article Information Form Panel -->
        <section>
          <div class="panel-body">
            <div class="tab-content"><!--Starts Tab Content -->

              <div class="tab-pane fade active in" id="logo_settings"><!--Starts Media Settings Tab Content -->


                <section class="panel panel-default">
                  <header class="panel-heading bg-info lt no-border font-bold">
                    <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('template_options');?></i>
                  </header>
                </section>

                 <div class="alert alert-info">
                   <strong>
                    <i class="fa fa-tint fa-4x pull-left text-dark"></i>
                    <p>You have to create your template folder accordingly to the default one existing at: <?php echo $template_path ?>**my_template**</p> 
                   </strong>
                 </div>

                <div class="form-group">
                  <label><?php echo $this->lang->line('template');?></label>
                  <input type="text" id="title" name="title" value="<?php echo set_value('title', $template->title);?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('template_placeholder');?>">
                </div>

                <section class="panel panel-default">

                  <header class="panel-heading bg-info lt no-border font-bold">
                    <i class="fa fa-bars fa-2x"> Templates that already exists in templates folder</i>
                  </header>

                  <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                      <thead>
                        <tr>
                          <th><?php echo $this->lang->line('template_title');?></th>
                          <th>Path to Template Folder</th>
                        </tr>
                      </thead>

                      <?php if (!empty($templates_folders)) { ?>

                      <tbody>

                        <?php foreach ($templates_folders as $template_folder) { ?>

                          <?php if ($template_folder["name"] != 'admin_themes') {?>

                          <tr>

                            <td>
                              <span class="label bg-success"> <?php echo $template_folder["name"] ?></span>
                            </td>

                            <td>
                              <span class="label bg-info"> <?php echo $template_folder["server_path"] ?></span>
                            </td>

                          </tr>
                          <?php } ?>  

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
                                  <h1><?php echo $this->lang->line('no_templates_found');?></h1>
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
                </section>


              </div><!--Ends Media Settings Tab Content -->

              <div class="tab-pane fade" id="template_positions_settings"><!--Starts Template Positions Tab Content -->

                <section class="panel panel-default">
                  <header class="panel-heading bg-warning lt no-border font-bold">
                    <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('template_positions');?></i>
                  </header>
                </section>


                 <div class="alert alert-info">
                   <strong>
                    <i class="fa fa-tint fa-4x pull-left text-dark"></i>
                    <p>This is where you have to place your template positions files: <?php echo $path_to_template_positions?></p>
                    <p>You have to manually create the positions inside the template.After that you can assing as many modules you like to these positions</p> 
                   </strong>
                 </div>

                <?php if (!empty($template_positions)) { ?>

                   <?php foreach ($template_positions AS $position) { ?>

                      <div class="input-group">
                        <input type="text" name="" value="<?php echo basename($position,".php") ?>" class="form-control input-lg" disabled="">
                        <span class="input-group-btn">
                          <a class="btn btn-dark btn-lg" title=""> 
                            <i class="fa fa-check-circle-o text-success"></i>
                          </a>
                        </span>
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>

                    <?php }?>

                  <?php } else { ?>

                  <div class="col-sm-12">
                    <ul class="list-group">
                      <li class="list-group-item text-center">
                        <h4>Nope!</h4>
                        <div class="progress progress-sm progress-striped active">
                          <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                        </div>
                        <h1><?php echo $this->lang->line('no_template_positions_found');?></h1>
                      </li>
                    </ul>
                  </div>

                  <?php } ?>

              </div><!--Ends Template Positions Tab Content -->

            </div><!--Ends Tab Content --> 
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


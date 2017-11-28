          <section class="vbox">

            <header class="header bg-white b-b b-light">
              <p><i class="fa fa-briefcase fa-2x text-info"></i> <?php echo $this->lang->line('portfolio');?></p>
              <div class="btn-group pull-right">
                <a href="<?php echo base_url(); ?>admin/portfolio/categories/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('portfolio_categories');?></a>
                <a href="<?php echo base_url(); ?>admin/portfolio/categories/trashed_portfolio_categories/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_portfolio_categories');?></a>
                <a href="<?php echo base_url(); ?>admin/portfolio/categories/create_portfolio_category" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('create_portfolio_category');?></a>                
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
                <h3 class="m-b-none"><?php echo $this->lang->line('create_portfolio_category');?></h3>
              </div>   

              <?php echo form_open(current_url()); ?>

              <div class="col-lg-4">

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="clearfix text-center m-t">
                      <div class="inline">


                        <span class="fa-stack fa-4x pull-center m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-dark"></i>
                          <i class="fa fa-briefcase fa-stack-1x text-white"></i>
                        </span>

                        <div class="h1 m-t m-b-xs text-info"><?php echo $this->lang->line('create_portfolio_category');?></div>
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

                <a class="btn btn-info btn-lg btn-block" href="#portfolio_category" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Portfolio Category
                </a>

                <a class="btn btn-info btn-lg btn-block" href="#portfolio_category_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Portfolio Category Options
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#seo_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  <?php echo $this->lang->line('seo_options');?>
                </a>

              </div> 


              <div class="col-lg-8">
               <!--Article Information Form Panel -->
               <section>
                <div class="panel-body">
                  <div class="tab-content"><!--Starts Tab Content -->

                    <div class="tab-pane fade active in" id="portfolio_category"><!--Starts Article Tab Content -->

                      <section class="panel panel-default">
                        <header class="panel-heading bg-warning lt no-border font-bold">
                          <i class="fa fa-bars fa-2x"> Portfolio Category</i>
                        </header>
                      </section>
                      
                      <div class="form-group">
                        <label><?php echo $this->lang->line('portfolio_category_title');?></label>
                        <input type="text" id="portfolio_category_title" name="portfolio_category_title" value="<?php echo set_value('portfolio_category_title');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('portfolio_category_title_placeholder');?>">
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('blog_category_description');?></label>
                        <textarea id="portfolio_category_description" name="portfolio_category_description" class="ckeditor" placeholder="<?php echo $this->lang->line('portfolio_category_description_placeholder');?>"><?php echo set_value('portfolio_category_description');?></textarea>
                      </div>

                      </div>

                      <div class="tab-pane fade" id="portfolio_category_settings"><!--Starts Blog Category Settings Tab Content -->       

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('form_portfolio_category_details');?></i>
                          </header>
                        </section>


                        <div class="form-group">
                          <label><?php echo $this->lang->line('portfolio_category_slug');?></label>
                          <input type="text" id="portfolio_category_slug" name="portfolio_category_slug" value="<?php echo set_value('portfolio_category_slug');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('portfolio_category_slug_placeholder');?>">
                        </div>

                      </div>

                      <div class="tab-pane fade" id="seo_settings"><!--Starts SEO Settings Tab Content -->

                        <section class="panel panel-default">
                          <header class="panel-heading bg-warning lt no-border font-bold">
                            <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('seo_options');?></i>
                          </header>
                        </section>
                        
                        <div class="form-group">
                          <label for="seo_page_title"><?php echo $this->lang->line('seo_page_title');?></label>
                          <input class="form-control input-sm m-b" type="text" name="seo_page_title" placeholder="<?php echo $this->lang->line('seo_page_title_placeholder');?>" value="<?php echo set_value('seo_page_title'); ?>" />
                          <p class="help-block"><?php echo $this->lang->line('seo_page_title_helper');?></p>
                        </div>

                        <div class="form-group">
                          <label for="keywords"><?php echo $this->lang->line('meta_keywords');?></label>
                          <input class="form-control input-sm m-b" type="text" name="meta_keywords" placeholder="<?php echo $this->lang->line('meta_keywords_placeholder');?>" value="<?php echo set_value('meta_keywords'); ?>"/>
                          <p class="help-block"><?php echo $this->lang->line('meta_keywords_helper');?></p>
                        </div>

                        <div class="form-group">
                          <label for="post_description"><?php echo $this->lang->line('meta_description');?></label>
                          <textarea class="form-control input-sm m-b" type="text" name="meta_description" rows="4" placeholder="<?php echo $this->lang->line('meta_description_placeholder');?>"><?php echo set_value('meta_description'); ?></textarea>
                        </div>

                      </div><!--Ends SEO Settings Tab Content -->

                    </div><!--Ends Tab Content --> 
                  </div>
                </section>
              </div><!--Ends div class = "col-lg-8-->

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

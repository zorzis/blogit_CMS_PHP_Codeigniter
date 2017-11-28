          <section class="vbox">
            <header class="header bg-white b-b b-light">
              <p><i class="fa fa-users"></i> <?php echo $this->lang->line('dashboard');?></p>
            </header>
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
  
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-file-text-o fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs">
                        <strong>

                          <?php if(!empty($no_of_published_articles_per_logged_in_user) && ($no_of_published_articles))  {?>

                            #<?php echo $no_of_published_articles_per_logged_in_user?> / #<?php echo $no_of_published_articles ?>

                          <?php } ?>

                        </strong>
                      </span>
                      <small class="text-muted text-uc">Articles published by you</small>

                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-file-text fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs">
                        <strong id="bugs">

                          <?php if(!empty($no_of_total_users))  {?>

                            #<?php echo $no_of_total_users ?>

                          <?php } ?>

                        </strong>
                      </span>
                      <small class="text-muted text-uc">Active Users</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-dark"></i>
                      <i class="fa fa-clock-o fa-stack-1x text-success"></i>
                    </span>
                    <a class="clear" href="#">
                      <small class="text-muted text-uc">Your Account Created at</small>

                      <span class="block m-t-xs">
                        <strong id="firers">

                          <?php if(!empty($user_date_added))  {?>

                            <?php echo $user_date_added; ?>

                          <?php }?>
                     
                        </strong>
                      </span>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                      <i class="fa fa-clock-o fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <small class="text-muted text-uc">You Last logged in at</small>

                      <span class="block m-t-xs">
                        <strong>

                          <?php if(!empty($user_last_login))  {?>

                            <?php echo $user_last_login; ?>

                          <?php }?>

                        </strong>
                      </span>
                    </a>
                  </div>
                </div>
              </section>


              <div class="row">

                <div class="col-lg-4">
                  <section class="panel panel-default">
                    <div class="panel-body">
                      <div class="clearfix text-center m-t">
                        <div class="inline">
                          <a href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $this->flexi_auth->get_user_id(); ?>">

                            <div class="thumb-lg">

                            <?php if(!empty($user_avatar)) {?>

                              <img src="<?php echo base_url() . $user_avatar;?>" class="img-circle">

                            <?php } else { ?>

                              <span class="fa-stack fa-4x pull-center m-r-sm">
                                <i class="fa fa-circle fa-stack-2x text-dark"></i>
                                <i class="fa fa-user fa-stack-1x text-white"></i>
                              </span>

                            <?php }?>

                            </div>

                          </a>

                          <div class="h4 m-t m-b-xs">

                            <?php echo $user_full_name; ?>

                          </div>

                          <div class="h4 m-t m-b-xs">

                            <?php echo $this->flexi_auth->get_user_identity(); ?>

                          </div>

                          <small class="text-muted m-b">

                            <?php echo $user_group_desc; ?>

                          </small>


                        </div>                      
                      </div>
                    </div>
                    <footer class="panel-footer bg-info text-center">
                      <div class="row pull-out">
                        <div class="col-xs-4">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white"></span>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                        <div class="col-xs-4 dk">
                          <div class="padder-v">
                            <small class="text-muted"></small>

                            <span class="m-b-xs h3 block text-white">

                              <?php echo ($this->flexi_auth->is_admin()) ? 'Admin' : 'Not Admin'; ?>

                            </span>

                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white"></span>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </footer>
                  </section>
                </div>

                <div class="col-sm-4 portlet">

                  <section class="panel panel-info portlet-item">
                    <header class="panel-heading">
                      Articles You Created
                    </header>
                    <div class="list-group bg-white">

                    <?php if(!empty($user_articles)) {?>
                      <?php foreach($user_articles AS $user_article): ?>

                        <a href="<?php echo base_url() . 'admin/blog/edit_blog_article/' . $user_article->id; ?>" class="list-group-item">
                          
                          <i class="fa fa-2x text-danger fa-file-text-o"></i> 

                            <?php echo $user_article->title; ?>

                        </a>

                      <?php endforeach;?>
                    <?php }?>
                      
                    </div>
                  </section>

                </div>

                <div class="col-sm-4 portlet">

                  <section class="panel panel-success portlet-item">
                    <header class="panel-heading">
                      Last 10 Added Articles by all users
                    </header>
                    <div class="list-group bg-white">

                      <?php if(!empty($get_10_latest_published_articles)) {?>
                        <?php foreach($get_10_latest_published_articles AS $article): ?>

                          <a href="<?php echo base_url() . 'admin/blog/edit_blog_article/' . $article->id; ?>" class="list-group-item">
                            <i class="fa fa-2x text-warning fa-file-text"></i> 

                              <?php echo $article->title; ?>

                          </a>

                        <?php endforeach;?>
                      <?php }?>

                    </div>
                  </section>

                </div>

              </div>

            </section><!-- Ends Section Scrollable Wrapper -->
          </section><!-- Ends VBOX Wrapper -->
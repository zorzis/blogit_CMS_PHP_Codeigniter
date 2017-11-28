<section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" target="_blank" href="http://www.haze.gr/blogit"><?php echo $this->lang->line('cms_title');?></a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong><?php echo $this->lang->line('login');?></strong>
        </header>

          <span>
            <h6>
              Demo Admin Login:
            </h6>
            <p>username: <b>admin</b></p>
            <p>password: <b>password</b></p>
          </span>
          <br/>
          <span>
            <h6>
              Demo Editor Login:
            </h6>
            <p>username: <b>non_admin</b></p>
            <p>password: <b>password</b></p>
          </span>
        
        

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

        <?php echo form_open(current_url(), 'class="panel-body wrapper-lg"');?>
          <div class="form-group">
            <label class="control-label"><?php echo $this->lang->line('username');?></label>
            <input type="text" id="identity" name="login_identity" placeholder="Username or Email" value="<?php echo set_value('login_identity');?>" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label"><?php echo $this->lang->line('password');?></label>
            <input type="password" id="password" name="login_password" value="<?php echo set_value('login_password');?>" placeholder="<?php echo $this->lang->line('password');?>" class="form-control input-lg">
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" id="remember_me" name="remember_me" value="1" <?php echo set_checkbox('remember_me', 1); ?>/> <?php echo $this->lang->line('remember_me');?>
            </label>
          </div>
          <!-- <a href="#" class="pull-right m-t-xs"><small><?php //echo $this->lang->line('forgot_password');?></small></a> -->
          <button type="submit" name="login_user" id="submit" value="Submit" class="btn btn-primary"><?php echo $this->lang->line('login');?></button>
          <div class="line line-dashed"></div>
          <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p> -->
          <!-- <a href="<?php //echo base_url()?>auth/register_account" class="btn btn-default btn-block"><?php //echo $this->lang->line('register');?></a> -->
        <?php echo form_close();?>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>BlogIt<br>&copy; 2015</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
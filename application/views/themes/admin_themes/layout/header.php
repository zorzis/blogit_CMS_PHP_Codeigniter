<div class="navbar-header aside-md">
  <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav">
    <i class="fa fa-bars"></i>
  </a>

  <a href="<?php echo base_url(); ?>admin/" class="navbar-brand">
    <i class="fa fa-rocket text-primary"></i>

    <span><?php echo $this->lang->line('cms_title');?></span>

  </a>

  <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
    <i class="fa fa-cog"></i>
  </a>
</div>
<ul class="nav navbar-nav hidden-xs">
  <li class="dropdown">
    <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-xs btn-primary">
      <i class="fa fa-heart-o fa-2x text-warning"></i> 
      <span class="h4 font-bold">Visit Webpage</span>
    </a>
  </li>
</ul>      
<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <span class="thumb-sm avatar pull-left">

        <?php if(!empty($user_avatar)) {?>

          <img src="<?php echo base_url() . $user_avatar;?>">

        <?php } else { ?>

          <img src="<?php echo base_url(); ?>assets/themes/admin/images/default_avatar.png">

        <?php }?>

      </span>

      <?php echo $user_full_name; ?>

      <b class="caret"></b>
    </a>
    <ul class="dropdown-menu animated fadeInRight">
      <span class="arrow top"></span>
      <li>
        <a href="<?php echo base_url(); ?>admin/users/update_user_account/<?php echo $this->flexi_auth->get_user_id(); ?>"><i class="fa fa-user text-primary"></i> <?php echo $this->lang->line('edit_profile')?></a>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>documents/documentation.html" target="_blank" class="active">
          <i class="fa fa-info-circle icon text-info"></i>
          <span>Help</span>
        </a>
      </li>
      <li class="divider"></li>
      <li>
        <a href="<?php echo base_url(); ?>auth/logout/"><i class="fa fa-sign-out text-danger"></i> <?php echo $this->lang->line('logout');?></a>
      </li>
    </ul>
  </li>
</ul>      
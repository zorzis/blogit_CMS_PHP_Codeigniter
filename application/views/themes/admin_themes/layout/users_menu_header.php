            <header class="header bg-white b-b b-light">
              <p><i class="fa fa-users"></i> <?php echo $this->lang->line('users');?></p>
              <div class="btn-group pull-right">
              	<a href="<?php echo base_url(); ?>admin/users/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-user"></i> <?php echo $this->lang->line('users');?></a>
              	<a href="<?php echo base_url(); ?>admin/users/create_user_account" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-user"></i> <?php echo $this->lang->line('create_new_user');?></a>
              	<a href="<?php echo base_url(); ?>admin/users/usergroups" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-users"></i> <?php echo $this->lang->line('usergroups');?></a>
              	<a href="<?php echo base_url(); ?>admin/users/insert_user_group" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-users"></i> <?php echo $this->lang->line('create_new_users_group');?></a>
              	<a href="<?php echo base_url(); ?>admin/users/privileges" class="hidden-xs btn btn-sm btn-warning"><i class="fa fa-key"></i> <?php echo $this->lang->line('privileges');?></a>
              	<a href="<?php echo base_url(); ?>admin/users/insert_privilege" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-key"></i> <?php echo $this->lang->line('create_privilege');?></a>

              </div>
            </header>
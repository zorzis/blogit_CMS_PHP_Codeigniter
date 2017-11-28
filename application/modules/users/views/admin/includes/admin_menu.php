                      <!--Start-> Checks if the uri segment is /admin/users/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='users')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/users/ and if yes active class for the aside user menu is TRUE else False -->
                       <a href="#"  >
                        <i class="fa fa-users icon">
                         <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">
                      	 <i class="fa fa-angle-down text"></i>
                      	 <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('users');?></span>
                       </a>
                       <ul class="nav lt">
                       	<li>
                            <a href="<?php echo base_url(); ?>admin/users/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_users');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/users/create_user_account/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('add_user');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/users/usergroups/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_users_groups');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/users/insert_user_group/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('add_usergroup');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/users/privileges/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_privileges');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/users/insert_privilege/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('add_privilege');?></span>
                            </a>
                          </li>
                        </ul>
                      </li>

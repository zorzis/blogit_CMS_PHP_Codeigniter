                      <!--Start-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='menus')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                       <a href="#"  >
                        <i class="fa fa-list-alt icon">
                         <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">
                         <i class="fa fa-angle-down text"></i>
                         <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('menus');?></span>
                       </a>
                       <ul class="nav lt">
                          <li>
                            <a href="<?php echo base_url(); ?>admin/menus/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_menus');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/menus/create_menu/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('add_menu');?></span>
                            </a>
                          </li>
                        </ul>
                      </li>

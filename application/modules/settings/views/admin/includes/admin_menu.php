                      <!--Start-> Checks if the uri segment is /admin/settings/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='settings')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/settings/ and if yes active class for the aside user menu is TRUE else False -->
                        <a href="<?php echo base_url(); ?>admin/settings/" >                                                        
                          <i class="fa fa-gear icon">
                           <b class="bg-danger"></b>
                          </i>

                          <span><?php echo $this->lang->line('settings');?></span>
                        </a>
                      </li>

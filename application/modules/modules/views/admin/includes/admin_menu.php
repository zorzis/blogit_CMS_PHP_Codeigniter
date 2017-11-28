                      <!--Start-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules')? 'active' : ''; ?>">
                        <!--Ehd-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                        <a href="#"  >
                          <i class="fa fa-sitemap icon">
                           <b class="bg-warning"></b>
                         </i>
                         <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('modules');?></span>
                      </a>
                      <ul class="nav lt">
                        <li>
                          <a href="<?php echo base_url(); ?>admin/modules/" >                                                        
                           <i class="fa fa-angle-right"></i>
                           <span><?php echo $this->lang->line('manage_modules');?></span>
                         </a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules' && $this->uri->segment(3)=='create_custom_module')? 'active' : ''; ?>">
                          <a href="<?php echo base_url(); ?>admin/modules/create_custom_module/" >                                                        
                            <i class="fa fa-code text-warning"></i>
                            <span><?php echo $this->lang->line('add_custom_module');?></span>
                          </a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules' && $this->uri->segment(3)=='create_images_slider_module')? 'active' : ''; ?>">
                          <a href="<?php echo base_url(); ?>admin/modules/create_images_slider_module/" >                                                        
                           <i class="fa fa-youtube-play text-warning"></i>
                           <span><?php echo $this->lang->line('add_images_slider_module');?></span>
                         </a>
                        </li> 
                        <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules' && $this->uri->segment(3)=='create_portfolio_module')? 'active' : ''; ?>">
                          <a href="<?php echo base_url(); ?>admin/modules/create_portfolio_module/" >                                                        
                           <i class="fa fa-briefcase text-warning"></i>
                           <span><?php echo $this->lang->line('add_portfolio_module');?></span>
                         </a>
                        </li> 
                        <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules' && $this->uri->segment(3)=='create_menu_module')? 'active' : ''; ?>">
                          <a href="<?php echo base_url(); ?>admin/modules/create_menu_module/" >                                                        
                            <i class="fa fa-list text-warning"></i>
                            <span><?php echo $this->lang->line('add_menu_module');?></span>
                          </a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules' && $this->uri->segment(3)=='create_latest_articles_module')? 'active' : ''; ?>">
                          <a href="<?php echo base_url(); ?>admin/modules/create_latest_articles_module/" >                                                        
                            <i class="fa fa-coffee text-warning"></i>
                            <span><?php echo $this->lang->line('add_latest_articles_module');?></span>
                          </a>
                        </li> 
                        <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='modules' && $this->uri->segment(3)=='create_popular_articles_module')? 'active' : ''; ?>">
                          <a href="<?php echo base_url(); ?>admin/modules/create_popular_articles_module/" >                                                        
                            <i class="fa fa-coffee text-warning"></i>
                            <span><?php echo $this->lang->line('add_popular_articles_module');?></span>
                          </a>
                        </li>                                                            
                      </ul>
                    </li>

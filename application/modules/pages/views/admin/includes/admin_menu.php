                      <!--Start-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='pages')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                       <a href="#"  >
                        <i class="fa fa-file-o icon">
                         <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                         <i class="fa fa-angle-down text"></i>
                         <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('pages');?></span>
                       </a>
                       <ul class="nav lt">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/pages/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_pages');?></span>
                            </a>
                          </li>
                          <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='pages' && $this->uri->segment(3)=='create_custom_page')? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>admin/pages/create_custom_page/" >                                                        
                               <i class="fa fa-code text-warning"></i>
                             <span><?php echo $this->lang->line('add_custom_page');?></span>
                            </a>
                          </li>
                          <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='pages' && $this->uri->segment(3)=='create_blog_page')? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>admin/pages/create_blog_page/" >                                                        
                               <i class="fa fa-edit text-warning"></i>
                             <span><?php echo $this->lang->line('add_blog_page');?></span>
                            </a>
                          </li>
                          <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='pages' && $this->uri->segment(3)=='create_portfolio_page')? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>admin/pages/create_portfolio_page/" >                                                        
                               <i class="fa fa-briefcase text-warning"></i>
                             <span><?php echo $this->lang->line('add_portfolio_page');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/pages/create_external_url_page/" >                                                        
                               <i class="fa fa-chain text-warning"></i>
                             <span><?php echo $this->lang->line('add_custom_url');?></span>
                            </a>
                          </li>
                        </ul>
                      </li>

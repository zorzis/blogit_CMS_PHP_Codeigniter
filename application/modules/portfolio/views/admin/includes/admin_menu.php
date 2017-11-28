                      <!--Start-> Checks if the uri segment is /admin/portfolio/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='portfolio')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/portfolio/ and if yes active class for the aside user menu is TRUE else False -->
                       <a href="#"  >
                        <i class="fa fa-briefcase icon">
                         <b class="bg-info"></b>
                        </i>
                        <span class="pull-right">
                      	 <i class="fa fa-angle-down text"></i>
                      	 <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('portfolio');?></span>
                       </a>
                       <ul class="nav lt">
                       	<li>
                            <a href="<?php echo base_url(); ?>admin/portfolio/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_portfolio');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/portfolio/create_portfolio_project/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('add_portfolio_project');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/portfolio/categories/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_portfolio_categories');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/portfolio/categories/create_portfolio_category" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('create_portfolio_categories');?></span>
                            </a>
                          </li>
                        </ul>
                      </li>

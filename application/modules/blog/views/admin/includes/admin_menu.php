                      <!--Start-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='blog')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                       <a href="#"  >
                        <i class="fa fa-edit icon">
                         <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                      	 <i class="fa fa-angle-down text"></i>
                      	 <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('blog');?></span>
                       </a>
                       <ul class="nav lt">
                       	<li>
                            <a href="<?php echo base_url(); ?>admin/blog/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_blog');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/blog/create_blog_article/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('add_blog_article');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/blog/categories/" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('manage_blog_categories');?></span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url(); ?>admin/blog/categories/create_blog_category" >                                                        
                               <i class="fa fa-angle-right"></i>
                             <span><?php echo $this->lang->line('create_blog_categories');?></span>
                            </a>
                          </li>
                        </ul>
                      </li>

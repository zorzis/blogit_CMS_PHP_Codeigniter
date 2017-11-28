                      <!--Start-> Checks if the uri segment is /admin/templates/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='templates')? 'active' : ''; ?>">
                        <!--Ehd-> Checks if the uri segment is /admin/templates/ and if yes active class for the aside user menu is TRUE else False -->
                        <a href="#"  >
                          <i class="fa fa-tint icon">
                           <b class="bg-warning"></b>
                         </i>
                         <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span><?php echo $this->lang->line('templates');?></span>
                      </a>
                      <ul class="nav lt">
                        <li>
                          <a href="<?php echo base_url(); ?>admin/templates/" >                                                        
                           <i class="fa fa-angle-right"></i>
                           <span><?php echo $this->lang->line('manage_templates');?></span>
                         </a>
                       </li>
                       <li>
                        <a href="<?php echo base_url(); ?>admin/templates/create_template" >                                                        
                         <i class="fa fa-angle-right"></i>
                         <span><?php echo $this->lang->line('add_template');?></span>
                       </a>
                     </li>
                   </ul>
                 </li>

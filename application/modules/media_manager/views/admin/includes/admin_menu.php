                      <!--Start-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                      <li class="<?php echo ($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='media_manager')? 'active' : ''; ?>">
                      <!--Ehd-> Checks if the uri segment is /admin/blog/ and if yes active class for the aside user menu is TRUE else False -->
                       <a href="<?php echo base_url(); ?>admin/media_manager/" >
                        <i class="fa fa-youtube-play icon">
                         <b class="bg-success"></b>
                        </i>
                        <span><?php echo $this->lang->line('media_manager');?></span>
                       </a>
                      </li>

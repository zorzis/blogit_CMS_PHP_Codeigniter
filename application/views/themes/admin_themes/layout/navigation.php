<!-- .aside -->
<aside class="bg-dark lter aside-md hidden-print" id="nav">          
  <section class="vbox">
    <header class="header bg-primary lter text-center clearfix">
      <div class="btn-group">
        <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button>
        <div class="btn-group hidden-nav-xs">
          <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
            New
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu text-left">
            <li><a href="<?php echo base_url(); ?>admin/blog/create_blog_article">Article</a></li>
            <li><a href="<?php echo base_url(); ?>admin/portfolio/create_portfolio_project">Project</a></li>
            <li><a href="<?php echo base_url(); ?>admin/pages/create_blog_page">Blog Page</a></li>
            <li><a href="<?php echo base_url(); ?>admin/pages/create_portfolio_page">Portfolio Page</a></li>
            <li><a href="<?php echo base_url(); ?>admin/pages/create_custom_page">Custom HTML Page</a></li>
          </ul>
        </div>
      </div>
    </header>
    <section class="w-f scrollable">
      <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
        
        <!-- nav -->
        <nav class="nav-primary hidden-xs">
          <ul class="nav">

            <li  class="active">
              <a href="<?php echo base_url(); ?>admin" class="active">
                <i class="fa fa-lightbulb-o icon">
                  <b class="bg-danger"></b>
                </i>
                <span>Home</span>
              </a>
            </li>

            <?php 
            $module_path = APPPATH . 'modules/';
            $menu_path = '/views/admin/includes/admin_menu.php';
            
            $module = 'blog'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'portfolio'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'menus'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'pages'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'modules'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'users'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'templates'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'media_manager'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);
            $module = 'settings'; if (file_exists($module_path . $module)) include ($module_path . $module . $menu_path);

            ?>


            <li class="active">
              <a href="<?php echo base_url(); ?>documents/documentation.html" target="_blank" class="active">
                <i class="fa fa-info-circle icon">
                  <b class="bg-info"></b>
                </i>
                <span>Help</span>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- / nav -->
      </div>
    </section>

    <footer class="footer lt hidden-xs b-t b-dark">
      <div class="btn-group hidden-nav-xs">
        <p><?php echo $this->config->item('cms_version');?> | Powered by <a href="http://www.haze.gr" target="_blank">haze</a></p>            
      </div>
      <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
        <i class="fa fa-angle-left text"></i>
        <i class="fa fa-angle-right text-active"></i>
      </a>
    </footer>
  </section>
</aside>
        <!-- /.aside -->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Controller extends Authentication_Controller {
 
    function __construct() 
    {
        parent::__construct();

        //The profiler works only in the development environment not in the production or testing
		//$this->output->enable_profiler(ENVIRONMENT == 'development'); 

		// Check user is logged in as an admin.
		// For security, admin users should always sign in via Password rather than 'Remember me'.
		if ( ! $this->flexi_auth->is_logged_in() || ! $this->flexi_auth->is_admin()) 
		{
			// Set a custom error message.
			//$this->flexi_auth->set_error_message('You must login as an admin to access this area.', TRUE);
			//$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			redirect('auth');
		}

		// Define a global variable to store data that is then used by the end view page.
		$this->data = null;

		

		// Sets the function for the template using in the backend in above code
		$this->_init();


		/*************************************************************************************/
		//LOAD MODELS FROM MODULES


		//Load the page model
        $this->load->model('pages/page_m');
        //Load the blog model
        $this->load->model('blog/article_m');        
        //Load the portfolio model
        $this->load->model('portfolio/portfolio_m');
        //Load the blog categories
        $this->load->model('categories/blog_categories_m');        
        //Load the portfolio categories
        $this->load->model('portfolio_categories/portfolio_categories_m');
        //Load the modules model
        $this->load->model('modules/module_m');
        //Load the menu model
        $this->load->model('menus/menu_m');
        //Load the settings model
        $this->load->model('settings/settings_m');
        //Load the Templates model
        $this->load->model('templates/templates_m');
        //Load Dashboard Functions Model
        $this->load->model('dashboard_model');


        /*************************************************************************************/	
	}

		/* ---------- Initializes the Admin Template Structure-------------------*/
		private function _init()
		{
			//We set the session for CKEDITOR Filemanger Session
			$this->session->set_userdata('upload_image_file_manager',true);

			// LOADS USER VARIABLES 	
			$user = $this->flexi_auth->get_user_by_id_row_array();

			$this->data['user_full_name'] = (! empty($user)) ? $user['upro_first_name'].' '.$user['upro_last_name'] : null;
			//$this->data['user_phone'] = (! empty($user)) ?  $user['upro_phone'] : null;
			$this->data['user_last_login'] = (! empty($user)) ? date('jS M Y @ H:i:s', strtotime($user['uacc_date_last_login'])) : null;
			$this->data['user_group_desc'] = (! empty($user)) ? $user['ugrp_desc'] : null;
			$this->data['user_avatar'] = (! empty($user)) ?  $user['upro_avatar'] : null;
			$this->data['user_date_added'] = (! empty($user)) ? date('jS M Y @ H:i:s', strtotime($user['uacc_date_added'])) : null;

			$this->output->set_template('admin_themes/admin');

			// CSS files
			$this->load->css('assets/themes/admin/css/bootstrap.css');
			$this->load->css('assets/themes/admin/css/animate.css');
			$this->load->css('assets/themes/admin/css/font-awesome.min.css');
			$this->load->css('assets/themes/admin/css/app.css');
			$this->load->css('assets/themes/admin/css/font.css');
			$this->load->css('assets/themes/admin/js/select2/select2.css');
			$this->load->css('assets/themes/admin/js/select2/theme.css');
			$this->load->css('assets/themes/admin/js/fuelux/fuelux.css');
			$this->load->css('assets/themes/admin/js/datepicker/datepicker.css');
			$this->load->css('assets/themes/admin/js/slider/slider.css');
			$this->load->css('assets/themes/admin/css/custom.css');

			// JS files
			$this->load->js('assets/themes/admin/js/jquery.min.js');
			$this->load->js('assets/themes/admin/js/bootstrap.js');
			$this->load->js('assets/themes/admin/js/app.js');
			$this->load->js('assets/themes/admin/js/app.plugin.js');
			$this->load->js('assets/themes/admin/js/slimscroll/jquery.slimscroll.min.js');
			$this->load->js('assets/themes/admin/js/datepicker/bootstrap-datepicker.js');
			$this->load->js('assets/themes/admin/js/fuelux/fuelux.js');
			$this->load->js('assets/themes/admin/js/slider/bootstrap-slider.js');
			$this->load->js('assets/themes/admin/js/file-input/bootstrap-filestyle.min.js');
			$this->load->js('assets/themes/admin/js/select2/select2.min.js');
			// wysiwyg 
			$this->load->js('assets/themes/admin/ckeditor/ckeditor.js');
			$this->load->js('assets/themes/admin/js/wysiwyg/bootstrap-wysiwyg.js');
			//Nested Sortable jQuery
			$this->load->js('assets/themes/admin/js/jquery-ui-1.10.3.custom.min.js');
			$this->load->js('assets/themes/admin/js/jquery.mjs.nestedSortable.js');

			//File Browser
			$this->load->js('assets/themes/admin/js/bootbox.min.js');
			//File Browser Upload Jquery Form JS
			$this->load->js('assets/themes/admin/js/jquery.form.js');



			


			// Loading sections using Codeigniter Simplicity Template Library
			$this->load->section('header', 'themes/admin_themes/layout/header', $this->data);
			$this->load->section('navigation', 'themes/admin_themes/layout/navigation', $this->data);
			$this->load->section('users_menu_header', 'themes/admin_themes/layout/users_menu_header', $this->data);





		}
		/* ---------- Initializes the Admin Template Structure-------------------*/

}
/* End of file Backend_Controller.php */
/* Location: ./application/core/Backend_Controller.php */

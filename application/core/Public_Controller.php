<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_Controller extends CI_Controller {
 
    function __construct() 
    {
        parent::__construct();

        //The profiler works only in the development environment not in the production or testing
		//$this->output->enable_profiler(ENVIRONMENT == 'development'); 

		// IMPORTANT! This global must be defined BEFORE the flexi auth library is loaded! 
 		// It is used as a global that is accessible via both models and both libraries, without it, flexi auth will not work.
		$this->auth = new stdClass;

		//Load Frontend Model
		$this->load->model('frontend_model');
		//Load the page model
        $this->load->model('pages/page_m');
        //Load the blog model
        $this->load->model('blog/article_m');
        //Load the blog categories
        $this->load->model('categories/blog_categories_m');        
        //Load the portfolio model
        $this->load->model('portfolio/portfolio_m');
        //Load the portfolio categories
        $this->load->model('portfolio_categories/portfolio_categories_m');
        //Load the modules model
        $this->load->model('modules/module_m');
        //Load the page model
        $this->load->model('menus/menu_m');
        //Load the Templates model
        $this->load->model('templates/templates_m');

        //Load file and directory helpers
		$this->load->helper('directory');
		$this->load->helper('file');

        //LOADS FLEXI AUTH LITE LIBRARY
		$this->load->library('flexi_auth_lite');	

		// Sets the function for the template using in the backend in above code
		$this->_init();

	}

	/* ---------- Initializes the Admin Template Structure-------------------*/
	private function _init()
	{
		$default_template_data = $this->frontend_model->get_default_template();
		$default_template = $default_template_data->title;
		$default_template_assets_folder = 'assets/themes/public_templates/' . $default_template . '/';

		// LOADS USER VARIABLES 	
		$user = $this->flexi_auth_lite->get_user_by_id_row_array();

		$this->data['user_full_name'] = (! empty($user)) ? $user['upro_first_name'].' '.$user['upro_last_name'] : null;
		$this->data['user_phone'] = (! empty($user)) ?  $user['upro_phone'] : null;
		$this->data['user_last_login'] = (! empty($user)) ? date('jS M Y @ H:i:s', strtotime($user['uacc_date_last_login'])) : null;
		$this->data['user_group_desc'] = (! empty($user)) ? $user['ugrp_desc'] : null;
		
		$this->output->set_template($default_template . '/main');

		//******************************************************************************************************//
		//																										//
		//											CSS AUTO loader 											//
		//																										//
		//******************************************************************************************************//

		//Get default template css files located at assets/themes/public_templates/**Template_Name**/css/***CSS_FILES***
		$css_path = $default_template_assets_folder . 'css/';

		if(is_dir($css_path))
		{

			$css_media = directory_map(realpath($css_path));

			foreach ($css_media AS $key=>$value)
			{

				if (!is_array($value))
				{
					// Get file extension
					$file_ext = strtolower(end(explode('.', $value)));
					
					switch($file_ext)
					{
						// CSS files only
						case 'css':
						
						// Setup a counter for looping through post arrays
						$css_count = count($value);

						for ($i=0; $i < $css_count; $i++) { 
						    $css_files[] = array(

								'name'		 => $value,										
								'path' 		 => $css_path. $value,
						        
						    );
						}

					}
				}
			}
		}

		// CSS files
		foreach ($css_files as $css)
		{
			$this->load->css($css['path']);
		}


		//******************************************************************************************************//
		//																										//
		//											JS AUTO loader 											    //
		//																										//
		//******************************************************************************************************//

		//Get default template css files located at assets/themes/public_templates/**Template_Name**/css/***CSS_FILES***
		$js_path = $default_template_assets_folder . 'js/';

		if(is_dir($js_path))
		{

			$css_media = directory_map(realpath($js_path));

			foreach ($css_media AS $key=>$value)
			{

				if (!is_array($value))
				{
					// Get file extension
					$file_ext = strtolower(end(explode('.', $value)));
					
					switch($file_ext)
					{
						// CSS files only
						case 'js':
						
						// Setup a counter for looping through post arrays
						$js_count = count($value);

						for ($i=0; $i < $js_count; $i++) { 
						    $js_files[] = array(

								'name'		 => $value,										
								'path' 		 => $js_path. $value,
						        
						    );
						}

					}
				}
			}
		}

		// JS files
		foreach ($js_files as $js)
		{
			$this->load->js($js['path']);
		}

	}
	/* ---------- Initializes the Admin Template Structure-------------------*/

}
/* End of file Backend_Controller.php */
/* Location: ./application/core/Backend_Controller.php */

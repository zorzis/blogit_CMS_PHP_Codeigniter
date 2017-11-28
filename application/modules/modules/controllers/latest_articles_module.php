<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Latest_articles_module extends Backend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function create ()
	{
	    // Check user has privileges to create blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Module'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create modules.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
		$this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');   
		$this->form_validation->set_rules('show_title','Show Title','integer');  
		$this->form_validation->set_rules('is_published','Is Publish','integer');
		$this->form_validation->set_rules('order','Module Order','integer');
        $this->form_validation->set_rules('limit_articles_number','Limit Articles','integer|numeric');

		if($this->form_validation->run() == FALSE)
		{ 

			//Get Blog Categories
			$this->data['categories'] = $this->blog_categories_m->get_blog_categories();

			//if(!empty($this->templates_m->get_default_template()))
			//{

				//*******************************************************************************************************/
				//
				//									Modules layouts and Template Positions 									
				//
				/*******************************************************************************************************/
				
				//Get default Template to assing positions
				$default_template_id = $this->templates_m->get_default_template()->id;
				$default_template_name = $this->templates_m->get_default_template()->title;

				//Get default template positions
				$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template_name . '/positions';
				$extensions = array('php');

				//Get template positions from application/views/themes/**custom_theme_name**/modules_layouts/blog_modules
				$this->data['template_positions'] = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);


				//Get Custom Module Layouts
				$this->data['path_to_latest_articles_blog_module_layouts'] = APPPATH . 'views/themes/' . $default_template_name . '/modules_layouts/blog_modules/latest_articles';
				$extensions = array('php');
				//
				$this->data['blog_module_layouts'] = get_filenames_by_extension($this->data['path_to_latest_articles_blog_module_layouts'], $extensions);

				/*******************************************************************************************************/
			//}

			//Get Access Privileges
			$this->data['privileges'] = $this->module_m->get_privileges();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('modules/admin/module_latest_articles_create', $this->data);
		} 

		else{

            // ********************************************************************************** //
            //
            //							Create modules Data Array
            //
			// ********************************************************************************** //

			$data = array(
				'title'						=> $this->input->post('title'), 
				'module_type' 				=> 'latest_blog_articles_module', //latest blog articles module content
				'is_published' 				=> $this->input->post('is_published'),
				'show_title' 				=> $this->input->post('show_title'),
				'set_order'     			=> $this->input->post('order'),
				'privilege_id'				=> $this->input->post('module_access_level'),
				'position'					=> $this->input->post('module_position'),
				'module_layout'				=> $this->input->post('module_layout'),
				'limit_articles_number'		=>$this->input->post('limit_articles_number'),

				);

            //Post Insert
			$this->module_m->insert($data);

           	//Get the last insert id of modules table from the module insert.
            $last_module_id = $this->module_m->get_insert_id();
            $next_module_id = $last_module_id;

            // ********************************************************************************** //
            //
            //							Create blog_module Data Array
            //
			// ********************************************************************************** //

            //Create Module Blog Content Latest Articles Data Array
            foreach ($this->input->post('category') as $category)
			{
				$latest_articles_from_categories = array(
					'module_id'					=> $next_module_id,
					'category_id'				=> $category,
				); 
			
				//Custom Module Insert
		        $this->db->insert('module_blog_content',$latest_articles_from_categories);

			};


			$this->session->set_flashdata('message', '<p>Latest Articles Module Created Succesfully!</p>');


			redirect('admin/modules');
		}    

	}

	public function update ($module_id = NULL)
	{
	    // Check user has privileges to update blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update modules.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
		$this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');   
		$this->form_validation->set_rules('show_title','Show Title','integer');  
		$this->form_validation->set_rules('is_published','Is Publish','integer');
		$this->form_validation->set_rules('order','Module Order','integer');
        $this->form_validation->set_rules('limit_articles_number','Limit Articles','integer|numeric');

		if($this->form_validation->run() == FALSE)
		{ 

		    //Get the post to edit 
			$this->data['module'] = $this->module_m->get_latest_articles_module($module_id);

			//Get Blog Categories
			$this->data['categories'] = $this->blog_categories_m->get_blog_categories();

	    	//Get pages assigned to current menu, based on menu_id on menu_items table for eah raw
	    	$current_blog_module_categories = $this->module_m->current_blog_module_categories($module_id);

	    	$this->data['current_blog_module_categories'] = array();
	    	foreach($current_blog_module_categories as $category)
	    	{
	    		$this->data['current_blog_module_categories'][] = $category->category_id;
	    	}

			//if(!empty($this->templates_m->get_default_template()))
			//{

				//*******************************************************************************************************/
				//
				//									Modules layouts and Template Positions 									
				//
				/*******************************************************************************************************/
				
				//Get default Template to assing positions
				$default_template_id = $this->templates_m->get_default_template()->id;
				$default_template_name = $this->templates_m->get_default_template()->title;

				//Get default template positions
				$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template_name . '/positions';
				$extensions = array('php');

				//Get template positions from application/views/themes/**custom_theme_name**/modules_layouts/blog_modules
				$this->data['template_positions'] = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);


				//Get Custom Module Layouts
				$this->data['path_to_latest_articles_blog_module_layouts'] = APPPATH . 'views/themes/' . $default_template_name . '/modules_layouts/blog_modules/latest_articles';
				$extensions = array('php');
				//
				$this->data['blog_module_layouts'] = get_filenames_by_extension($this->data['path_to_latest_articles_blog_module_layouts'], $extensions);

				/*******************************************************************************************************/

			//}
			
			//Get Access Privileges
			$this->data['privileges'] = $this->module_m->get_privileges();

    		//Get Created By name for logging events
			$this->data['created_by'] = $this->module_m->get_created_by($module_id);

    		//Get Modified By for logging events
			$this->data['modified_by'] = $this->module_m->get_modified_by($module_id);

			//Get module positions for dropdown selection form
    		//$this->data['positions'] = $this->module_m->get_module_positions();

			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

			// Load the view
			$this->load->view('modules/admin/module_latest_articles_update', $this->data);
		}

		else {

            //Create modules Data Array
			$data = array(
				'title'						=> $this->input->post('title'), 
				'module_type' 				=> 'latest_blog_articles_module', //latest blog articles module content
				'is_published' 				=> $this->input->post('is_published'),
				'show_title' 				=> $this->input->post('show_title'),
				'set_order'     			=> $this->input->post('order'),
				'privilege_id'				=> $this->input->post('module_access_level'),
				'position'					=> $this->input->post('module_position'),
				'module_layout'				=> $this->input->post('module_layout'),
				'limit_articles_number'		=>$this->input->post('limit_articles_number'),
				);

			//Module Update
			$this->module_m->update_by(array('id'=>$module_id), $data);

            // ********************************************************************************** //
            //
            //							Create blog_module latest articles Data Array
            //
			// ********************************************************************************** //

			//Custom Module Update
	        $this->module_m->update_module_blog_content($module_id);


			$this->session->set_flashdata('message', '<p>Latest Articles Module Updated Succesfully!</p>');


			redirect('admin/modules');
		}  

	}
}
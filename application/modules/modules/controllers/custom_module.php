<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Custom_module extends Backend_Controller
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

		//Module Custom Content
        $this->form_validation->set_rules('module_body','Module Body','trim|required');

		if($this->form_validation->run() == FALSE)
		{ 

			//if(!empty($this->templates_m->get_default_template()))
			//{

				//Get default Template to assing positions
				$default_template_id = $this->templates_m->get_default_template()->id;
				$default_template_name = $this->templates_m->get_default_template()->title;

				//Get template positions
				$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template_name . '/positions';
				$extensions = array('php');

				$this->data['template_positions'] = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);


				//Get Custom Module Layouts
				$this->data['path_to_custom_module_layouts'] = APPPATH . 'views/themes/' . $default_template_name . '/modules_layouts/custom_modules';
				$extensions = array('php');

				$this->data['custom_module_layouts'] = get_filenames_by_extension($this->data['path_to_custom_module_layouts'], $extensions);
			//}

			//Get Access Privileges
			$this->data['privileges'] = $this->module_m->get_privileges();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('modules/admin/module_custom_create', $this->data);
		} 

		else{

            // ********************************************************************************** //
            //
            //							Create modules Data Array
            //
			// ********************************************************************************** //

			$data = array(
				'title'				=> $this->input->post('title'), 
				'module_type' 		=> 'custom_module', //custom module content
				'is_published' 		=> $this->input->post('is_published'),
				'show_title' 		=> $this->input->post('show_title'),
				'set_order'     	=> $this->input->post('order'),
				'privilege_id'		=> $this->input->post('module_access_level'),
				'position'			=> $this->input->post('module_position'),
				'module_layout'		=> $this->input->post('module_layout'),
				);

            //Post Insert
			$this->module_m->insert($data);

           	//Get the last insert id of modules table from the module insert.
            $last_module_id = $this->module_m->get_insert_id();
            $next_module_id = $last_module_id;

            // ********************************************************************************** //
            //
            //							Create custom_module Data Array
            //
			// ********************************************************************************** //

            //Create Module Custom Content Data Array
			$data = array(
				'module_id'					=> $next_module_id,
				'body'						=> $this->input->post('module_body'),
			); 

			//Custom Module Insert
	        $this->module_m->add_module_custom_content($data);


			$this->session->set_flashdata('message', '<p>Custom Module Created Succesfully!</p>');


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

		//Module Custom Content
        $this->form_validation->set_rules('module_body','Module Body','trim|required');

		if($this->form_validation->run() == FALSE)
		{ 

		    //Get the post to edit 
			$this->data['module'] = $this->module_m->get_custom_module($module_id);

			//if(!empty($this->templates_m->get_default_template()))
			//{

				//Get default Template to assing positions
				$default_template_id = $this->templates_m->get_default_template()->id;
				$default_template_name = $this->templates_m->get_default_template()->title;

				//Get template positions
				$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template_name . '/positions';
				$extensions = array('php');

				$this->data['template_positions'] = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);

				//Get Access Privileges
				$this->data['privileges'] = $this->module_m->get_privileges();

				//Get Custom Module Layouts
				$this->data['path_to_custom_module_layouts'] = APPPATH . 'views/themes/' . $default_template_name . '/modules_layouts/custom_modules';
				$extensions = array('php');

				$this->data['custom_module_layouts'] = get_filenames_by_extension($this->data['path_to_custom_module_layouts'], $extensions);
			//}
			
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
			$this->load->view('modules/admin/module_custom_update', $this->data);
		}

		else {

            //Create modules Data Array
			$data = array(
				'title'				=> $this->input->post('title'),
				'module_type' 		=> 'custom_module', //custom module content
				'is_published' 		=> $this->input->post('is_published'),
				'show_title' 		=> $this->input->post('show_title'),
				'set_order'     	=> $this->input->post('order'),
				'privilege_id'		=> $this->input->post('module_access_level'),
				'position'			=> $this->input->post('module_position'),
				'module_layout'		=> $this->input->post('module_layout'),
				);

			//Module Update
			$this->module_m->update_by(array('id'=>$module_id), $data);

            // ********************************************************************************** //
            //
            //							Create custom_module Data Array
            //
			// ********************************************************************************** //

            //Create Module Custom Content Data Array
			$data = array(
				'module_id'					=> $module_id,
				'body'						=> $this->input->post('module_body'),
			); 

			//Custom Module Update
	        $this->module_m->update_module_custom_content($data);


			$this->session->set_flashdata('message', '<p>Custom Module Updated Succesfully!</p>');


			redirect('admin/modules');
		}  

	}
}
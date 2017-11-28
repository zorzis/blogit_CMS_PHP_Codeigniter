<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(0);

class Images_slider_module extends Backend_Controller
{

	public function __construct ()
	{
		parent::__construct();

		$this->load->helper('directory');
		$this->load->helper('file');


	}

	//Get the selected image paths using ajax, from the admin_images_slider view
	function select_media()
	{

		if (!empty($_POST['media']))
		{

			$this->data['media_details_from_ajax_post'] = $_POST['media'];

		}

		//Unset Template 
		$this->output->unset_template();

		// Load view
		$this->load->view('modules/admin/includes/admin_images_slider', $this->data);

	}

	public function create()
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
        //$this->form_validation->set_rules('image_caption','Image Caption','trim|xss_clean');


		if($this->form_validation->run() == FALSE)
		{ 

				//*******************************************************************************************************/
				//
				//									Get Files And Folders???									
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
				$this->data['path_to_image_slider_module_layouts'] = APPPATH . 'views/themes/' . $default_template_name . '/modules_layouts/image_slider_modules';
				$extensions = array('php');
				//
				$this->data['image_slider_module_layouts'] = get_filenames_by_extension($this->data['path_to_image_slider_module_layouts'], $extensions);

				/*******************************************************************************************************/
			

			//Get Access Privileges
			$this->data['privileges'] = $this->module_m->get_privileges();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('modules/admin/module_images_slider_create', $this->data);
		} 

		else{

            // ********************************************************************************** //
            //
            //							Create modules Data Array
            //
			// ********************************************************************************** //

			$data = array(
				'title'						=> $this->input->post('title'), 
				'module_type' 				=> 'image_slider_module', //image slider module content
				'is_published' 				=> $this->input->post('is_published'),
				'show_title' 				=> $this->input->post('show_title'),
				'set_order'     			=> $this->input->post('order'),
				'privilege_id'				=> $this->input->post('module_access_level'),
				'position'					=> $this->input->post('module_position'),
				'module_layout'				=> $this->input->post('module_layout'),

				);

            //Post Insert
			$this->module_m->insert($data);

           	//Get the last insert id of modules table from the module insert.
            $last_module_id = $this->module_m->get_insert_id();
            $next_module_id = $last_module_id;

            // ********************************************************************************** //
            //
            //							Create image_slider_module Data Array
            //
			// ********************************************************************************** //


            $image_path = $this->input->post('slider_image_path');
            $image_caption = $this->input->post('image_caption');
            
			if(!empty($image_path))
			{

	            $rows = array();  # we'll store each row in this array

				// Setup a counter for looping through post arrays
				// If there are x items in one post array (e.g. $image_path) 
				// then the others *should* contain the same number
				$row_count = count($image_path);

				for ($i=0; $i < $row_count; $i++) { 
				    $rows[] = array(

						'module_id'		=> $next_module_id,
						'image_path' => $image_path[$i],
				        'image_caption' => $image_caption[$i],
				        
				    );
				}

				
				//Image Slider Content Insert
			    $this->db->insert_batch('module_image_slider',$rows);
			}


			$this->session->set_flashdata('message', '<p>Image Slider Module Created Succesfully!</p>');


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


		if($this->form_validation->run() == FALSE)
		{ 

		    //Get the post to edit 
			$this->data['module'] = $this->module_m->get_image_slider_module($module_id);

	    	//Get images for image_slider_module from database
	    	$current_images_data = $this->module_m->current_image_slider_module_images($module_id);

	    	$this->data['current_images_data'] = array();
	    	foreach($current_images_data as $image_data)
	    	{
	    		$this->data['current_images_data'][] = $image_data;

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
				$this->data['path_to_image_slider_module_layouts'] = APPPATH . 'views/themes/' . $default_template_name . '/modules_layouts/image_slider_modules';
				$extensions = array('php');
				//
				$this->data['image_slider_module_layouts'] = get_filenames_by_extension($this->data['path_to_image_slider_module_layouts'], $extensions);

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
			$this->load->view('modules/admin/module_images_slider_update', $this->data);
		}

		else {

            //Create modules Data Array
			$data = array(
				'title'						=> $this->input->post('title'), 
				'module_type' 				=> 'image_slider_module', //image_slider module content
				'is_published' 				=> $this->input->post('is_published'),
				'show_title' 				=> $this->input->post('show_title'),
				'set_order'     			=> $this->input->post('order'),
				'privilege_id'				=> $this->input->post('module_access_level'),
				'position'					=> $this->input->post('module_position'),
				'module_layout'				=> $this->input->post('module_layout'),
				);

			//Module Update
			$this->module_m->update_by(array('id'=>$module_id), $data);

            // ********************************************************************************** //
            //
            //							Update Image Slider Images Data Array
            //
			// ********************************************************************************** //

			//Firstly we delete any images stored for the current image slider module
			//in module_image_slider table
	        $this->module_m->delete_image_slider_images($module_id);


	        $image_path = $this->input->post('slider_image_path');
	        $image_caption = $this->input->post('image_caption');
			
			if(!empty($image_path))
			{
	            $rows = array();  # we'll store each row in this array

				// Setup a counter for looping through post arrays
				// If there are x items in one post array (e.g. $image_path) 
				// then the others *should* contain the same number
				$row_count = count($image_path);

				for ($i=0; $i < $row_count; $i++) { 
				    $rows[] = array(

						'module_id'		=> $module_id,
						'image_path' => $image_path[$i],
				        'image_caption' => $image_caption[$i],
				        
				    );
				}


				$this->db->insert_batch('module_image_slider',$rows);
			}


			$this->session->set_flashdata('message', '<p>Image Slider Module Updated Succesfully!</p>');


			redirect('admin/modules');
		}  

	}
}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 10;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('templates_m');
		$this->load->helper('file');

		//Get path to templates folder as descibed below
		$template_path = APPPATH .'views/themes/';

		$this->data['templates_folders'] = get_dir_file_info($template_path, $top_level_only = TRUE);
	}

	public function index()
	{
		// Check user has privileges to view trashed Module Positions, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Templates'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view Templates.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_templates'] = $this->templates_m->get_total_not_trashed_templates();

		//Configure pagination
        $config['base_url'] = base_url().'admin/templates/page/';
        $config['total_rows'] = $this->data['total_templates'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/templates/';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';	
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';

        //Init pagination
        $this->pagination->initialize($config);

		// Fetch all articles
        $this->data['templates'] = $this->templates_m->limit( $config['per_page'],$this->uri->segment(4))->get_templates();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('templates/admin/templates_view', $this->data);		
	}

	public function trashed_templates ()
	{
		// Check user has privileges to view pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Templates'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed templates.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_trashed_templates'] = $this->templates_m->get_total_trashed_templates();

		//Configure pagination
        $config['base_url'] = base_url().'admin/templates/trashed_templates/page/';
        $config['total_rows'] = $this->data['total_trashed_templates'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/templates/trashed_templates/';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';	
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';

        //Init pagination
        $this->pagination->initialize($config);

		// Fetch all articles
        $this->data['templates'] = $this->templates_m->limit( $config['per_page'],$this->uri->segment(5))->get_trashed_templates();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('templates/admin/templates_trashed', $this->data);		
	}


	public function create_template()
	{
		// Check user has privileges to create blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Templates'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create Templates.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
        $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');   
        $this->form_validation->set_rules('is_published','Is Publish','integer');


    	if($this->form_validation->run() == FALSE){ 

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

       		// Load the view
			$this->load->view('templates/admin/template_create', $this->data);
       	}
       	else{

            //Create modules Data Array
			$data = array(
				'title'				=> $this->input->post('title'), 
			);

            //Post Insert
            $this->templates_m->insert($data);

			$this->session->set_flashdata('message', '<p>Template Created Succesfully!</p>');


			redirect('admin/templates/');
       	}
    } 

	public function update_template($template_id)
	{
		// Check user has privileges to create blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Templates'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Update Templates.</p>');
			
			redirect('admin/');		
		}

		// If menu found in database do the rest
		if	($this->data['templates'] = $this->templates_m->get($template_id) )		
		{

			$this->load->library('form_validation');
			
			//Validation Rules
	        $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');   
	        $this->form_validation->set_rules('is_published','Is Publish','integer');

	    	if($this->form_validation->run() == FALSE){ 

	    		//Get Template
	    		$this->data['template'] = $this->templates_m->get_template($template_id);

	    		//Get Template Positions
				$this->data['path_to_template_positions'] = APPPATH . 'views/themes/' . $this->data['template']->title . '/positions';
				$extensions = array('php');

				$this->data['template_positions'] = get_filenames_by_extension($this->data['path_to_template_positions'], $extensions, TRUE);

		    	// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
				

				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

	       		// Load the view
				$this->load->view('templates/admin/template_update', $this->data);
	       	}
	       	else{

	            //Create modules Data Array
				$data = array(
					'title'				=> $this->input->post('title'), 
				);

	            //Template Title Update
	            $this->templates_m->update_by(array('id'=>$template_id), $data);

				$this->session->set_flashdata('message', '<p>Template Updated Succesfully!</p>');


				redirect('admin/templates/');
	       	}		
	    }
	    else
		{
			$this->session->set_flashdata('message', '<p>Template Cannot be found!</p>');
			redirect('admin/templates/');
		}//ends else
	}

    public function set_default_template($template_id){
    	// Check user has privileges to Publish/Unpublish pages, 
    	// else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Set Default Template'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Set Default Template.</p>');
			
			redirect('admin/');		
		}
		// If menu found in database do the rest
		if	($this->data['templates'] = $this->templates_m->get($template_id) )		
		{

			//************************************************************************************************************
			// Before we'll set the homepage, we unset any homepage, using the update_all function from core/My_Model
			//************************************************************************************************************
			$data = array(
				'default' => 0,
				);
			$this->templates_m->update_all($data);
			//************************************************************************************************************


			//Set home page
			$this->templates_m->set_default_template($template_id);
			         
			//Create Message
			$this->session->set_flashdata('message', '<p>Default Template is set Succesfully!</p>');
			            
			//Redirect to pages
			redirect('admin/templates');
		}
		else
		{

			//Create Message
			$this->session->set_flashdata('message', '<p>Template Not Found!</p>');
			            
			//Redirect to pages
			redirect('admin/templates');	
		}
    }

    public function unset_trashed_template($template_id)
    {

    	// Check user has privileges to Publish/Unpublish pages, 
    	// else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Templates'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Templates .</p>');
			
			redirect('admin/');		
		}

		$this->templates_m->unset_trashed_template($template_id);

		//Create Message
		$this->session->set_flashdata('message', '<p>Trashed Template Moved to Templates Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/templates');

			
	}


    public function delete_template($template_id)
    {
    	// Check user has privileges to Publish/Unpublish pages, 
    	// else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Templates'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Template.</p>');
			
			redirect('admin/');		
		}
		// If menu found in database do the rest
		if	($this->data['templates'] = $this->templates_m->get($template_id) )		
		{

				//Delete Template
		        $this->templates_m->set_trashed_template($template_id);

		        //Create Message
		        $this->session->set_flashdata('message', '<p>Template Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/templates');
			
		}
		else
		{

			//Create Message
			$this->session->set_flashdata('message', '<p>Template Not Found!</p>');
			            
			//Redirect to pages
			redirect('admin/templates');	
		}
    }

    public function delete_trashed_template($template_id)
    {
    	// Check user has privileges to Publish/Unpublish pages, 
    	// else display a message to notify the user they do not have valid privileges.
    	if (! $this->flexi_auth->is_privileged('Delete Templates'))
    	{
    		$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Template.</p>');

    		redirect('admin/');		
    	}

		//Delete Template
    	$this->templates_m->delete_trashed_template($template_id);

		//Delete Template Positions Assigned to Template
    	$this->templates_m->delete_by_template_id($template_id);

		//Create Message
    	$this->session->set_flashdata('message', '<p>Template and assigned Template Positions Deleted Succesfully!</p>');

		//Redirect to categories
    	redirect('admin/templates');

    }

}
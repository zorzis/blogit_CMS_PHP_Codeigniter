<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 250;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('module_m');
	}

	public function index ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view modules.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_modules'] = $this->db->count_all('modules');

		// Fetch all articles
		//Configure pagination
        $config['base_url'] = base_url().'admin/modules/page';
        $config['total_rows'] = $this->data['total_modules'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/modules/';
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
	
        $this->data['modules'] = $this->module_m->limit( $config['per_page'],$this->uri->segment(4))->get_modules();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('modules/admin/modules_view', $this->data);		
	}

	public function trashed_modules ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed modules.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_modules'] = $this->db->count_all('modules');

		//Configure pagination
        $config['base_url'] = base_url().'admin/modules/trashed_modules/page';
        $config['total_rows'] = $this->data['total_modules'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/modules/trashed_modules';
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
        $this->data['modules'] = $this->module_m->limit( $config['per_page'],$this->uri->segment(5))->get_trashed_modules();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('modules/admin/modules_trashed', $this->data);		
	}


	// This makes call to MY_model function with soft_delete enabled so modules deleted from that function
	// goes to trashed modules, because deleted is set to 1 and not permanetly deleted.
    public function delete_module($id){      
	    // Check user has privileges to delete modules, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Modules.</p>');
			
			redirect('admin/');		
		}

		// If module is found on database delete it
		if	($this->data['modules'] = $this->module_m->get($id) )
			
			{

		        //Delete module
		        $this->module_m->delete($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Module Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to modules
		        redirect('admin/modules');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Module Cannot be found!</p>');

			redirect('admin/modules');

			}
     }

	// This function permanetly delete trashed modules from the database
    public function delete_trashed_module($id)
    {      
	    // Check user has privileges to delete modules, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Modules.</p>');
			
			redirect('admin/');		
		}

		//Get Module Type to decide what deletion we will do here
		$module = $this->module_m->get_module($id);
		$module_type = $module->module_type;

		if($module->module_type == 'custom_module')
		{
			$this->module_m->delete_custom_module_content($id);
		}
		elseif($module->module_type == 'menu_module')
		{
			$this->module_m->delete_menu_module_content($id);
		}			
		elseif($module->module_type == 'latest_blog_articles_module')
		{
			$this->module_m->delete_blog_module_content($id);
		}			
		elseif($module->module_type == 'popular_blog_articles_module')
		{
			$this->module_m->delete_blog_module_content($id);
		}			
		elseif($module->module_type == 'image_slider_module')
		{
			$this->module_m->delete_image_slider_module_content($id);
		}


		//Delete permanetly trashed module
		//Delete from modules table
		$this->module_m->delete_trashed_module($id);

		//Create Message
		$this->session->set_flashdata('message', '<p>Trashed Module Deleted Succesfully!</p>');

		//Redirect to trashed modules
		redirect('admin/modules/trashed_modules');

    }

    public function publish_module($id){
    	// Check user has privileges to Publish/Unpublish modules, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish Modules.</p>');
			
			redirect('admin/');		
		}

		//Delete article
		$this->module_m->publish_module($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Module Published Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/modules');
    }

    public function unpublish_module($id){
    	// Check user has privileges to Publish/Unpublish modules, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Modules'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Update Modules.</p>');
			
			redirect('admin/');		
		}

		//Unpublish module
		$this->module_m->unpublish_module($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Module Unpublished Succesfully!</p>');
		            
		//Redirect to modules
		redirect('admin/modules');
    }

}
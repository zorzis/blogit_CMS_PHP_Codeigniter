<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 5;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('portfolio_categories_m');
	}

	public function index ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view Portfolio Categories.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_categories'] = $this->db->count_all('portfolio_categories');

		//Configure pagination
        $config['base_url'] = base_url().'admin/portfolio/categories/page/';
        $config['total_rows'] = $this->data['total_categories'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/portfolio/categories/';
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
	
        $this->data['categories'] = $this->portfolio_categories_m->limit( $config['per_page'],$this->uri->segment(5))->get_portfolio_categories();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('portfolio_categories/admin/portfolio_categories_view', $this->data);		
	}

	public function trashed_portfolio_categories ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed Portfolio Categories.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_categories'] = $this->db->count_all('portfolio_categories');

		//Configure pagination
        $config['base_url'] = base_url().'admin/portfolio/categories/trashed_portfolio_categories/page/';
        $config['total_rows'] = $this->data['total_categories'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 6;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/portfolio/categories/trashed_portfolio_categories/';
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
        $this->data['categories'] = $this->portfolio_categories_m->limit( $config['per_page'],$this->uri->segment(6))->get_trashed_portfolio_categories();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('portfolio_categories/admin/portfolio_categories_trashed', $this->data);		
	}

	public function create_portfolio_category ()
	{
	    // Check user has privileges to create blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create portfolio categories.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
        $this->form_validation->set_rules('portfolio_category_title','Portfolio Category Title','trim|required|max_length[100]|xss_clean');  
        $this->form_validation->set_rules('portfolio_category_slug','Portfolio Category Slug','trim|max_length[100]|url_title|xss_clean');   
        $this->form_validation->set_rules('portfolio_category_description','Portfolio Category Description','trim|required');
        $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
        $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

    	if($this->form_validation->run() == FALSE){ 

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('portfolio_categories/admin/portfolio_categories_create', $this->data);
       	} 

       	else{
            //Generate Slug
            if(!$this->input->post('portfolio_category_slug')){
                $portfolio_category_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('portfolio_category_title'))));
            } else {
                $portfolio_category_slug = $this->input->post('portfolio_category_slug');
            }


            //Create Posts Data Array
			$data = array(
				'portfolio_category_title'				=> $this->input->post('portfolio_category_title'), 
				'portfolio_category_slug'				=> $portfolio_category_slug, 
				'portfolio_category_description'		=> $this->input->post('portfolio_category_description'), 
				'is_published' 							=> 1,
				'seo_page_title' 						=> $this->input->post('seo_page_title'),
				'meta_keywords' 						=> $this->input->post('meta_keywords'),
				'meta_description' 						=> $this->input->post('meta_description'),
				'tags'          						=> $this->input->post('meta_keywords'),
			);

            //Portfolio Category Insert
            $this->portfolio_categories_m->insert($data);

			$this->session->set_flashdata('message', '<p>Portfolio Category Created Succesfully!</p>');


			redirect('admin/portfolio/categories');
       	}    

	}

	public function edit_portfolio_category($id = NULL)
	{
	    // Check user has privileges to update portfolio categories, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update Portfolio categories.</p>');
			
			redirect('admin/');		
		}

		if($this->data['categories'] = $this->portfolio_categories_m->get($id))
		{

			$this->load->library('form_validation');
			
			//Validation Rules
	        $this->form_validation->set_rules('portfolio_category_title','Portfolio Category Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('portfolio_category_slug','Portfolio Category Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('portfolio_category_description','Portfolio Category Description','trim|required');
	        $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
	        $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
	        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

			if($this->form_validation->run() == FALSE)
			{ 

			    //Get the category to edit 
			    $this->data['category'] = $this->portfolio_categories_m->get_portfolio_category($id);

				//Get Created By name for logging events
	    		$this->data['created_by'] = $this->portfolio_categories_m->get_created_by($id);

	    		//Get Modified By for logging events
	    		$this->data['modified_by'] = $this->portfolio_categories_m->get_modified_by($id);

				// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
					
				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
					
				// Load the view
				$this->load->view('portfolio_categories/admin/portfolio_categories_update', $this->data);
			}

			else 
			{
	            //Generate Slug
	            if(!$this->input->post('category_slug')){
	                $category_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('category_title'))));
	            } else {
	                $category_slug = $this->input->post('category_slug');
	            }

		        //Update Portfolio Category Data Array
				$data = array(
					'portfolio_category_title'				=> $this->input->post('portfolio_category_title'), 
					'portfolio_category_slug'				=> $portfolio_category_slug, 
					'portfolio_category_description'		=> $this->input->post('portfolio_category_description'), 
					'is_published' 							=> 1,
					'seo_page_title' 						=> $this->input->post('seo_page_title'),
					'meta_keywords' 						=> $this->input->post('meta_keywords'),
					'meta_description' 						=> $this->input->post('meta_description'),
					'tags'          						=> $this->input->post('meta_keywords'),
				);

				//Portfolio Category Udate
		        $this->portfolio_categories_m->update_by(array('id'=>$id), $data);

				$this->session->set_flashdata('message', '<p>Portfolio Category Updated Succesfully!</p>');


				redirect('admin/portfolio/categories');
	       	}

	    }
	    else
		{
			$this->session->set_flashdata('message', '<p>Portfolio Category Cannot be found!</p>');
			redirect('admin/portfolio/categories');
		}//ends else    

	}

	// This makes call to MY_model function with soft_delete enabled so categories deleted from that function
	// goes to trashed categories, because deleted is set to 1 and not permanetly deleted.
    public function delete_portfolio_category($id){      
	    // Check user has privileges to delete portfolio categories, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Portfolio Categories.</p>');
			
			redirect('admin/');		
		}

		// If category is found on database delete it
		if	($this->data['category'] = $this->portfolio_categories_m->get($id) )
			
			{

		        //Delete Portfolio Category
		        $this->portfolio_categories_m->delete($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Portfolio Category Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/portfolio/categories');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Portfolio Category Cannot be found!</p>');

			redirect('admin/blog/categories');

			}
     }

	// This function permanetly delete trashed portfolio categories from the database
    public function delete_trashed_portfolio_category($id){      
	    // Check user has privileges to permanently delete portfolio categories, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Portfolio Categories.</p>');
			
			redirect('admin/');		
		}

		
		        //Delete Portfolio Category
		        $this->portfolio_categories_m->delete_trashed_portfolio_category($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Portfolio Category Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/portfolio/categories/trashed_portfolio_categories');

    }

    public function publish_portfolio_category($id){
    	// Check user has privileges to Publish/Unpublish portfolio categories, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Portfolio Categories.</p>');
			
			redirect('admin/');		
		}

		//Publish Portfolio Category
		$this->portfolio_categories_m->publish_portfolio_category($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Portfolio Category Published Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/portfolio/categories');
    }

    public function unpublish_portfolio_category($id){
    	// Check user has privileges to Publish/Unpublish portfolio categories, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Portfolio Categories'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Portfolio Categories.</p>');
			
			redirect('admin/');		
		}

		//Unpublish portfolio category
		$this->portfolio_categories_m->unpublish_portfolio_category($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Portfolio Category Unpublished Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/portfolio/categories');
    }


}
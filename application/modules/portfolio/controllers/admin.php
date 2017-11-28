<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 100;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('portfolio_m');

	}

	public function index ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_portfolio_projects'] = $this->db->count_all('portfolios');

		//Configure pagination
        $config['base_url'] = base_url().'admin/portfolio/page';
        $config['total_rows'] = $this->data['total_portfolio_projects'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/portfolio/';
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
	
        $this->data['portfolio_projects'] = $this->portfolio_m->limit( $config['per_page'],$this->uri->segment(4))->get_portfolio_projects();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('portfolio/admin/portfolio_projects_view', $this->data);		
	}

	public function trashed_portfolio_projects ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_portfolio_projects'] = $this->db->count_all('portfolios');

		//Configure pagination
        $config['base_url'] = base_url().'admin/portfolio/trashed_portfolio_projects/page';
        $config['total_rows'] = $this->data['total_portfolio_projects'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/portfolio/trashed_portfolio_projects';
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
        $this->data['portfolio_projects'] = $this->portfolio_m->limit( $config['per_page'],$this->uri->segment(5))->get_trashed_portfolio_projects();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('portfolio/admin/portfolio_projects_trashed', $this->data);		
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
		$this->load->view('portfolio/admin/includes/ajax_media_selector', $this->data);

	}

	public function create_portfolio_project ()
	{
	    // Check user has privileges to create blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create Portfolio Project.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
		$this->form_validation->set_rules('project_title','Title','trim|required|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('project_slug','Slug','trim|max_length[100]|url_title|xss_clean');   
		$this->form_validation->set_rules('project_description','Project Description','trim|xss_clean');
		$this->form_validation->set_rules('project_webpage','Project Webpage','trim|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('project_company_proposal','Project Company Proposal','trim');
		$this->form_validation->set_rules('project_developer','Project Developer','trim|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('date_project_finished','Date Project Finished','trim|exact_length[10]|xss_clean');
		$this->form_validation->set_rules('project_category','Project Category','trim|xss_clean');    

		$this->form_validation->set_rules('project_client_name','Project Client Name','trim|max_length[100]|xss_clean');    
		$this->form_validation->set_rules('project_client_description','Project Client Description','trim|xss_clean');    
		$this->form_validation->set_rules('project_client_webpage','Project Client Webpage','trim|max_length[100]|xss_clean');  


        $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
        $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

    	if($this->form_validation->run() == FALSE){ 

			//Get Project Categories for dropdown selection form
    		$this->data['portfolio_categories'] = $this->portfolio_m->get_portfolio_categories();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('portfolio/admin/portfolio_projects_create', $this->data);
       	} 

       	else
       	{
            //Generate Slug
            if(!$this->input->post('project_slug')){
                $project_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('project_title'))));
            } else {
                $project_slug = $this->input->post('project_slug');
            }

            //Generate Seo Page Title
            if(!$this->input->post('seo_page_title'))
            {
                $seo_page_title = $this->input->post('project_title');
            } 
            else 
            {
                $seo_page_title = $this->input->post('seo_page_title');
            }



            //Create Project Data Array
			$data = array(
				'project_title'				=> $this->input->post('project_title'), 
				'project_slug'				=> $project_slug, 
				'project_description'		=> $this->input->post('project_description'), 
				'project_url'				=> $this->input->post('project_webpage'),
				'date_project_done'			=> $this->input->post('date_project_finished'),
				'project_category_id' 		=> $this->input->post('project_category'),
				'company_proposal' 			=> $this->input->post('project_company_proposal'),
				'developer' 				=> $this->input->post('project_developer'),

				'client_name'				=> $this->input->post('project_client_name'), 
				'client_url'				=> $this->input->post('project_client_webpage'), 
				'client_description'		=> $this->input->post('project_client_description'),

				'is_published' 				=> 1,
				'seo_page_title' 			=> $seo_page_title,
				'meta_keywords' 			=> $this->input->post('meta_keywords'),
				'meta_description' 			=> $this->input->post('meta_description'),
				'tags'          			=> $this->input->post('meta_keywords'),
			);

            //Project Insert
            $this->portfolio_m->insert($data);

            //Get the last insert id in the portfolio table from the above portfolio project insertion.
            $last_project_id = $this->portfolio_m->get_insert_id();
            $next_project_id = $last_project_id;

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

						'project_id'		=> $next_project_id,
						'image_path' 		=> $image_path[$i],
				        'image_caption' 	=> $image_caption[$i],
				        
				    );
				}

				
				//Image Slider Content Insert
			    $this->db->insert_batch('portfolio_media',$rows);
			}

			$this->session->set_flashdata('message', '<p>Portfolio Project created Succesfully!</p>');



			redirect('admin/portfolio');
       	}    

	}

	public function edit_portfolio_project ($id = NULL)
	{
	    // Check user has privileges to update blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		if ($this->data['portfolio_projects'] = $this->portfolio_m->get($id))
		{

			$this->load->library('form_validation');
			
			//Validation Rules
			$this->form_validation->set_rules('project_title','Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('project_slug','Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('project_description','Project Description','trim|xss_clean');
			$this->form_validation->set_rules('project_webpage','Project Webpage','trim|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('project_company_proposal','Project Company Proposal','trim');
			$this->form_validation->set_rules('project_developer','Project Developer','trim|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('date_project_finished','Date Project Finished','trim|exact_length[10]|xss_clean');
	        $this->form_validation->set_rules('project_category','Project Category','trim|xss_clean');    
	        
	        $this->form_validation->set_rules('project_client_name','Project Client Name','trim|max_length[100]|xss_clean');    
	        $this->form_validation->set_rules('project_client_description','Project Client Description','trim|xss_clean');    
			$this->form_validation->set_rules('project_client_webpage','Project Client Webpage','trim|max_length[100]|xss_clean');  


	        $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
	        $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
	        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

			if($this->form_validation->run() == FALSE)
			{ 

			    //Get the post to edit 
			    $this->data['project'] = $this->portfolio_m->get_portfolio_project($id);

			    //Get images for image_slider_module from database
		    	$current_project_media_data = $this->portfolio_m->current_portfolio_project_media($id);

		    	$this->data['current_project_media_data'] = array();
		    	foreach($current_project_media_data as $project_media_data)
		    	{
		    		$this->data['current_project_media_data'][] = $project_media_data;

		    	}

	    		//Get Created By name for logging events
	    		$this->data['created_by'] = $this->portfolio_m->get_created_by($id);

	    		//Get Modified By for logging events
	    		$this->data['modified_by'] = $this->portfolio_m->get_modified_by($id);

				//Get Portfolio Categories for dropdown selection form
	    		$this->data['portfolio_categories'] = $this->portfolio_m->get_portfolio_categories();

				// Set validation errors.
				$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
					
				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
					
				// Load the view
				$this->load->view('portfolio/admin/portfolio_projects_update', $this->data);
			}

			else 
			{
				//Generate Slug
				if(!$this->input->post('project_slug')){
					$project_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('project_title'))));
				} else {
					$project_slug = $this->input->post('project_slug');
				}

	            //Generate Seo Page Title
	            if(!$this->input->post('seo_page_title'))
	            {
	                $seo_page_title = $this->input->post('title');
	            } 
	            else 
	            {
	                $seo_page_title = $this->input->post('seo_page_title');
	            }

				

		        //Update Project Data Array
				$data = array(
					'project_title'				=> $this->input->post('project_title'), 
					'project_slug'				=> $project_slug, 
					'project_description'		=> $this->input->post('project_description'), 
					'project_url'				=> $this->input->post('project_webpage'),
					'date_project_done'			=> $this->input->post('date_project_finished'),
					'project_category_id' 		=> $this->input->post('project_category'),
					'company_proposal' 			=> $this->input->post('project_company_proposal'),
					'developer' 				=> $this->input->post('project_developer'),

					'client_name'				=> $this->input->post('project_client_name'), 
					'client_url'				=> $this->input->post('project_client_webpage'), 
					'client_description'		=> $this->input->post('project_client_description'),

					'is_published' 				=> 1,
					'seo_page_title' 			=> $seo_page_title,
					'meta_keywords' 			=> $this->input->post('meta_keywords'),
					'meta_description' 			=> $this->input->post('meta_description'),
					'tags'          			=> $this->input->post('meta_keywords'),
				);

				//Project Udate
				$this->portfolio_m->update_by(array('id'=>$id), $data);

				// ********************************************************************************** //
	            //
	            //							Update Image Slider Images Data Array
	            //
				// ********************************************************************************** //

				//Firstly we delete any images stored for the current image slider module
				//in module_image_slider table
		        $this->portfolio_m->delete_portfolio_project_media($id);


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

							'project_id'	=> $id,
							'image_path' 	=> $image_path[$i],
					        'image_caption' => $image_caption[$i],
					        
					    );
					}


					$this->db->insert_batch('portfolio_media',$rows);
				}

				$this->session->set_flashdata('message', '<p>Portfolio Project Updated Succesfully!</p>');


				redirect('admin/portfolio');
	       	}
       	}
       	else
		{
			$this->session->set_flashdata('message', '<p>Portfolio Project Cannot be found!</p>');
			redirect('admin/portfolio');
		}//ends else  

	}

	// This makes call to MY_model function with soft_delete enabled so articles deleted from that function
	// goes to trashed articles, because deleted is set to 1 and not permanetly deleted.
    public function delete_portfolio_project($id){      
	    // Check user has privileges to delete blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to delete Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		// If project is found on database delete it
		if	($this->data['project'] = $this->portfolio_m->get($id) )
			
			{

		        //Delete project
		        $this->portfolio_m->delete($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Portfolio Project Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to portfolio project list
		        redirect('admin/portfolio');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Portfolio Project Cannot be found!</p>');

			redirect('admin/portfolio');

			}
     }

	// This function permanetly delete trashed articles from the database
    public function delete_trashed_portfolio_project($id){      
	    // Check user has privileges to delete blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to delete Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		
		        //Delete project
		        $this->portfolio_m->delete_trashed_portfolio_project($id);

		        //Delete Media Objects assigned to project
		        $this->portfolio_m->delete_portfolio_project_media($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Portfolio Project Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/portfolio/trashed_portfolio_projects');

    }

    public function publish_portfolio_project($id){
    	// Check user has privileges to Publish/Unpublish blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to publish Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		//Publish Project
		$this->portfolio_m->publish_portfolio_project($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Portfolio Project Published Succesfully!</p>');
		            
		//Redirect to portfolio
		redirect('admin/portfolio');
    }

    public function unpublish_portfolio_project($id){
    	// Check user has privileges to Publish/Unpublish blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Portfolio Projects'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to unpublish Portfolio Projects.</p>');
			
			redirect('admin/');		
		}

		//Unpublish Portfolio Project
		$this->portfolio_m->unpublish_portfolio_project($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Portfolio Project Unpublished Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/portfolio');
    }


}
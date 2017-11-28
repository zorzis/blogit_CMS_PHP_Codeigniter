<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 10;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('article_m');

	}

	public function index ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view blog articles.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_articles'] = $this->db->count_all('articles');

		// Fetch all articles
		//Configure pagination
        $config['base_url'] = base_url().'admin/blog/page';
        $config['total_rows'] = $this->data['total_articles'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/blog/';
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
	
        $this->data['articles'] = $this->article_m->limit( $config['per_page'],$this->uri->segment(4))->get_articles();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('blog/admin/blog_articles_view', $this->data);		
	}

	public function trashed_articles ()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed blog articles.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_articles'] = $this->db->count_all('articles');

		//Configure pagination
        $config['base_url'] = base_url().'admin/blog/trashed_articles/page';
        $config['total_rows'] = $this->data['total_articles'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/blog/trashed_articles';
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
        $this->data['articles'] = $this->article_m->limit( $config['per_page'],$this->uri->segment(5))->get_trashed_articles();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('blog/admin/blog_articles_trashed', $this->data);		
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
		$this->load->view('blog/admin/includes/ajax_media_selector', $this->data);

	}

	public function create_blog_article ()
	{
	    // Check user has privileges to create blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create blog articles.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
		$this->form_validation->set_rules('author','Author','trim|required|xss_clean');   
        $this->form_validation->set_rules('pubdate','Publication date','trim|required|exact_length[10]|xss_clean');
        $this->form_validation->set_rules('category','Blog Category','trim|required|xss_clean');    
        $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');  
        $this->form_validation->set_rules('slug','Slug','trim|max_length[100]|url_title|xss_clean');   
        $this->form_validation->set_rules('body','Body','trim|required');
        $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
        $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

    	if($this->form_validation->run() == FALSE){ 

    		//Get Authors for dropdown selection form
    		$this->data['authors'] = $this->article_m->get_authors();

			//Get Blog Categories for dropdown selection form
    		$this->data['categories'] = $this->article_m->get_blog_categories();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('blog/admin/blog_articles_create', $this->data);
       	} 

       	else
       	{
            //Generate Slug
            if(!$this->input->post('slug')){
                $article_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('title'))));
            } else {
                $article_slug = $this->input->post('slug');
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



            //Create Posts Data Array
			$data = array(
				'title'				=> $this->input->post('title'), 
				'slug'				=> $article_slug, 
				'body'				=> $this->input->post('body'), 
				'pubdate'			=> $this->input->post('pubdate'),
				'is_published' 		=> 1,
				'author_id' 		=> $this->input->post('author'),
				'category_id' 		=> $this->input->post('category'),
				'seo_page_title' 	=> $seo_page_title,
				'meta_keywords' 	=> $this->input->post('meta_keywords'),
				'meta_description' 	=> $this->input->post('meta_description'),
				'tags'          	=> $this->input->post('meta_keywords'),
			);

            //Post Insert
            $this->article_m->insert($data);

            //Get the last insert id in the articles table from the above article insertion.
            $last_article_id = $this->article_m->get_insert_id();
            $next_article_id = $last_article_id;

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

						'article_id'		=> $next_article_id,
						'image_path' => $image_path[$i],
				        'image_caption' => $image_caption[$i],
				        
				    );
				}

				
				//Image Slider Content Insert
			    $this->db->insert_batch('articles_media',$rows);
			}

			$this->session->set_flashdata('message', '<p>Blog article created Succesfully!</p>');



			redirect('admin/blog');
       	}    

	}

	public function edit_blog_article ($id = NULL)
	{
	    // Check user has privileges to update blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update blog articles.</p>');
			
			redirect('admin/');		
		}

		if ($this->data['articles'] = $this->article_m->get($id))
		{

			$this->load->library('form_validation');
			
			//Validation Rules
			$this->form_validation->set_rules('author','Author','trim|required|xss_clean');   
	        $this->form_validation->set_rules('pubdate','Publication date','trim|required|exact_length[10]|xss_clean');
	        $this->form_validation->set_rules('category','Blog Category','trim|required|xss_clean');    
	        $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('slug','Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('body','Body','trim|required');
	        $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
	        $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
	        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean'); 

			if($this->form_validation->run() == FALSE)
			{ 

			    //Get the post to edit 
			    $this->data['article'] = $this->article_m->get_article($id);

			    //Get images for image_slider_module from database
		    	$current_article_media_data = $this->article_m->current_article_media($id);

		    	$this->data['current_article_media_data'] = array();
		    	foreach($current_article_media_data as $article_media_data)
		    	{
		    		$this->data['current_article_media_data'][] = $article_media_data;

		    	}

			    //Get Authors for dropdown selection form
	    		$this->data['authors'] = $this->article_m->get_authors();

	    		//Get Created By name for logging events
	    		$this->data['created_by'] = $this->article_m->get_created_by($id);

	    		//Get Modified By for logging events
	    		$this->data['modified_by'] = $this->article_m->get_modified_by($id);

				//Get Blog Categories for dropdown selection form
	    		$this->data['categories'] = $this->article_m->get_blog_categories();

				// Set validation errors.
				$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
					
				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
					
				// Load the view
				$this->load->view('blog/admin/blog_articles_update', $this->data);
			}

			else 
			{
				//Generate Slug
				if(!$this->input->post('slug')){
					$article_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('title'))));
				} else {
					$article_slug = $this->input->post('slug');
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

				

		            //Update Posts Data Array
				$data = array(
					'title'				=> $this->input->post('title'), 
					'slug'				=> $article_slug, 
					'body'				=> $this->input->post('body'), 
					'pubdate'			=> $this->input->post('pubdate'),
					'author_id' 		=> $this->input->post('author'),
					'category_id' 		=> $this->input->post('category'),
					'seo_page_title' 	=> $seo_page_title,
					'meta_keywords' 	=> $this->input->post('meta_keywords'),
					'meta_description' 	=> $this->input->post('meta_description'),
					'tags'          	=> $this->input->post('meta_keywords'),
					);

					//Post Udate
				$this->article_m->update_by(array('id'=>$id), $data);

				// ********************************************************************************** //
	            //
	            //							Update Image Slider Images Data Array
	            //
				// ********************************************************************************** //

				//Firstly we delete any images stored for the current image slider module
				//in module_image_slider table
		        $this->article_m->delete_article_media($id);


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

							'article_id'	=> $id,
							'image_path' 	=> $image_path[$i],
					        'image_caption' => $image_caption[$i],
					        
					    );
					}


					$this->db->insert_batch('articles_media',$rows);
				}

				$this->session->set_flashdata('message', '<p>Blog article Updated Succesfully!</p>');


				redirect('admin/blog');
	       	}
       	}
       	else
		{
			$this->session->set_flashdata('message', '<p>Blog Article Cannot be found!</p>');
			redirect('admin/blog/');
		}//ends else  

	}

	// This makes call to MY_model function with soft_delete enabled so articles deleted from that function
	// goes to trashed articles, because deleted is set to 1 and not permanetly deleted.
    public function delete_blog_article($id){      
	    // Check user has privileges to delete blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to delete blog articles.</p>');
			
			redirect('admin/');		
		}

		// If article is found on database delete it
		if	($this->data['article'] = $this->article_m->get($id) )
			
			{

		        //Delete article
		        $this->article_m->delete($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Blog Article Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/blog');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Blog Article Cannot be found!</p>');

			redirect('admin/blog');

			}
     }

	// This function permanetly delete trashed articles from the database
    public function delete_trashed_blog_article($id){      
	    // Check user has privileges to delete blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to delete blog articles.</p>');
			
			redirect('admin/');		
		}

		
		        //Delete article
		        $this->article_m->delete_trashed_blog_article($id);

		        //Delete Media Objects Assigned to article
		        $this->article_m->delete_article_media($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Blog Article Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/blog/trashed_articles');

    }

    public function publish_blog_article($id){
    	// Check user has privileges to Publish/Unpublish blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to publish blog articles.</p>');
			
			redirect('admin/');		
		}

		//Delete article
		$this->article_m->publish_blog_article($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Blog Article Published Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/blog');
    }

    public function unpublish_blog_article($id){
    	// Check user has privileges to Publish/Unpublish blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Blog Articles'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to unpublish blog articles.</p>');
			
			redirect('admin/');		
		}

		//Delete article
		$this->article_m->unpublish_blog_article($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Blog Article Unpublished Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/blog');
    }


}
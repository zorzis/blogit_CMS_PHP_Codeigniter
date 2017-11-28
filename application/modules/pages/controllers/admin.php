<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 100;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('page_m');
	}

	public function index ()
	{
		// Check user has privileges to view pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to View Pages.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_pages'] = $this->db->count_all('pages');

		// Fetch all articles
		//Configure pagination
        $config['base_url'] = base_url().'admin/pages/page/';
        $config['total_rows'] = $this->data['total_pages'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/pages/';
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
	
        $this->data['pages'] = $this->page_m->limit( $config['per_page'],$this->uri->segment(4))->get_pages();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('pages/admin/pages_view', $this->data);		
	}

	public function trashed_pages ()
	{
		// Check user has privileges to view pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed pages.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_pages'] = $this->db->count_all('pages');

		//Configure pagination
        $config['base_url'] = base_url().'admin/pages/trashed_pages/page/';
        $config['total_rows'] = $this->data['total_pages'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/pages/trashed_pages/';
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
        $this->data['pages'] = $this->page_m->limit( $config['per_page'],$this->uri->segment(5))->get_trashed_pages();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('pages/admin/pages_trashed', $this->data);		
	}

/****************************************************************************************************************************
*****************************************************************************************************************************
*
*
* 											CUSTOM PAGE Functions
*
*
*****************************************************************************************************************************
*****************************************************************************************************************************/


	public function create_custom_page ()
	{
	    // Check user has privileges to create pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create pages.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Page Validation Rules
        $this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
        $this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
        $this->form_validation->set_rules('page_meta_keywords','Page Meta Keywords','trim|xss_clean');
        $this->form_validation->set_rules('page_meta_description','Page Meta Description','trim|xss_clean');
        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

        //Page Custom Content
	    $this->form_validation->set_rules('page_body','Page Body','trim|xss_clean');

    	if($this->form_validation->run() == FALSE){ 

			//Get Page Modules
			$this->data['page_modules_selection'] = $this->page_m->get_page_modules();

			//Get Access Privileges
			$this->data['privileges'] = $this->page_m->get_privileges();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('pages/admin/create_custom_page', $this->data);
       	} 

       	else
       	{
            //Generate Slug
            if(!$this->input->post('page_slug'))
            {
                $page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
            } 
            else 
            {
                $page_slug = $this->input->post('page_slug');
            }

            //Generate Seo Page Title
            if(!$this->input->post('seo_page_title'))
            {
                $seo_page_title = $this->input->post('page_title');
            } 
            else 
            {
                $seo_page_title = $this->input->post('seo_page_title');
            }


            //Get Page Modules if Any
              if($this->input->post('page_modules') != ""){
                $page_modules[] = $this->input->post('page_modules');
                foreach ($page_modules as $mods) {
                    foreach($mods as $mod){
                    $mod_string[] = $mod;
                    }
                }
                //Make Array CSV string
                $mod_string = implode(",",$mod_string);
              } else {
                  $mod_string = 0;
              }          

            //Create Posts Data Array
			$data = array(
				'title'						=> $this->input->post('page_title'), 
				'slug'						=> $page_slug, 
				'is_published' 				=> 1, 
				'seo_page_title' 			=> $seo_page_title,
				'meta_keywords' 			=> $this->input->post('page_meta_keywords'),
				'meta_description' 			=> $this->input->post('page_meta_description'),
				'modules'					=> $mod_string,
				'page_type' 				=> 1, // value 1 = custom page content
				'is_home'					=> 0, // by default we set new page as NON homepage
				'privilege_id'				=> $this->input->post('page_access_level'),

			);

            //Post Insert
            $this->page_m->insert($data);

            /*********************************************************************************************/
           	//Get the last insert id of pages table from the page insert.
           	//*we need to construct some functions for the FK we create in the related tables,
           	//*so if, something goes wron while the inserts of the data to all 3 tables we use
           	//*then to stop and get an error for that

            $last_page_id = $this->page_m->get_insert_id();
            $next_page_id = $last_page_id;

			/**********************************************************************************************/

            /*********************************************************************************************
            //
            //
            //
           	//Here are the functions to store data in page_custom_content table 
			//
			//
			//
			**********************************************************************************************/

            //Create Page Custom Content Data Array
			$data = array(
				'page_id'					=> $next_page_id,
				'body'						=> $this->input->post('page_body'),
			); 

			//Post Insert
	        $this->page_m->add_page_custom_content($data);


			$this->session->set_flashdata('message', '<p>Page Created Succesfully!</p>');


			redirect('admin/pages');
       	}    

	}

	public function edit_custom_page($page_id){
		// Check user has privileges to update pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update pages.</p>');
			
			redirect('admin/');		
		}

		// If menu found in database do the rest
		if	($this->data['pages'] = $this->page_m->get($page_id) )		
		{

			$this->load->library('form_validation');
			
			//Page Validation Rules
	        $this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('page_meta_keywords','Page Meta Keywords','trim|xss_clean');
	        $this->form_validation->set_rules('page_meta_description','Page Meta Description','trim|xss_clean');
	        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

	        //Page Custom Content
	        $this->form_validation->set_rules('page_body','Page Body','trim|xss_clean');

	    	if($this->form_validation->run() == FALSE){ 

	    		//Get the requested page(based on id)
	    		$this->data['page'] = $this->page_m->get_custom_page($page_id);

	    		//Get Page Modules
				$this->data['page_modules_selection'] = $this->page_m->get_page_modules();

				//Get selected Modules
	            $this->data['selected_modules'] = $this->page_m->get_selected_modules($page_id);

				//Get Access Privileges
				$this->data['privileges'] = $this->page_m->get_privileges();

		    	// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
				

				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
				
	       		// Load the view
				$this->load->view('pages/admin/edit_custom_page', $this->data);
	       	} 

	       	else{
	            //Generate Slug
	            if(!$this->input->post('page_slug')){
	                $page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
	            } else {
	                $page_slug = $this->input->post('page_slug');
	            }

	            //Generate Seo Page Title
	            if(!$this->input->post('seo_page_title'))
	            {
	                $seo_page_title = $this->input->post('page_title');
	            } 
	            else 
	            {
	                $seo_page_title = $this->input->post('seo_page_title');
	            }


	            //Get Page Modules if Any
	              if($this->input->post('page_modules') != ""){
	                $page_modules[] = $this->input->post('page_modules');
	                foreach ($page_modules as $mods) {
	                    foreach($mods as $mod){
	                    $mod_string[] = $mod;
	                    }
	                }
	                //Make Array CSV string
	                $mod_string = implode(",",$mod_string);
	              } else {
	                 $mod_string = 0;
	              }          

	            //Create Posts Data Array
				$data = array(
					'title'						=> $this->input->post('page_title'), 
					'slug'						=> $page_slug, 
					'is_published' 				=> 1, 
					'seo_page_title' 			=> $seo_page_title,
					'meta_keywords' 			=> $this->input->post('page_meta_keywords'),
					'meta_description' 			=> $this->input->post('page_meta_description'),
					'modules'					=> $mod_string,
					'page_type' 				=> 1, // value 1 = custom page content
					'privilege_id'				=> $this->input->post('page_access_level'),

				);



	            //Post Insert
	            $this->page_m->update_by(array('id'=>$page_id), $data);

	            /*********************************************************************************************
	            //
	            //
	            //
	           	//Here are the functions to store data in menu_items table 
				//
				//
				//
				**********************************************************************************************/

	            //Create Page Custom Content Data Array
				$data = array(
					'page_id'					=> $page_id,
					'body'						=> $this->input->post('page_body'),
				); 

				//Post Insert
		        $this->page_m->edit_page_custom_content($data);


				$this->session->set_flashdata('message', '<p>Page Updated Succesfully!</p>');


				redirect('admin/pages');
	       	}
	    }
	    else
		{
			$this->session->set_flashdata('message', '<p>Page Cannot be found!</p>');
			redirect('admin/pages/');
		}//ends else

	}

	/****************************************************************************************************************************
	*****************************************************************************************************************************
	*
	*
	* 											External URL Functions
	*
	*
	*****************************************************************************************************************************
	*****************************************************************************************************************************/


	public function create_external_url_page ()
	{
	    // Check user has privileges to create pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create pages.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Page Validation Rules
		$this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');         
		$this->form_validation->set_rules('external_url','External Url','trim|required');  

    	if($this->form_validation->run() == FALSE){ 

			//Get Access Privileges
			$this->data['privileges'] = $this->page_m->get_privileges();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('pages/admin/create_external_url_page', $this->data);
       	} 

       	else
       	{         
            //Generate Slug
            if(!$this->input->post('page_slug'))
            {
                $page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
            } 
            else 
            {
                $page_slug = $this->input->post('page_slug');
            }

            //Create Posts Data Array
			$data = array(
				'title'						=> $this->input->post('page_title'), 
				'slug'						=> $page_slug, 
				'is_published' 				=> 1, 
				'page_type' 				=> 3, // value 3 = external_url
				'is_home'					=> 0, // by default we set new page as NON homepage
				'privilege_id'				=> $this->input->post('page_access_level'),

			);

            //Post Insert
            $this->page_m->insert($data);

            /*********************************************************************************************/
           	//Get the last insert id of pages table from the page insert.
           	//*we need to construct some functions for the FK we create in the related tables,
           	//*so if, something goes wron while the inserts of the data to all 3 tables we use
           	//*then to stop and get an error for that

            $last_page_id = $this->page_m->get_insert_id();
            $next_page_id = $last_page_id;

			/**********************************************************************************************/

            /*********************************************************************************************
            //
            //
            //
           	//Here are the functions to store data in page_external_url_content table 
			//
			//
			//
			**********************************************************************************************/

            //Create Page external_url Content Data Array
			$data = array(
				'page_id'					=> $next_page_id,
				'external_url'				=> $this->input->post('external_url'),
			); 

			//Post Insert
	        $this->page_m->add_page_external_url_content($data);


			$this->session->set_flashdata('message', '<p>Page Created Succesfully!</p>');


			redirect('admin/pages');
       	}    

	}

	public function edit_external_url_page($page_id){
		// Check user has privileges to update pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update pages.</p>');
			
			redirect('admin/');		
		}

		// If menu found in database do the rest
		if	($this->data['pages'] = $this->page_m->get($page_id) )		
		{

			$this->load->library('form_validation');
			
			//Page Validation Rules
	        $this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('is_published','Page Status','integer');
	        $this->form_validation->set_rules('external_url','External Url','trim|required');  


	    	if($this->form_validation->run() == FALSE){ 

	    		//Get the requested page(based on id)
	    		$this->data['page'] = $this->page_m->get_external_url_page($page_id);

				//Get Access Privileges
				$this->data['privileges'] = $this->page_m->get_privileges();

		    	// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
				

				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
				
	       		// Load the view
				$this->load->view('pages/admin/edit_external_url_page', $this->data);
	       	} 

	       	else{
	            //Generate Slug
	            if(!$this->input->post('page_slug')){
	                $page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
	            } else {
	                $page_slug = $this->input->post('page_slug');
	            }

	            //Create page Data Array
				$data = array(
					'title'						=> $this->input->post('page_title'), 
					'slug'						=> $page_slug, 
					'is_published' 				=> 1, 
					'page_type' 				=> 3, // value 3 = external_url page content
					'privilege_id'				=> $this->input->post('page_access_level'),

				);


	            //Post Insert
	            $this->page_m->update_by(array('id'=>$page_id), $data);

	            /*********************************************************************************************
	            //
	            //
	            //
	           	//Here are the functions to store data in page_external_url_content table 
				//
				//
				//
				**********************************************************************************************/

	            //Create Page Custom Content Data Array
				$data = array(
					'page_id'					=> $page_id,
					'external_url'				=> $this->input->post('external_url'),
				); 

				//Post Insert
		        $this->page_m->edit_page_external_url_content($data);


				$this->session->set_flashdata('message', '<p>Page Updated Succesfully!</p>');


				redirect('admin/pages');
	       	}
	    }
	    else
		{
			$this->session->set_flashdata('message', '<p>Page Cannot be found!</p>');
			redirect('admin/pages/');
		}//ends else

	}

	/******************************************************************************************************************8*********
	*****************************************************************************************************************************
	*
	*
	* 													BLOG PAGE CREATION
	*
	*
	*****************************************************************************************************************************
	*****************************************************************************************************************************/
	public function create_blog_page ()
	{
	    // Check user has privileges to create pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create pages.</p>');
			
			redirect('admin/');		
		}


		$this->load->library('form_validation');

	        //Page Table Fields Validation Rules
		$this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
		$this->form_validation->set_rules('page_meta_keywords','Page Meta Keywords','trim|xss_clean');
		$this->form_validation->set_rules('page_meta_description','Page Meta Description','trim|xss_clean');
		$this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

		if($this->form_validation->run() == FALSE)
		{ 

				//Get Page Modules
			$this->data['page_modules_selection'] = $this->page_m->get_page_modules();

				//Get Page-Blog Categories to show as content in the frontend
			$this->data['page_blog_categories_selection'] = $this->blog_categories_m->get_blog_categories();

				//Get Access Privileges
			$this->data['privileges'] = $this->page_m->get_privileges();

		    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');


				// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		


	       		// Load the view
			$this->load->view('pages/admin/create_blog_page', $this->data);
		} 

		else
		{
	        //Generate Slug
			if(!$this->input->post('page_slug')){
				$page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
			} else {
				$page_slug = $this->input->post('page_slug');
			}

			//Generate Seo Page Title
            if(!$this->input->post('seo_page_title'))
            {
                $seo_page_title = $this->input->post('page_title');
            } 
            else 
            {
                $seo_page_title = $this->input->post('seo_page_title');
            }


	        //Get Page Modules if Any
			if($this->input->post('page_modules') != ""){
				$page_modules[] = $this->input->post('page_modules');
				foreach ($page_modules as $mods) {
					foreach($mods as $mod){
						$mod_string[] = $mod;
					}
				}
	        //Make Array CSV string
				$mod_string = implode(",",$mod_string);
			} else {
				$mod_string = 0;
			}          

	            //Create Posts Data Array
			$data = array(
				'title'						=> $this->input->post('page_title'), 
				'slug'						=> $page_slug, 
				'is_published' 				=> 1, 
				'seo_page_title' 			=> $seo_page_title,
				'meta_keywords' 			=> $this->input->post('page_meta_keywords'),
				'meta_description' 			=> $this->input->post('page_meta_description'),
				'modules'					=> $mod_string,
				'page_type' 				=> 2, // value 2 = blog page content
				'is_home'					=> 0, // by default we set new page as NON homepage
				'privilege_id'				=> $this->input->post('page_access_level'),

				);


	            //Post Insert
			$this->page_m->insert($data);

	            /*********************************************************************************************
	            //
	            //
	            //
	           	//Here are the functions to store data in page_blog_content table 
				//
				//
				//
	            **********************************************************************************************/

	            //Get the last insert id
	            $last_page_id = $this->page_m->get_insert_id();
	            $next_page_id = $last_page_id;

	            //Get Blog Categories if Any
	            if($this->input->post('page_categories') != ""){
	            	$page_categories[] = $this->input->post('page_categories');
	            	foreach ($page_categories as $cats) {
	            		foreach($cats as $cat){
	            			$cat_string[] = $cat;
	            		}
	            	}
	                //Make Array CSV string
	            	$cat_string = implode(",",$cat_string);
	            } else {
	            	$cat_string = 0;
	            }   

					//Create Page Blog Content Data Array
	            $data = array(
	            	'page_id'					=> $next_page_id,
	            	'blog_categories'			=> $cat_string,
	            	);

					//Post Insert
	            $this->page_m->add_blog_content_to_page($data);




	            $this->session->set_flashdata('message', '<p>Page Created Succesfully!</p>');


	            redirect('admin/pages');
	        }

	}

	public function edit_blog_page($page_id)
	{
		// Check user has privileges to update pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update pages.</p>');
			
			redirect('admin/');		
		}

		// If menu found in database do the rest
		if	($this->data['pages'] = $this->page_m->get($page_id) )		
		{
		
			$this->load->library('form_validation');
			
			//Page Validation Rules
	        $this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('page_meta_keywords','Page Meta Keywords','trim|xss_clean');
	        $this->form_validation->set_rules('page_meta_description','Page Meta Description','trim|xss_clean');
	        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');
	        $this->form_validation->set_rules('page_status','Page Status','integer');

	    	if($this->form_validation->run() == FALSE){ 


	    		//Get the requested page(based on id)
	    		$this->data['page'] = $this->page_m->get_blog_page($page_id);

				//Get Page-Blog Categories to show as content in the frontend
				$this->data['page_blog_categories_selection'] = $this->blog_categories_m->get_blog_categories();

	    		//Get Page Modules
				$this->data['page_modules_selection'] = $this->page_m->get_page_modules();

				//Get selected Modules
	            $this->data['selected_blog_categories'] = $this->page_m->get_selected_blog_categories($page_id);

				//Get selected Modules
	            $this->data['selected_modules'] = $this->page_m->get_selected_modules($page_id);

				//Get Access Privileges
				$this->data['privileges'] = $this->page_m->get_privileges();

		    	// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
				

				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
				
	       		// Load the view
				$this->load->view('pages/admin/edit_blog_page', $this->data);
	       	} 

	       	else{
	            //Generate Slug
	            if(!$this->input->post('page_slug')){
	                $page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
	            } else {
	                $page_slug = $this->input->post('page_slug');
	            }

	            //Generate Seo Page Title
	            if(!$this->input->post('seo_page_title'))
	            {
	                $seo_page_title = $this->input->post('page_title');
	            } 
	            else 
	            {
	                $seo_page_title = $this->input->post('seo_page_title');
	            }


	            //Get Page Modules if Any
	              if($this->input->post('page_modules') != ""){
	                $page_modules[] = $this->input->post('page_modules');
	                foreach ($page_modules as $mods) {
	                    foreach($mods as $mod){
	                    $mod_string[] = $mod;
	                    }
	                }
	                //Make Array CSV string
	                $mod_string = implode(",",$mod_string);
	              } else {
	                 $mod_string = 0;
	              }          

	            //Create Posts Data Array
				$data = array(
					'title'						=> $this->input->post('page_title'), 
					'slug'						=> $page_slug, 
					'seo_page_title' 			=> $seo_page_title,
					'meta_keywords' 			=> $this->input->post('page_meta_keywords'),
					'meta_description' 			=> $this->input->post('page_meta_description'),
					'modules'					=> $mod_string,
					'page_type' 				=> 2, // value 2 = custom page blog
					'privilege_id'				=> $this->input->post('page_access_level'),


				);


	            //Post Insert
	            $this->page_m->update_by(array('id'=>$page_id), $data);

	            /*********************************************************************************************
	            //
	            //
	            //
	           	//Here are the functions to store data in page_blog_content table 
				//
				//
				//
				**********************************************************************************************/

	            //Get Blog Categories if Any
	              if($this->input->post('page_categories') != ""){
	                $page_categories[] = $this->input->post('page_categories');
	                foreach ($page_categories as $cats) {
	                    foreach($cats as $cat){
	                    $cat_string[] = $cat;
	                    }
	                }
	                //Make Array CSV string
	                $cat_string = implode(",",$cat_string);
	              } else {
	                  $cat_string = 0;
	              }   

					//Create Page Blog Content Data Array
					$data = array(
						'page_id'					=> $page_id,
						'blog_categories'			=> $cat_string,
					);

					//Post Insert
		            $this->page_m->edit_blog_content_to_page($data);

				$this->session->set_flashdata('message', '<p>Page Updated Succesfully!</p>');


				redirect('admin/pages');
	       	}  

		}
		else
		{
			$this->session->set_flashdata('message', '<p>Page Cannot be found!</p>');
			redirect('admin/pages/');
		}//ends else
	}


/******************************************************************************************************************8*********
	*****************************************************************************************************************************
	*
	*
	* 													Portfolio PAGE CREATION
	*
	*
	*****************************************************************************************************************************
	*****************************************************************************************************************************/
	public function create_portfolio_page ()
	{
	    // Check user has privileges to create pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create pages.</p>');
			
			redirect('admin/');		
		}


		$this->load->library('form_validation');

	        //Page Table Fields Validation Rules
		$this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
		$this->form_validation->set_rules('page_meta_keywords','Page Meta Keywords','trim|xss_clean');
		$this->form_validation->set_rules('page_meta_description','Page Meta Description','trim|xss_clean');
		$this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

		if($this->form_validation->run() == FALSE)
		{ 

			//Get Page Modules
			$this->data['page_modules_selection'] = $this->page_m->get_page_modules();

			//Get Page-Portfolio Categories to show as content in the frontend
			$this->data['page_portfolio_categories_selection'] = $this->portfolio_categories_m->get_portfolio_categories();

			//Get Access Privileges
			$this->data['privileges'] = $this->page_m->get_privileges();

		    // Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');


			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		


	       	// Load the view
			$this->load->view('pages/admin/create_portfolio_page', $this->data);
		} 

		else
		{
	        //Generate Slug
			if(!$this->input->post('page_slug')){
				$page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
			} else {
				$page_slug = $this->input->post('page_slug');
			}

			//Generate Seo Page Title
            if(!$this->input->post('seo_page_title'))
            {
                $seo_page_title = $this->input->post('page_title');
            } 
            else 
            {
                $seo_page_title = $this->input->post('seo_page_title');
            }


	        //Get Page Modules if Any
			if($this->input->post('page_modules') != ""){
				$page_modules[] = $this->input->post('page_modules');
				foreach ($page_modules as $mods) {
					foreach($mods as $mod){
						$mod_string[] = $mod;
					}
				}
	        //Make Array CSV string
				$mod_string = implode(",",$mod_string);
			} else {
				$mod_string = 0;
			}          

	        //Create Posts Data Array
			$data = array(
				'title'						=> $this->input->post('page_title'), 
				'slug'						=> $page_slug, 
				'is_published' 				=> 1, 
				'seo_page_title' 			=> $seo_page_title,
				'meta_keywords' 			=> $this->input->post('page_meta_keywords'),
				'meta_description' 			=> $this->input->post('page_meta_description'),
				'modules'					=> $mod_string,
				'page_type' 				=> 4, // value 4 = portfolio page content
				'is_home'					=> 0, // by default we set new page as NON homepage
				'privilege_id'				=> $this->input->post('page_access_level'),

				);


	        //Post Insert
			$this->page_m->insert($data);

	            /*********************************************************************************************
	            //
	            //
	            //
	           	//Here are the functions to store data in page_portfolio_content table 
				//
				//
				//
	            **********************************************************************************************/

	            //Get the last insert id
	            $last_page_id = $this->page_m->get_insert_id();
	            $next_page_id = $last_page_id;

	            //Get Portfolio Categories if Any
	            if($this->input->post('page_categories') != "")
	            {
	            	$page_categories[] = $this->input->post('page_categories');
	            	foreach ($page_categories as $cats) 
	            	{
	            		foreach($cats as $cat)
	            		{
	            			$cat_string[] = $cat;
	            		}
	            	}

	                //Make Array CSV string
	            	$cat_string = implode(",",$cat_string);
	            } 
	            else 
	            {
	            	$cat_string = 0;
	            }   

				//Create Page Portfolio Content Data Array
	            $data = array(
	            	'page_id'					=> $next_page_id,
	            	'portfolio_categories'		=> $cat_string,
	            	);

				//Post Insert
	            $this->page_m->add_portfolio_content_to_page($data);

	            $this->session->set_flashdata('message', '<p>Page Created Succesfully!</p>');

	            redirect('admin/pages');
	        }

	}

	public function edit_portfolio_page($page_id)
	{
		// Check user has privileges to update pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update pages.</p>');
			
			redirect('admin/');		
		}

		// If requested page exists do the rest
		if	($this->data['pages'] = $this->page_m->get($page_id) )		
		{
		
			$this->load->library('form_validation');
			
			//Page Validation Rules
	        $this->form_validation->set_rules('page_title','Page Title','trim|required|max_length[100]|xss_clean');  
	        $this->form_validation->set_rules('page_slug','Page Slug','trim|max_length[100]|url_title|xss_clean');   
	        $this->form_validation->set_rules('page_meta_keywords','Page Meta Keywords','trim|xss_clean');
	        $this->form_validation->set_rules('page_meta_description','Page Meta Description','trim|xss_clean');
	        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');
	        $this->form_validation->set_rules('page_status','Page Status','integer');

	    	if($this->form_validation->run() == FALSE){ 


	    		//Get the requested page(based on id)
	    		$this->data['page'] = $this->page_m->get_portfolio_page($page_id);

				//Get Page-Portfolio Categories to show as content in the frontend
				$this->data['page_portfolio_categories_selection'] = $this->portfolio_categories_m->get_portfolio_categories();

	    		//Get Page Modules
				$this->data['page_modules_selection'] = $this->page_m->get_page_modules();

				//Get selected portfolio categories
	            $this->data['selected_portfolio_categories'] = $this->page_m->get_selected_portfolio_categories($page_id);

				//Get selected Modules
	            $this->data['selected_modules'] = $this->page_m->get_selected_modules($page_id);

				//Get Access Privileges
				$this->data['privileges'] = $this->page_m->get_privileges();

		    	// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
				

				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
				
	       		// Load the view
				$this->load->view('pages/admin/edit_portfolio_page', $this->data);
	       	} 

	       	else{
	            //Generate Slug
	            if(!$this->input->post('page_slug')){
	                $page_slug = urldecode(strtolower(str_replace(' ','-',$this->input->post('page_title'))));
	            } else {
	                $page_slug = $this->input->post('page_slug');
	            }

	            //Generate Seo Page Title
	            if(!$this->input->post('seo_page_title'))
	            {
	                $seo_page_title = $this->input->post('page_title');
	            } 
	            else 
	            {
	                $seo_page_title = $this->input->post('seo_page_title');
	            }


	            //Get Page Modules if Any
	            if($this->input->post('page_modules') != "")
	            {
	            	$page_modules[] = $this->input->post('page_modules');
	            	foreach ($page_modules as $mods) 
	            	{
	            		foreach($mods as $mod)
	            		{
	            			$mod_string[] = $mod;
	            		}
	            	}

	                //Make Array CSV string
	            	$mod_string = implode(",",$mod_string);
	            } 
	            else 
	            {
	            	$mod_string = 0;
	            }          

	            //Create Posts Data Array
				$data = array(
					'title'						=> $this->input->post('page_title'), 
					'slug'						=> $page_slug, 
					'seo_page_title' 			=> $seo_page_title,
					'meta_keywords' 			=> $this->input->post('page_meta_keywords'),
					'meta_description' 			=> $this->input->post('page_meta_description'),
					'modules'					=> $mod_string,
					'page_type' 				=> 4, // value 4 = portfolio page
					'privilege_id'				=> $this->input->post('page_access_level'),


				);

	            //Post Insert
	            $this->page_m->update_by(array('id'=>$page_id), $data);

	            /*********************************************************************************************
	            //
	            //
	            //
	           	//Here are the functions to store data in page_portfolio_content table 
				//
				//
				//
				**********************************************************************************************/

	            //Get Portfolio Categories if Any
	              if($this->input->post('page_categories') != ""){
	                $page_categories[] = $this->input->post('page_categories');
	                foreach ($page_categories as $cats) {
	                    foreach($cats as $cat){
	                    $cat_string[] = $cat;
	                    }
	                }
	                //Make Array CSV string
	                $cat_string = implode(",",$cat_string);
	              } else {
	                  $cat_string = 0;
	              }   

					//Update Page Portfolio Content Data Array
					$data = array(
						'page_id'					=> $page_id,
						'portfolio_categories'			=> $cat_string,
					);

					//Post Insert
		            $this->page_m->edit_portfolio_content_to_page($data);

				$this->session->set_flashdata('message', '<p>Page Updated Succesfully!</p>');


				redirect('admin/pages');
	       	}  

		}
		else
		{
			$this->session->set_flashdata('message', '<p>Page Cannot be found!</p>');
			redirect('admin/pages/');
		}//ends else
	}



	// This makes call to MY_model function with soft_delete enabled so categories deleted from that function
	// goes to trashed categories, because deleted is set to 1 and not permanetly deleted.
    public function delete_page($id){      
	    // Check user has privileges to delete pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Pages.</p>');
			
			redirect('admin/');		
		}

		// If page is found on database delete it
		if	($this->data['pages'] = $this->page_m->get($id) )
			
			{

		        //Delete article
		        $this->page_m->delete($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Page Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/pages');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Page Cannot be found!</p>');

			redirect('admin/pages');

			}
     }


	// This function permanetly delete trashed custom pages from the database
    public function delete_trashed_custom_page($id){      
	    // Check user has privileges to permanently delete pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Pages.</p>');
			
			redirect('admin/');		
		}

		        //Delete article
		        $this->page_m->delete_trashed_page($id);

		        //Delete page menu item
		        $this->page_m->delete_page_menu_item($id);

		        //Delete article
		        $this->page_m->delete_page_custom_content($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Page Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/pages/trashed_pages');
    }

    // This function permanetly delete trashed custom pages from the database
    public function delete_trashed_external_url_page($id){      
	    // Check user has privileges to permanently delete pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Pages.</p>');
			
			redirect('admin/');		
		}

		        //Delete article
		        $this->page_m->delete_trashed_page($id);

		        //Delete page menu item
		        $this->page_m->delete_page_menu_item($id);

		        //Delete article
		        $this->page_m->delete_page_external_url_content($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Page Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/pages/trashed_pages');
    }

	// This function permanetly delete trashed blog pages from the database
    public function delete_trashed_blog_page($id){      
	    // Check user has privileges to permanently delete pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Pages.</p>');
			
			redirect('admin/');		
		}

		        //Delete article
		        $this->page_m->delete_trashed_page($id);

		        //Delete page menu item
		        $this->page_m->delete_page_menu_item($id);

		        //Delete article
		        $this->page_m->delete_page_blog_content($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Page Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/pages/trashed_pages');
    }


	// This function permanetly delete trashed blog pages from the database
    public function delete_trashed_portfolio_page($id){      
	    // Check user has privileges to permanently delete pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Pages.</p>');
			
			redirect('admin/');		
		}

		        //Delete page
		        $this->page_m->delete_trashed_page($id);

		        //Delete page menu item
		        $this->page_m->delete_page_menu_item($id);

		        //Delete portfolio content
		        $this->page_m->delete_page_portfolio_content($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Page Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/pages/trashed_pages');
    }

    public function set_home_page($id){
    	// Check user has privileges to Publish/Unpublish pages, 
    	// else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Set Home Page'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Set Home Page.</p>');
			
			redirect('admin/');		
		}

		$page = $this->page_m->get_page($id);

		//We ensure that a custom url page will never be set as homepage(custom_url_page has page_type = 3)
		if ($page->page_type != 3)
		{

			//************************************************************************************************************
			// Before we'll set the homepage, we unset any homepage, using the update_all function from core/My_Model
			//************************************************************************************************************
			$data = array(
				'is_home' => 0,
				);
			$this->page_m->update_all($data);
			//************************************************************************************************************


			//Set home page
			$this->page_m->set_home_page($id);
			         
			//Create Message
			$this->session->set_flashdata('message','<p>Home page is set Succesfully!</p>');
			            
			//Redirect to pages
			redirect('admin/pages');
		}
		else
		{
			//Create Message
			$this->session->set_flashdata('message','<p>Custom Url is not an option of homepage!</p>');
			            
			//Redirect to pages
			redirect('admin/pages');
		}
    }

    public function publish_page($id){
    	// Check user has privileges to Publish/Unpublish pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Pages.</p>');
			
			redirect('admin/');		
		}

		//Delete article
		$this->page_m->publish_page($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Page Published Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/pages');
    }

    public function unpublish_page($id){
    	// Check user has privileges to Publish/Unpublish pages, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Pages'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Pages.</p>');
			
			redirect('admin/');		
		}

		//We load the functon to get the page we want depending on the page_type of requested url
		$this->data['homepage'] = $this->page_m->get_home_page();

		$is_home = $this->data['homepage']->is_home;

			//Unpublish page
			$this->page_m->unpublish_page($id);
				         
			//Create Message
			$this->session->set_flashdata('message', '<p>Page Unpublished Succesfully!</p>');

			//Redirect to categories
			redirect('admin/pages');
		            
    }


}
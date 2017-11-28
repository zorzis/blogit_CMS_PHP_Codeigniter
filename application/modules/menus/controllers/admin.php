<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 5;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('menu_m');
	}

	public function index ()
	{
		// Check user has privileges to view menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to View Menus.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_menus'] = $this->db->count_all('menus');

		// Fetch all articles
		//Configure pagination
        $config['base_url'] = base_url().'admin/menus/page';
        $config['total_rows'] = $this->data['total_menus'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/menus';
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
	
        $this->data['menus'] = $this->menu_m->limit( $config['per_page'],$this->uri->segment(4))->get_menus();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('menus/admin/menus_view', $this->data);		
	}

	public function trashed_menus ()
	{
		// Check user has privileges to view menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view trashed menus.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('pagination');

		$this->data['total_menus'] = $this->db->count_all('menus');

		//Configure pagination
        $config['base_url'] = base_url().'admin/menus/trashed_menus/page';
        $config['total_rows'] = $this->data['total_menus'];
        $config['per_page'] = $this->post_limit; 
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;

        $config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/menus/trashed_menus/';
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
        $this->data['menus'] = $this->menu_m->limit( $config['per_page'],$this->uri->segment(5))->get_trashed_menus();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('menus/admin/menus_trashed', $this->data);		
	}

	public function create_menu ()
	{
	    // Check user has privileges to create menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to create menus.</p>');
			
			redirect('admin/');		
		}

		$this->load->library('form_validation');
		
		//Validation Rules
        $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');  
		$this->form_validation->set_rules('show_title','Show Title','integer');  
        $this->form_validation->set_rules('is_global','Set Global','integer');
        $this->form_validation->set_rules('is_published','Is Publish','integer');
        $this->form_validation->set_rules('priority_order','Menu Order','integer');



    	if($this->form_validation->run() == FALSE){ 

    		//Get pages
    		$this->data['pages'] = $this->page_m->get_pages();

			//Get Privileges
			$this->data['privileges'] = $this->menu_m->get_privileges();

	    	// Set validation errors.
			$this->data['message'] = validation_errors('<p>', '</p>');
			

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			

       		// Load the view
			$this->load->view('menus/admin/menus_create', $this->data);
       	} 

       	else{

		        //Create Menus Data Array
				$data = array(
					'title'						=> $this->input->post('title'), 
					'is_published' 				=> $this->input->post('is_published'),
					'is_global' 				=> $this->input->post('is_global'),
					'show_title' 				=> $this->input->post('show_title'),
					'priority_order'			=> $this->input->post('priority_order'),
					'privilege_id'				=> $this->input->post('privilege'),
				);

            //Menu Insert
            $this->menu_m->insert($data);

            /********************* Insert Data to menu_items table *********************/

            //Get the last insert id
            $last_menu_id = $this->menu_m->get_insert_id();
            $next_menu_id = $last_menu_id;

            //Create Page Blog Content Data Array
            foreach ($this->input->post('page') as $page)
			{
				$menu_items = array(
					'menu_id' 					=> $next_menu_id,
					'page_id'					=> $page,
				);

				$this->db->insert('menu_items', $menu_items);
			};


			$this->session->set_flashdata('message', '<p>Menu Created Succesfully!</p>');


			redirect('admin/menus');
       	}    

	}

	/** 
	**
	**	Here we create the ajax view to order the menu items (pages).
	**	Notice that we unset the template, so view only the order_ajax.php view file, without the header 
	**
	**/
	public function order_ajax($id = NULL)
	{
		
		//Call the get_menu model function using the id of the current menu we edit
		$this->menu = $this->menu_m->get_menu($id);
		//Declare the $menu_id as the id of the menu we edit
		$menu_id = $this->menu->id;


		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			$this->menu_m->save_menu_items_order($_POST['sortable'], $menu_id);
		}

    	//Pass the menu id to our get_nested_menu_items function, to show only
    	//the menu_items(pages) belonging to the current menu we edit.
    	$this->data['menu_items'] = $this->menu_m->get_nested_menu_items($menu_id);
		
    	//Unset the template to show only html of order_ajax view
    	$this->output->unset_template();
       	// Load the view
		$this->load->view('menus/admin/includes/admin_order_pages_to_menu', $this->data);
	}

	public function edit_menu ($id = NULL, $page = NULL)
	{
	    // Check user has privileges to update menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Update Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update menus.</p>');
			
			redirect('admin/');		
		}

		// If menu found in database do the rest
		if	($this->data['menus'] = $this->menu_m->get($id) )		
		{

			$this->load->library('form_validation');

			//Validation Rules
	        $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|xss_clean');  
			$this->form_validation->set_rules('show_title','Show Title','integer');  
	        $this->form_validation->set_rules('is_global','Set Global','integer');
	        $this->form_validation->set_rules('is_published','Is Publish','integer');
	        $this->form_validation->set_rules('priority_order','Menu Order','integer');


			if($this->form_validation->run() == FALSE)
			{ 

			    //Get the menu to edit 
			    $this->data['menu'] = $this->menu_m->get_menu($id);

				//Get pages
	    		$this->data['pages'] = $this->page_m->get_pages();

	    		//Get pages assigned to current menu, based on menu_id on menu_items table for eah raw
	    		$current_menu_pages = $this->menu_m->current_menu_pages($id);

	    		$this->data['current_menu_pages'] = array();
	    		foreach($current_menu_pages as $page)
	    		{
	    			$this->data['current_menu_pages'][] = $page->page_id;
	    		}


				//Get Privileges
				$this->data['privileges'] = $this->menu_m->get_privileges();

				//Get Created By name for logging events
	    		$this->data['created_by'] = $this->menu_m->get_created_by($id);

	    		//Get Modified By for logging events
	    		$this->data['modified_by'] = $this->menu_m->get_modified_by($id);

				// Set validation errors.
				$this->data['message'] = validation_errors('<p>', '</p>');
					
				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
					
				// Load the view
				$this->load->view('menus/admin/menus_update', $this->data);
			}

			else 
			{

			        //Create Menus Data Array
					$data = array(
						'title'						=> $this->input->post('title'), 
						'is_published' 				=> $this->input->post('is_published'),
						'is_global' 				=> $this->input->post('is_global'),
						'show_title' 				=> $this->input->post('show_title'),
						'priority_order'			=> $this->input->post('priority_order'),
						'privilege_id'				=> $this->input->post('privilege'),
					);

					//Post Udate
			        $this->menu_m->update_by(array('id'=>$id), $data);


			        /********************* Insert Data to menu_items table *********************/
					$this->menu_m->update_menu_pages($id);  


			        $this->session->set_flashdata('message', '<p>Menu Updated Succesfully!</p>');


					redirect('admin/menus/edit_menu/'.$id );

		    }//ends else
	   	}//ends if
		else
		{
			$this->session->set_flashdata('message', '<p>Menu Cannot be found!</p>');
			redirect('admin/menus/');
		}//ends else
	}// end edit function

	// This makes call to MY_model function with soft_delete enabled so categories deleted from that function
	// goes to trashed categories, because deleted is set to 1 and not permanetly deleted.
    public function delete_menu($id){      
	    // Check user has privileges to delete menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Menus.</p>');
			
			redirect('admin/');		
		}

		// If menu is found on database delete it
		if	($this->data['menus'] = $this->menu_m->get($id) )
			
			{

		        //Delete article
		        $this->menu_m->delete($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Menu Moved to Trashed Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/menus');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Menu Cannot be found!</p>');

			redirect('admin/menus');

			}
     }

	// This function permanetly delete trashed menus from the database
    public function delete_trashed_menu($id){      
	    // Check user has privileges to permanently delete menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Menus.</p>');
			
			redirect('admin/');		
		}

		
		        //Delete article
		        $this->menu_m->delete_trashed_menu($id);

		        //Delete menu_items from menu_items table based on current menu we editing, $id
		        $this->menu_m->delete_menu_items_when_a_menu_is_deleted($id);

		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Menu Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/menus/trashed_menus');

    }

    public function publish_menu($id){
    	// Check user has privileges to Publish/Unpublish menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Menus.</p>');
			
			redirect('admin/');		
		}

		//Delete article
		$this->menu_m->publish_menu($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Menu Published Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/menus');
    }

    public function unpublish_menu($id){
    	// Check user has privileges to Publish/Unpublish menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Publish/Unpublish Menus'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Publish/Unpublish Menus.</p>');
			
			redirect('admin/');		
		}

		//Delete article
		$this->menu_m->unpublish_menu($id);
		         
		//Create Message
		$this->session->set_flashdata('message', '<p>Menu Unpublished Succesfully!</p>');
		            
		//Redirect to categories
		redirect('admin/menus');
    }


	// This function permanetly delete trashed menus from the database
    public function delete_trashed_item($id){      
	    // Check user has privileges to permanently delete menus, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Menu Items'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Delete Menu Items.</p>');
			
			redirect('admin/');		
		}

		// If article is found on database delete it
		if	($this->data['items'] = $this->menu_m->get_item($id) )
			
			{
		    	//Delete article
		        $this->menu_m->delete_trashed_item($id);
		         
		        //Create Message
		        $this->session->set_flashdata('message', '<p>Trashed Menu Item Deleted Succesfully!</p>');
		            
		        //Redirect to categories
		        redirect('admin/menus/items/trashed_items');
		    }

		else{

			$this->session->set_flashdata('message', '<p>Menu Item Cannot be found!</p>');

			redirect('admin/menus/items');

			}
    }














}
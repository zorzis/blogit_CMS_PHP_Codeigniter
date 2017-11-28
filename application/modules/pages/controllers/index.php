<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Index extends Public_Controller
{

    private $post_limit = 100;

    private $latest_articles_limit = 10;


	public function __construct ()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->benchmark->mark('auth_start');

		$total_segments = $this->uri->total_segments();

		if($total_segments == 0 || is_numeric($this->uri->segment(1)))
		{
			//We load the functon to get the page we want depending on the page_type of requested url
	    	$this->data['page'] = $this->frontend_model->get_home_page();
	    	$page = $this->data['page'];		
		
			count($this->data['page']) || show_404(uri_string());

		 	//We ensure that there is a page in the db as homepage, 
			//to avoid errors of not getting property in the frontend,
			//when pages db is empty or non page is selected as homepage
	    	if(!empty($this->data['page']))
	    	{
				//Get page_type so we can use it in the "if" functions bellow
		    	$page_type = $this->data['page']->page_type;

				//Get page_id
		    	$page_id = $this->data['page']->id;

		    	//We take the privilege id of the page we have assign from backend
		    	$page_access_privilege = $this->data['page']->privilege_id;

			    //We ensure that privilege id is not 0. Public Access is assigned to 0 value and is not passed in the 
			    //database of access privileges
		    	if ($page_access_privilege != 0)
		    	{

		    		$access_privilege_name = $this->frontend_model->get_page_privilege_name($page_access_privilege);

		    		if(empty($access_privilege_name))
		    		{
		    				//If user has not the access privilege we return him in the 404 page
		    			show_404(uri_string());		
		    		}
		    		else
		    		{
							//We check if user has the access level to see the page content
			    			//We use the flexi_auth_lite library for the frontend, despite in backend we use flexi_auth library
		    			if (! $this->flexi_auth_lite->is_privileged($access_privilege_name->upriv_name))
		    			{
								//If user has not the access privilege we return him in the 404 page
		    				show_404(uri_string());		
		    			}
		    		}


		    	}

			    
	    	


					/**********************************Meta and Logo Starts********************************/

					$this->data['settings'] = $this->settings_m->get_settings();
					$settings = $this->data['settings'];

					$default_seo_meta_description = $settings->meta_description;
					$default_seo_meta_keywords = $settings->meta_keywords;
					$default_seo_page_title = $settings->seo_page_title;

					$page_seo_meta_description = $page->meta_description;
					$page_seo_meta_keywords = $page->meta_keywords;
					$page_seo_page_title = $page->seo_page_title;

					//Set Seo Page Title
					if (!empty($page_seo_page_title))
					{

						$this->data['seo_page_title'] = $page_seo_page_title;

					}
					else
					{
						$this->data['seo_page_title'] = $default_seo_page_title;
					}

					//Set Seo Meta Keywords
					if (!empty($page_seo_meta_keywords))
					{

						$this->data['seo_meta_keywords'] = $page_seo_meta_keywords;

					}
					else
					{
						$this->data['seo_meta_keywords'] = $default_seo_meta_keywords;
					}

					//Set Seo Meta Description
					if (!empty($page_seo_meta_description))
					{

						$this->data['seo_meta_description'] = $page_seo_meta_description;

					}
					else
					{
						$this->data['seo_meta_description'] = $default_seo_meta_description;
					}



				/*********************************************************************************************************/
				//
				//								Modules and Tempalte Sections Loader
				//					
				/*********************************************************************************************************/
			
				//Get default Template to assing positions
				$default_template = $this->templates_m->get_default_template();
				$default_template_name = $default_template->title;

				//Get template positions
				$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template->title . '/positions';
				$extensions = array('php');

				$template_positions = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);



				/**************************************Page Modules************************************/

				//Get witch published page is a portfolio or a blog and choose 
				//(a little paradox to work with urls in portfolio module and blog modules links)

				//portfolio page slug
				$portfolio_page = $this->page_m->get_portfolio_page_for_portfolio_modules_use();
				$this->data['portfolio_page_slug'] = $portfolio_page->slug;				
				//blog page slug
				$blog_page = $this->page_m->get_blog_page_for_blog_modules_use();
				$this->data['blog_page_slug'] = $blog_page->slug;

				//Get the selected modules for each Page
				$selected_page_modules = $this->frontend_model->get_selected_modules($page_id);

				if (!empty($template_positions)) 
				{
					foreach ($template_positions AS $position)
					{
						//Using basename (core PHP funtion ) we can get only the filename without the extension
						//that we know it is a .php file. To achieve that we use in get_filenames_by_extension
						//with 3rd parameter to TRUE, so we can get the full path to the file, as needed by "basename"
						$position = basename($position, ".php");
						$this->data['position'] = $position;

						$page_modules = $this->frontend_model->get_page_selected_modules_content($selected_page_modules, $position);
					    
					    //Check if $page_modules is not empty to avoid errors on pages showing modules meant not to be shown
						if (!empty($page_modules)) 
						{
						    
						    //Get Custom Modules Data
						    $this->data['custom_modules'] = $this->frontend_model->get_custom_modules($page_modules);
						    

						    //Get Menu Modules Data
						    $this->data['menu_modules'] = $this->frontend_model->get_menu_modules($page_modules);
						    //Get Menu Modules Menu Items data using $this->data['menu_modules'] we got above
						    $this->data['menu_items'] = $this->frontend_model->get_menu_items_per_menu_module($this->data['menu_modules']);

						    //Get Latest Articles Modules
						    $this->data['latest_articles_blog_modules'] = $this->frontend_model->get_latest_blog_articles_modules($page_modules);
						    
						    //Get Popular Articles Modules
						    $this->data['popular_articles_blog_modules'] = $this->frontend_model->get_popular_blog_articles_modules($page_modules);

						    //Get Image Slider Modules
						    $this->data['image_slider_modules'] = $this->frontend_model->get_image_slider_modules($page_modules);
						    
						    //Get Portfolio Modules
						    $this->data['portfolio_modules'] = $this->frontend_model->get_portfolio_modules($page_modules);


						    $this->data['path_to_custom_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/custom_modules/';
						    $this->data['path_to_menu_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/menu_modules/';
						    $this->data['path_to_latest_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/latest_articles/';
						    $this->data['path_to_popular_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/popular_articles/';
						    $this->data['path_to_image_slider_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/image_slider_modules/';
						    $this->data['path_to_portfolio_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/portfolio_modules/';

						}

						$this->load->section($position, 'themes/'. $default_template->title . '/positions/' . $position, $this->data);
						
					}
				}



				//****************************************************************************************/
				//
				//				Custom Content Frontend Functions based on page_type
				//
				/*****************************************************************************************/
				if ($page_type == 1)
				{

					$this->_custom_page_content($page_id, $default_template_name);

				}

				//****************************************************************************************/
				//
				//				Blog Content Frontend Functions based on page_type
				//
				/*****************************************************************************************/
				elseif($page_type == 2)
				{

					$this->_blog_homepage_content($page_id, $default_template_name);

				}

				//****************************************************************************************/
				//
				//				Portfolio Content Frontend Functions based on page_type
				//
				/*****************************************************************************************/
				elseif($page_type == 4)
				{

					$this->_portfolio_content($page_id, $default_template_name);

				}

			}
		}

		else if(is_numeric($this->uri->total_segments()))
		{

			if(!is_numeric($this->uri->segment(1)))
			{
				$page_slug = $this->uri->segment(1);


				$this->data['page'] = $this->frontend_model->get_page_by_slug($page_slug);

				$page = $this->data['page'];
					
				count($this->data['page']) || show_404(uri_string());

				//We ensure that there is a page in the db as homepage, 
				//to avoid errors of not getting property in the frontend,
				//when pages db is empty or non page is selected as homepage
				if(!empty($this->data['page']))
		    	{
					//Get page_type so we can use it in the "if" functions bellow
			    	$page_type = $this->data['page']->page_type;

					//Get page_id
			    	$page_id = $this->data['page']->id;

			    	//We take the privilege id of the page we have assign from backend
			    	$page_access_privilege = $this->data['page']->privilege_id;

			    	//We ensure that privilege id is not 0. Public Access is assigned to 0 value and is not passed in the 
			    	//database of access privileges
		    		if ($page_access_privilege != 0)
		    		{
		    			var_dump($page_access_privilege );

		    			$access_privilege_name = $this->frontend_model->get_page_privilege_name($page_access_privilege);
		    			var_dump($access_privilege_name);

		    			if(empty($access_privilege_name))
		    			{
		    				//If user has not the access privilege we return him in the 404 page
							show_404(uri_string());		
		    			}
		    			else
		    			{
							//We check if user has the access level to see the page content
			    			//We use the flexi_auth_lite library for the frontend, despite in backend we use flexi_auth library
							if (! $this->flexi_auth_lite->is_privileged($access_privilege_name->upriv_name))
							{
								//If user has not the access privilege we return him in the 404 page
								show_404(uri_string());		
							}
		    			}

		    			
		    		}


					/**********************************Meta and Logo Starts********************************/

					$this->data['settings'] = $this->settings_m->get_settings();
					$settings = $this->data['settings'];

					$default_seo_meta_description = $settings->meta_description;
					$default_seo_meta_keywords = $settings->meta_keywords;
					$default_seo_page_title = $settings->seo_page_title;

					$page_seo_meta_description = $page->meta_description;
					$page_seo_meta_keywords = $page->meta_keywords;
					$page_seo_page_title = $page->seo_page_title;

					//Set Seo Page Title
					if (!empty($page_seo_page_title))
					{

						$this->data['seo_page_title'] = $page_seo_page_title;

					}
					else
					{
						$this->data['seo_page_title'] = $default_seo_page_title;
					}

					//Set Seo Meta Keywords
					if (!empty($page_seo_meta_keywords))
					{

						$this->data['seo_meta_keywords'] = $page_seo_meta_keywords;

					}
					else
					{
						$this->data['seo_meta_keywords'] = $default_seo_meta_keywords;
					}

					//Set Seo Meta Description
					if (!empty($page_seo_meta_description))
					{

						$this->data['seo_meta_description'] = $page_seo_meta_description;

					}
					else
					{
						$this->data['seo_meta_description'] = $default_seo_meta_description;
					}




					/*********************************************************************************************************/
					//
					//								Modules and Tempalte Sections Loader
					//					
					/*********************************************************************************************************/
			
					//Get default Template to assing positions
					$default_template = $this->templates_m->get_default_template();
					$default_template_name = $default_template->title;


					//Get template positions
					$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template->title . '/positions';
					$extensions = array('php');

					$template_positions = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);

					/**************************************Page Modules************************************/

					//Get witch published page is a portfolio or a blog and choose 
					//(a little paradox to work with urls in portfolio module and blog modules links)

					//portfolio page slug
					$portfolio_page = $this->page_m->get_portfolio_page_for_portfolio_modules_use();
					$this->data['portfolio_page_slug'] = $portfolio_page->slug;				
					//blog page slug
					$blog_page = $this->page_m->get_blog_page_for_blog_modules_use();
					$this->data['blog_page_slug'] = $blog_page->slug;

					//Get the selected modules for each Page
					$selected_page_modules = $this->frontend_model->get_selected_modules($page_id);

					if (!empty($template_positions)) 
					{
						foreach ($template_positions AS $position)
						{

							//Using basename (core PHP funtion ) we can get only the filename without the extension
							//that we know it is a .php file. To achieve that we use in get_filenames_by_extension
							//with 3rd parameter to TRUE, so we can get the full path to the file, as needed by "basename"
							$position = basename($position, ".php");

							$this->data['position'] = $position;

							$page_modules = $this->frontend_model->get_page_selected_modules_content($selected_page_modules, $position);
						    
						    //Check if $page_modules is not empty to avoid errors on pages showing modules meant not to be shown
							if (!empty($page_modules)) 
							{
							    //Get Custom Modules Data
							    $this->data['custom_modules'] = $this->frontend_model->get_custom_modules($page_modules);
							    

							    //Get Menu Modules Data
							    $this->data['menu_modules'] = $this->frontend_model->get_menu_modules($page_modules);
							    //Get Menu Modules Menu Items data using $this->data['menu_modules'] we got above
							    $this->data['menu_items'] = $this->frontend_model->get_menu_items_per_menu_module($this->data['menu_modules']);

							    //Get Latest Articles Modules
							    $this->data['latest_articles_blog_modules'] = $this->frontend_model->get_latest_blog_articles_modules($page_modules);

							    //Get Popular Articles Modules
							    $this->data['popular_articles_blog_modules'] = $this->frontend_model->get_popular_blog_articles_modules($page_modules);

							    //Get Image Slider Modules
							    $this->data['image_slider_modules'] = $this->frontend_model->get_image_slider_modules($page_modules);

							    //Get Portfolio Modules
							    $this->data['portfolio_modules'] = $this->frontend_model->get_portfolio_modules($page_modules);


							    $this->data['path_to_custom_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/custom_modules/';
							    $this->data['path_to_menu_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/menu_modules/';
							    $this->data['path_to_latest_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/latest_articles/';
							    $this->data['path_to_popular_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/popular_articles/';
							    $this->data['path_to_image_slider_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/image_slider_modules/';
							    $this->data['path_to_portfolio_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/portfolio_modules/';

							}

							$this->load->section($position, 'themes/'. $default_template->title . '/positions/' . $position, $this->data);
						}
					}

					//****************************************************************************************/
					//
					//				Custom Content Frontend Functions based on page_type
					//
					/*****************************************************************************************/
					if ($page_type == 1)
					{

						$this->_custom_page_content($page_id, $default_template_name);

					}

					//****************************************************************************************/
					//
					//				Blog Content Frontend Functions based on page_type
					//
					/*****************************************************************************************/
					elseif($page_type == 2)
					{

						$this->_blog_page_content($page_id, $default_template_name);

					}

					//****************************************************************************************/
					//
					//				Portfolio Content Frontend Functions based on page_type
					//
					/*****************************************************************************************/
					elseif($page_type == 4)
					{

						$this->_portfolio_content($page_id, $default_template_name);

					}

				}
			}

		}
    	$this->benchmark->mark('auth_end');	
    }


    private function _custom_page_content($page_id, $default_template_name)
    {

		//Get the requested page(based on id)
    	$this->data['page'] = $this->page_m->get_custom_page($page_id);


		// Load view
		$this->load->view('themes/' . $default_template_name . '/templates/frontend_custom_content', $this->data);	

	}

	private function _portfolio_content($page_id, $default_template_name)
	{

		//Get the function to get portfolio categories related to the blog page
		$this->data['portfolio_categories'] = $this->page_m->get_selected_portfolio_categories($page_id);

		//Create the portfolio categories array
		$portfolio_categories = $this->data['portfolio_categories'];

		//Choose the articles that belong to the above categories.
		//We pass the $blog_categories array to the model functon get_blog_articles
		//that is used in the or_where_in db function in the article_m->get_blog_articles function

		//Fetch all projects
		$this->data['projects'] = $this->portfolio_m->get_portfolio_projects_frontend($portfolio_categories);
		//var_dump($this->data['page']->slug);
		//var_dump($this->data['projects']);
		//Get Articles Media(function to show for each article is done in the view)
		$this->data['projects_media'] = $this->portfolio_m->get_portfolio_projects_media_frontend($this->data['projects']);
		
		// Load view
		$this->load->view('themes/' . $default_template_name . '/templates/frontend_portfolio_content', $this->data);

	}

	private function _blog_homepage_content($page_id, $default_template_name)
	{

		//Get the function to get blog categories related to the blog page
		$this->data['blog_categories'] = $this->page_m->get_selected_blog_categories($page_id);

		//Create the blog_categories array
		$blog_categories = $this->data['blog_categories'];
		//var_dump($blog_categories);

		/*********************************************************************************************************/
		//							Create Pagination Functions for Homepage Blog Page
		/*********************************************************************************************************/
		$this->load->library('pagination');

		$this->data['total_articles'] = $this->article_m->count_blog_articles_per_frontpage($blog_categories);

		        //Configure pagination
		$config['base_url'] = base_url().'';
		$config['total_rows'] = $this->data['total_articles'];
		$config['per_page'] = $this->post_limit; 
		$config['uri_segment'] = 1;
		$config['use_page_numbers'] = TRUE;

		$config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/';
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';	
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		$config['prev_tag_open'] = '';
		$config['prev_tag_close'] = '';
		$config['next_tag_open'] = '';
		$config['next_tag_close'] = '';
		$config['next_link'] = 'Older';
		$config['prev_link'] = 'Newer';

		//Init pagination
		$this->pagination->initialize($config);

		//Choose the articles that belong to the above categories.
		//We pass the $blog_categories array to the model functon get_blog_articles
		//that is used in the or_where_in db function in the article_m->get_blog_articles function

		//Fetch all articles with pagination
		$this->data['articles'] = $this->article_m->limit( $config['per_page'],$this->uri->segment(1))->get_blog_articles($blog_categories);

		//Get Articles Media(function to show for each article is done in the view)
		$this->data['articles_media'] = $this->article_m->get_articles_media_frontend($this->data['articles']);
		
		
		// Load view
		$this->load->view('themes/' . $default_template_name . '/templates/frontend_blog_content', $this->data);
	}

	private function _blog_page_content($page_id, $default_template_name)
	{
		$page_slug = $this->data['page']->slug;
		//Load the latest articles
		$this->data['latest_articles'] = $this->article_m->limit($this->latest_articles_limit)->get_latest_articles();

		//Get the function to get blog categories related to the blog page
		$this->data['blog_categories'] = $this->page_m->get_selected_blog_categories($page_id);

		//Create the blog_categories array
		$blog_categories = $this->data['blog_categories'];

		/*********************************************************************************************************/
		//							Create Pagination Functions for Homepage Blog Page
		/*********************************************************************************************************/
		$this->load->library('pagination');

		$this->data['total_articles'] = $this->article_m->count_blog_articles_per_frontpage($blog_categories);

		        //Configure pagination
		$config['base_url'] = base_url(). $page_slug . '/' .'page';
		$config['total_rows'] = $this->data['total_articles'];
		$config['per_page'] = $this->post_limit; 
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url(). $page_slug . '/';
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';	
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		$config['prev_tag_open'] = '';
		$config['prev_tag_close'] = '';
		$config['next_tag_open'] = '';
		$config['next_tag_close'] = '';
		$config['next_link'] = 'Older';
		$config['prev_link'] = 'Newer';

		//Init pagination
		$this->pagination->initialize($config);

		//Choose the articles that belong to the above categories.
		//We pass the $blog_categories array to the model functon get_blog_articles
		//that is used in the or_where_in db function in the article_m->get_blog_articles function

		// Fetch all articles with pagination
		$this->data['articles'] = $this->article_m->limit( $config['per_page'],$this->uri->segment(3))->get_blog_articles($blog_categories);
		
		//Get Articles Media(function to show for each article is done in the view)
		$this->data['articles_media'] = $this->article_m->get_articles_media_frontend($this->data['articles']);
		
		/*********************************************************************************************************/
		
		// Load view
		$this->load->view('themes/' . $default_template_name . '/templates/frontend_blog_content', $this->data);
	}


	public function article($page_slug, $category, $id, $article_slug)
	{

		$this->data['page'] = $this->frontend_model->get_page_by_slug($page_slug);
		$page = $this->data['page'];

		count($this->data['page']) || show_404(uri_string());


		//Get page_type so we can use it in the "if" functions bellow
		$page_type = $this->data['page']->page_type;

		//Get page_id
		$page_id = $this->data['page']->id;

		/*********************************************************************************************************/
		//
		//								Modules and Tempalte Sections Loader
		//					
		/*********************************************************************************************************/
		
		//Get default Template to assing positions
		$default_template = $this->templates_m->get_default_template();
		$default_template_name = $default_template->title;


		//Get template positions
		$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template->title . '/positions';
		$extensions = array('php');

		$template_positions = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);


		/**************************************Page Modules************************************/

		//Get witch published page is a portfolio or a blog and choose 
		//(a little paradox to work with urls in portfolio module and blog modules links)

		//portfolio page slug
		$portfolio_page = $this->page_m->get_portfolio_page_for_portfolio_modules_use();
		$this->data['portfolio_page_slug'] = $portfolio_page->slug;				
		//blog page slug
		$blog_page = $this->page_m->get_blog_page_for_blog_modules_use();
		$this->data['blog_page_slug'] = $blog_page->slug;

		//Get the selected modules for each Page
		$selected_page_modules = $this->frontend_model->get_selected_modules($page_id);

		if (!empty($template_positions)) 
		{
			foreach ($template_positions AS $position)
			{
				//Using basename (core PHP funtion ) we can get only the filename without the extension
				//that we know it is a .php file. To achieve that we use in get_filenames_by_extension
				//with 3rd parameter to TRUE, so we can get the full path to the file, as needed by "basename"
				$position = basename($position, ".php");
				$this->data['position'] = $position;

				$page_modules = $this->frontend_model->get_page_selected_modules_content($selected_page_modules, $position);
				    
				//Check if $page_modules is not empty to avoid errors on pages showing modules meant not to be shown
				if (!empty($page_modules)) 
				{
					//Get Custom Modules Data
					$this->data['custom_modules'] = $this->frontend_model->get_custom_modules($page_modules);
					    

					//Get Menu Modules Data
					$this->data['menu_modules'] = $this->frontend_model->get_menu_modules($page_modules);
					//Get Menu Modules Menu Items data using $this->data['menu_modules'] we got above
				    $this->data['menu_items'] = $this->frontend_model->get_menu_items_per_menu_module($this->data['menu_modules']);

				    //Get Latest Articles Modules
				    $this->data['latest_articles_blog_modules'] = $this->frontend_model->get_latest_blog_articles_modules($page_modules);
					    
				    //Get Popular Articles Modules
				    $this->data['popular_articles_blog_modules'] = $this->frontend_model->get_popular_blog_articles_modules($page_modules);
						    
					//Get Image Slider Modules
					$this->data['image_slider_modules'] = $this->frontend_model->get_image_slider_modules($page_modules);

					//Get Portfolio Modules
					$this->data['portfolio_modules'] = $this->frontend_model->get_portfolio_modules($page_modules);


					$this->data['path_to_custom_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/custom_modules/';
					$this->data['path_to_menu_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/menu_modules/';
					$this->data['path_to_latest_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/latest_articles/';
					$this->data['path_to_popular_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/popular_articles/';
					$this->data['path_to_image_slider_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/image_slider_modules/';
					$this->data['path_to_portfolio_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/portfolio_modules/';

				}
				
				$this->load->section($position, 'themes/'. $default_template->title . '/positions/' . $position, $this->data);

			}
		}



    	//Get article
		$this->data['article'] = $this->article_m->get_single_blog_article($id);
		$article = $this->data['article'];

		//Get Articles Media(function to show for each article is done in the view)
		$this->data['articles_media'] = $this->article_m->get_single_article_media_frontend($id);
		

		// Return 404 if not found
		count($this->data['article']) || show_404(uri_string());

		//We ensure that the current article belongs to the category that we pass to the url as first segment
		if($category != $this->data['article']->category_slug)
		{
			show_404(uri_string());
		}


		// Redirect if slug was incorrect
		$requested_slug = $this->uri->segment(5);
		$set_slug = $this->data['article']->slug;
		if ($requested_slug != $set_slug) 
		{
			redirect((string)$this->data['page']->slug . '/' .(string)$this->data['article']->category_slug . '/' .'article/' . (int)$this->data['article']->id . '/' . (string)$this->data['article']->slug, 'location', '303');
		}

		//Article views Counter 
		$this->frontend_model->article_page_views_counter($id);


		/**********************************Meta and Logo Starts********************************/

		$this->data['settings'] = $this->settings_m->get_settings();
		$settings = $this->data['settings'];

		$default_seo_meta_description = $settings->meta_description;
		$default_seo_meta_keywords = $settings->meta_keywords;
		$default_seo_page_title = $settings->seo_page_title;

		$page_seo_meta_description = $page->meta_description;
		$page_seo_meta_keywords = $page->meta_keywords;
		$page_seo_page_title = $page->seo_page_title;

		$article_seo_meta_description = $article->meta_description;
		$article_seo_meta_keywords = $article->meta_keywords;
		$article_seo_page_title = $article->seo_page_title;

		//Set Seo Page Title
		if (!empty($article_seo_page_title))
		{

			$this->data['seo_page_title'] = $article_seo_page_title . '  ||  ' . $page_seo_page_title;

		}
		else
		{
			$this->data['seo_page_title'] = $default_seo_page_title;
		}

		//Set Seo Meta Keywords
		if (!empty($article_seo_meta_keywords))
		{

			$this->data['seo_meta_keywords'] = $article_seo_meta_keywords . ', ' . $default_seo_meta_keywords;

		}
		else
		{
			$this->data['seo_meta_keywords'] = $default_seo_meta_keywords;
		}

		//Set Seo Meta Description
		if (!empty($article_seo_meta_description))
		{

			$this->data['seo_meta_description'] = $article_seo_meta_description . '. ' . $default_seo_meta_description;

		}
		else
		{
			$this->data['seo_meta_description'] = $default_seo_meta_description;
		}


		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];     


		// Load view
		$this->load->view('themes/' . $default_template_name . '/templates/frontend_single_article', $this->data);


	}


	public function project($page_slug, $category, $id, $project_slug)
	{

		$this->data['page'] = $this->frontend_model->get_page_by_slug($page_slug);
		$page = $this->data['page'];

		count($this->data['page']) || show_404(uri_string());


		//Get page_type so we can use it in the "if" functions bellow
		$page_type = $this->data['page']->page_type;

		//Get page_id
		$page_id = $this->data['page']->id;

		/*********************************************************************************************************/
		//
		//								Modules and Tempalte Sections Loader
		//					
		/*********************************************************************************************************/
		
		//Get default Template to assing positions
		$default_template = $this->templates_m->get_default_template();
		$default_template_name = $default_template->title;


		//Get template positions
		$this->data['path_to_default_template_positions'] = APPPATH . 'views/themes/' . $default_template->title . '/positions';
		$extensions = array('php');

		$template_positions = get_filenames_by_extension($this->data['path_to_default_template_positions'], $extensions, TRUE);


		/**************************************Page Modules************************************/
		
		//Get witch published page is a portfolio or a blog and choose 
		//(a little paradox to work with urls in portfolio module and blog modules links)

		//portfolio page slug
		$portfolio_page = $this->page_m->get_portfolio_page_for_portfolio_modules_use();
		$this->data['portfolio_page_slug'] = $portfolio_page->slug;				
		//blog page slug
		$blog_page = $this->page_m->get_blog_page_for_blog_modules_use();
		$this->data['blog_page_slug'] = $blog_page->slug;

		//Get the selected modules for each Page
		$selected_page_modules = $this->frontend_model->get_selected_modules($page_id);

		if (!empty($template_positions)) 
		{
			foreach ($template_positions AS $position)
			{
				//Using basename (core PHP funtion ) we can get only the filename without the extension
				//that we know it is a .php file. To achieve that we use in get_filenames_by_extension
				//with 3rd parameter to TRUE, so we can get the full path to the file, as needed by "basename"
				$position = basename($position, ".php");
				$this->data['position'] = $position;

				$page_modules = $this->frontend_model->get_page_selected_modules_content($selected_page_modules, $position);
				    
				//Check if $page_modules is not empty to avoid errors on pages showing modules meant not to be shown
				if (!empty($page_modules)) 
				{
					//Get Custom Modules Data
					$this->data['custom_modules'] = $this->frontend_model->get_custom_modules($page_modules);
					    

					//Get Menu Modules Data
					$this->data['menu_modules'] = $this->frontend_model->get_menu_modules($page_modules);
					//Get Menu Modules Menu Items data using $this->data['menu_modules'] we got above
				    $this->data['menu_items'] = $this->frontend_model->get_menu_items_per_menu_module($this->data['menu_modules']);

				    //Get Latest Articles Modules
				    $this->data['latest_articles_blog_modules'] = $this->frontend_model->get_latest_blog_articles_modules($page_modules);
					    
				    //Get Popular Articles Modules
				    $this->data['popular_articles_blog_modules'] = $this->frontend_model->get_popular_blog_articles_modules($page_modules);
						    
					//Get Image Slider Modules
					$this->data['image_slider_modules'] = $this->frontend_model->get_image_slider_modules($page_modules);

					//Get Portfolio Modules
					$this->data['portfolio_modules'] = $this->frontend_model->get_portfolio_modules($page_modules);


					$this->data['path_to_custom_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/custom_modules/';
					$this->data['path_to_menu_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/menu_modules/';
					$this->data['path_to_latest_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/latest_articles/';
					$this->data['path_to_popular_articles_blog_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/blog_modules/popular_articles/';
					$this->data['path_to_image_slider_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/image_slider_modules/';
					$this->data['path_to_portfolio_module_layout'] = APPPATH . 'views/themes/' . $default_template->title . '/modules_layouts/portfolio_modules/';

				}
				
				$this->load->section($position, 'themes/'. $default_template->title . '/positions/' . $position, $this->data);

			}
		}



    	//Get article
		$this->data['project'] = $this->portfolio_m->get_single_portfolio_project($id);
		$project = $this->data['project'];

		//Get Articles Media(function to show for each article is done in the view)
		$this->data['projects_media'] = $this->portfolio_m->get_single_portfolio_project_media_frontend($id);
		

		// Return 404 if not found
		count($this->data['project']) || show_404(uri_string());

		//We ensure that the current article belongs to the category that we pass to the url as first segment
		if($category != $this->data['project']->category_slug)
		{
			show_404(uri_string());
		}


		// Redirect if slug was incorrect
		$requested_slug = $this->uri->segment(5);
		$set_slug = $this->data['project']->project_slug;
		if ($requested_slug != $set_slug) 
		{
			redirect((string)$this->data['page']->slug . '/' .(string)$this->data['project']->category_slug . '/' .'project/' . (int)$this->data['project']->id . '/' . (string)$this->data['project']->project_slug, 'location', '303');
		}

		//Article views Counter 
		$this->frontend_model->project_page_views_counter($id);


		/**********************************Meta and Logo Starts********************************/

		$this->data['settings'] = $this->settings_m->get_settings();
		$settings = $this->data['settings'];

		$default_seo_meta_description = $settings->meta_description;
		$default_seo_meta_keywords = $settings->meta_keywords;
		$default_seo_page_title = $settings->seo_page_title;

		$page_seo_meta_description = $page->meta_description;
		$page_seo_meta_keywords = $page->meta_keywords;
		$page_seo_page_title = $page->seo_page_title;

		$project_seo_meta_description = $project->meta_description;
		$project_seo_meta_keywords = $project->meta_keywords;
		$project_seo_page_title = $project->seo_page_title;

		//Set Seo Page Title
		if (!empty($project_seo_page_title))
		{

			$this->data['seo_page_title'] = $project_seo_page_title . '  ||  ' . $page_seo_page_title;

		}
		else
		{
			$this->data['seo_page_title'] = $default_seo_page_title;
		}

		//Set Seo Meta Keywords
		if (!empty($project_seo_meta_keywords))
		{

			$this->data['seo_meta_keywords'] = $project_seo_meta_keywords . ', ' . $default_seo_meta_keywords;

		}
		else
		{
			$this->data['seo_meta_keywords'] = $default_seo_meta_keywords;
		}

		//Set Seo Meta Description
		if (!empty($project_seo_meta_description))
		{

			$this->data['seo_meta_description'] = $project_seo_meta_description . '. ' . $default_seo_meta_description;

		}
		else
		{
			$this->data['seo_meta_description'] = $default_seo_meta_description;
		}


		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];     


		// Load view
		$this->load->view('themes/' . $default_template_name . '/templates/frontend_single_portfolio_project', $this->data);


	}

}

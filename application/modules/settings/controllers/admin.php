<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Backend_Controller
{
	private $post_limit = 5;

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('settings_m');
	}

	public function index()
	{
		// Check user has privileges to change settings, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Modify Settings'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to modify Settings.</p>');
			
			redirect('admin/');		
		}
		

		$this->load->library('form_validation');
		
		//Validation Rules
		$this->form_validation->set_rules('webpage_title','Webpage Title','trim|xss_clean|required');

	    $this->form_validation->set_rules('meta_keywords','Keywords','trim|xss_clean');
	    $this->form_validation->set_rules('meta_description','Description','trim|xss_clean');
        $this->form_validation->set_rules('seo_page_title','SEO Page Title','trim|xss_clean');

		if($this->form_validation->run() == FALSE)
		{ 

		    //Get settings 
		    $this->data['settings'] = $this->settings_m->get_settings();


			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
				
			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
				
			// Load view
			$this->load->view('settings/admin/settings_update', $this->data);
		}

		else 
		{
			//Upload Image
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '4000';
			$config['max_height'] = '4000';
			$config['overwrite']    = TRUE;
			$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()){
				$upload_errors = array('error' => $this->upload->display_errors());

				$this->session->set_flashdata('upload_errors', $upload_errors['error']);


				if($this->input->post('delete_image') != 1){
					$logo_image = $this->settings_m->get_settings->logo_image;

				} else {
					$logo_image = '';
				}
			} else {
				$this->data = array('upload_data' => $this->upload->data());
				$logo_image = $_FILES['userfile']['name'];
			}

            //Create modules Data Array
			$data = array(
				'webpage_title'					=> $this->input->post('webpage_title'),
				'seo_page_title' 				=> $this->input->post('seo_page_title'),
				'meta_keywords' 				=> $this->input->post('meta_keywords'),
				'meta_description' 				=> $this->input->post('meta_description'),
				'logo_image'    				=> $logo_image,
				'google_analytics_tracking_id'	=> $this->input->post('google_analytics_tracking_id'),
				);

			//Post Udate
			$this->settings_m->update_by(array('id' => 0), $data);

			$this->session->set_flashdata('message', '<p>Settings Updated Succesfully!</p>');


			redirect('admin/settings');
		}  

	}



}
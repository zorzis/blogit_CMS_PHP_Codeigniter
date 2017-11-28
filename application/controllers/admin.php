<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Backend_Controller {
 
	public function index()
	{
		//Get Current Logged in User ID
		$current_logged_in_user = $this->flexi_auth->get_user_id();

		//Get All active Users
		$this->data['no_of_total_users'] = count($this->dashboard_model->get_total_active_users());

		//Get 10 Latest Published Articles By all users
		$this->data['get_10_latest_published_articles'] = $this->dashboard_model->get_10_latest_published_articles();


		//Get all published articles
		$this->data['published_articles'] = $this->dashboard_model->get_published_articles_created_per_user($current_logged_in_user);
		
		//#Number of ALL published Articles  
		$number_of_all_published_articles = count($this->data['published_articles']);
		if(!empty($number_of_all_published_articles))
		{

			$this->data['no_of_published_articles'] = count($this->data['published_articles']);
		}


		//Get Articles Published per current logged in user
		$this->data['user_articles'] = $this->dashboard_model->get_published_articles_created_per_user($current_logged_in_user);

		//#Number of Articles Published per current logged in user
		$number_of_user_articles = count($this->data['user_articles']);
		if(!empty($number_of_user_articles))
		{

			$this->data['no_of_published_articles_per_logged_in_user'] = count($this->data['user_articles']);
		}


		$this->data['message'] = $this->session->flashdata('message');
		$this->load->view('themes/admin_themes/dashboard',$this->data);
		
	}


	
}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
<?php
class Migration extends Backend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		$this->load->library('migration');
		if (! $this->migration->current()) {
			show_error($this->migration->error_string());
		}
		else {

			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
			
			$this->session->set_flashdata('message', '<p>Migration Run Succesfully!</p>');

			redirect('admin');
		}
	
	}

}
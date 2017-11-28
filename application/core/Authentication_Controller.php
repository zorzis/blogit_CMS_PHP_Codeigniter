<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication_Controller extends CI_Controller {
 
    public function __construct() {
            parent::__construct();

		// Load required CI libraries and helpers.
		$this->load->database();
		$this->load->library('session');
 		$this->load->helper('url');
 		$this->load->helper('form');

  		// IMPORTANT! This global must be defined BEFORE the flexi auth library is loaded! 
 		// It is used as a global that is accessible via both models and both libraries, without it, flexi auth will not work.
		$this->auth = new stdClass;
		
		// Load 'standard' flexi auth library by default.

		/*------ START Benchmark Flexi Auth------------------------- */
		$this->benchmark->mark('auth_start');

		$this->load->library('flexi_auth');	

		$this->benchmark->mark('auth_end');
		/*------END Benchmark Flexi Auth ------------------------- */

	}
}
/* End of file Authentication_Controller.php */
/* Location: ./application/core/Authentication_Controller.php */

		
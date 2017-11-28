<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_admin_model extends CI_Model {
	
	// The following method prevents an error occurring when $this->data is modified.
	// Error Message: 'Indirect modification of overloaded property Demo_cart_admin_model::$data has no effect'.
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// User Accounts
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

 	/**
	 * get_user_accounts
	 * Gets a paginated list of users that can be filtered via the user search form, filtering by the users email and first and last names.
	 */
	function get_user_accounts()
	{
		// Select user data to be displayed.
		$sql_select = array(
			$this->flexi_auth->db_column('user_acc', 'id'),
			$this->flexi_auth->db_column('user_acc', 'email'),
			$this->flexi_auth->db_column('user_acc', 'suspend'),
			$this->flexi_auth->db_column('user_group', 'name'),
			$this->flexi_auth->db_column('user_group', 'id'),
			$this->flexi_auth->db_column('user_acc', 'last_login_date'),
			$this->flexi_auth->db_column('user_acc', 'date_added'),
			'upro_first_name',
			'upro_last_name',
			'upro_avatar',
		);
		$this->flexi_auth->sql_select($sql_select);

		// We set limitation only administrator users can see administrator users.
		if ($this->flexi_auth->get_user_group_id() != 3)
		{
			$sql_where[$this->flexi_auth->db_column('user_group', 'id').' !='] = 3;
			$this->flexi_auth->sql_where($sql_where);
		}	

		// Get url for any search query or pagination position.
		$uri = $this->uri->uri_to_assoc(3);

		// Set pagination limit, get current position and get total users.
		$limit = 100;
		$offset = (isset($uri['page'])) ? $uri['page'] : FALSE;		
		
		// Set SQL WHERE condition depending on whether a user search was submitted.
		if (array_key_exists('search', $uri))
		{
			// Set pagination url to include search query.
			$pagination_url = 'admin/users/search/'.$uri['search'].'/';
			$config['uri_segment'] = 6; // Changing to 6 will select the 6th segment, example 'controller/function/search/query/page/10'.

			// Convert uri '-' back to ' ' spacing.
			$search_query = str_replace('-',' ',$uri['search']);
								
			// Get users and total row count for pagination.
			// Custom SQL SELECT, WHERE and LIMIT statements have been set above using the sql_select(), sql_where(), sql_limit() functions.
			// Using these functions means we only have to set them once for them to be used in future function calls.
			$total_users = $this->flexi_auth->search_users_query($search_query)->num_rows();			
			
			$this->flexi_auth->sql_limit($limit, $offset);
			$this->data['users'] = $this->flexi_auth->search_users_array($search_query);
		}
		else
		{
			// Set some defaults.
			$pagination_url = 'admin/users/';
			$search_query = FALSE;
			$config['uri_segment'] = 4; // Changing to 4 will select the 4th segment, example 'controller/function/page/10'.
			
			// Get users and total row count for pagination.
			// Custom SQL SELECT and WHERE statements have been set above using the sql_select() and sql_where() functions.
			// Using these functions means we only have to set them once for them to be used in future function calls.
			$total_users = $this->flexi_auth->get_users_query()->num_rows();

			$this->flexi_auth->sql_limit($limit, $offset);
			$this->data['users'] = $this->flexi_auth->get_users_array();
		}
		
		// Create user record pagination.
		$this->load->library('pagination');	
		$config['base_url'] = base_url().$pagination_url.'page/';
		$config['total_rows'] = $total_users;
		$config['per_page'] = $limit; 

		$config['last_link'] = '';
		$config['first_link'] = '';
		$config['first_url'] = base_url().'/admin/users/';
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

		$this->pagination->initialize($config); 
		
		// Make search query and pagination data available to view.
		$this->data['search_query'] = $search_query; // Populates search input field in view.
		$this->data['pagination']['links'] = $this->pagination->create_links();
		$this->data['pagination']['total_users'] = $total_users;
	}
    

	// Get all administrator users
	// We assume that administrator users belong to Usergroup with id = 3 by default called as Master Admin Usergroup
	// We have set limitation to deletion of usergroup with id = 3
    function get_users_belong_to_master_admin_group_with_id_3()
    {
    	$this->db->select('a.*');
        $this->db->from('user_accounts AS a');
        $this->db->where('uacc_group_fk', 3);
        $this->db->where('uacc_active', 1);
        $this->db->where('uacc_suspend', 0);
        $data = $this->db->get()->result_array();

        $array = array();

        foreach($data as $row)
        {
        	$array[] = $row['uacc_id'];
        }
        return $array;
    }



    /**
    *
    *Delete user function used from delete button at manage_users_table 
    */
    function delete_user_account()
    {

		if ($user_id = $this->input->post('delete_user_account'))
		{
			if($user_id != $this->flexi_auth->get_user_id())
			{
				if($this->flexi_auth->get_user_group_id == 3)
				{

					// Delete only if there are more than one administrators on database
					// We call custom function $this->get_users_belong_to_master_admin_group_with_id_3
					// At usergroups we make Master Admin Usergroup undeletable to prevent deletion of Admin Usergroup
					if(count($this->get_users_belong_to_master_admin_group_with_id_3) > 1)
					{

						$this->flexi_auth->delete_user($user_id);
						
					}
					else
					{
						$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete the last administrator');
						redirect('admin/users');
					}
				}
				elseif($this->flexi_auth->get_user_group_id != 3)
				{
					if(in_array($user_id, $this->get_users_belong_to_master_admin_group_with_id_3() ))
					{
						$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete that user account');
						redirect('admin/users');
					}
					else
					{
						$this->flexi_auth->delete_user($user_id);
					}
				}
			}
			else
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete your own account');
				redirect('admin/users');
			}

    	}
 		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/');
    }

	// Delete Multiple Users Accounts
	function delete_multiple_users_accounts()
    {
    	$users_ids = $this->input->post('selected_users_accounts');

		foreach($users_ids as $key => $value)
		{
			if($key != $this->flexi_auth->get_user_id())
			{
				if($this->flexi_auth->get_user_group_id == 3)
				{

					// Delete only if there are more than one administrators on database
					// We call custom function $this->get_users_belong_to_master_admin_group_with_id_3
					// At usergroups we make Master Admin Usergroup undeletable to prevent deletion of Admin Usergroup
					if(count($this->get_users_belong_to_master_admin_group_with_id_3) > 1)
					{

						$this->flexi_auth->delete_user($key);
						
					}
					else
					{
						$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete the last administrator');
						redirect('admin/users');
					}
				}
				elseif($this->flexi_auth->get_user_group_id != 3)
				{
					if(in_array($key, $this->get_users_belong_to_master_admin_group_with_id_3() ))
					{
						$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete that administrators users accounts');
						redirect('admin/users');
					}
					else
					{
						$this->flexi_auth->delete_user($key);
					}
				}


			}
			else
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete your account.</p>');
				redirect('admin/users');
			}
		}

		
		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/');			
	}

	// Unblock Multiple Users Accounts
	function block_multiple_users_accounts()
	{

		$users_ids = $this->input->post('selected_users_accounts');


		foreach($users_ids as $key => $value)
		{
			if($key != $this->flexi_auth->get_user_id())
			{
				if($this->flexi_auth->get_user_group_id == 3)
				{

					// Delete only if there are more than one administrators on database
					// We call custom function $this->get_users_belong_to_master_admin_group_with_id_3
					// At usergroups we make Master Admin Usergroup undeletable to prevent deletion of Admin Usergroup
					if(count($this->get_users_belong_to_master_admin_group_with_id_3) > 1)
					{

						$this->flexi_auth->update_user($key, array($this->flexi_auth->db_column('user_acc', 'suspend') => 1));
						
					}
					else
					{
						$this->session->set_flashdata('message', '<p class="error_msg">You cannot block the last administrator');
						redirect('admin/users');
					}
				}
				elseif($this->flexi_auth->get_user_group_id != 3)
				{
					if(in_array($key, $this->get_users_belong_to_master_admin_group_with_id_3() ))
					{
						$this->session->set_flashdata('message', '<p class="error_msg">You cannot block that user account');
						redirect('admin/users');
					}
					else
					{
						$this->flexi_auth->update_user($key, array($this->flexi_auth->db_column('user_acc', 'suspend') => 1));
					}
				}


			}
			else
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot block your account.</p>');
				redirect('admin/users');
			}
		}
			
		
			
		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/');
	}

	// Unblock Multiple Users Accounts
	function unblock_multiple_users_accounts()
	{

		$users_ids = $this->input->post('selected_users_accounts');

		foreach($users_ids as $key => $value)
		{
			$this->flexi_auth->update_user($key, array($this->flexi_auth->db_column('user_acc', 'suspend') => 0));

		}
			
		
			
		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/');
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Create New Account
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * register_account
	 * Create a new user account. 
	 * Then if defined via the '$instant_activate' var, automatically log the user into their account.
	 */
	function create_user_account()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		// The custom rules 'identity_available' and 'validate_password' can be found in '../libaries/MY_Form_validation.php'.
		$validation_rules = array(
			array('field' => 'register_first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'register_last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'register_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
			array('field' => 'register_newsletter', 'label' => 'Newsletter', 'rules' => 'integer'),
			array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
			array('field' => 'register_username', 'label' => 'Username', 'rules' => 'required|min_length[4]|identity_available'),
			array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
			array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]'),
			array('field' => 'register_group', 'label' => 'User Group', 'rules' => 'required|integer')
		);

		$this->form_validation->set_rules($validation_rules);

		// Run the validation.
		if ($this->form_validation->run())
		{
			// Get user login details from input.
			$email = $this->input->post('register_email_address');
			$username = $this->input->post('register_username');
			$password = $this->input->post('register_password');
			$usergroup = $this->input->post('register_group');
			
			// Get user profile data from input.
			// You can add whatever columns you need to customise user tables.
			$profile_data = array(
				'upro_first_name' => $this->input->post('register_first_name'),
				'upro_last_name' => $this->input->post('register_last_name'),
				'upro_phone' => $this->input->post('register_phone_number'),
				'upro_newsletter' => $this->input->post('register_newsletter'),
				'upro_avatar' => $this->input->post('avatar')
			);
			
			// Set whether to instantly activate account.
			// This var will be used twice, once for registration, then to check if to log the user in after registration.
			$instant_activate = TRUE;
	
			// The last 2 variables on the register function are optional, these variables allow you to:
			// #1. Specify the group ID for the user to be added to (i.e. 'Moderator' / 'Public'), the default is set via the config file.
			// #2. Set whether to automatically activate the account upon registration, default is FALSE. 
			// Note: An account activation email will be automatically sent if auto activate is FALSE, or if an activation time limit is set by the config file.
			
			$response = $this->flexi_auth->insert_user($email, $username, $password, $profile_data, $usergroup, $instant_activate);

			/**
			if ($response)
			{
				// This is an example 'Welcome' email that could be sent to a new user upon registration.
				// Bear in mind, if registration has been set to require the user activates their account, they will already be receiving an activation email.
				// Therefore sending an additional email welcoming the user may be deemed unnecessary.
				$email_data = array('identity' => $email);
				$this->flexi_auth->send_email($email, 'Welcome', 'registration_welcome.tpl.php', $email_data);
				// Note: The 'registration_welcome.tpl.php' template file is located in the '../views/includes/email/' directory defined by the config file.
				
				###+++++++++++++++++###
				
				// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
				$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
				
			}
			*/

			// Save any public or admin status or error messages to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			redirect('admin/users');
		}

		// Set validation errors.
		$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

		return FALSE;

	}
	
 	/**
	 * update_user_account
	 * Updates the account and profile data of a specific user.
	 * Note: The user profile table ('demo_user_profiles') is used in this demo as an example of relating additional user data to the auth libraries account tables. 
	 */
	function update_user_account($user_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'update_first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'update_last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'update_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
			array('field' => 'update_newsletter', 'label' => 'Newsletter', 'rules' => 'integer'),
			array('field' => 'update_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available['.$user_id.']'),
			array('field' => 'update_username', 'label' => 'Username', 'rules' => 'min_length[4]|identity_available['.$user_id.']'),
			array('field' => 'update_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
			array('field' => 'update_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[update_password]'),
			array('field' => 'update_group', 'label' => 'User Group', 'rules' => 'required|integer')

		);

		$this->form_validation->set_rules($validation_rules);
		
		if ($this->form_validation->run())
		{
			// 'Update User Account' form data is valid.
			// IMPORTANT NOTE: As we are updating multiple tables (The main user account and user profile tables), it is very important to pass the
			// primary key column and value in the $profile_data for any custom user tables being updated, otherwise, the function will not
			// be able to identify the correct custom data row.
			// In this example, the primary key column and value is 'upro_id' => $user_id.
			$profile_data = array(
				'upro_id' => $user_id,
				'upro_first_name' => $this->input->post('update_first_name'),
				'upro_last_name' => $this->input->post('update_last_name'),
				'upro_phone' => $this->input->post('update_phone_number'),
				'upro_newsletter' => $this->input->post('update_newsletter'),
				'upro_avatar' => $this->input->post('avatar'),
				$this->flexi_auth->db_column('user_acc', 'email') => $this->input->post('update_email_address'),
				$this->flexi_auth->db_column('user_acc', 'username') => $this->input->post('update_username'),
				$this->flexi_auth->db_column('user_acc', 'password') => $this->input->post('update_password'),
				$this->flexi_auth->db_column('user_acc', 'group_id') => $this->input->post('update_group')
			);			

			// If we were only updating profile data (i.e. no email, username or group included), we could use the 'update_custom_user_data()' function instead.
			$this->flexi_auth->update_user($user_id, $profile_data);
				
			// Save any public or admin status or error messages to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			redirect('admin/users');			
		}

		// Set validation errors.
		$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

		return FALSE;
	}

 	/**
	 * delete_users
	 * Delete all user accounts that have not been activated X days since they were registered.
	 */
	function delete_users($inactive_days)
	{
		// Deleted accounts that have never been activated.
		$this->flexi_auth->delete_unactivated_users($inactive_days);

		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('auth_admin/manage_user_accounts');			
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// User Groups
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

  	/**
	 * manage_user_groups
	 * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated user groups.
	 */
   function manage_user_groups()
    {
		// Delete groups.
		if ($selected_groups = $this->input->post('selected_groups'))
		{
			foreach($selected_groups as $key => $value)
			{
				$group_id = $key;

				if ($group_id == 3 || $group_id == 1)
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete these usergroups.</p>');
					redirect('admin/users/usergroups');
				}
				elseif($this->flexi_auth->get_user_group_id() == $group_id)
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete the usergroup you are assigned to.</p>');
					redirect('admin/users/usergroups');				
				}
				else
				{

					$this->flexi_auth->delete_group($group_id);
			
				}
			}
				
		}

		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/manage_user_groups');			
	}



	/**
    *
    *Delete users groups function used from delete button at manage_users_groups_table 
    */
    function delete_user_group()
    {

		if ($group_id = $this->input->post('delete_user_group'))
		{
			// By default usergroup with id = 3 is the "Master Admin" the default Administration Usergroup
			// We set limitation if ugrp_id = 3 to be deleted
			// By default usergroup with id = 1 is the "Public" the default Public users Usergroup
			// We set limitation if ugrp_id = 1 to be deleted

			if ($group_id == 3 || $group_id == 1)
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete that usergroup.</p>');
				redirect('admin/users/usergroups');
			}
			elseif($this->flexi_auth->get_user_group_id() == $group_id)
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete the usergroup you are assigned to.</p>');
				redirect('admin/users/usergroups');				
			}
			else
			{
    			$this->flexi_auth->delete_group($group_id);
			}
    	}
 		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/usergroups');
    }
	
  	/**
	 * insert_user_group
	 * Inserts a new user group.
	 */
	function insert_user_group()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'insert_group_name', 'label' => 'Group Name', 'rules' => 'required'),
			array('field' => 'insert_group_admin', 'label' => 'Admin Status', 'rules' => 'integer')
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		if ($this->form_validation->run())
		{
			// Get user group data from input.
			$group_name = $this->input->post('insert_group_name');
			$group_desc = $this->input->post('insert_group_description');
			$group_admin = ($this->input->post('insert_group_admin')) ? 1 : 0;

			$this->flexi_auth->insert_group($group_name, $group_desc, $group_admin);
				
			// Save any public or admin status or error messages to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			redirect('admin/users/usergroups');			
		}
	}
	
  	/**
	 * update_user_group
	 * Updates a specific user group.
	 */
	function update_user_group($group_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'update_group_name', 'label' => 'Group Name', 'rules' => 'required'),
			array('field' => 'update_group_admin', 'label' => 'Admin Status', 'rules' => 'integer')
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		if ($this->form_validation->run())
		{
			// Get user group data from input.
			$data = array(
				$this->flexi_auth->db_column('user_group', 'name') => $this->input->post('update_group_name'),
				$this->flexi_auth->db_column('user_group', 'description') => $this->input->post('update_group_description'),
				$this->flexi_auth->db_column('user_group', 'admin') => $this->input->post('update_group_admin')
			);			

			$this->flexi_auth->update_group($group_id, $data);
				
			// Save any public or admin status or error messages to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			redirect('admin/users/usergroups');			
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Privileges
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	// Get only frontend privileges 
	// To get an array of values from a single table column(upriv_id)
	// we loop to results of $data -> result_array()
    function get_only_frontend_privileges()
    {
    	$this->db->select('a.upriv_id');
        $this->db->from('user_privileges AS a');
        $this->db->where('upriv_is_frontend', 1);
        $data = $this->db->get()->result_array();

        $array = array();

        foreach($data as $row)
        {
        	$array[] = $row['upriv_id'];
        }
        return $array;
        
    }

  	/**
	 * manage_privileges
	 * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated privileges.
	 */
    function manage_privileges()
    {
		// Delete privileges.
		if ($selected_privileges = $this->input->post('selected_privileges'))
		{
			foreach($selected_privileges as $key => $value)
			{
				$privilege_id = $key;

				if($this->flexi_auth->get_user_group_id() == 3)
				{
					$this->flexi_auth->delete_privilege($privilege_id);
	    		}
	    		else
	    		{
					if(in_array($privilege_id, $this->get_only_frontend_privileges() ))
					{
	    				$this->flexi_auth->delete_privilege($privilege_id);
	    			}
	    			else
	    			{
	    				$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete these privilege.</p>');
						redirect('admin/users/privileges');	
	    			}
	    		}
			}
		}

		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		//redirect('admin/users/privileges');			
	}

	/**
    *
    *Delete Privilege function used from delete button at manage_privileges_table 
    */
    function delete_privileges_one_by_one()
    {

		if ($privilege_id = $this->input->post('delete_privilege_one_by_one'))
		{
			if($this->flexi_auth->get_user_group_id() == 3)
			{
				$this->flexi_auth->delete_privilege($privilege_id);
    		}
    		else
    		{
				if(in_array($privilege_id, $this->get_only_frontend_privileges() ))
				{
    				$this->flexi_auth->delete_privilege($privilege_id);
    			}
    			else
    			{
    				$this->session->set_flashdata('message', '<p class="error_msg">You cannot delete that privilege.</p>');
					redirect('admin/users/privileges');	
    			}
    		}
    	}
 		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/privileges');
    }

  	/**
	 * insert_privilege
	 * Inserts a new privilege.
	 */
	function insert_privilege()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'insert_privilege_name', 'label' => 'Privilege Name', 'rules' => 'required')
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		if ($this->form_validation->run())
		{
			// Get privilege data from input.
			$privilege_name = $this->input->post('insert_privilege_name');
			$privilege_desc = $this->input->post('insert_privilege_description');

			$privilege_is_frontend = array(
				'upriv_is_frontend' => $this->input->post('insert_is_frontend_priv'),
			);
			

			$this->flexi_auth->insert_privilege($privilege_name, $privilege_desc, $privilege_is_frontend);
				
			// Save any public or admin status or error messages to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			redirect('admin/users/privileges');			
		}
	}
	
  	/**
	 * update_privilege
	 * Updates a specific privilege.
	 */
	function update_privilege($privilege_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'update_privilege_name', 'label' => 'Privilege Name', 'rules' => 'required')
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		if ($this->form_validation->run())
		{
			// Get privilege data from input.
			$data = array(
				$this->flexi_auth->db_column('user_privileges', 'name') => $this->input->post('update_privilege_name'),
				$this->flexi_auth->db_column('user_privileges', 'description') => $this->input->post('update_privilege_description'),
				$this->flexi_auth->db_column('user_privileges', 'is_frontend_priv') => $this->input->post('update_is_frontend_priv')
			);			

			$this->flexi_auth->update_privilege($privilege_id, $data);
				
			// Save any public or admin status or error messages to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			redirect('admin/users/privileges');			
		}
	}
	
   	/**
	 * update_user_privileges
	 * Updates the privileges for a specific user.
	 */
	function update_user_privileges($user_id)
    {
		// Update privileges.
		foreach($this->input->post('update') as $row)
		{
			if ($row['current_status'] != $row['new_status'])
			{
				// Insert new user privilege.
				if ($row['new_status'] == 1)
				{
					$this->flexi_auth->insert_privilege_user($user_id, $row['id']);	
				}
				// Delete existing user privilege.
				else
				{
					$sql_where = array(
						$this->flexi_auth->db_column('user_privilege_users', 'user_id') => $user_id,
						$this->flexi_auth->db_column('user_privilege_users', 'privilege_id') => $row['id']
					);
					
					$this->flexi_auth->delete_privilege_user($sql_where);
				}
			}
		}

		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/');			
	}

   	/**
	 * update_group_privileges
	 * Updates the privileges for a specific user group.
	 */
	function update_group_privileges($group_id)
    {
		// Update privileges.
		foreach($this->input->post('update') as $row)
		{
			if ($row['current_status'] != $row['new_status'])
			{
				// Insert new user privilege.
				if ($row['new_status'] == 1)
				{
					$this->flexi_auth->insert_user_group_privilege($group_id, $row['id']);	
				}
				// Delete existing user privilege.
				else
				{
					$sql_where = array(
						$this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $group_id,
						$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id') => $row['id']
					);
					
					$this->flexi_auth->delete_user_group_privilege($sql_where);
				}
			}
		}

		// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('admin/users/usergroups');			
    }
}

/* End of file auth_admin_model.php */
/* Location: ./application/modules/users/models/auth_admin_model.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Backend_Controller {
 
    function __construct() 
    {
        parent::__construct();

    }

	// User Accounts
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
 	/**
 	 * manage_user_accounts
 	 * View and manage a table of all users.
 	 * This example allows accounts to be suspended or deleted via checkoxes within the page.
 	 * The example also includes a search tool to lookup users via either their email, first name or last name. 
 	 */
    function manage_user_accounts()
    {
		$this->load->model('auth_admin_model');

		// Check user has privileges to view user accounts, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Users'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user accounts.</p>');
			redirect('admin');
		}

		// If 'Admin Search User' form has been submitted, this example will lookup the users email address and first and last name.
		if ($this->input->post('search_users') && $this->input->post('search_query')) 
		{
			// Convert uri ' ' to '-' spacing to prevent '20%'.
			// Note: Native php functions like urlencode() could be used, but by default, CodeIgniter disallows '+' characters.
			$search_query = str_replace(' ','-',$this->input->post('search_query'));
		
			// Assign search to query string.
			redirect('admin/users/search/'.$search_query.'/page/');
		}

		// Delete Users from delete button at each raw of user data
		if ($this->input->post('delete_user_account'))
		{
			if (! $this->flexi_auth->is_privileged('Delete Users'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to Delete users accounts.</p>');
				redirect('admin');	
			}
			else  
			{
				$this->auth_admin_model->delete_user_account();
			}
		} 
		// If user has suspend user account privilege then do it.(Multiple Blocks)
		else if ($this->input->post('block_multiple_users_accounts') && $this->flexi_auth->is_privileged('Block Users')) 
		{
			$this->auth_admin_model->block_multiple_users_accounts();
		}
		// If user has suspend user account privilege then do it.(Multiple Unblocks)
		else if ($this->input->post('unblock_multiple_users_accounts') && $this->flexi_auth->is_privileged('Unblock Users')) 
		{
			$this->auth_admin_model->unblock_multiple_users_accounts();
		}
		// If user has delete user account privilege then do it.(Multiple Deletes)
		else if ($this->input->post('delete_multiple_users_accounts') && $this->flexi_auth->is_privileged('Delete Users')) 
		{
			$this->auth_admin_model->delete_multiple_users_accounts();
		}

		// Get user account data for all users. 
		// If a search has been performed, then filter the returned users.
		$this->auth_admin_model->get_user_accounts();
		
		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->load->view('users/admin/users_accounts_view', $this->data);		
    }

	//Get the selected image paths using ajax
	function select_avatar()
	{

		if (!empty($_POST['media']))
		{

			$this->data['media_details_from_ajax_post'] = $_POST['media'];

		}

			//Unset Template 
		$this->output->unset_template();

			// Load view
		$this->load->view('users/admin/includes/ajax_avatar_selector', $this->data);

	}


	 /**
	 * register_account
	 * User registration page used by all new users wishing to create an account.
	 * Note: This page is only accessible to users who are not currently logged in, else they will be redirected.
	 */ 
	function create_user_account()
	{
		// Check user has privileges to create user accounts, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Insert Users')) 
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to Create users accounts.</p>');
			redirect('admin/users');		
		}

		// If 'Registration' form has been submitted, attempt to register their details as a new account.
		else if ($this->input->post('register_user'))
		{			
			$this->load->model('auth_admin_model');
			$this->auth_admin_model->create_user_account();
		}

		// Get user groups.
		$this->data['groups'] = $this->flexi_auth->get_groups_array();
		
		// Get any status message that may have been set.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->load->view('users/admin/user_account_create', $this->data);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Account Activation
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * activate_account
	 * User account activation via email.
	 * The default setup of this demo requires that new account registrations must be authenticated via email before the account is activated.
	 * In this demo, this page is accessed via an activation link in the 'views/includes/email/activate_account.tpl.php' email template.
	 */ 
	function activate_account($user_id, $token = FALSE)
	{
		// The 3rd activate_user() parameter verifies whether to check '$token' matches the stored database value.
		// This should always be set to TRUE for users verifying their account via email.
		// Only set this variable to FALSE in an admin environment to allow activation of accounts without requiring the activation token.
		$this->flexi_auth->activate_user($user_id, $token, TRUE);

		// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

		redirect('auth');
	}
	/**
 	 * update_user_account
 	 * Update the account details of a specific user.
 	 */
	function update_user_account($user_id)
	{
		$this->load->model('auth_admin_model');

		$default_administrators_usergroup_users = $this->auth_admin_model->get_users_belong_to_master_admin_group_with_id_3();

		if($this->flexi_auth->get_user_group_id() == 3)
		{

				// Check user has privileges to update user accounts, else display a message to notify the user they do not have valid privileges.
				if (! $this->flexi_auth->is_privileged('Update Users'))
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update user accounts.</p>');
					redirect('admin/users');		
				}

				// If 'Update User Account' form has been submitted, update the users account details.
				if ($this->input->post('update_users_account')) 
				{
					$this->auth_admin_model->update_user_account($user_id);
				}
				
				// Get users current data.
				$sql_where = array($this->flexi_auth->db_column('user_acc', 'id') => $user_id);
				$this->data['user'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);
			
				// Get user groups.
				$this->data['groups'] = $this->flexi_auth->get_groups_array();
				
				// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

				$this->load->view('users/admin/user_account_update', $this->data);
			
		}
		elseif($this->flexi_auth->get_user_group_id() != 3)
		{
			if(in_array($user_id, $default_administrators_usergroup_users))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update that user.</p>');
				redirect('admin/users');
			}
			else
			{			
				// Check user has privileges to update user accounts, else display a message to notify the user they do not have valid privileges.
				if (! $this->flexi_auth->is_privileged('Update Users'))
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update user accounts.</p>');
					redirect('admin/users');		
				}

					// If 'Update User Account' form has been submitted, update the users account details.
				if ($this->input->post('update_users_account')) 
				{
					$this->auth_admin_model->update_user_account($user_id);
				}

					// Get users current data.
				$sql_where = array($this->flexi_auth->db_column('user_acc', 'id') => $user_id);
				$this->data['user'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);
				
					// Get user groups.
				$this->data['groups'] = $this->flexi_auth->get_groups_array();

					// Set any returned status/error messages.
				$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

				$this->load->view('users/admin/user_account_update', $this->data);
			}
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// User Groups
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
 	/**
 	 * manage_user_groups
 	 * View and manage a table of all user groups.
 	 * This example allows user groups to be deleted via checkoxes within the page.
 	 */
    function manage_user_groups()
    {
		// Check user has privileges to view user groups, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View User Groups'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user groups.</p>');
			redirect('admin');		
		}

		
		// If 'Manage User Group' form has been submitted and user has privileges, delete user groups.
		if ($this->input->post('delete_group') && $this->flexi_auth->is_privileged('Delete User Groups')) 
		{
			$this->load->model('auth_admin_model');
			$this->auth_admin_model->manage_user_groups();
		}

		// Delete User Group from delete button at each raw of user data
		if ($this->input->post('delete_user_group'))
		{
			if (! $this->flexi_auth->is_privileged('Delete User Groups'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to Delete user group.</p>');
				redirect('admin');	
			}
			else  
			{
				$this->load->model('auth_admin_model');
				$this->auth_admin_model->delete_user_group();
			}
		} 


		// Define the group data columns to use on the view page. 
		// Note: The columns defined using the 'db_column()' functions are native table columns to the auth library. 
		// Read more on 'db_column()' functions in the quick help section near the top of this controller. 
		$sql_select = array(
			$this->flexi_auth->db_column('user_group', 'id'),
			$this->flexi_auth->db_column('user_group', 'name'),
			$this->flexi_auth->db_column('user_group', 'description'),
			$this->flexi_auth->db_column('user_group', 'admin')
		);
		$this->data['user_groups'] = $this->flexi_auth->get_groups_array($sql_select);
				
		// Set any returned status/error messages.
		$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->load->view('users/admin/groups_view', $this->data);		
    }
	
 	/**
 	 * insert_user_group
 	 * Insert a new user group.
 	 */
	function insert_user_group()
	{
		// Check user has privileges to insert user groups, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Insert User Groups'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to insert new user groups.</p>');
			redirect('admin/users/usergroups');		
		}

		// If 'Add User Group' form has been submitted, insert the new user group.
		if ($this->input->post('insert_user_group')) 
		{
			$this->load->model('auth_admin_model');
			$this->auth_admin_model->insert_user_group();
		}
		
		// Set any returned status/error messages.
		$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->load->view('users/admin/groups_create', $this->data);
	}
	
 	/**
 	 * update_user_group
 	 * Update the details of a specific user group.
 	 * We set limitation for users not belonging to Default Administration Usergroup($group_id == 3)
 	 * to update Default Administration Usergroup.
 	 * To achieve that we check if $group_id == 3 and if yes, then user must belong to that usergroup ($this->flexi_auth->get_user_group_id() == 3).
 	 */
	function update_user_group($group_id)
	{

		if($group_id != 3)
		{


			// Check user has privileges to update user groups, else display a message to notify the user they do not have valid privileges.
			if (! $this->flexi_auth->is_privileged('Update User Groups'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update user groups.</p>');
				redirect('admin/users/usergroups');		
			}

			// If 'Update User Group' form has been submitted, update the user group details.
			if ($this->input->post('update_user_group')) 
			{
				$this->load->model('auth_admin_model');
				$this->auth_admin_model->update_user_group($group_id);
			}

			// Get user groups current data.
			$sql_where = array($this->flexi_auth->db_column('user_group', 'id') => $group_id);
			$this->data['group'] = $this->flexi_auth->get_groups_row_array(FALSE, $sql_where);
			
			// Set any returned status/error messages.
			$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

			$this->load->view('users/admin/groups_update', $this->data);
		}
		elseif($group_id == 3)
		{
			if($this->flexi_auth->get_user_group_id() == 3)
			{
				// Check user has privileges to update user groups, else display a message to notify the user they do not have valid privileges.
				if (! $this->flexi_auth->is_privileged('Update User Groups'))
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update user groups.</p>');
					redirect('admin/users/usergroups');		
				}

				// If 'Update User Group' form has been submitted, update the user group details.
				if ($this->input->post('update_user_group')) 
				{
					$this->load->model('auth_admin_model');
					$this->auth_admin_model->update_user_group($group_id);
				}

				// Get user groups current data.
				$sql_where = array($this->flexi_auth->db_column('user_group', 'id') => $group_id);
				$this->data['group'] = $this->flexi_auth->get_groups_row_array(FALSE, $sql_where);
				
				// Set any returned status/error messages.
				$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

				$this->load->view('users/admin/groups_update', $this->data);				
			}
			else
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update Administrators Usergroup.</p>');
				redirect('admin/users/usergroups');	
			}

		}
		
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Privileges
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
 	/**
 	 * manage_privileges
 	 * View and manage a table of all user privileges.
 	 * This example allows user privileges to be deleted via checkoxes within the page.
 	 */
    function manage_privileges()
    {
		// Check user has privileges to view user privileges, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Privileges'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to view user privileges.</p>');
			redirect('admin');		
		}
		
		// If 'Manage Privilege' form has been submitted and the user has privileges to delete privileges.
		if ($this->input->post('delete_privilege') && $this->flexi_auth->is_privileged('Delete Privileges')) 
		{
			$this->load->model('auth_admin_model');
			$this->auth_admin_model->manage_privileges();
		}

		// Delete Privilege from delete button at each raw of user data
		if ($this->input->post('delete_privilege_one_by_one'))
		{
			if (! $this->flexi_auth->is_privileged('Delete Privileges'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to Delete Privileges.</p>');
				redirect('admin');	
			}
			else  
			{
				$this->load->model('auth_admin_model');
				$this->auth_admin_model->delete_privileges_one_by_one();
			}
		} 

		// Define the privilege data columns to use on the view page. 
		// Note: The columns defined using the 'db_column()' functions are native table columns to the auth library. 
		// Read more on 'db_column()' functions in the quick help section near the top of this controller. 
		$sql_select = array(
			$this->flexi_auth->db_column('user_privileges', 'id'),
			$this->flexi_auth->db_column('user_privileges', 'name'),
			$this->flexi_auth->db_column('user_privileges', 'description'),
			$this->flexi_auth->db_column('user_privileges', 'is_frontend_priv')
		);

		// Check if user belongs to default admin usergroup (ugrp_id == 3)
		// If yes then all privileges will be shown up
		// If no then only privileges for frontend use will be shown up
		// This is done to prevent changing main app privileges.
		if($this->flexi_auth->get_user_group_id() == 3)
		{
			$this->data['privileges'] = $this->flexi_auth->get_privileges_array($sql_select);

		}
		else
		{
			$sql_or_where_in = array(
										$this->flexi_auth->db_column('user_privileges', 'is_frontend_priv') => '1',
								);

			$this->data['privileges'] = $this->flexi_auth->get_privileges_array($sql_select, $sql_or_where_in);
		}

		
				
		// Set any returned status/error messages.
		$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->load->view('users/admin/privileges_view', $this->data);
	}
	
 	/**
 	 * insert_privilege
 	 * Insert a new user privilege.
 	 */
	function insert_privilege()
	{
		// Check user has privileges to insert user privileges, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Insert Privileges'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to insert new user privileges.</p>');
			redirect('admin/users/privileges');		
		}

		// If 'Add Privilege' form has been submitted, insert the new privilege.
		if ($this->input->post('insert_privilege')) 
		{
			$this->load->model('auth_admin_model');
			$this->auth_admin_model->insert_privilege();
		}
		
		// Set any returned status/error messages.
		$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->load->view('users/admin/privileges_create', $this->data);
	}
	
 	/**
 	 * update_privilege
 	 * Update the details of a specific user privilege.
 	 */
	function update_privilege($privilege_id)
	{
		$this->load->model('auth_admin_model');
		$frontend_privileges = $this->auth_admin_model->get_only_frontend_privileges();

		if($this->flexi_auth->get_user_group_id() == 3)
		{

			// Check user has privileges to update user privileges, else display a message to notify the user they do not have valid privileges.
			if (! $this->flexi_auth->is_privileged('Update Privileges'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update user privileges.</p>');
				redirect('admin/users/privileges');		
			}

			// If 'Update Privilege' form has been submitted, update the privilege details.
			if ($this->input->post('update_privilege')) 
			{
				$this->auth_admin_model->update_privilege($privilege_id);
			}

			// Get privileges current data.
			$sql_where = array($this->flexi_auth->db_column('user_privileges', 'id') => $privilege_id);
			$this->data['privilege'] = $this->flexi_auth->get_privileges_row_array(FALSE, $sql_where);

			// Set any returned status/error messages.
			$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

			$this->load->view('users/admin/privileges_update', $this->data);

		}
		else
		{
			if(in_array($privilege_id, $frontend_privileges ))
			{

				// Check user has privileges to update user privileges, else display a message to notify the user they do not have valid privileges.
				if (! $this->flexi_auth->is_privileged('Update Privileges'))
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update user privileges.</p>');
					redirect('admin/users/privileges');		
				}

				// If 'Update Privilege' form has been submitted, update the privilege details.
				if ($this->input->post('update_privilege')) 
				{
					$this->auth_admin_model->update_privilege($privilege_id);
				}
				
				// Get privileges current data.
				$sql_where = array($this->flexi_auth->db_column('user_privileges', 'id') => $privilege_id);
				$this->data['privilege'] = $this->flexi_auth->get_privileges_row_array(FALSE, $sql_where);
				
				// Set any returned status/error messages.
				$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

				$this->load->view('users/admin/privileges_update', $this->data);
			}
			else
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot update selected privilege.</p>');
				redirect('admin/users/privileges');
			}
		}

	}
	
 	/**
 	 * update_user_privileges
 	 * Update the access privileges of a specific user.
 	 */
    function update_user_privileges($user_id)
    {
    	$this->load->model('auth_admin_model');

		$default_administrators_usergroup_users = $this->auth_admin_model->get_users_belong_to_master_admin_group_with_id_3();

    	if($this->flexi_auth->get_user_group_id() == 3)
		{
			// Check user has privileges to update user privileges, else display a message to notify the user they do not have valid privileges.
			if (! $this->flexi_auth->is_privileged('Update Privileges'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update user privileges.</p>');
				redirect('admin/users');		
			}

			// If 'Update User Privilege' form has been submitted, update the user privileges.
			if ($this->input->post('update_user_privilege')) 
			{
				$this->auth_admin_model->update_user_privileges($user_id);
			}

			// Get users current data.

			$sql_where = array($this->flexi_auth->db_column('user_acc', 'id') => $user_id);
			$this->data['user'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);

			// Get all privilege data. 
			$sql_select = array(
				$this->flexi_auth->db_column('user_privileges', 'id'),
				$this->flexi_auth->db_column('user_privileges', 'name'),
				$this->flexi_auth->db_column('user_privileges', 'description')
			);
			$this->data['privileges'] = $this->flexi_auth->get_privileges_array($sql_select);
			
			// Get user groups current privilege data.
			$sql_select = array($this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
			$sql_where = array($this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $this->data['user'][$this->flexi_auth->db_column('user_acc', 'group_id')]);
			$group_privileges = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);
	                
	        $this->data['group_privileges'] = array();
	        foreach($group_privileges as $privilege)
	        {
	            $this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
	        }
	                
			// Get users current privilege data.
			$sql_select = array($this->flexi_auth->db_column('user_privilege_users', 'privilege_id'));
			$sql_where = array($this->flexi_auth->db_column('user_privilege_users', 'user_id') => $user_id);
			$user_privileges = $this->flexi_auth->get_user_privileges_array($sql_select, $sql_where);
		
			// For the purposes of the example demo view, create an array of ids for all the users assigned privileges.
			// The array can then be used within the view to check whether the user has a specific privilege, this data allows us to then format form input values accordingly. 
			$this->data['user_privileges'] = array();
			foreach($user_privileges as $privilege)
			{
				$this->data['user_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_users', 'privilege_id')];
			}
		
			// Set any returned status/error messages.
			$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

	        // For demo purposes of demonstrate whether the current defined user privilege source is getting privilege data from either individual user 
	        // privileges or user group privileges, load the settings array containing the current privilege sources. 
			$this->data['privilege_sources'] = $this->auth->auth_settings['privilege_sources'];
	                
			$this->load->view('users/admin/users_privileges_update', $this->data);	
		}
		else
		{
			if(in_array($user_id, $default_administrators_usergroup_users))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update that user privileges.</p>');
				redirect('admin/users');
			}
			else
			{
				// Check user has privileges to update user privileges, else display a message to notify the user they do not have valid privileges.
				if (! $this->flexi_auth->is_privileged('Update Privileges'))
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update user privileges.</p>');
					redirect('admin/users');		
				}

				// If 'Update User Privilege' form has been submitted, update the user privileges.
				if ($this->input->post('update_user_privilege')) 
				{
					$this->auth_admin_model->update_user_privileges($user_id);
				}

				// Get users current data.

				$sql_where = array($this->flexi_auth->db_column('user_acc', 'id') => $user_id);
				$this->data['user'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);

				// Get all privilege data. 
				$sql_select = array(
					$this->flexi_auth->db_column('user_privileges', 'id'),
					$this->flexi_auth->db_column('user_privileges', 'name'),
					$this->flexi_auth->db_column('user_privileges', 'description')
				);
				$this->data['privileges'] = $this->flexi_auth->get_privileges_array($sql_select);
				
				// Get user groups current privilege data.
				$sql_select = array($this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
				$sql_where = array($this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $this->data['user'][$this->flexi_auth->db_column('user_acc', 'group_id')]);
				$group_privileges = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);
		                
		        $this->data['group_privileges'] = array();
		        foreach($group_privileges as $privilege)
		        {
		            $this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
		        }
		                
				// Get users current privilege data.
				$sql_select = array($this->flexi_auth->db_column('user_privilege_users', 'privilege_id'));
				$sql_where = array($this->flexi_auth->db_column('user_privilege_users', 'user_id') => $user_id);
				$user_privileges = $this->flexi_auth->get_user_privileges_array($sql_select, $sql_where);
			
				// For the purposes of the example demo view, create an array of ids for all the users assigned privileges.
				// The array can then be used within the view to check whether the user has a specific privilege, this data allows us to then format form input values accordingly. 
				$this->data['user_privileges'] = array();
				foreach($user_privileges as $privilege)
				{
					$this->data['user_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_users', 'privilege_id')];
				}
			
				// Set any returned status/error messages.
				$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		        // For demo purposes of demonstrate whether the current defined user privilege source is getting privilege data from either individual user 
		        // privileges or user group privileges, load the settings array containing the current privilege sources. 
				$this->data['privilege_sources'] = $this->auth->auth_settings['privilege_sources'];
		                
				$this->load->view('users/admin/users_privileges_update', $this->data);
			}
		}	
    }
    
 	/**
 	 * update_group_privileges 
 	 * Update the access privileges of a specific user group.
 	 */
    function update_group_privileges($group_id)
    {
    	if($this->flexi_auth->get_user_group_id() == 3)
		{
			// Check user has privileges to update group privileges, else display a message to notify the user they do not have valid privileges.
			if (! $this->flexi_auth->is_privileged('Update Privileges'))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update group privileges.</p>');
				redirect('admin/users/usergroups');		
			}

			// If 'Update Group Privilege' form has been submitted, update the privileges of the user group.
			if ($this->input->post('update_group_privilege')) 
			{
				$this->load->model('auth_admin_model');
				$this->auth_admin_model->update_group_privileges($group_id);
			}
			
			// Get data for the current user group.
			$sql_where = array($this->flexi_auth->db_column('user_group', 'id') => $group_id);
			$this->data['group'] = $this->flexi_auth->get_groups_row_array(FALSE, $sql_where);
	                
			// Get all privilege data. 
			$sql_select = array(
				$this->flexi_auth->db_column('user_privileges', 'id'),
				$this->flexi_auth->db_column('user_privileges', 'name'),
				$this->flexi_auth->db_column('user_privileges', 'description')
			);
			$this->data['privileges'] = $this->flexi_auth->get_privileges_array($sql_select);
			
			// Get data for the current privilege group.
			$sql_select = array($this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
			$sql_where = array($this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $group_id);
			$group_privileges = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);
	                
			// For the purposes of the example demo view, create an array of ids for all the privileges that have been assigned to a privilege group.
			// The array can then be used within the view to check whether the group has a specific privilege, this data allows us to then format form input values accordingly. 
			$this->data['group_privileges'] = array();
			foreach($group_privileges as $privilege)
			{
				$this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
			}
		
			// Set any returned status/error messages.
			$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

	        // For demo purposes of demonstrate whether the current defined user privilege source is getting privilege data from either individual user 
	        // privileges or user group privileges, load the settings array containing the current privilege sources. 
	        $this->data['privilege_sources'] = $this->auth->auth_settings['privilege_sources'];
	                
			$this->load->view('users/admin/group_privileges_update', $this->data);	
		}
		else
		{
			if($group_id == 3)
			{
				$this->session->set_flashdata('message', '<p class="error_msg">You cannot access that usergroup privileges.</p>');
				redirect('admin/users/usergroups');	
			}
			elseif($group_id != 3)
			{
				// Check user has privileges to update group privileges, else display a message to notify the user they do not have valid privileges.
				if (! $this->flexi_auth->is_privileged('Update Privileges'))
				{
					$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to update group privileges.</p>');
					redirect('admin/users/usergroups');		
				}

				// If 'Update Group Privilege' form has been submitted, update the privileges of the user group.
				if ($this->input->post('update_group_privilege')) 
				{
					$this->load->model('auth_admin_model');
					$this->auth_admin_model->update_group_privileges($group_id);
				}
				
				// Get data for the current user group.
				$sql_where = array($this->flexi_auth->db_column('user_group', 'id') => $group_id);
				$this->data['group'] = $this->flexi_auth->get_groups_row_array(FALSE, $sql_where);
		                
				// Get all privilege data. 
				$sql_select = array(
					$this->flexi_auth->db_column('user_privileges', 'id'),
					$this->flexi_auth->db_column('user_privileges', 'name'),
					$this->flexi_auth->db_column('user_privileges', 'description')
				);
				$this->data['privileges'] = $this->flexi_auth->get_privileges_array($sql_select);
				
				// Get data for the current privilege group.
				$sql_select = array($this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
				$sql_where = array($this->flexi_auth->db_column('user_privilege_groups', 'group_id') => $group_id);
				$group_privileges = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);
		                
				// For the purposes of the example demo view, create an array of ids for all the privileges that have been assigned to a privilege group.
				// The array can then be used within the view to check whether the group has a specific privilege, this data allows us to then format form input values accordingly. 
				$this->data['group_privileges'] = array();
				foreach($group_privileges as $privilege)
				{
					$this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
				}
			
				// Set any returned status/error messages.
				$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		        // For demo purposes of demonstrate whether the current defined user privilege source is getting privilege data from either individual user 
		        // privileges or user group privileges, load the settings array containing the current privilege sources. 
		        $this->data['privilege_sources'] = $this->auth->auth_settings['privilege_sources'];
		                
				$this->load->view('users/admin/group_privileges_update', $this->data);
			}
		}	
    }

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// User Activity
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
 	/**
 	 * list_user_status
 	 * Display a list of active or inactive user accounts. 
 	 * The active status of an account is based on whether the user has verified their account after registering - typically via email activation. 
 	 * This demo example simply shows a table of users that have, and have not activated their accounts.
 	 */
	function list_user_status($status = FALSE)
	{
		// Check user has privileges to view user accounts, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Users'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user accounts.</p>');
			redirect('auth_admin');		
		}

		// The view associated with this controller method is used by multiple methods, therefore set a page title.
		$this->data['page_title'] = ($status == 'inactive') ? 'Inactive Users' : 'Active Users';
		$this->data['status'] = ($status == 'inactive') ? 'inactive_users' : 'active_users'; // Indicate page function.
		
		// Get an array of all active/inactive user accounts, using the sql select and where statements defined below.
		// Note: The columns defined using the 'db_column()' functions are native table columns to the auth library. 
		// Read more on 'db_column()' functions in the quick help section near the top of this controller. 
		$sql_select = array(
			$this->flexi_auth->db_column('user_acc', 'id'),
			$this->flexi_auth->db_column('user_acc', 'email'),
			$this->flexi_auth->db_column('user_acc', 'active'),
			$this->flexi_auth->db_column('user_group', 'name'),
			// The following columns are located in the demo example 'demo_user_profiles' table, which is not required by the library.
			'upro_first_name', 
			'upro_last_name'
		);
		$sql_where[$this->flexi_auth->db_column('user_acc', 'active')] = ($status == 'inactive') ? 0 : 1;
		if (! $this->flexi_auth->in_group('Master Admin'))
		{
			// For this example, prevent any 'Master Admin' users being listed to non master admins.
			$sql_where[$this->flexi_auth->db_column('user_group', 'id').' !='] = 2;
		}
		$this->data['users'] = $this->flexi_auth->get_users_array($sql_select, $sql_where);
			
		$this->load->view('demo/admin_examples/users_view', $this->data);
	}

 	/**
 	 * delete_unactivated_users
 	 * Display a list of all user accounts that have not been activated within a define time period. 
 	 * This demo example allows the option to then delete all of the unactivated accounts.
 	 */
	function delete_unactivated_users()
	{
		// Check user has privileges to view user accounts, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Users'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user accounts.</p>');
			redirect('auth_admin');		
		}

		// Filter accounts old than set number of days.
		$inactive_days = 28;
	
		// If 'Delete Unactivated Users' form has been submitted and user has privileges to delete users.
		if ($this->input->post('delete_unactivated') && $this->flexi_auth->is_privileged('Delete Users'))
		{
			$this->load->model('auth_admin_model');
			$this->auth_admin_model->delete_users($inactive_days);
		}

		// Get an array of all user accounts that have not been activated within the defined limit ($inactive_days), using the sql select and where statements defined below.
		// Note: The columns defined using the 'db_column()' functions are native table columns to the auth library. 
		// Read more on 'db_column()' functions in the quick help section near the top of this controller. 
		$sql_select = array(
			$this->flexi_auth->db_column('user_acc', 'id'),
			$this->flexi_auth->db_column('user_acc', 'email'),
			$this->flexi_auth->db_column('user_acc', 'active'),
			$this->flexi_auth->db_column('user_group', 'name'),
			// The following columns are located in the demo example 'demo_user_profiles' table, which is not required by the library.
			'upro_first_name',
			'upro_last_name'
		);
		$this->data['users'] = $this->flexi_auth->get_unactivated_users_array($inactive_days, $sql_select);
				
		$this->load->view('demo/admin_examples/users_unactivated_view', $this->data);
	}
	
 	/**
 	 * failed_login_users
 	 * Display a list of all user accounts that have too many failed login attempts since the users last successful login. 
	 * The purpose of this example is to highlight user accounts that have either struggled to login, or that may be the subject of a brute force hacking attempt.
 	 */
	function failed_login_users()
	{
		// Check user has privileges to view user accounts, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Users'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view this page.</p>');
			redirect('auth_admin');		
		}

		// The view associated with this controller method is used by other methods, therefore set a page title.
		$this->data['page_title'] = 'Failed Login Users';
		$this->data['status'] = 'failed_login_users'; // Indicate page function.
		
		// Get an array of all user accounts that have more than 3 failed login attempts since their last successfuly login.
		// Note: The columns defined using the 'db_column()' functions are native table columns to the auth library. 
		// Read more on 'db_column()' functions in the quick help section near the top of this controller. 
		$sql_select = array(
			$this->flexi_auth->db_column('user_acc', 'id'),
			$this->flexi_auth->db_column('user_acc', 'email'),
			$this->flexi_auth->db_column('user_acc', 'failed_logins'),
			$this->flexi_auth->db_column('user_acc', 'active'),
			$this->flexi_auth->db_column('user_group', 'name'),
			// The following columns are located in the demo example 'demo_user_profiles' table, which is not required by the library.
			'upro_first_name',
			'upro_last_name'
		);
		$sql_where[$this->flexi_auth->db_column('user_acc', 'failed_logins').' >='] = 3; // Get users with 3 or more failed login attempts.
		if (! $this->flexi_auth->in_group('Master Admin'))
		{
			// For this example, prevent any 'Master Admin' users being listed to non master admins.
			$sql_where[$this->flexi_auth->db_column('user_group', 'id').' !='] = 2;
		}
		$this->data['users'] = $this->flexi_auth->get_users_array($sql_select, $sql_where);
		
		$this->load->view('demo/admin_examples/users_view', $this->data);
	}

}

/* End of file auth_admin.php */
/* Location: ./application/modules/users/controllers/admin.php */
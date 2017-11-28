<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}

	public function get_published_articles_created_per_user($current_logged_in_user)
	{
		$this->db->select('a.*');
    	$this->db->from('articles AS a');
        $this->db->where('author_id', $current_logged_in_user);
        $this->db->where('is_published', 1);
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        return $query->result(); 
	}

	public function get_all_published_articles()
	{
		$this->db->select('a.*');
    	$this->db->from('articles AS a');
        $this->db->where('is_published', 1);
        $this->db->where('deleted', 0);
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get();
        return $query->result();		
	}	

	public function get_10_latest_published_articles()
	{
		$this->db->select('a.*');
    	$this->db->from('articles AS a');
        $this->db->where('is_published', 1);
        $this->db->where('deleted', 0);
        $this->db->limit(10);
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get();
        return $query->result();		
	}



	public function get_total_active_users()
	{
		$this->db->select('a.*');
    	$this->db->from('user_accounts AS a');
        $this->db->where('uacc_active', 1);
        $this->db->where('uacc_suspend', 0);
        $query = $this->db->get();
        return $query->result();		
	}


}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings_m extends MY_Model{

    // $_logevents are declared as FALSE in MY_Model in insert,update_by functions we use in article_m model
    // Here we set them to true to parse the if statement in MY_Model used in Functions Create/Update
    // ***
    //_logevents save in update_by and in insert methods the create(date), created_by(current logged in user id)
    // modified(date), modified_by(current logged in user id)
    // ***
    protected $_logevents = TRUE;

	 function __construct(){
        parent::__construct();
        $this->table = 'settings';
    }

    public function get_settings()
    {
        $this->db->select('a.*');
        $this->db->from('settings AS a');
        $this->db->where('a.id', 0);
        $query = $this->db->get();
        return $query->row();
    }
    
}
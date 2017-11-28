<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Templates_m extends MY_Model{

    // $_logevents are declared as FALSE in MY_Model in insert,update_by functions we use in article_m model
    // Here we set them to true to parse the if statement in MY_Model used in Functions Create/Update
    /*
    */
    // $_logevents save in update_by and in insert methods the create(date), created_by(current logged in user id)
    // modified(date), modified_by(current logged in user id)
    // ***
	protected $_logevents = TRUE;

    // We have set soft_delete to FALSE to MY_Model by default so we change it here
    protected $soft_delete = TRUE;

	 function __construct(){
        parent::__construct();
        $this->table = 'templates';
    }
    
    //We use the get_insert_id to the menu controller in the insert function
    //to store the menu_id into the menu_items table, in the create menu function
    public function get_insert_id()
    {
        return $this->db->insert_id();   
    }

    // Function to show all published/unpublished templates
    public function get_templates(){
        $this->db->select('a.*');
        $this->db->from('templates AS a');
        $this->db->where('deleted',0);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Function to show all published/unpublished templates
    public function get_trashed_templates(){
        $this->db->select('a.*');
        $this->db->from('templates AS a');
        $this->db->where('deleted',1);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }


    // Function to get a menu raw per id (used for updating the form of a chosen menu)
    public function get_template($template_id){
        $this->db->select('a.*');
        $this->db->from('templates AS a');
        $this->db->where('a.id',$template_id);
        $this->db->where('deleted',0);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_not_trashed_templates(){
        $this->db->select('a.*');
        $this->db->from('templates AS a');
        $this->db->where('deleted',0);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;       
    }

    public function get_total_trashed_templates()
    {
        $this->db->select('a.*');
        $this->db->from('templates AS a');
        $this->db->where('deleted',1);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;       
    }

    public function set_trashed_template($template_id)
    {
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 1
            );
        $this->db->where('id',$template_id);
        $this->db->update('templates',$data);
        return;
    }


    public function unset_trashed_template($template_id)
    {
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$template_id);
        $this->db->update('templates',$data);
        return;
    }


    /**
    * Permanently Delete a row from the table by the primary value without using soft_delete
    */
    public function delete_trashed_template($template_id)
    {
        $this->trigger('before_delete', $template_id);

        $this->_database->where($this->primary_key, $template_id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }


    public function set_default_template($template_id){
        $data = array(
            'default' => 1,
            //set deleted to 0 so that there is only home page published for our frontend
            //also we set published to 1 so that homepage is always set to published
            'deleted' => 0,
            'is_published' => 1,
            );
        $this->db->where('id',$template_id);
        $this->db->update('templates',$data);
        return;
    }

    public function get_default_template()
    {
        $this->db->select('a.*');
        $this->db->from('templates AS a');
        $this->db->where('default', 1);
        $this->db->where('deleted',0);
        $query = $this->db->get();
        return $query->row();
    }


}
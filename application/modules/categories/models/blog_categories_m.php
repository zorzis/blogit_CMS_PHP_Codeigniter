<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_categories_m extends MY_Model{

    // $_logevents are declared as FALSE in MY_Model in insert,update_by functions we use in article_m model
    // Here we set them to true to parse the if statement in MY_Model used in Functions Create/Update
    // ***
    //_logevents save in update_by and in insert methods the create(date), created_by(current logged in user id)
    // modified(date), modified_by(current logged in user id)
    // ***
    protected $_logevents = TRUE;

    // We have set soft_delete to FALSE to MY_Model by default so we change it here
    protected $soft_delete = TRUE;

	 function __construct(){
        parent::__construct();
        $this->table = 'blog_categories';
    }

    // Function to show all published/unpublished articles
 	public function get_blog_categories(){
        $this->db->select('a.*');
        $this->db->from('blog_categories AS a');
        $this->db->where('deleted',0);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Function to show category raw per id used on update articles
    public function get_blog_category($id){
        $this->db->select('a.*');
        $this->db->from('blog_categories AS a');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to show trashed articles with is_published status = 2 same with get_articles function
 	public function get_trashed_blog_categories(){
    	$this->db->select('a.*');
		$this->db->from('blog_categories AS a');
		$this->db->where('deleted',1);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
      	$query = $this->db->get();
       	return $query->result();
    }

    /**
     * Permanently Delete a row from the table by the primary value without using soft_delete
     */
    public function delete_trashed_blog_category($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }

    public function publish_blog_category ($id){
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$id);
        $this->db->update('blog_categories',$data);
        return;
    }

    public function unpublish_blog_category ($id){
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
             );
        $this->db->where('id',$id);
        $this->db->update('blog_categories',$data);
        return;
    }

    //Get Created by user
    public function get_created_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('blog_categories AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.created_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }
    //Get Modified by user
    public function get_modified_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('blog_categories AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.modified_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

}



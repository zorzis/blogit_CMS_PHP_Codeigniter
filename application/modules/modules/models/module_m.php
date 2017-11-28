<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Module_m extends MY_Model{

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
        $this->table = 'modules';
    }
    
    public function get_insert_id(){
        return $this->db->insert_id();
    }

    // Function to show all published/unpublished articles
    public function get_modules(){
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('deleted',0);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_custom_module($id){
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$id);
        $this->db->where('a.module_type','custom_module');
        $this->db->join('module_custom_content AS b', 'b.module_id = a.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_menu_module($id){
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$id);
        $this->db->where('a.module_type','menu_module');
        $this->db->join('module_menu_content AS b', 'b.module_id = a.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_latest_articles_module($module_id)
    {
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$module_id);
        $this->db->where('a.module_type','latest_blog_articles_module');
        $query = $this->db->get();
        return $query->row();
    }
    public function get_popular_articles_module($module_id)
    {
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$module_id);
        $this->db->where('a.module_type','popular_blog_articles_module');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_image_slider_module($module_id)
    {
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$module_id);
        $this->db->where('a.module_type','image_slider_module');
        $query = $this->db->get();
        return $query->row();  
    }

    public function get_portfolio_module($module_id)
    {
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$module_id);
        $this->db->where('a.module_type','portfolio_module');
        $query = $this->db->get();
        return $query->row();  
    }

    // Function to show category raw per id used on update articles
    public function get_module($id){
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to show trashed articles with is_published status = 2 same with get_articles function
    public function get_trashed_modules(){
        $this->db->select('a.*');
        $this->db->from('modules AS a');
        $this->db->where('deleted',1);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Permanently Delete a row from the table by the primary value without using soft_delete
     */
    public function delete_trashed_module($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }

    //Delete Custom Module Content
    public function delete_custom_module_content($module_id)
    {
        $this->db->where('module_id', $module_id);
        $this->db->delete('module_custom_content');
    }  

    //Delete Menu Module Content
    public function delete_menu_module_content($module_id)
    {
        $this->db->where('module_id', $module_id);
        $this->db->delete('module_menu_content');
    } 

    //Delete Blog Module Content(Latest Articles and Popular Articles)
    //They are stored in the same table, only functions change
    public function delete_blog_module_content($module_id)
    {
        $this->db->where('module_id', $module_id);
        $this->db->delete('module_blog_content');
    }
    
    //Delete Blog Module Content(Latest Articles and Popular Articles)
    public function delete_image_slider_module_content($module_id)
    {
        $this->db->where('module_id', $module_id);
        $this->db->delete('module_image_slider');
    }    

    //Get Privileges (used to get the privilege id from user_privileges table)
    public function get_privileges(){
        $this->db->select('w.*');
        $this->db->from('user_privileges AS w');
        $this->db->where('upriv_is_frontend', 1);

        $this->db->order_by('w.upriv_id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function publish_module ($id){
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$id);
        $this->db->update('modules',$data);
        return;
    }

    public function unpublish_module ($id){
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
             );
        $this->db->where('id',$id);
        $this->db->update('modules',$data);
        return;
    }

    //Get Created by user
    public function get_created_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('modules AS a');
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
        $this->db->from('modules AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.modified_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    // Add Custom Content to module_custom_content table
    public function add_module_custom_content($data, $skip_validation = FALSE)
    {

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->db->insert('module_custom_content',$data);
            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }


    public function update_module_custom_content($data)
    {
        $this->db->where('module_id',$data['module_id']);
        $query = $this->db->get('module_custom_content');
         
        if($query->num_rows() > 0){
            $this->db->where('module_id', $data['module_id']);
            $this->db->update('module_custom_content', $data);
        } else {
            $this->add_module_custom_content($data);
        }
    
    }

    // Add Chosen Menu to module_menu_content table
    public function add_module_menu($data, $skip_validation = FALSE)
    {

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->db->insert('module_menu_content',$data);
            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    public function update_module_menu_content($data)
    {
        $this->db->where('module_id',$data['module_id']);
        $query = $this->db->get('module_menu_content');
         
        if($query->num_rows() > 0){
            $this->db->where('module_id', $data['module_id']);
            $this->db->update('module_menu_content', $data);
        } else {
            $this->add_module_menu_content($data);
        }
    
    }

    //Get current blog module categories selected
    public function current_blog_module_categories($module_id)
    {

        $this->db->select('a.*');
        $this->db->from('module_blog_content AS a');
        $this->db->where('module_id', $module_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_blog_module_articles_categories($module_id, $category_id)
    {
        if (!is_numeric($module_id) || !is_numeric($category_id))
        {
            return FALSE;
        }

            //Edw mporei na kanw lathos
        $latest_articles_categories = array(
            'module_id'                   => $module_id,
            'category_id'                 => $category_id,
            );

        $this->db->insert('module_blog_content', $latest_articles_categories);

        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
    }

    public function delete_blog_module_articles_categories($sql_where)
    {
        if (is_numeric($sql_where))
        {
            $sql_where = array('id' => $sql_where);
        }
        
        $this->db->delete('module_blog_content', $sql_where);

        return $this->db->affected_rows() == 1; 
    }

    public function update_module_blog_content($module_id)
    {
        // Update categories for current module.
        foreach($this->input->post('update_categories') as $row)
        {

            if ($row['current_status'] != $row['new_status'])
            {
                // Insert new module categories.
                if ($row['new_status'] == 1)
                {
                    $this->insert_blog_module_articles_categories($module_id, $row['category_id']);  
                }
                else
                {
                    $sql_where = array(

                        'module_id'     => $module_id,
                        'category_id'   => $row['category_id'],
                    );
                    
                    $this->delete_blog_module_articles_categories($sql_where);
                }

            }
        }
    }

    //Get current portfolio module categories selected
    public function current_portfolio_module_categories($module_id)
    {

        $this->db->select('a.*');
        $this->db->from('module_portfolio_content AS a');
        $this->db->where('module_id', $module_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_portfolio_module_projects_categories($module_id, $category_id)
    {
        if (!is_numeric($module_id) || !is_numeric($category_id))
        {
            return FALSE;
        }

            //Edw mporei na kanw lathos
        $portfolio_categories = array(
            'module_id'                   => $module_id,
            'category_id'                 => $category_id,
            );

        $this->db->insert('module_portfolio_content', $portfolio_categories);

        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
    }

    public function delete_portfolio_module_projects_categories($sql_where)
    {
        if (is_numeric($sql_where))
        {
            $sql_where = array('id' => $sql_where);
        }
        
        $this->db->delete('module_portfolio_content', $sql_where);

        return $this->db->affected_rows() == 1; 
    }

    public function update_module_portfolio_content($module_id)
    {
        // Update categories for current module.
        foreach($this->input->post('update_categories') as $row)
        {

            if ($row['current_status'] != $row['new_status'])
            {
                // Insert new module categories.
                if ($row['new_status'] == 1)
                {
                    $this->insert_portfolio_module_projects_categories($module_id, $row['category_id']);  
                }
                else
                {
                    $sql_where = array(

                        'module_id'     => $module_id,
                        'category_id'   => $row['category_id'],
                    );
                    
                    $this->delete_portfolio_module_projects_categories($sql_where);
                }

            }
        }
    }

    //Image Slider Module Get Images Stored in Database
    public function current_image_slider_module_images($module_id)
    {
        $this->db->select('a.*');
        $this->db->from('module_image_slider AS a');
        $this->db->where('module_id', $module_id);
        $query = $this->db->get();
        return $query->result();       
    }

    public function delete_image_slider_images($module_id)
    {
        $this->db->where('module_id', $module_id);
        $this->db->delete('module_image_slider');
    }


}



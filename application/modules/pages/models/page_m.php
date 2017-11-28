<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page_m extends MY_Model{

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
        $this->table = 'pages';
    }

    /***********************************************************************************************************/
    //
    //
    //
    //                                              Pages Functions
    //
    //
    //
    /***********************************************************************************************************/

    // Function to show all published/unpublished articles
 	public function get_pages(){
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('deleted',0);
        $this->db->order_by('a.created ','ASC');
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //Get page type
    public function get_page($id){
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to get page with custom content based upon others on declared page type (page_type == 1 for custom content)
    public function get_custom_page($id){
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->from('pages AS a');
        $this->db->where('a.id',$id);
        $this->db->where('a.page_type',1);
        $this->db->join('page_custom_content AS b', 'b.page_id = a.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    // Function to get page with blog content based upon others on declared page type (page_type == 2 for blog content)
    public function get_blog_page($id){
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('a.id',$id);
        $this->db->where('a.page_type',2);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to get page with external url based upon others on declared page type (page_type == 3 for external url content)
    public function get_external_url_page($id){
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->from('pages AS a');
        $this->db->where('a.id',$id);
        $this->db->where('a.page_type',3);
        $this->db->join('page_external_url_content AS b', 'b.page_id = a.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    // Function to get page with portfolio content based upon others on declared page type (page_type == 4 for portfolio content)
    public function get_portfolio_page($id){
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('a.id',$id);
        $this->db->where('a.page_type',4);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to show trashed articles with is_published status = 2 same with get_articles function
 	public function get_trashed_pages(){
    	$this->db->select('a.*');
		$this->db->from('pages AS a');
		$this->db->where('deleted',1);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
      	$query = $this->db->get();
       	return $query->result();
    }

    /**
     * Permanently Delete a row from the table by the primary value without using soft_delete
     */
    public function delete_trashed_page($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }

    public function set_home_page($id){
        $data = array(
            'is_home' => 1,
            //set deleted to 0 so that there is only home page published for our frontend
            //also we set published to 1 so that homepage is always set to published
            'deleted' => 0,
            'is_published' => 1,
            );
        $this->db->where('id',$id);
        $this->db->where('page_type !=', 3);
        $this->db->update('pages',$data);
        return;
    }

    public function publish_page ($id){
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$id);
        $this->db->update('pages',$data);
        return;
    }

    public function unpublish_page ($id){
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
             );
        $this->db->where('id',$id);
        $this->db->where('is_home !=',1);
        $this->db->update('pages',$data);
        return;
    }

    //Get Created by user
    public function get_created_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('pages AS a');
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
        $this->db->from('pages AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.modified_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
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

    //Get Pages (used for getting page id)
    public function get_page_modules(){
        $this->db->select('m.*');
        $this->db->from('modules AS m');
        $this->db->where('deleted',0);
        $this->db->order_by('m.created ','ASC');
        $this->db->order_by('m.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //Get Page Types based on page_type value (1 = Custom Page, 2=Blog Page, 3=Custom Url, 4=Portfolio)
    public function get_page_types(){
        $this->db->select('p.*');
        $this->db->from('page_types AS p');
        $this->db->order_by('p.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //Get blog categories as an array of values, using the explode function to remove the comma
    //we have set using the implode function in the controller before storing them to the cell.
    public function get_selected_blog_categories($id){
        $query = $this->db->query('SELECT * FROM page_blog_content WHERE page_id = '.$id);
        $cat_string = $query->row()->blog_categories;
        $blog_categories_array = explode(',',$cat_string); 
        return $blog_categories_array;
    }

    //Get portfolio categories as an array of values, using the explode function to remove the comma
    //we have set using the implode function in the controller before storing them to the cell.
    public function get_selected_portfolio_categories($id){
        $query = $this->db->query('SELECT * FROM page_portfolio_content WHERE page_id = '.$id);
        $cat_string = $query->row()->portfolio_categories;
        $portfolio_categories_array = explode(',',$cat_string); 
        return $portfolio_categories_array;
    }

    //Get selected modules as an array in the update form.Values are stored and seperated by comma.
    public function get_selected_modules($id){
        $query = $this->db->query('SELECT * FROM pages WHERE id = '.$id);
        $mod_string = $query->row()->modules;
        $modules_array = explode(',',$mod_string); 
        return $modules_array;
    }

    /************************************************************/
   
    //Get the modules selected for a certain page
    public function get_selected_mods($page_id){
        $this->db->select('p.*');
        $this->db->from('pages AS p');
        $this->db->where('deleted',0);
        $this->db->order_by('p.created ','ASC');
        $this->db->order_by('p.id','ASC');
        $query = $this->db->get();

        $mod_string = @$query->row()->modules;
        $modules_array = explode(',',$mod_string); 
        return $modules_array;
    }
    /************************************************************/

    public function get_insert_id(){
        return $this->db->insert_id();
    }



    
    /***********************************************************************************************************/
    //
    //
    //
    //                                              Menu Items Functions
    //
    //
    //
    /***********************************************************************************************************/

    // Function to show all non deleted menus
    public function get_menu(){
        $this->db->select('a.*');
        $this->db->from('menus AS a');
        $this->db->where('deleted',0);
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //Get a pages menu
    public function get_selected_menu($page_id){
        $this->db->where('page_id',$page_id);
        $query = $this->db->get('menu_items');
        return $query->row();
    }
    
/***************************************************************************************************/
//
//                                      Custom Content Functions
//
/***************************************************************************************************/



    public function add_page_custom_content($data, $skip_validation = FALSE)
    {

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->db->insert('page_custom_content',$data);
            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit_page_custom_content($data)
    {
        $this->db->where('page_id',$data['page_id']);
        $query = $this->db->get('page_custom_content');
         
        if($query->num_rows() > 0){
            $this->db->where('page_id', $data['page_id']);
            $this->db->update('page_custom_content', $data);
        } else {
            $this->add_page_custom_content($data);
        }
    
    }

    public function delete_page_custom_content($id)
    {
        $this->db->delete('page_custom_content', array('page_id' => $id));      
    }

/***************************************************************************************************/
//
//                                      External URL Functions
//
/***************************************************************************************************/


    public function add_page_external_url_content($data, $skip_validation = FALSE)
    {

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->db->insert('page_external_url_content',$data);
            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit_page_external_url_content($data)
    {
        $this->db->where('page_id',$data['page_id']);
        $query = $this->db->get('page_external_url_content');
         
        if($query->num_rows() > 0){
            $this->db->where('page_id', $data['page_id']);
            $this->db->update('page_external_url_content', $data);
        } else {
            $this->add_page_external_url_content($data);
        }
    
    }

    public function delete_page_external_url_content($id)
    {
        $this->db->delete('page_external_url_content', array('page_id' => $id));      
    }


/***************************************************************************************************/
//
//                                      Menu Items Functions
//
/***************************************************************************************************/



    public function delete_page_menu_item($id)
    {
        $this->db->delete('menu_items', array('page_id' => $id));    
    }

/***************************************************************************************************/
//
//                                      Blog Content Functions
//
/***************************************************************************************************/

    public function add_blog_content_to_page($data, $skip_validation = FALSE)
    {  

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->db->insert('page_blog_content',$data);
            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit_blog_content_to_page($data)
    {
        $this->db->where('page_id',$data['page_id']);
        $query = $this->db->get('page_blog_content');
         
        if($query->num_rows() > 0){
            $this->db->where('page_id', $data['page_id']);
            $this->db->update('page_blog_content', $data);
        } else {
            $this->add_page_blog_content($data);
        }
    
    }

    public function delete_page_blog_content($id)
    {
        $this->db->delete('page_blog_content', array('page_id' => $id));      
    }


    /***************************************************************************************************/
    //
    //                                      Portfolio Content Functions
    //
    /***************************************************************************************************/

    public function add_portfolio_content_to_page($data, $skip_validation = FALSE)
    {  

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->db->insert('page_portfolio_content',$data);
            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit_portfolio_content_to_page($data)
    {
        $this->db->where('page_id',$data['page_id']);
        $query = $this->db->get('page_portfolio_content');
         
        if($query->num_rows() > 0){
            $this->db->where('page_id', $data['page_id']);
            $this->db->update('page_portfolio_content', $data);
        } else {
            $this->add_page_portfolio_content($data);
        }
    
    }

    public function delete_page_portfolio_content($id)
    {
        $this->db->delete('page_portfolio_content', array('page_id' => $id));      
    }

    //Get the home page. Homepage is unique.
    public function get_home_page(){
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('a.is_home',1);
        $this->db->where('a.is_published',1);
        $this->db->where('a.deleted',0);
        $query = $this->db->get();
        return $query->row();
    }

    //**************************************************************************************************//
    //                                                                                                  //
    //                                      FRONTEND FUNCTIONS                                          //
    //                                                                                                  //
    //**************************************************************************************************//

    //We think that most times users will have only one portfolio page or blog page
    //So for portfolio and blog modules items links to send them to the correct page
    //we construct function to get the portfolio or blog page

    public function get_portfolio_page_for_portfolio_modules_use()
    {
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('a.page_type', 4);
        $this->db->where('a.is_published',1);
        $this->db->where('a.deleted',0);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_blog_page_for_blog_modules_use()
    {
        $this->db->select('a.*');
        $this->db->from('pages AS a');
        $this->db->where('a.page_type', 2);
        $this->db->where('a.is_published',1);
        $this->db->where('a.deleted',0);
        $query = $this->db->get();
        return $query->row();
    }

}



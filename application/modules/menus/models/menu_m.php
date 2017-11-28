<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_m extends MY_Model{

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
        $this->table = 'menus';
    }

    // Function to show all published/unpublished articles
 	public function get_menus(){
        $this->db->select('a.*');
        $this->db->from('menus AS a');
        $this->db->where('deleted',0);
        $this->db->order_by('a.created ','ASC');
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Function to get a menu raw per id (used for updating the form of a chosen menu)
    public function get_menu($id){
        $this->db->select('a.*');
        $this->db->from('menus AS a');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to show trashed articles with is_published status = 2 same with get_articles function
 	public function get_trashed_menus(){
    	$this->db->select('a.*');
		$this->db->from('menus AS a');
		$this->db->where('deleted',1);
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
      	$query = $this->db->get();
       	return $query->result();
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

    /**
     * Permanently Delete a row from the table by the primary value without using soft_delete
     */
    public function delete_trashed_menu($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }

    public function delete_menu_items_when_a_menu_is_deleted($id)
    {
        $this->db->where('menu_id', $id);
        $query = $this->db->delete('menu_items');
        return $query;
    }

    public function publish_menu ($id){
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$id);
        $this->db->update('menus',$data);
        return;
    }

    public function unpublish_menu ($id){
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
             );
        $this->db->where('id',$id);
        $this->db->update('menus',$data);
        return;
    }

    //Get Created by user
    public function get_created_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('menus AS a');
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
        $this->db->from('menus AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.modified_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    //We use the get_insert_id to the menu controller in the insert function
    //to store the menu_id into the menu_items table, in the create menu function
    public function get_insert_id()
    {
        return $this->db->insert_id();   
    }

    public function save_menu_items_order ($menu_items, $menu_id)
    {
        if (count($menu_items)) {

            foreach ($menu_items as $order => $menu_item) 
            {

                //Print the array to see what we will store in the database
                //var_dump($menu_item);

                if ($menu_item['item_id'] != '') 
                {
                    $data = array(

                        'parent_id' => (int) $menu_item['parent_id'], 
                        'priority_order' => $order
                    );
                    $this->db->set($data)
                    //we use the $menu_item['item_id'] we get from order_ajax view
                    //As item_id we get from the view file (order_ajax), we get the page_id of
                    //each assigned page.
                    ->where('page_id', $menu_item['item_id'])

                    //Here we set to save where menu_id, is the current menu id we update
                    //and pass it through the menu controller
                    ->where('menu_id', $menu_id)

                    ->update('menu_items');

                //Print the last query just to check out what is happening in the update
                //echo '<pre>' . $this->db->last_query() . '</pre>';

                }
            }
            
            //If we order items echo message for success
            echo '<p class="alert alert-success">' .  "Well Done! Menu Pages Ordered Successfully!" . '</p>';
        }
    }

    //In order to create a n-level deep menu, you should iterate through the items recursively.
    //We can use prepareList as a helper function.If that happens we remove the $this->prepareList and call
    //the function simple as prepareList
    function prepareList(array $menu_items, $pid = 0)
    {
        //Preparing the array we have get from above query        
        $array = array();

        foreach ($menu_items as $menu_item) 
        {
            # Whether the parent_id of the item matches the current $pid
            if ((int) $menu_item['parent_id'] == $pid) 
            {

                # Call the function recursively, use the item's id as the parent's id
                # The function returns the list of children or an empty array()

                //Notice we use $this->prepareList and not prepareList because we have loaded the
                //prepareList function above in our menu_m Model
                if ($children = $this->prepareList($menu_items, $menu_item['id'])) 
                {

                    # Store all children of the current menu_item
                    $menu_item['children'] = $children;
                }

                # Fill the array
                $array[] = $menu_item;

            }

        }

        return $array;
    }

    public function get_nested_menu_items($menu_id)
    {
        //We set the query to get the menu_items from the database in the order we want
        //Notice we get them as an array using **get->result_array()** and not as **get->result()**
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->from('menu_items AS a');
        $this->db->where('menu_id',$menu_id);
        $this->db->join('pages AS b', 'b.id = a.page_id', 'left');
        $this->db->order_by('a.priority_order ','ASC');
        $this->db->order_by('a.id');
        $menu_items = $this->db->get()->result_array();

        //We load the prepareList from above.If we load it as a helper we remove ** $this->prepareList **
        //and just use ** prepareList **
        return $this->prepareList($menu_items);
        
    }


    //Get Pages (used for getting page id)
    public function get_page_types(){
        $this->db->select('p.*');
        $this->db->from('page_types AS p');
        $this->db->order_by('p.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }


    /**********************************************************************************/
    /*                                MENU ITEMS Functions                            */
    /**********************************************************************************/

    public function current_menu_pages($menu_id)
    {
        $this->db->select('a.*');
        $this->db->from('menu_items AS a');
        $this->db->where('menu_id', $menu_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_menu_items($menu_id, $page_id)
    {
        if (!is_numeric($menu_id) || !is_numeric($page_id))
        {
            return FALSE;
        }

            //Edw mporei na kanw lathos
        $menu_items = array(
            'menu_id'                   => $menu_id,
            'page_id'                   => $page_id,
            );

        $this->db->insert('menu_items', $menu_items);

        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
    }

    public function delete_menu_pages($sql_where)
    {
        if (is_numeric($sql_where))
        {
            $sql_where = array('id' => $sql_where);
        }
        
        $this->db->delete('menu_items', $sql_where);

        return $this->db->affected_rows() == 1; 
    }

    public function update_menu_pages($menu_id)
    {
        // Update pages for current menu.
        foreach($this->input->post('update_pages') as $row)
        {

            if ($row['current_status'] != $row['new_status'])
            {
                // Insert new user privilege.
                if ($row['new_status'] == 1)
                {
                    $this->insert_menu_items($menu_id, $row['page_id']);  
                }
                else
                {
                    $sql_where = array(

                        'menu_id' => $menu_id,
                        'page_id' => $row['page_id'],
                    );
                    
                    $this->delete_menu_pages($sql_where);
                }

            }
        }
    }

}

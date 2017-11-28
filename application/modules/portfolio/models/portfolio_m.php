<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Portfolio_m extends MY_Model{

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
        $this->table = 'portfolios';
    }
    
    public function get_insert_id(){
        return $this->db->insert_id();
    }

    // Function to show all published/unpublished portfolio
 	public function get_portfolio_projects(){
    	$this->db->select('a.*,b.portfolio_category_title as category_title, b.portfolio_category_slug as category_slug');
		$this->db->from('portfolios AS a');
		$this->db->where('a.deleted', '0');
        $this->db->join('portfolio_categories AS b', 'b.id = a.project_category_id', 'left');
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');
      	$query = $this->db->get();
       	return $query->result();
    }

    // Function to show article raw per id used on update articles
    public function get_portfolio_project($id){
        $this->db->select('a.*');
        $this->db->from('portfolios AS a');
        $this->db->where('a.id',$id);
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->row();
    }

    
    //Get Portfolio Categories
    public function get_portfolio_categories(){
        $this->db->select('g.*');
        $this->db->from('portfolio_categories AS g');
        $this->db->where('g.is_published',1);
        $this->db->where('g.deleted',0);
        $query = $this->db->get();
        return $query->result();
    }

    //Portfolio Project Current Media
    public function current_portfolio_project_media($project_id)
    {
        $this->db->select('a.*');
        $this->db->from('portfolio_media AS a');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result();       
    }

    public function delete_portfolio_project_media($project_id)
    {
        $this->db->where('project_id', $project_id);
        $this->db->delete('portfolio_media');
    }

    //Get Created by user
    public function get_created_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('portfolios AS a');
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
        $this->db->from('portfolios AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.modified_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    // Function to show trashed articles with is_published status = 2 same with get_articles function
    public function get_trashed_portfolio_projects(){
        $this->db->select('a.*,b.portfolio_category_title as category_title, b.portfolio_category_slug as category_slug');
        $this->db->from('portfolios AS a');
        $this->db->where('a.deleted',1);
        $this->db->join('portfolio_categories AS b', 'b.id = a.project_category_id', 'left');
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Permanently Delete a row from the table by the primary value without using soft_delete
     */
    public function delete_trashed_portfolio_project($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }

    public function publish_portfolio_project($id)
    {
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$id);
        $this->db->update('portfolios',$data);
        return;
    }

    public function unpublish_portfolio_project($id)
    {
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
             );
        $this->db->where('id',$id);
        $this->db->update('portfolios',$data);
        return;
    }
   
    /*****************************************************************************************
    *
    *
    *                                           FRONTEND
    *                               
    *
    ******************************************************************************************/
    
    //Get portfolio projects for the homepage if page type is portfolio page
    //The $portfolio_categories array is passed to the function from the controller based on the $page_id
    //We choose Page Type -> getting page_id -> 
    public function get_portfolio_projects_frontend($portfolio_categories){
        $this->db->select('a.*,d.portfolio_category_title as category_title, d.portfolio_category_slug as category_slug');
        //$this->db->select('m.*');
        $this->db->from('portfolios AS a');

        //Get $portfolio_categories as an array of values, from page_portfolio_content
        //The function to get page_portfolio_content categories is set in the 
        //page_m->get_selected_portfolio_categories($page_id)
        foreach ($portfolio_categories AS $category)
        {

            $this->db->or_where('a.project_category_id',$category);

        }

        //We set some restrictions about the projects
        $this->db->where('a.deleted', '0');
        $this->db->where('a.is_published', '1');

        $this->db->join('portfolio_categories AS d', 'd.id = a.project_category_id', 'left');

        //We set the order of the projects
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');

        //get the results as an array (not as row) so we use the result(); method
        $query = $this->db->get();
        return $query->result();
    }

    public function get_portfolio_projects_media_frontend($projects)
    {
        $this->db->select('a.*');
        $this->db->from('portfolio_media AS a');
        //echo"This is model var dump";
        //var_dump($articles);
        foreach($projects AS $project)
        {
            $this->db->or_where('project_id', $project->id);
        }
        $query = $this->db->get();
        return $query->result(); 
    }

    public function get_single_portfolio_project($project_id){
        $this->db->select('a.*,d.portfolio_category_title as category_title, d.portfolio_category_slug as category_slug');
        $this->db->from('portfolios AS a');
        
        //We set some restrictions about the portfolio projects
        $this->db->where('a.id', $project_id);
        $this->db->where('a.deleted', '0');
        $this->db->where('a.is_published', '1');

        $this->db->join('portfolio_categories AS d', 'd.id = a.project_category_id', 'left');
        //We set the order of the portfolio projects
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');

        $query = $this->db->get();
        return $query->row();
    }

    public function get_single_portfolio_project_media_frontend($project_id)
    {
        $this->db->select('a.*');
        $this->db->from('portfolio_media AS a');
        //echo"This is model var dump";
        //var_dump($articles);

            $this->db->or_where('project_id', $project_id);
        
        $query = $this->db->get();
        return $query->result(); 
    }

}

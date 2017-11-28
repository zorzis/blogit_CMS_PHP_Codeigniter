<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article_m extends MY_Model{

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
        $this->table = 'articles';
    }
    
    public function get_insert_id(){
        return $this->db->insert_id();
    }

    // Function to show all published/unpublished articles
 	public function get_articles(){
    	$this->db->select('a.*,d.category_title as category_title, d.category_slug as category_slug');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
		$this->db->from('articles AS a');
		$this->db->where('a.deleted', '0');
        $this->db->join('blog_categories AS d', 'd.id = a.category_id', 'left');
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.author_id', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');
      	$query = $this->db->get();
       	return $query->result();
    }

    // Function to show article raw per id used on update articles
    public function get_article($id){
        $this->db->select('a.*');
        $this->db->from('articles AS a');
        $this->db->where('a.id',$id);
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // Function to show trashed articles with is_published status = 2 same with get_articles function
 	public function get_trashed_articles(){
    	$this->db->select('a.*,d.category_title as category_title, d.category_slug as category_slug');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
		$this->db->from('articles AS a');
		$this->db->where('a.deleted',1);
        $this->db->join('blog_categories AS d', 'd.id = a.category_id', 'left');
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.author_id', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id','DESC');
      	$query = $this->db->get();
       	return $query->result();
    }

    /**
     * Permanently Delete a row from the table by the primary value without using soft_delete
     */
    public function delete_trashed_blog_article($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        $this->trigger('after_delete', $result);

        return $result;
    }

    public function publish_blog_article ($id){
        $data = array(
            'is_published' => 1,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
            );
        $this->db->where('id',$id);
        $this->db->update('articles',$data);
        return;
    }

    public function unpublish_blog_article ($id){
        $data = array(
            'is_published' => 0,
            // set deleted to 0 to avoid another function with trashed articles
            // as we use the publish to put trashed articles to active blog articles
            'deleted' => 0
             );
        $this->db->where('id',$id);
        $this->db->update('articles',$data);
        return;
    }

    //Get Authors
    public function get_authors(){
        $this->db->select('d.*');
        $this->db->select('e.upro_first_name,e.upro_last_name');
        $this->db->from('user_accounts AS d');
        $this->db->where('d.uacc_active',1);
        $this->db->where('d.uacc_suspend',0);
        $this->db->join('user_profiles AS e', 'e.upro_uacc_fk = d.uacc_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    //Get Blog Categories
    public function get_blog_categories(){
        $this->db->select('g.*');
        $this->db->from('blog_categories AS g');
        $this->db->where('g.is_published',1);
        $this->db->where('g.deleted',0);
        $query = $this->db->get();
        return $query->result();
    }

    //Get Created by user
    public function get_created_by($id){
        $this->db->select('a.*');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('articles AS a');
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
        $this->db->from('articles AS a');
        $this->db->where('a.id',$id);
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.modified_by', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

   /*****************************************************************************************
    *
    *
    *                                           FRONTEND
    *                               
    *
    ******************************************************************************************/
    
    //Get blog articles for the homepage if page type is blog page
    //The $blog_categories array is passed to the function from the controller based on the $page_id
    //We choose Page Type -> getting page_id -> 
    public function get_blog_articles($blog_categories){
        $this->db->select('a.*,d.category_title as category_title, d.category_slug as category_slug');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        //$this->db->select('m.*');
        $this->db->from('articles AS a');

         //Get $blog_categories as an array of values, from page_blog_content
        //The function to get page_blog_content categories is set in the 
        //page_m->get_selected_blog_categories($page_id)

        foreach ($blog_categories AS $category)
        {

            $this->db->or_where('a.category_id',$category);

        }

        //We set some restrictions about the articles
        $this->db->where('a.deleted', '0');
        $this->db->where('a.is_published', '1');

        $this->db->join('blog_categories AS d', 'd.id = a.category_id', 'left');
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.author_id', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');

        //$this->db->join('articles_media AS m', 'm.article_id = a.id', 'left');

        //We set the order of the articles
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');

        //get the results as an array (not as row) so we use the result(); method
        $query = $this->db->get();
        return $query->result();
    }

    public function get_articles_media_frontend($articles)
    {
        $this->db->select('a.*');
        $this->db->from('articles_media AS a');
        //echo"This is model var dump";
        //var_dump($articles);
        foreach($articles AS $article)
        {
            $this->db->or_where('article_id', $article->id);
        }
        $query = $this->db->get();
        return $query->result(); 
    }

    public function get_single_blog_article($article_id){
        $this->db->select('a.*,d.category_title as category_title, d.category_slug as category_slug');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('articles AS a');
        
        //We set some restrictions about the articles
        $this->db->where('a.id', $article_id);
        $this->db->where('a.deleted', '0');
        $this->db->where('a.is_published', '1');

        $this->db->join('blog_categories AS d', 'd.id = a.category_id', 'left');
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.author_id', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');

        //We set the order of the articles
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');

        $query = $this->db->get();
        return $query->row();
    }

    public function get_single_article_media_frontend($article_id)
    {
        $this->db->select('a.*');
        $this->db->from('articles_media AS a');
        //echo"This is model var dump";
        //var_dump($articles);

            $this->db->or_where('article_id', $article_id);
        
        $query = $this->db->get();
        return $query->result(); 
    }

    public function count_blog_articles_per_frontpage($blog_categories){
        $this->db->select('a.*');
        $this->db->from('articles AS a');
        
        //Get $blog_categories as an array of values, from page_blog_content
        //The function to get page_blog_content categories is set in the 
        //page_m->get_selected_blog_categories($page_id)
        $this->db->or_where_in('a.category_id',$blog_categories);

        //We set some restrictions about the articles
        $this->db->where('a.deleted', '0');
        $this->db->where('a.is_published', '1');

        //Count Rows found based on where criterias
        return $this->db->count_all_results();
    }

    public function get_latest_articles(){
        $this->db->select('a.*,d.category_title as category_title,d.category_slug as category_slug');
        $this->db->select('b.uacc_email');
        $this->db->select('c.upro_first_name,c.upro_last_name');
        $this->db->from('articles AS a');
        $this->db->where('a.deleted', '0');
        $this->db->where('a.is_published', '1');
        $this->db->join('blog_categories AS d', 'd.id = a.category_id', 'left');
        $this->db->join('user_accounts AS b', 'b.uacc_id = a.author_id', 'left');
        $this->db->join('user_profiles AS c', 'c.upro_uacc_fk = b.uacc_id', 'left');
        $this->db->order_by('a.created ','DESC');
        $this->db->order_by('a.id ','DESC');
        $query = $this->db->get();
        return $query->result();
    }


    //Article Current Media
    public function current_article_media($article_id)
    {
        $this->db->select('a.*');
        $this->db->from('articles_media AS a');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get();
        return $query->result();       
    }

    public function delete_article_media($article_id)
    {
        $this->db->where('article_id', $article_id);
        $this->db->delete('articles_media');
    }

}



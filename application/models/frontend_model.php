<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend_model extends CI_Model {
	
	// The following method prevents an error occurring when $this->data is modified.
	// Error Message: 'Indirect modification of overloaded property Demo_cart_admin_model::$data has no effect'.
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
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

    public function get_privilege_name($privilege_id)
    {
        $this->db->select('a.*');
        $this->db->from('user_privileges AS a');
        $this->db->where('a.upriv_id', $privilege_id);
        $query = $this->db->get();
        return $query->row();   
    }

    //Get the current page we are viewing from the page_slug object we take from the pages/controllers/index.php
    //That page_slug string comes from the uri we are geting to the controller function.
    public function get_page_by_slug($page_slug)
    {
        $this->db->select('p.*');
        $this->db->from('pages AS p');
        $this->db->where('p.slug', $page_slug);
        $query = $this->db->get('pages');
        return $query->row();


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


    //Get selected modules as an array in the update form.Values are stored and seperated by comma.
    public function get_selected_modules($id)
    {
        $query = $this->db->query('SELECT * FROM pages WHERE id = '.$id);
        $mod_string = $query->row()->modules;
        $modules_array = explode(',',$mod_string); 
        return $modules_array;
    }


    public function get_page_selected_modules_content($selected_page_modules, $position)
    {
        $this->db->select('a.*');
    	$this->db->from('modules AS a');
    	foreach ($selected_page_modules AS $selected_page_module)
    	{

            $this->db->or_where('id', $selected_page_module);
            $this->db->where('position', $position);
            $this->db->where('is_published', 1);
            $this->db->where('deleted', 0);

    	}


        $query = $this->db->get();
        return $query->result(); 

    }

    //Get Custom Content Modules
    public function get_custom_modules($page_modules)
    {
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->select('c.upriv_name');
        $this->db->from('module_custom_content AS a');
        foreach ($page_modules AS $custom_module)
        {

            $this->db->or_where('module_id', $custom_module->id);
        }
        $this->db->join('modules AS b', 'b.id = a.module_id', 'left');
        $this->db->join('user_privileges AS c', 'c.upriv_id = b.privilege_id', 'left');
        $this->db->order_by('b.set_order', 'ASC');
        $query = $this->db->get();
        return $query->result();   
    }

    //Get Menu Module Content
    public function get_menu_modules($page_modules)
    {
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->select('c.upriv_name');

        $this->db->from('module_menu_content AS a');
        foreach ($page_modules AS $menu_module)
        {
            $this->db->or_where('module_id', $menu_module->id);
        }
        $this->db->join('modules AS b', 'b.id = a.module_id', 'left');
        $this->db->join('user_privileges AS c', 'c.upriv_id = b.privilege_id', 'left');

        $this->db->order_by('b.set_order', 'ASC');
        $query = $this->db->get();
        return $query->result();   
    }

    public function get_menu_items_per_menu_module($menu_modules)
    {

        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->select('c.*');
        $this->db->from('menu_items AS a');

        foreach ($menu_modules AS $menu_module)
        {
            $this->db->or_where('menu_id', $menu_module->menu_id);
        }
        $this->db->join('pages AS b', 'b.id = a.page_id', 'left');
        $this->db->join('page_external_url_content AS c', 'c.page_id = a.page_id', 'left');
        $this->db->where('deleted',0);
        $this->db->where('is_published',1);

        $this->db->order_by('a.priority_order','ASC');
        $query = $this->db->get();
        return $query->result();          
    }

    public function get_portfolio_modules($page_modules)
    {
        $this->db->select('a.*');
        $this->db->select('b.upriv_name');

        $this->db->from('modules AS a');
        foreach ($page_modules AS $portfolio_module)
        {
            $this->db->or_where('id', $portfolio_module->id);
            $this->db->where('module_type', 'portfolio_module');
        }

        $this->db->join('user_privileges AS b', 'b.upriv_id = a.privilege_id', 'left');

        $this->db->order_by('a.set_order', 'ASC');
        $query = $this->db->get();
        return $query->result();  
    }

    public function get_latest_blog_articles_modules($page_modules)
    {
        $this->db->select('a.*');
        $this->db->select('b.upriv_name');

        $this->db->from('modules AS a');
        foreach ($page_modules AS $blog_module)
        {
            $this->db->or_where('id', $blog_module->id);
            $this->db->where('module_type', 'latest_blog_articles_module');
        }

        $this->db->join('user_privileges AS b', 'b.upriv_id = a.privilege_id', 'left');

        $this->db->order_by('a.set_order', 'ASC');
        $query = $this->db->get();
        return $query->result();  
    }

    public function get_popular_blog_articles_modules($page_modules)
    {
        $this->db->select('a.*');
        $this->db->select('b.upriv_name');

        $this->db->from('modules AS a');
        foreach ($page_modules AS $blog_module)
        {
            $this->db->or_where('id', $blog_module->id);
            $this->db->where('module_type', 'popular_blog_articles_module');
        }

        $this->db->join('user_privileges AS b', 'b.upriv_id = a.privilege_id', 'left');

        $this->db->order_by('a.set_order', 'ASC');
        $query = $this->db->get();
        return $query->result();  
    }

    //Get Portfolio Module Content 
    public function get_portfolio_modules_projects($portfolio_module_id, $limit_projects_number)
    {
        $this->db->select('a.*');
        $this->db->select('b.*,b.portfolio_category_slug AS category_slug');
        $this->db->select('c.*');
        $this->db->from('module_portfolio_content AS a');
        $this->db->or_where('module_id', $portfolio_module_id);
        $this->db->limit($limit_projects_number);
        $this->db->join('portfolio_categories AS b', 'b.id = a.category_id', 'left');
        $this->db->where('b.is_published', 1);
        $this->db->where('b.deleted', 0);
        $this->db->join('portfolios AS c', 'c.project_category_id = a.category_id', 'left');
        $this->db->where('c.is_published', 1);
        $this->db->where('c.deleted', 0);

        //We order the results based on the created date of the article
        $this->db->order_by('c.created ','DESC');

        $query = $this->db->get();
        return $query->result();   
    }

    //Get media for portfolio mofule projects
    public function get_portfolio_modules_projects_media($projects_per_module)
    {
        $this->db->select('a.*');
        $this->db->from('portfolio_media AS a');

        foreach ($projects_per_module as $project)
        {
            $this->db->or_where('project_id', $project->id);

        }
        $query = $this->db->get();
        return $query->result();  
    }

    //Get Latest Articles for Blog Module Content Latest Articles
    public function get_blog_modules_latest_articles($blog_module_id, $limit_articles_number)
    {
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->select('c.*');
        $this->db->select('d.uacc_email');
        $this->db->select('e.upro_first_name,e.upro_last_name');
        $this->db->from('module_blog_content AS a');
        $this->db->or_where('module_id', $blog_module_id);
        $this->db->limit($limit_articles_number);
        $this->db->join('blog_categories AS b', 'b.id = a.category_id', 'left');
        $this->db->where('b.is_published', 1);
        $this->db->where('b.deleted', 0);
        $this->db->join('articles AS c', 'c.category_id = a.category_id', 'left');
        $this->db->where('c.is_published', 1);
        $this->db->where('c.deleted', 0);
        $this->db->join('user_accounts AS d', 'd.uacc_id = c.author_id', 'left');
        $this->db->join('user_profiles AS e', 'e.upro_uacc_fk = d.uacc_id', 'left');


        //We order the results based on the created date of the article
        $this->db->order_by('c.created ','DESC');

        $query = $this->db->get();
        return $query->result();   
    }

    //Get media for latest articles 
    public function get_blog_modules_latest_articles_media($latest_articles_per_module)
    {
        $this->db->select('a.*');
        $this->db->from('articles_media AS a');

        foreach ($latest_articles_per_module as $latest_article)
        {
            $this->db->or_where('article_id', $latest_article->id);

        }
        $query = $this->db->get();
        return $query->result();  
    }

    public function get_blog_modules_popular_articles($blog_module_id, $limit_articles_number)
    {        
        $this->db->select('a.*');
        $this->db->select('b.*');
        $this->db->select('c.*');
        $this->db->select('d.uacc_email');
        $this->db->select('e.upro_first_name,e.upro_last_name');
        $this->db->from('module_blog_content AS a');
        $this->db->or_where('module_id', $blog_module_id);
        $this->db->limit($limit_articles_number);
        $this->db->join('blog_categories AS b', 'b.id = a.category_id', 'left');
        $this->db->where('b.is_published', 1);
        $this->db->where('b.deleted', 0);
        $this->db->join('articles AS c', 'c.category_id = a.category_id', 'left');
        $this->db->where('c.is_published', 1);
        $this->db->where('c.deleted', 0);
        $this->db->join('user_accounts AS d', 'd.uacc_id = c.author_id', 'left');
        $this->db->join('user_profiles AS e', 'e.upro_uacc_fk = d.uacc_id', 'left');


        //We order the results based on views counter 
        $this->db->where('c.views_counter !=' , 0);
        $this->db->order_by('c.views_counter ','DESC');

        $query = $this->db->get();
        return $query->result();     
    }


    //Get media for popular articles 
    public function get_blog_modules_popular_articles_media($popular_articles_per_module)
    {
        $this->db->select('a.*');
        $this->db->from('articles_media AS a');

        foreach ($popular_articles_per_module as $popular_article)
        {
            $this->db->or_where('article_id', $popular_article->id);

        }
        $query = $this->db->get();
        return $query->result();  
    }


    public function article_page_views_counter($article_id)
        
    {
        $this->db->where('id', $article_id);
        $this->db->set('views_counter', 'views_counter+1', FALSE);
        $this->db->update('articles');

    }

    public function project_page_views_counter($project_id)
        
    {
        $this->db->where('id', $project_id);
        $this->db->set('views_counter', 'views_counter+1', FALSE);
        $this->db->update('portfolios');

    }

    public function get_image_slider_modules($page_modules)
    {
        $this->db->select('a.*');
        $this->db->select('b.upriv_name');

        $this->db->from('modules AS a');
        foreach ($page_modules AS $image_slider_module)
        {
            $this->db->or_where('id', $image_slider_module->id);
            $this->db->where('module_type', 'image_slider_module');
        }

        $this->db->join('user_privileges AS b', 'b.upriv_id = a.privilege_id', 'left');

        $this->db->order_by('a.set_order', 'ASC');
        $query = $this->db->get();
        return $query->result();  
    }

    public function get_image_slider_images_and_caption($image_slider_module_id)
    {        
        $this->db->select('a.*');
        $this->db->from('module_image_slider AS a');
        $this->db->or_where('module_id', $image_slider_module_id);
        $query = $this->db->get();
        return $query->result();     
    }

}

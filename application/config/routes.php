<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


#Login

#USERS
//**********************************************************************************************************************//
// Users Accounts
$route['admin/users'] = 'users/admin/manage_user_accounts';
$route['admin/users/page/(:num)'] = 'users/admin/manage_user_accounts/page/$1';
$route['admin/users/search/(:any)/page'] = 'users/admin/manage_user_accounts';
$route['admin/users/search/(:any)/page/(:num)'] = 'users/admin/manage_user_accounts';
$route['admin/users/create_user_account'] = 'users/admin/create_user_account';
$route['admin/users/update_user_account/(:num)'] = 'users/admin/update_user_account/$1';
$route['admin/users/select_avatar'] = 'users/admin/select_avatar';


// Users Groups
$route['admin/users/usergroups'] = 'users/admin/manage_user_groups';
$route['admin/users/insert_user_group'] = 'users/admin/insert_user_group';
$route['admin/users/update_user_group/(:num)'] = 'users/admin/update_user_group/$1';
//***********************************************************************************************************************//

#PRIVILLEGES
// User Privilleges
$route['admin/users/privileges'] = 'users/admin/manage_privileges';
$route['admin/users/insert_privilege'] = 'users/admin/insert_privilege';
$route['admin/users/update_privilege/(:num)'] = 'users/admin/update_privilege/$1';
$route['admin/users/update_user_privileges/(:num)'] = 'users/admin/update_user_privileges/$1';
$route['admin/users/update_group_privileges/(:num)'] = 'users/admin/update_group_privileges/$1';
//***********************************************************************************************************************//

#BLOG
//Blog Articles
$route['admin/blog'] = 'blog/admin';
$route['admin/blog/page/(:num)'] = 'blog/admin/index/page/&1';
$route['admin/blog/create_blog_article'] = 'blog/admin/create_blog_article';
$route['admin/blog/select_media'] = 'blog/admin/select_media';
$route['admin/blog/edit_blog_article/(:num)'] = 'blog/admin/edit_blog_article/$1';
$route['admin/blog/delete_blog_article/(:num)'] = 'blog/admin/delete_blog_article/$1';
$route['admin/blog/delete_trashed_blog_article/(:num)'] = 'blog/admin/delete_trashed_blog_article/$1';
$route['admin/blog/publish_blog_article/(:num)'] = 'blog/admin/publish_blog_article/$1';
$route['admin/blog/unpublish_blog_article/(:num)'] = 'blog/admin/unpublish_blog_article/$1';
$route['admin/blog/trashed_articles'] = 'blog/admin/trashed_articles';
$route['admin/blog/trashed_articles/page/(:num)'] = 'blog/admin/trashed_articles/page/&1';
//************************************************************************************************************************//

//Blog Categories
$route['admin/blog/categories'] = 'categories/admin';
$route['admin/blog/categories/page/(:num)'] = 'categories/admin/index/page/&1';
$route['admin/blog/categories/create_blog_category'] = 'categories/admin/create_blog_category';
$route['admin/blog/categories/edit_blog_category/(:num)'] = 'categories/admin/edit_blog_category/$1';
$route['admin/blog/categories/delete_blog_category/(:num)'] = 'categories/admin/delete_blog_category/$1';
$route['admin/blog/categories/delete_trashed_blog_category/(:num)'] = 'categories/admin/delete_trashed_blog_category/$1';
$route['admin/blog/categories/publish_blog_category/(:num)'] = 'categories/admin/publish_blog_category/$1';
$route['admin/blog/categories/unpublish_blog_category/(:num)'] = 'categories/admin/unpublish_blog_category/$1';
$route['admin/blog/categories/trashed_blog_categories'] = 'categories/admin/trashed_blog_categories';
$route['admin/blog/categories/trashed_blog_categories/page/(:num)'] = 'categories/admin/trashed_blog_categories/page/&1';
//*************************************************************************************************************************//


#PORTFOLIO
//Portfolio Projects
$route['admin/portfolio'] = 'portfolio/admin';
$route['admin/portfolio/page/(:num)'] = 'portfolio/admin/index/page/&1';
$route['admin/portfolio/create_portfolio_project'] = 'portfolio/admin/create_portfolio_project';
$route['admin/portfolio/select_media'] = 'portfolio/admin/select_media';
$route['admin/portfolio/edit_portfolio_project/(:num)'] = 'portfolio/admin/edit_portfolio_project/$1';
$route['admin/portfolio/delete_portfolio_project/(:num)'] = 'portfolio/admin/delete_portfolio_project/$1';
$route['admin/portfolio/delete_trashed_portfolio_project/(:num)'] = 'portfolio/admin/delete_trashed_portfolio_project/$1';
$route['admin/portfolio/publish_portfolio_project/(:num)'] = 'portfolio/admin/publish_portfolio_project/$1';
$route['admin/portfolio/unpublish_portfolio_project/(:num)'] = 'portfolio/admin/unpublish_portfolio_project/$1';
$route['admin/portfolio/trashed_portfolio_projects'] = 'portfolio/admin/trashed_portfolio_projects';
$route['admin/portfolio/trashed_portfolio_projects/page/(:num)'] = 'portfolio/admin/trashed_portfolio_projects/page/&1';
//************************************************************************************************************************//

//Portfolio Categories
$route['admin/portfolio/categories'] = 'portfolio_categories/admin';
$route['admin/portfolio/categories/page/(:num)'] = 'portfolio_categories/admin/index/page/&1';
$route['admin/portfolio/categories/create_portfolio_category'] = 'portfolio_categories/admin/create_portfolio_category';
$route['admin/portfolio/categories/edit_portfolio_category/(:num)'] = 'portfolio_categories/admin/edit_portfolio_category/$1';
$route['admin/portfolio/categories/delete_portfolio_category/(:num)'] = 'portfolio_categories/admin/delete_portfolio_category/$1';
$route['admin/portfolio/categories/delete_trashed_portfolio_category/(:num)'] = 'portfolio_categories/admin/delete_trashed_portfolio_category/$1';
$route['admin/portfolio/categories/publish_portfolio_category/(:num)'] = 'portfolio_categories/admin/publish_portfolio_category/$1';
$route['admin/portfolio/categories/unpublish_portfolio_category/(:num)'] = 'portfolio_categories/admin/unpublish_portfolio_category/$1';
$route['admin/portfolio/categories/trashed_portfolio_categories'] = 'portfolio_categories/admin/trashed_portfolio_categories';
$route['admin/portfolio/categories/trashed_portfolio_categories/page/(:num)'] = 'portfolio_categories/admin/trashed_portfolio_categories/page/&1';
//*************************************************************************************************************************//


#PAGES
//CMS Pages
$route['admin/pages'] = 'pages/admin';
$route['admin/pages/page/(:num)'] = 'pages/admin/index/page';
$route['admin/pages/create_custom_page'] = 'pages/admin/create_custom_page';
$route['admin/pages/create_external_url_page'] = 'pages/admin/create_external_url_page';
$route['admin/pages/create_blog_page'] = 'pages/admin/create_blog_page';
$route['admin/pages/create_portfolio_page'] = 'pages/admin/create_portfolio_page';
$route['admin/pages/edit_custom_page/(:num)'] = 'pages/admin/edit_custom_page/$1';
$route['admin/pages/edit_external_url_page/(:num)'] = 'pages/admin/edit_external_url_page/$1';
$route['admin/pages/edit_blog_page/(:num)'] = 'pages/admin/edit_blog_page/$1';
$route['admin/pages/edit_portfolio_page/(:num)'] = 'pages/admin/edit_portfolio_page/$1';
$route['admin/pages/delete_page/(:num)'] = 'pages/admin/delete_page/$1';
$route['admin/pages/delete_trashed_blog_page/(:num)'] = 'pages/admin/delete_trashed_blog_page/$1';
$route['admin/pages/delete_trashed_portfolio_page/(:num)'] = 'pages/admin/delete_trashed_portfolio_page/$1';
$route['admin/pages/delete_trashed_custom_page/(:num)'] = 'pages/admin/delete_trashed_custom_page/$1';
$route['admin/pages/delete_trashed_external_page/(:num)'] = 'pages/admin/delete_trashed_external_url_page/$1';
$route['admin/pages/set_home_page/(:num)'] = 'pages/admin/set_home_page/$1';
$route['admin/pages/publish_page/(:num)'] = 'pages/admin/publish_page/$1';
$route['admin/pages/unpublish_page/(:num)'] = 'pages/admin/unpublish_page/$1';
$route['admin/pages/trashed_pages'] = 'pages/admin/trashed_pages/';
$route['admin/pages/trashed_pages/page/(:num)'] = 'pages/admin/trashed_pages/page/$1';
//*************************************************************************************************************************//

#MENUS
//Menus
$route['admin/menus'] = 'menus/admin';
$route['admin/menus/page/(:num)'] = 'menus/admin/index/page/$1';
$route['admin/menus/create_menu'] = 'menus/admin/create_menu';
$route['admin/menus/order_ajax/(:num)'] = 'menus/admin/order_ajax/$1';
$route['admin/menus/edit_menu/(:num)'] = 'menus/admin/edit_menu/$1';
$route['admin/menus/delete_menu/(:num)'] = 'menus/admin/delete_menu/$1';
$route['admin/menus/delete_trashed_menu/(:num)'] = 'menus/admin/delete_trashed_menu/$1';
$route['admin/menus/publish_menu/(:num)'] = 'menus/admin/publish_menu/$1';
$route['admin/menus/unpublish_menu/(:num)'] = 'menus/admin/unpublish_menu/$1';
$route['admin/menus/trashed_menus'] = 'menus/admin/trashed_menus/';
$route['admin/menus/trashed_menus/page/(:num)'] = 'pages/admin/trashed_menus/page/$1';
//**************************************************************************************************************************//

// Menu items
$route['admin/menus/items'] = 'menus/admin/items';
$route['admin/menus/items/page/(:num)'] = 'menus/admin/items/page/$1';
$route['admin/menus/items/edit_item/(:num)'] = 'menus/admin/edit_item/$1';
$route['admin/menus/items/create_item'] = 'menus/admin/create_item';
$route['admin/menus/items/trashed_items'] = 'menus/admin/trashed_items';
$route['admin/menus/items/trashed_items/page/(:num)'] = 'menus/admin/items/trashed_items/page/$1';
$route['admin/menus/items/publish_item/(:num)'] = 'menus/admin/publish_item/$1';
$route['admin/menus/items/unpublish_item/(:num)'] = 'menus/admin/unpublish_item/$1';
$route['admin/menus/items/delete_item/(:num)'] = 'menus/admin/delete_item/$1';
$route['admin/menus/items/delete_trashed_item/(:num)'] = 'menus/admin/delete_trashed_item/$1';
//**************************************************************************************************************************//

#MODULES
// Modules

/*Common Routes for all modules types*/
$route['admin/modules'] = 'modules/admin';
$route['admin/modules/page/(:num)'] = 'modules/admin/index/page/$1';
$route['admin/modules/trashed_modules'] = 'modules/admin/trashed_modules';
$route['admin/modules/trashed_modules/page/(:num)'] = 'modules/admin/trashed_modules/page/$1';
$route['admin/modules/publish_module/(:num)'] = 'modules/admin/publish_module/$1';
$route['admin/modules/unpublish_module/(:num)'] = 'modules/admin/unpublish_module/$1';
$route['admin/modules/delete_module/(:num)'] = 'modules/admin/delete_module/$1';
$route['admin/modules/delete_trashed_module/(:num)'] = 'modules/admin/delete_trashed_module/$1';

/*Custom Module*/
$route['admin/modules/create_custom_module'] = 'modules/custom_module/create';
$route['admin/modules/edit_custom_module/(:num)'] = 'modules/custom_module/update/$1';

/*Menu Module*/
$route['admin/modules/create_menu_module'] = 'modules/menu_module/create';
$route['admin/modules/edit_menu_module/(:num)'] = 'modules/menu_module/update/$1';

/*Latest Articles Module*/
$route['admin/modules/create_latest_articles_module'] = 'modules/latest_articles_module/create';
$route['admin/modules/edit_latest_articles_module/(:num)'] = 'modules/latest_articles_module/update/$1';

/*Popular Articles Module*/
$route['admin/modules/create_popular_articles_module'] = 'modules/popular_articles_module/create';
$route['admin/modules/edit_popular_articles_module/(:num)'] = 'modules/popular_articles_module/update/$1';

/*Image Slider Module*/
$route['admin/modules/create_images_slider_module'] = 'modules/images_slider_module/create';
$route['admin/modules/edit_image_slider_module/(:num)'] = 'modules/images_slider_module/update/$1';
$route['admin/modules/images_slider_module/select_media'] = 'modules/images_slider_module/select_media';

/*Portfolio Module*/
$route['admin/modules/create_portfolio_module'] = 'modules/portfolio_module/create';
$route['admin/modules/edit_portfolio_module/(:num)'] = 'modules/portfolio_module/update/$1';

//****************************************************************************************************************************//

//Templates
$route['admin/templates'] = 'templates/admin';
$route['admin/templates/page/(:num)'] = 'templates/admin/index/page/$1';
$route['admin/templates/trashed_templates'] = 'templates/admin/trashed_templates';
$route['admin/templates/trashed_templates/page/(:num)'] = 'templates/admin/trashed_templates/page/$1';
$route['admin/templates/create_template'] = 'templates/admin/create_template';
$route['admin/templates/update_template/(:num)'] = 'templates/admin/update_template/$1';
$route['admin/templates/set_default_template/(:num)'] = 'templates/admin/set_default_template/$1';
$route['admin/templates/delete_template/(:num)'] = 'templates/admin/delete_template/$1';
$route['admin/templates/unset_trashed_template/(:num)'] = 'templates/admin/unset_trashed_template/$1';
$route['admin/templates/delete_trashed_template/(:num)'] = 'templates/admin/delete_trashed_template/$1';

//*******************************************************************************************************************************//

//Media Manager
$route['admin/media_manager'] = 'media_manager/admin';
$route['admin/media_manager/file_browser'] = 'media_manager/admin/file_browser';
$route['admin/media_manager/do_upload'] = 'media_manager/admin/do_upload';
$route['admin/media_manager/create_folder'] = 'media_manager/admin/create_folder';
$route['admin/media_manager/remove_media'] = 'media_manager/admin/remove_media';


//*******************************************************************************************************************************//



// Settings
$route['admin/settings'] = 'settings/admin';


//Get a single article from a blog page
$route['(:any)/(:any)/article/(:num)/(:any)'] = 'pages/index/article/$1/$2/$3/$4';

//Get a single portfolio project from a portfolio page
$route['(:any)/(:any)/project/(:num)/(:any)'] = 'pages/index/project/$1/$2/$3/$4';

//Get the default controller.We assign pages as default controller using the pages/controllers/index.php controller
$route['default_controller'] = 'pages/index';

//Get the default 404 
$route['404_override'] = 'pages/index';
$route['(:any)/(:any)/article/(:num)/(:any)'] = 'pages/index/article/$1/$2/$3/$4';
$route['(:any)/(:any)/project/(:num)/(:any)'] = 'pages/index/project/$1/$2/$3/$4';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
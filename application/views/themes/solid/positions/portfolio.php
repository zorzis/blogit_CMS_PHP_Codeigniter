<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

					    if  (!empty($custom_modules))
						{
						  
						    foreach ($custom_modules as $module)
						    {

						    	if ($module->privilege_id == 0 || $this->flexi_auth_lite->is_privileged($module->upriv_name))
						    	{
						    		if($module->position == $position)
						    		{
						        		if (file_exists($path_to_custom_module_layout . $module->module_layout)) include($path_to_custom_module_layout . $module->module_layout);
						    	
						    		}
						    	}

						    }
					    	
					    }		

					    if  (!empty($menu_modules))
						{
						  

						    foreach ($menu_modules as $module)
						    {	

						    	if ($module->privilege_id == 0 || $this->flexi_auth_lite->is_privileged($module->upriv_name))
						    	{
						    		if($module->position == $position)
						    		{
						        	
						        		if (file_exists($path_to_menu_module_layout . $module->module_layout)) include($path_to_menu_module_layout . $module->module_layout);

						    		}
						        }
						    }
						}

						if  (!empty($latest_articles_blog_modules))
							{
							    foreach ($latest_articles_blog_modules as $module)
							    {	
							    	if ($module->privilege_id == 0 || $this->flexi_auth_lite->is_privileged($module->upriv_name))
						    		{
						    			if($module->position == $position)
						    			{
							    			//We get the latest_articles by categories using limit in the model query
											$latest_articles_per_module = $this->frontend_model->get_blog_modules_latest_articles($module->id,$module->limit_articles_number);	
											
											$latest_articles_media = $this->frontend_model->get_blog_modules_latest_articles_media($latest_articles_per_module);

							        		if (file_exists($path_to_latest_articles_blog_module_layout . $module->module_layout)) include($path_to_latest_articles_blog_module_layout . $module->module_layout);
							        	}
							        }
							    }
							}

							if  (!empty($popular_articles_blog_modules))
							{
							    foreach ($popular_articles_blog_modules as $module)
							    {	
						    		if ($module->privilege_id == 0 || $this->flexi_auth_lite->is_privileged($module->upriv_name))
						    		{
						    			if($module->position == $position)
						    			{
											//We get the popular_articles by categories using limit in the model query
											$popular_articles_per_module = $this->frontend_model->get_blog_modules_popular_articles($module->id,$module->limit_articles_number);	

											$popular_articles_media = $this->frontend_model->get_blog_modules_popular_articles_media($popular_articles_per_module);

							        		if (file_exists($path_to_popular_articles_blog_module_layout . $module->module_layout)) include($path_to_popular_articles_blog_module_layout . $module->module_layout);
							        
							        	}
							        }
							    }
							}

							if  (!empty($image_slider_modules))
							{
							    foreach ($image_slider_modules as $module)
							    {	
						    		if ($module->privilege_id == 0 || $this->flexi_auth_lite->is_privileged($module->upriv_name))
						    		{
						    			if($module->position == $position)
						    			{
											//We get the images and captions from image_slider_module_content
											$images_and_captions_per_module = $this->frontend_model->get_image_slider_images_and_caption($module->id);	

							        		if (file_exists($path_to_image_slider_module_layout . $module->module_layout)) include($path_to_image_slider_module_layout . $module->module_layout);
							        
							        	}
							        }
							    }
							}

							if  (!empty($portfolio_modules))
							{
							    foreach ($portfolio_modules as $module)
							    {	
							    	if ($module->privilege_id == 0 || $this->flexi_auth_lite->is_privileged($module->upriv_name))
						    		{
						    			if($module->position == $position)
						    			{
							    			//We get the portfolio projects by categories using limit in the model query
											$projects = $this->frontend_model->get_portfolio_modules_projects($module->id,$module->limit_projects_number);	
											
											$projects_media = $this->frontend_model->get_portfolio_modules_projects_media($projects);

							        		if (file_exists($path_to_portfolio_module_layout . $module->module_layout)) include($path_to_portfolio_module_layout . $module->module_layout);
							        	}
							        }
							    }
							}

					?>
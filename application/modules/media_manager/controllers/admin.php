<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends Backend_Controller
{

	public function __construct ()
	{
		parent::__construct();

		$this->load->helper('directory');
		$this->load->helper('file');


	}

	public function index()
	{
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('View Media Files'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to access media manager.</p>');
			
			redirect('admin/');		
		}
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Upload Media Files'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Upload Files with media manager.</p>');
			
			redirect('admin/');		
		}		
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Delete Media Files'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Remove Files with media manager.</p>');
			
			redirect('admin/');		
		}		
		// Check user has privileges to view blog articles, else display a message to notify the user they do not have valid privileges.
		if (! $this->flexi_auth->is_privileged('Create Media Folders'))
		{
			$this->session->set_flashdata('message', '<p class="error_msg">You do not have access privileges to Create Folders with media manager.</p>');
			
			redirect('admin/');		
		}

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		
		
		// Load view
		$this->load->view('media_manager/admin/media_manager', $this->data);
	}

	public function file_browser($path_post = NULL)
	{

		//Define the root path folder where you store your media files used by Blogit CMS
		$media_path = 'filemanager/userfiles';

		$this->data['media_root'] = $media_path;

		if(isset($_POST['clicked_folder_path']))
		{

			$path_post = $_POST['clicked_folder_path'];

		}



		//We ensure we get the path_post only if a folder is clicked to see contents
		if(!empty($path_post))
		{
			$path = $path_post . '/';
			$this->data['path'] = $path;
		}
		else
		{
			$path = $media_path . '/';
			$this->data['path'] = $path;

		}


		if(is_dir($path))
		{

			$media = directory_map(realpath($path));

			foreach ($media AS $key=>$value)
			{

				if (is_array($value))
				{


					$row_count_folders = count($key);

					for ($i=0; $i < $row_count_folders; $i++) { 
						$this->data['folders'][] = array(

							'name'	=>	$key,							
							'path'	=>	$path. $key

							);
					}

				}
				else
				{
					// Get file extension
					$file_ext = strtolower(end(explode('.', $value)));
					
					switch($file_ext)
					{
						// Images
						case 'jpg':
						case 'png':
						case 'gif':							
						case 'bmp':
						case 'jpeg':
						case 'ico':


						$row_count = count($value);

						for ($i=0; $i < $row_count; $i++) { 
						    $this->data['images'][] = array(

								'name'		 => $value,										
								'path' 		 => $path. $value, // relative path of image or folder									
							);
						}

					}


				}
			}
		
		}

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		//Unset Template 
		$this->output->unset_template();

		// Load view
		$this->load->view('media_manager/admin/includes/ajax_file_browser', $this->data);		
	}


// Create folder in specified media directory
	public function create_folder()
	{

		// Get new folder name
		$new_folder_name = trim(strip_tags($_POST['foldername']));

		//Get the folder path we gonna create new folder
		$path = trim(strip_tags($_POST['new_folder_path']));

		//Bind the 2 values to get the new folder path
		$new_folder_path = $path . $new_folder_name;


		// Sanitize folder name for . .. ...
		$new_folder_path = str_replace('\\', '/', $new_folder_path);
		$tmp = explode('/',$new_folder_path);			
		$tmp = array_filter($tmp);
		$tmp = array_diff($tmp, array('.','..','...'));
		$new_folder_path = implode('/',$tmp);	
		
		// Array to set error messages
		$data = array();

		if($new_folder_path)
		{			
				$dir = $new_folder_path;				

				// create folder
				if (!is_dir($dir)) 
				{
				    if(!mkdir($dir, 0777, TRUE))
				    {
				    	// could not create folder					
						$data['errors'] = array('Could not create folder.');									
				    } 

				} 
				else 
				{
					// Directory already exists				
					$data['errors'] = array('Folder already exists.');
				}

		} 
		else 
		{
			// Folder name empty			
			$data['errors'] = array('Choose appropriate name for folder.');
		}

		// Set error notifications		
		if(!empty($data))
		{
			$this->session->set_userdata('notifications',$data);
		}

		$this->file_browser();

	}	


	// Remove folder or file
	function remove_media()
	{		
		//The array we get from ajax post is like:

		//array (size=2)
		//  0 => 
		//    array (size=2)
		//      'name' => string 'media_details[]' (length=4)
		//      'value' => string 'uploads/noimage.png' (length=19)
		//  1 => 
		//    array (size=2)
		//      'name' => string 'media_details[]' (length=4)
		//      'value' => string 'uploads/shave.jpg' (length=17)

		$media_details_from_ajax_post = $_POST['media'];
		//var_dump($image_details_from_ajax_post);	

		//Here we get only the 'value' the array we have got before from ajax post
		foreach($media_details_from_ajax_post as $key => $value) {
		
			$media_path = $value['value'];

			if(is_file($media_path)) // if file
			{		
				
				unlink($media_path);

			}
			elseif(is_dir($media_path)) // if folder
			{				
				delete_files($media_path, TRUE);
				rmdir($media_path);
			}


		}

       	// Go to root (uploads folder after delete)
		$this->file_browser();	
	}

	public function do_upload(){
   
        // Detect form submission.
        if($this->input->post('submit'))
        {
            
            //Using a hidden input field in upload submit form in view file(ajax_file_browser)
            //we manage to get the $path variable we get from images_slider_module->file_browser function below
            //so we can upload files in the folder we are currently inside.
            $path = $this->input->post('upload_path');

            //We load the MY_Upload library in application/libraries
            $this->load->library('upload');
           
            /**
             * Refer to https://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html
             * for full argument documentation.
             *
             */
             
            // Define file rules
            $this->upload->initialize(array(
                "upload_path"       =>  $path,
                "allowed_types"     =>  "gif|jpg|jpeg|png|JPG|JPEG|PNG|GIF",
                "max_size"          =>  '',
                "max_width"         =>  '',
                "max_height"        =>  ''
            ));
           
            if($this->upload->do_multi_upload("uploadfile"))
            {
               
                $data['upload_data'] = $this->upload->get_multi_upload_data();
                              
               	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-ban-circle"></i><strong>' . count($data['upload_data']) . 'File(s) successfully uploaded.</div>';
            } 
            else 
            {   
                // Output the errors
                $errors = array('error' => $this->upload->display_errors('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-ban-circle"></i><strong>', '</div>'));              
           
                foreach($errors as $k => $error){
                    echo $error;
                }
               
            }
           
        } 
        else 
        {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-ban-circle"></i><strong>An error occured, please try again later.</div>';
           
        }
        // Exit to avoid further execution
        exit();
    }


	
}
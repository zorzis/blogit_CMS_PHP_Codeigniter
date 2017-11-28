  <header class="header bg-default b-b b-light">

  	<div id="toolbar-select" class="btn-toolbar btn-group pull-left">

  		<button id="select" type="button" class="btn btn-sm btn-info"><i class="fa fa-check-square fa-2x"></i> <span class="hidden-xs">Select Items</span></button>  

  	</div>

  	<div class="btn-group pull-right">
  		<button type="button" data-toggle="collapse" data-target="#collapseUpload" class="btn btn-sm btn-success"><i class="fa fa-upload fa-2x"></i> <span class="hidden-xs">Upload Items</span></button>

  		<button type="button" data-toggle="collapse" data-target="#collapseFolder" class="btn btn-sm btn-dark"><i class="fa fa-folder-o fa-2x"></i> <span class="hidden-xs">Create Folder</span></button>

  		<button type="button" class="btn btn-sm btn-danger" onclick="delete_media()"><i class="fa fa-trash-o fa-2x"></i><span class="hidden-xs"> Delete Items</span></button>
  	</div>
  </header>



  <!-- File Upload Form -->        
  <div id="collapseUpload" class="media-actions collapse">   

  	<!-- AJAX Response will be outputted on this DIV container -->
  	<div class = "upload-image-messages"></div>


  	<section>

  		<div class="panel-body">

  			<div class="form-group">

  				<span class="h4 text-dark">Upload your files inside:</span> <span class="h4 text-warning"> <?php echo $path; ?> </span>

  			</div>

  			<!-- Generate the form using form helper function: form_open_multipart(); -->
  			<?php echo form_open_multipart('admin/media_manager/do_upload/', array('class' => 'upload-image-form'));?>

  			<div class="input-group">

  				<!-- We use this hidden value to bypass the $path variable we get from file_browser function in the controller-->
  				<input type="hidden" name="upload_path" value="<?php echo $path?>"/>


  				<input type="file" multiple = "multiple" accept = "image/*" class = "form-control input-lg" name="uploadfile[]"/>


  				<span class="input-group-btn">

  					<input type="submit" name = "submit" value="Upload" class = "btn btn-primary btn-lg" />

  				</span>
  			</div> 

  			<?php echo form_close();?>


  		</div>
  	</section>


  	<script>       

  		jQuery(document).ready(function($) 
  		{

  			var options = 
  			{
  				beforeSend: function()
  				{
                    // Replace this with your loading gif image
                    $(".upload-image-messages").html('<span class="text-center"><img src = "<?php echo base_url() ?>assets/themes/admin/images/loader.gif" class = "loader" /></span>');
                },
                complete: function(response)
                {
                    // Output AJAX response to the div container
                    $(".upload-image-messages").html(response.responseText);
                    $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top-100}, 150);

                }
            }; 
            // Submit the form
            $(".upload-image-form").ajaxForm(options); 

            return false;

        });
  	</script>         

  </div>
  <!-- File Upload Form END -->  

  <!-- Create Folder Form -->
  <div id="collapseFolder" class="media-actions collapse">

  	<section>

  		<div class="panel-body">

  			<div class="form-group">

  			<span class="h4 text-dark">Create your new folder inside: </span> <span class="h4 text-danger"> <?php echo $path; ?> </span>
  			</div>

  			<div class="input-group">

  				<input type="hidden" name="new_folder_path" id="new_folder_path" value="<?php echo $path?>"/>

  				<input type="text" id="foldername" name="foldername" placeholder="<?php echo $path?>" class="form-control input-lg" >

  				<span class="input-group-btn">

  					<button type="button" onclick="create_folder()" class="btn btn-success btn-lg pull-right"><span class="fa fa-folder-o"></span> Create Folder</button> 

  				</span>
  			</div> 

  		</div>
  	</section>

  </div>

  <div class="row">

  	<div class="col-lg-3">
  		<section class="panel panel-default">
  			<div class="panel-body">
  				<div class="clearfix text-center m-t">
  					<div class="inline">

  						<a href="#" class="openfolder" id="<?php echo $media_root; ?>">

  							<span class="fa-stack fa-4x pull-center m-r-sm">
  								<i class="fa fa-circle fa-stack-2x text-dark"></i>
  								<i class="fa fa-folder fa-stack-1x text-warning"></i>
  							</span>
  						</a>

  						<div class="h4 m-t m-b-xs text-warning">
  							<a href="#" class="openfolder" id="<?php echo $media_root; ?>">
  								Go to Root
  							</a>
  						</div>
  					</div>                      
  				</div>
  			</div>
  			<footer class="panel-footer bg-dark text-center">
  				<div class="row pull-out">
  					<div class="col-xs-12">
  						<div class="padder-v">

  							<small class="text-muted">

  								You are here: <span class="text-warning"> <?php echo $path; ?> </span>

  							</small>

  							<span class="m-b-xs h4 block"></span>

  						</div>
  					</div>
  				</div>
  			</footer>
  		</section>
  	</div>


  	<?php if(isset($folders)): ?>

  		<?php foreach($folders as $folder): ?>

        <?php if ($folder['name'] != '_thumbs') { ?>

    			<div class="col-lg-3">
    				<section class="panel panel-default">
    					<div class="item media-item">
    						<div class="cover"></div>

    						<div class="panel-body">
    							<div class="clearfix text-center m-t">
    								<div class="inline">

    									<input type="checkbox" name="media_details[]" class="hidden" value="<?php echo $folder['path']; ?>">

    									<a href="#" class="openfolder" id="<?php echo $folder['path']; ?>">

    										<span class="fa-stack fa-4x pull-center m-r-sm">
    											<i class="fa fa-circle fa-stack-2x text-dark"></i>
    											<i class="fa fa-folder fa-stack-1x text-info"></i>
    										</span>
    									</a>

    									<div class="m-t m-b-xs text-info">

    										<a href="#" class="openfolder" id="<?php echo $folder['path']; ?>"><?php echo $folder['name'];?></a>                        	
    									</div>
    								</div>                      
    							</div>
    						</div>
    					</div>
    				</section>
    			</div>	

        <?php } ?>

  		<?php endforeach; ?>
  	<?php endif; ?>

  </div>

  <div class="row">

  	<!-- Media List of images -->
  	<?php if(isset($images)): ?>

  		<?php $i = 0; ?>
  		<?php foreach($images as $image): ?>

  			<div class="col-lg-3">

  				<section class="panel panel-default">

  					<div class="item media-item">
  						<div class="cover"></div>

  						<div class="panel-body">

  							<div class="clearfix text-center m-t">
  								<div class="inline">

  									<input type="checkbox" name="media_details[]" class="hidden" value="<?php echo $image['path']; ?>">

  									<a class="" href="<?php echo base_url(); ?><?php echo $image['path']; ?>"><img width="80" src="<?php echo base_url(); ?><?php echo $image['path']; ?>">
  									</a>


  								</div>
  							</div>
  						</div>
  					</div>
  					<footer class="panel-footer bg-dark text-center">
  						<div class="row pull-out">
  							<div class="col-xs-12">
  								<div class="padder-v">

  									<small class="text-muted">

  										<a class="" href="<?php echo base_url(); ?><?php echo $image['path']; ?>"><?php echo $image['name']; ?></a>

  									</small>

  									<span class="m-b-xs h4 block">

  									</span>

  								</div>
  							</div>
  						</div>
  					</footer>
  				</section>			

  			</div>

  			<?php $i++; ?>
  		<?php endforeach; ?>
  	<?php endif; ?>	

  </div>


  <script>

  	$(document).ready(function() 
    { 

  		// Enable select button, disable media links
  		$('#toolbar-select #select').click(function(e) {                
  			$(this).toggleClass('active');
  			$('.cover').toggleClass('media-disabled');
  			$('.media-item').removeClass('media-selected');
  			$('#thumbsView input').prop('checked',false);
  		}); 

  	    // Select media items
  	    $('.media-item').click(function() {  
  	    	if($('#toolbar-select button').hasClass('active')){
  	    		$(this).toggleClass('media-selected');            
  	    		$(this).find('input').prop('checked',function(i,val) {
  	    			return !val;


  	    		});
  	    	} 
  	    });
	  });


	// Navigate through folders
	$('a[class="openfolder"]').click(function()
	{ //start click

		//Get the ID of the button that was clicked on
		var id_of_folder_button_clicked = $(this).attr("id");

		$("#ajax").fadeOut("slow",function(){});

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>admin/media_manager/file_browser',
		   data: "clicked_folder_path=" + id_of_folder_button_clicked, //The data your sending to some-page.php
		   success: function(data){
		   	$("#ajax").html(data);
		   	console.log("AJAX request was successfull");
		   	console.log(id_of_folder_button_clicked)
		   },
		   error:function(){
		   	console.log("AJAX request was a failure");
		   	console.log(id_of_folder_button_clicked)

		   }
		});


		$("#ajax").fadeIn("slow",function(){});

	}); //end click


	// Delete multiple files or folder
	function delete_media() {
		var checked = $('#ajax input:checkbox').is(':checked');

	    //We use serializeArray to get Objects and not a single string like serialize does
	    var media_details = $('#ajax input[name="media_details[]"]').serializeArray();

	    if (checked === true) {
	    	bootbox.confirm('This action will delete the selected media.', function(r) {
	    		if (r === true) {

	    			$.ajax({
	    				type: 'POST',
	    				url: '<?php echo base_url(); ?>admin/media_manager/remove_media',

					   //We use {} to get array values as objects
					   data: {media : media_details}, //The data your sending to some-page.php
					   success: function(data)
             {
					   	$("#ajax").html(data);

					   	console.log("AJAX request was successfull");

					   	console.log(media_details)
					   	//Using console.log("what_we_want_to_log") gives us in eg: firebug console,
					   	//the posting data like:
					   	//[Object { name="image_details[]",  value="uploads/noimage.png"}, Object { name="image_details[]",  value="uploads/shave.jpg"}]
					   	//So we can see what we expecting to see in php posting data
					   },
					   error:function(){
					   	console.log("AJAX request was a failure");

					   }
					});
	    		}
	    	});
	    } else {
	    	bootbox.alert('Select atleast one media or folder.');
	    }
	}

	function create_folder() 
	{

		var new_folder_name = document.getElementById("foldername").value;
		var path = document.getElementById("new_folder_path").value;



		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>admin/media_manager/create_folder',
			data: { foldername: new_folder_name, new_folder_path: path }, //The data your sending to some-page.php
			success: function(data)
			{
				$("#ajax").html(data);

				console.log("AJAX request was successfull");

				console.log( new_folder_name + '| | ' + path);

			},
			error:function()
			{
				console.log("AJAX request was a failure");
				console.log( new_folder_name + '| | ' + path);

			}
		});

	}

</script>

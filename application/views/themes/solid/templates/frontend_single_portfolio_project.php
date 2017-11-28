<!-- *****************************************************************************************************************
	 HEADERWRAP
	 ***************************************************************************************************************** -->	

<?php echo $this->load->get_section('after_header_headerwrap'); ?>

			

<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->

	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3><?php echo $project->project_title ?></h3>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /blue -->

<!-- *****************************************************************************************************************
	 TITLE & CONTENT
	 ***************************************************************************************************************** -->

	<div class="container mt">
	 	<div class="row">
		 	<div class="col-lg-10 col-lg-offset-1 centered">
			 	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">

				  	<?php foreach($projects_media as $media): ?>

						<?php if ($media->project_id == $project->id): ?>

					    <div class="item active">
					      <img src="<?php echo base_url() . $media->image_path ?>" alt="<?php echo $media->image_path ?>" title="<?php echo $media->image_caption ?>">
					    </div>

						<?php endif; ?>

					<?php endforeach; ?>

				  </div>
				</div><!--/Carousel -->
		 	</div>
		 	
		 	<div class="col-lg-5 col-lg-offset-1">
			 	<div class="spacing"></div>
		 		<h4><?php echo $project->project_title ?></h4>
		 		<p><?php echo $project->project_description ?></p>
		 		<h4>Company Proposal</h4>
		 		<p><?php echo $project->company_proposal ?></p>
		 	</div>
		 	
		 	<div class="col-lg-4 col-lg-offset-1">
			 	<div class="spacing"></div>
		 		<h4>Project Details</h4>
		 		<div class="hline"></div>
		 		<p><b>Date:</b> <?php echo $project->date_project_done ?></p>
		 		<p><b>Developer:</b> <?php echo $project->developer ?></p>
		 		<p><b>Category:</b> <?php echo $project->category_title ?></p>
		 		<p><b>Client:</b> <?php echo $project->client_name ?></p>
		 		<p><b>Website:</b> <a href="<?php echo $project->project_url ?>"><?php echo $project->project_url ?></a></p>
		 	</div>
		 	
	 	</div><!--/row -->
	 </div><!--/container -->



<!-- *****************************************************************************************************************
	 SERVICE LOGOS
	 ***************************************************************************************************************** -->
	 <div id="service">
	 	<div class="container">
 			<div class="row centered">

<?php echo $this->load->get_section('services_section'); ?>
	 				
	 		</div>
	 	</div><!--/container -->
	 </div><!--/service -->

<!-- *****************************************************************************************************************
	 TESTIMONIALS
	 ***************************************************************************************************************** -->

	 <?php echo $this->load->get_section('testimonials'); ?>
	 
	 
	<!-- *****************************************************************************************************************
	 OUR CLIENTS
	 ***************************************************************************************************************** -->
	 
	 <?php echo $this->load->get_section('our_clients'); ?>

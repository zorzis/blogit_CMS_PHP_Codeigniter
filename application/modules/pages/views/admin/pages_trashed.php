          <section class="vbox">

          	<header class="header bg-white b-b b-light">
              <p><i class="fa fa-file-o"></i> <?php echo $this->lang->line('pages');?></p>
              <div class="btn-group pull-right">
				<a href="<?php echo base_url(); ?>admin/pages/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('pages');?></a>
              	<a href="<?php echo base_url(); ?>admin/pages/trashed_pages/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_pages');?></a>
                
                <div class="btn-group">
                	<button class="btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> New Page?</button>
		            <button class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-2x"></i></button>
              			<ul class="dropdown-menu">
		                	<li><a href="<?php echo base_url(); ?>admin/pages/create_custom_page">Custom HTML Page</a></li>
		                    <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/pages/create_blog_page">Blog Page</a></li>
		   		            <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/pages/create_portfolio_page">Portfolio Page</a></li>
		                    <li class="divider"></li>
		                    <li><a href="<?php echo base_url(); ?>admin/pages/create_external_url_page">Link to external URL</a></li>
		                 </ul>
              	</div>
              
              </div>
            </header>

            <section class="scrollable wrapper">

              <!-- Codeigniter Flash Messages Area -->
              
              <?php if (! empty($message)) { ?>

                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">Close ×</button>
                    <i class="fa fa-info-sign"></i>
                    <strong>
                    <?php echo $message; ?>
                  </strong>
                </div>

              <?php } ?>

              <!-- Codeigniter Flash Messages Area -->

              <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_trashed_pages');?></h3>
              </div>
				<section class="panel panel-default">
				                <header class="panel-heading">
				                	<i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('trashed_pages');?></i>
				                </header>
				                <div class="row wrapper">
				                 <!-- Filter form -->

				                  <div class="col-sm-5 m-b-xs">

				                  </div>
				                  <!--End filter form -->

				                  <div class="col-sm-4 m-b-xs">

				                  </div>

				                  <div class="col-sm-3">
               
				                  </div>

				                </div>

				                 <?php echo form_open(current_url());?>

				                <div class="table-responsive">
				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
										<th width="20"><input type="checkbox"></th>
										<th width="20">ID</th>
				                        <th><?php echo $this->lang->line('page_title');?></th>
				                        <th><?php echo $this->lang->line('page_type');?></th>
				                        <th><?php echo $this->lang->line('page_status');?></th>
				                        <th><?php echo $this->lang->line('page_created_date');?></th>
				                        <th><?php echo $this->lang->line('page_updated_date');?></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($pages)) { ?>

				                    <tbody>

				                    	<?php foreach ($pages as $page) { ?>

										<tr>

											<td><input type="checkbox" name="" value=""></td>

											<td>

												<?php if($page->page_type == 1) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_custom_page/<?php echo $page->id ?>">
														
														<?php echo $page->id ?>

													</a>

												<?php }?>			

												<?php if($page->page_type == 2) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_blog_page/<?php echo $page->id ?>">
														
														<?php echo $page->id ?>

													</a>

												<?php }?>


												<?php if($page->page_type == 3) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_external_url_page/<?php echo $page->id ?>">
														
														<?php echo $page->id ?>

													</a>

												<?php }?>

												<?php if($page->page_type == 4) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_portfolio_page/<?php echo $page->id ?>">
														
														<?php echo $page->id ?>

													</a>

												<?php }?>

											</td>

											<td>

												<?php if($page->page_type == 1) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_custom_page/<?php echo $page->id ?>">
														
														<?php echo $page->title ?>

													</a>

												<?php }?>			

												<?php if($page->page_type == 2) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_blog_page/<?php echo $page->id ?>">
														
														<?php echo $page->title ?>

													</a>

												<?php }?>


												<?php if($page->page_type == 3) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_external_url_page/<?php echo $page->id ?>">
														
														<?php echo $page->title ?>

													</a>

												<?php }?>

												<?php if($page->page_type == 4) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_portfolio_page/<?php echo $page->id ?>">
														
														<?php echo $page->title ?>

													</a>

												<?php }?>

											</td>

											<td>

												<?php if($page->page_type == 1) {?>

													<span class="label bg-warning"><i class="fa fa-code"></i> Custom Page </span>

												<?php }?>			

												<?php if($page->page_type == 2) {?>

													<span class="label bg-primary"><i class="fa fa-edit"></i> Blog Page </span>

												<?php }?>


												<?php if($page->page_type == 3) {?>

													<span class="label bg-danger"><i class="fa fa-chain"></i> External Url </span>

												<?php }?>

												<?php if($page->page_type == 4) {?>

													<span class="label bg-info"><i class="fa fa-briefcase"></i> Portfolio Page </span>

												<?php }?>


											</td>

											<td>

												<span class="label <?php echo ($page->deleted == 1) ? "bg-dark" : "";?> "> <?php echo ($page->deleted == 1) ? "Trashed" : "";?> </span>

											</td>

											<td>

												<?php echo $page->created; ?>

											</td>

											<td>

												<?php echo $page->modified; ?>

											</td>
											
											<td>

												<?php if($page->page_type == 1) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_custom_page/<?php echo $page->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update">
														
														<i class="fa fa-eye"></i>
														
													</a>

												<?php }?>			

												<?php if($page->page_type == 2) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_blog_page/<?php echo $page->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update">
														
														<i class="fa fa-eye"></i>

													</a>

												<?php }?>


												<?php if($page->page_type == 3) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_external_url_page/<?php echo $page->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update">
														
														<i class="fa fa-eye"></i>

													</a>

												<?php }?>

												<?php if($page->page_type == 4) {?>

													<a href="<?php echo base_url(); ?>admin/pages/edit_portfolio_page/<?php echo $page->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update">
														
														<i class="fa fa-eye"></i>

													</a>

												<?php }?>

											</td>
											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/pages/publish_page/<?php echo $page->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-circle text-success"></i></a>
											</td>

											<td>

												<?php if($page->page_type == 1) {?>

				                        		<a onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" href="<?php echo base_url(); ?>admin/pages/delete_trashed_custom_page/<?php echo $page->id ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
				                        		
				                        			<i class="fa fa-trash-o"></i>

				                        		</a>

												<?php }?>			

												<?php if($page->page_type == 2) {?>

					                        		<a onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" href="<?php echo base_url(); ?>admin/pages/delete_trashed_blog_page/<?php echo $page->id ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
					                        		
					                        			<i class="fa fa-trash-o"></i>

					                        		</a>

												<?php }?>


												<?php if($page->page_type == 3) {?>

													<a onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" href="<?php echo base_url(); ?>admin/pages/delete_trashed_external_page/<?php echo $page->id ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
					                        		
					                        			<i class="fa fa-trash-o"></i>

					                        		</a>

												<?php }?>

												<?php if($page->page_type == 4) {?>

													<a onclick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');" href="<?php echo base_url(); ?>admin/pages/delete_trashed_portfolio_page/<?php echo $page->id ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
														
					                        			<i class="fa fa-trash-o"></i>

													</a>

												<?php }?>
												
											</td>

										</tr>

									   	<?php } ?>	

				                    </tbody>

				                    <?php } else { ?>

										<tbody>
											<tr>
												<td colspan="12" class="msgboard">
													<div class="col-sm-4">
													</div>
													<div class="col-sm-4">
														<ul class="list-group">
    														<li class="list-group-item">
    															<h4>Nope!</h4>
																<div class="progress progress-sm progress-striped active">
		    														<div class="progress-bar progress-bar-danger" style="width: 100%"></div>
																</div>
																<h1><?php echo $this->lang->line('no_pages_found');?></h1>
															</li>
														</ul>
													</div>
													<div class="col-sm-4">
													</div>
												</td>
											</tr>
										</tbody>

									<?php } ?>

				                  </table>
				                </div>

				                <footer class="panel-footer">
				                  <div class="row">

				                  	

				                    <div class="col-sm-4 text-left">
				                      <span> <h4><?php echo $this->lang->line('total_pages');?><span class="badge bg-dark"><?php echo $total_pages; ?></span> </h4></span>
				                    </div>

				                    <div class="col-sm-4 text-center-xs">                
				                      <ul class="pagination pagination-sm m-t-none m-b-none">

										<?php echo $this->pagination->create_links(); ?>				                        
				                      
				                      </ul>
				                    </div>

				                    <div class="col-sm-4">
				                    </div>

				                    

				                  </div>
				                </footer>



				                <?php echo form_close();?>

				            </section>
				        </section>
				    </section>



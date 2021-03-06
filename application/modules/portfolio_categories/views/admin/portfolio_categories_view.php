          <section class="vbox">

          	<header class="header bg-white b-b b-light">
              <p><i class="fa fa-briefcase fa-2x text-info"></i> <?php echo $this->lang->line('portfolio');?></p>
              <div class="btn-group pull-right">
				<a href="<?php echo base_url(); ?>admin/portfolio/categories/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('portfolio_categories');?></a>
              	<a href="<?php echo base_url(); ?>admin/portfolio/categories/trashed_portfolio_categories/" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_portfolio_categories');?></a>
                <a href="<?php echo base_url(); ?>admin/portfolio/categories/create_portfolio_category" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('create_portfolio_category');?></a>                
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
                <h3 class="m-b-none"><?php echo $this->lang->line('manage_portfolio_categories');?></h3>
              </div>
				<section class="panel panel-default">
				                <header class="panel-heading">
				                  <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('portfolio_categories');?></i>
				                </header>

				                 <?php echo form_open(current_url());?>

				                <div class="table-responsive">
				                  <table class="table table-striped b-t b-light">
				                    <thead>
				                      <tr>
										<th width="20"><input type="checkbox"></th>
										<th width="20">ID</th>
				                        <th><?php echo $this->lang->line('portfolio_category_title');?></th>
				                        <th><?php echo $this->lang->line('portfolio_category_status');?></th>
				                        <th><?php echo $this->lang->line('portfolio_category_created_date');?></th>
				                        <th><?php echo $this->lang->line('portfolio_category_updated_date');?></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                        <th width="30"></th>
				                      </tr>
				                    </thead>

				                    <?php if (!empty($categories)) { ?>

				                    <tbody>

				                    	<?php foreach ($categories as $category) { ?>

										<tr>

											<td><input type="checkbox" name="" value=""></td>

											<td>
												<a href="<?php echo base_url(); ?>admin/portfolio/categories/edit_portfolio_category/<?php echo $category->id ?>">
													
													<?php echo $category->id ?>

												</a>
											</td>

											<td>
												<a href="<?php echo base_url(); ?>admin/portfolio/categories/edit_portfolio_category/<?php echo $category->id ?>">
													
													<?php echo $category->portfolio_category_title ?>

												</a>
											</td>

											<td>

												<span class="label <?php echo ($category->is_published == 1) ? "bg-success" : "bg-danger";?>"> <?php echo ($category->is_published == 1) ? "Published" : "Unpublished";?> </span>
											
											</td>

											<td>

												<?php echo $category->created; ?>

											</td>

											<td>

												<?php echo $category->modified; ?>

											</td>
											
											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/portfolio/categories/edit_portfolio_category/<?php echo $category->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/portfolio/categories/publish_portfolio_category/<?php echo $category->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Publish"><i class="fa fa-circle text-success"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/portfolio/categories/unpublish_portfolio_category/<?php echo $category->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Unpublish"><i class="fa fa-circle text-danger"></i></a>
											</td>

											<td>
				                        		<a type="text" href="<?php echo base_url(); ?>admin/portfolio/categories/delete_portfolio_category/<?php echo $category->id ?>" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fa fa-trash-o text-warning"></i></a>
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
																<h1><?php echo $this->lang->line('no_categories_found');?></h1>
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
				                      <span> <h4><?php echo $this->lang->line('total_categories');?><span class="badge bg-dark"><?php echo $total_categories; ?></span> </h4></span>
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



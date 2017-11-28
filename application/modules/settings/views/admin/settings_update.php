          <section class="vbox">

          	<section class="scrollable wrapper">

          		<!-- Codeigniter Flash Messages Area -->

          		<?php if (! empty($message)) { ?>

          		<div class="alert alert-info">
          			<button type="button" class="close" data-dismiss="alert">Close ×</button>
          			<strong>
          				<?php echo $message; ?>
          			</strong>
          		</div>

          		<?php } ?>

          		<!-- Codeigniter Flash Messages Area -->

          		<div class="m-b-md">
          			<h3 class="m-b-none"><?php echo $this->lang->line('settings');?></h3>
          		</div>   

          		<?php echo form_open_multipart(current_url()); ?>

          		<div class="col-lg-4">

          			<section class="panel panel-default">
          				<div class="panel-body">
          					<div class="clearfix text-center m-t">
          						<div class="inline">


          							<span class="fa-stack fa-4x pull-center m-r-sm">
          								<i class="fa fa-circle fa-stack-2x text-dark"></i>
          								<i class="fa fa-cog fa-stack-1x text-white"></i>
          							</span>

          							<div class="h1 m-t m-b-xs text-info"><?php echo $this->lang->line('settings');?></div>
          						</div>                      
          					</div>
          				</div>
          				<footer class="panel-footer bg-dark text-center">
          					<div class="row pull-out">
          						<div class="col-xs-4">
          							<div class="padder-v">

          								<small class="text-muted"></small>

          								<span class="m-b-xs h4 block"> </span>

          							</div>
          						</div>
          						<div class="col-xs-4 dk">
          							<div class="padder-v">

          								<small class="text-muted"></small>

          								<span class="m-b-xs h4 block"> </span>

          							</div>
          						</div>
          						<div class="col-xs-4">
          							<div class="padder-v">

          								<small class="text-muted m-b"> </small>

          								<span class="m-b-xs h4 block text-white"> </span>

          							</div>
          						</div>
          					</div>
          				</footer>
          			</section>

          			<a class="btn btn-info btn-lg btn-block" href="#logo_settings" data-toggle="tab">
          				<i class="fa fa-bars pull-left"></i>
          				Choose Logo
          			</a>
                         <a class="btn btn-info btn-lg btn-block" href="#seo_settings" data-toggle="tab">
                              <i class="fa fa-bars pull-left"></i>
                              Seo Settings
                         </a>
                         <a class="btn btn-info btn-lg btn-block" href="#google_analytics" data-toggle="tab">
                              <i class="fa fa-bars pull-left"></i>
                              Google Analytics
                         </a>


          		</div> 


          		<div class="col-lg-8">
          			<!--Article Information Form Panel -->
          			<section>
          				<div class="panel-body">
          					<div class="tab-content"><!--Starts Tab Content -->

          						<div class="tab-pane fade active in" id="logo_settings"><!--Starts Media Settings Tab Content -->


          							<section class="panel panel-default">
          								<header class="panel-heading bg-warning lt no-border font-bold">
          									<i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('logo_options');?></i>
          								</header>
          							</section>

                                             <div class="form-group">
                                                  <label for="webpage_title"><?php echo $this->lang->line('webpage_title');?></label>
                                                  <input class="form-control input-lg m-b" type="text" name="webpage_title" placeholder="<?php echo $this->lang->line('logo_title_placeholder');?>" value="<?php echo set_value('webpage_title', $settings->webpage_title); ?>" />
                                                  <p class="help-block"><?php echo $this->lang->line('logo_title_helper');?></p>
                                             </div>

                                             <section class="panel panel-default">
                                                  <header class="panel-heading bg-info lt no-border font-bold">
                                                       <i class="fa fa-picture-o fa-2x"> Choose Logo Image</i>
                                                  </header>
                                             </section>

          							<div class="form-group">

          								<?php if(is_file('uploads/' . $settings->logo_image)) : ?>

                                                  <div class="col-lg-12">
          								  <img width="350" src="<?php echo site_url(); ?>uploads/<?php echo $settings->logo_image; ?>" />
                                                  </div>

                                                  <div class="col-lg-8 text-warning">

               								<h4><?php echo $this->lang->line('logo_image_delete');?> <?php echo form_checkbox('delete_image', '1', false); ?></h4>
                                                  </div>

          							<?php else: ?>

                                             <section class="panel panel-default">
                                                   <div class="panel-body">
                                                     <div class="clearfix text-center m-t">

                                                       <div class="inline">

                                                         <div id="avatar"></div><!-- Show new avatar -->

                                                           <div class="thumb-lg">
                                                             
                                                             <span class="fa-stack fa-4x pull-center m-r-sm">
                                                               <i class="fa fa-circle fa-stack-2x text-dark"></i>
                                                               <i class="fa fa-picture-o fa-stack-1x text-warning"></i>
                                                             </span>                                    

                                                           </div>

                                                       </div>   

                                                     </div>
                                                   </div>
                                                   <footer class="panel-footer bg-dark text-center">
                                                       <div class="row pull-out">

                                                         <div class="col-xs-12 dk">
                                                           <div class="padder-v">
                                                             <span class="m-b-xs h2 block text-danger">No Logo Selected!</span>
                                                             <small class="text-muted"></small>
                                                           </div>
                                                         </div>

                                                       </div>
                                                     </footer>
                                                   
                                             </section>

                                             <?php endif; ?>


                                             <div class="col-lg-4 text-danger">

          								<input type="file" name="userfile" class="filetype" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s">

          							</div>

          						</div>

          					</div><!--Ends Media Settings Tab Content -->

          					<div class="tab-pane fade" id="seo_settings"><!--Starts Seo Settings Tab Content -->

          						<section class="panel panel-default">
          							<header class="panel-heading bg-warning lt no-border font-bold">
          								<i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('seo_options');?></i>
          							</header>
          						</section>

          						<div class="form-group">
          							<label for="seo_page_title"><?php echo $this->lang->line('seo_page_title');?></label>
          							<input class="form-control input-lg m-b" type="text" name="seo_page_title" placeholder="<?php echo $this->lang->line('seo_page_title_placeholder');?>" value="<?php echo set_value('seo_page_title', $settings->seo_page_title); ?>" />
          							<p class="help-block"><?php echo $this->lang->line('seo_page_title_helper');?></p>
          						</div>

          						<div class="form-group">
          							<label for="keywords"><?php echo $this->lang->line('meta_keywords');?></label>
          							<input class="form-control input-lg m-b" type="text" name="meta_keywords" placeholder="<?php echo $this->lang->line('meta_keywords_placeholder');?>" value="<?php echo set_value('meta_keywords', $settings->meta_keywords); ?>"/>
          							<p class="help-block"><?php echo $this->lang->line('meta_keywords_helper');?></p>
          						</div>

          						<div class="form-group">
          							<label for="post_description"><?php echo $this->lang->line('meta_description');?></label>
          							<textarea class="form-control input-lg m-b" type="text" name="meta_description" rows="4" placeholder="<?php echo $this->lang->line('meta_description_placeholder');?>"><?php echo set_value('meta_description', $settings->meta_description); ?></textarea>
          						</div>

          					</div><!--Ends Seo Settings Tab Content -->

                                   <div class="tab-pane fade" id="google_analytics"><!--Starts Google Analytics Tab Content -->

                                        <section class="panel panel-default">
                                             <header class="panel-heading bg-warning lt no-border font-bold">
                                                  <i class="fa fa-bars fa-2x"> Google Analytics Tracking  ID</i>
                                             </header>
                                        </section>

                                    <label for="google_analytics_track_id">Google Analytics Tracking ID</label>
                                    <div class="input-group">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default btn-lg btn-primary" type="button"><i class="fa  fa-bar-chart-o"></i></button>
                                      </span>
                                      <input class="form-control input-lg m-b" type="text" name="google_analytics_tracking_id" placeholder="Enter Google Analytics Trackind ID" value="<?php echo set_value('google_analytics_tracking_id', $settings->google_analytics_tracking_id); ?>"/>
                                    </div>
                                    <p class="help-block">*Enter your Google Analytics Trackind ID.</p>



                                   </div><!--Ends Google Analytics Tab Content -->

          				</div><!--Ends Tab Content --> 
          			</div>
          		</section>

          	    <section class="panel panel-default">
          			<div class="panel-body">
          				<div class="btn-group pull-right">

          					<button type="submit" name="Save" id="submit" value="Save" class="btn btn-success btn-lg"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('save');?></button>

          				</div>
          			</div>
          		</section>
          	
          	</div><!--Ends div class = "col-lg-8-->

          	<?php echo form_close();?>

          </section><!--Ends scrollable padder -->
      </section><!--Ends vbox -->

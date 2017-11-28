          <section class="vbox">

            <header class="header bg-white b-b b-light">
              <p><i class="fa fa-edit"></i> <?php echo $this->lang->line('blog');?></p>
              <div class="btn-group pull-right">
                <a href="<?php echo base_url(); ?>admin/blog/" class="hidden-xs btn btn-sm btn-info"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('blog_articles');?></a>
                <a href="<?php echo base_url(); ?>admin/blog/trashed_articles" class="hidden-xs btn btn-sm btn-dark"><i class="fa fa-trash-o fa-2x text-warning"></i> <?php echo $this->lang->line('trashed_blog_articles');?></a>
                <a href="<?php echo base_url(); ?>admin/blog/create_blog_article" class="hidden-xs btn btn-sm btn-success"><i class="fa fa-tasks fa-2x"></i> <?php echo $this->lang->line('create_blog_article');?></a>
              </div>
            </header>
            
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
                <h3 class="m-b-none"><?php echo $this->lang->line('create_blog_article');?></h3>
              </div>   

              <?php echo form_open_multipart(current_url()); ?>

              <div class="col-lg-4">

                <section class="panel panel-default">
                  <div class="panel-body">
                    <div class="clearfix text-center m-t">
                      <div class="inline">

                        <span class="fa-stack fa-4x pull-center m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-dark"></i>
                          <i class="fa fa-edit fa-stack-1x text-white"></i>
                        </span>

                        <div class="h1 m-t m-b-xs text-info"><?php echo $this->lang->line('create_blog_article');?></div>
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
                <a class="btn btn-info btn-lg btn-block" href="#article" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Article
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#article_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Article Options
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#article_media" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Media Options
                </a>
                <a class="btn btn-info btn-lg btn-block" href="#seo_settings" data-toggle="tab">
                  <i class="fa fa-bars pull-left"></i>
                  Seo Settings
                </a>
              </div> 


              <div class="col-lg-8">
               <!--Article Information Form Panel -->
               <section>
                <div class="panel-body">
                  <div class="tab-content"><!--Starts Tab Content -->
                  
                    <div class="tab-pane fade active in" id="article"><!--Starts Article Tab Content -->
                     
                      <section class="panel panel-default">
                        <header class="panel-heading bg-warning lt no-border font-bold">
                          <i class="fa fa-bars fa-2x"> Article</i>
                        </header>
                      </section>
                      
                      <div class="form-group">
                        <label><?php echo $this->lang->line('blog_article_title');?></label>
                        <input type="text" id="title" name="title" value="<?php echo set_value('title');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('blog_article_title_placeholder');?>">
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('blog_article_body');?></label>
                        <textarea name="body" id="editor1" form-control input-lg m-b"" placeholder="<?php echo $this->lang->line('blog_article_body_placeholder');?>"><?php echo set_value('body');?></textarea>
                      </div>

                    </div>

                    <div class="tab-pane fade" id="article_settings"><!--Starts Article Settings Tab Content -->       

                      <section class="panel panel-default">
                        <header class="panel-heading bg-warning lt no-border font-bold">
                          <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('form_article_details');?></i>
                        </header>
                      </section>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('blog_article_slug');?></label>
                        <input type="text" id="slug" name="slug" value="<?php echo set_value('slug');?>" class="form-control input-lg m-b" placeholder="<?php echo $this->lang->line('blog_article_slug_placeholder');?>">
                        <span class="help-block m-b-none"><?php echo $this->lang->line('blog_article_slug_helper');?></span>
                      </div>
                      <div class="line line-dashed line-lg pull-in"></div>

                      <div class="form-group">

                        <?php if (! $this->flexi_auth->in_group(array('Moderator', 'Master Admin'))): ?>

                        <input type="hidden" name="author" value="<?php echo $this->flexi_auth->get_user_id(); ?>" class="form-control" >

                      <?php else: ?>

                      <label><?php echo $this->lang->line('blog_article_author');?></label>

                      <select name="author" class="form-control input-lg m-b">

                        <?php foreach ($authors as $author) : ?>

                        <option value="<?php echo $author->uacc_id; ?>"

                          <?php if($author->uacc_id == $this->flexi_auth->get_user_id() ) : ?>

                          selected

                        <?php endif; ?>

                        >

                        <?php echo $author->upro_first_name; ?> <?php echo $author->upro_last_name; ?> ||  <?php echo $author->uacc_email; ?>

                      </option>

                    <?php endforeach; ?>

                  </select>
                  <div class="line line-dashed line-lg pull-in"></div>

                <?php endif; ?>

              </div>

              <div class="form-group">
                <label><?php echo $this->lang->line('blog_article_pupblish_date');?></label>           
                <input class="input-lg input-s datepicker-input form-control" type="text" data-date-format="yyyy-mm-dd" name="pubdate" value="<?php echo set_value('pubdate');?>" size="16">
              </div>
              <div class="line line-dashed line-lg pull-in"></div>


              <div class="form-group">

                <label><?php echo $this->lang->line('blog_article_category');?></label>

                <select name="category" id="category" class="form-control input-lg m-b">

                  <?php foreach ($categories as $category) : ?>

                  <option value="<?php echo $category->id; ?>">

                    <?php echo $category->category_title; ?>

                  </option>

                <?php endforeach; ?>

              </select>
              <div class="line line-dashed line-lg pull-in"></div>
            </div>                            

          </div><!-- Ends Article Settings Tab-->

          <div class="tab-pane fade " id="article_media"><!--Starts Module Image Slider Tab -->

            <section class="panel panel-default">
              <a href="#modal-form" class="btn btn-dark btn-block" data-toggle="modal"><i class="fa fa-youtube-play fa-2x pull-left"></i> <h4>File Browser</h4></a>
            </section>

            <!-- Starts Modal Containing Ajax File Browser -->
            <div class="modal file_browser fade" id="modal-form">
              <div class="file-browser">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <i class="fa fa-youtube-play fa-4x pull-left text-info"></i><h2 class="modal-title text-info">File Browser</h2>
                    </div>


                    <div class="modal-header">

                      <button type="button" class="btn btn-sm btn-success" onclick="use_selected_media()"><i class="fa fa-mail-reply fa-2x"></i><span class="hidden-xs"> Use Selected Items</span></button>

                    </div>


                    <div class="modal-body">

                      <!--Starts Media Files Browser AJAX -->
                      <div id="ajax"> </div>
                      <script>

                        $(function() {
                          $.post('<?php echo base_url(); ?>admin/media_manager/file_browser',function(data){
                            $('#ajax').html(data);
                          });

                        });

                      </script>
                      <!--Ends Media Files Browser AJAX -->

                      <style>
                        .modal .file-browser .modal-dialog { width: 80%; }
                      </style>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Ends Modal Containing Ajax File Browser -->

            <section class="panel panel-default">
              <header class="panel-heading bg-warning lt no-border font-bold">
                <i class="fa fa-bars fa-2x"> Selected Images for Article</i>
              </header>
            </section>


            <div id="media_values"> </div>

          </div><!-- Ends Module Image Slider Tab -->

        <div class="tab-pane fade" id="seo_settings"><!--Starts Seo Settings Tab Content -->

          <section class="panel panel-default">
            <header class="panel-heading bg-warning lt no-border font-bold">
              <i class="fa fa-bars fa-2x"> <?php echo $this->lang->line('seo_options');?></i>
            </header>
          </section>

          <div class="form-group">
            <label for="seo_page_title"><?php echo $this->lang->line('seo_page_title');?></label>
            <input class="form-control input-lg m-b" type="text" name="seo_page_title" placeholder="<?php echo $this->lang->line('seo_page_title_placeholder');?>" value="<?php echo set_value('seo_page_title'); ?>" />
            <p class="help-block"><?php echo $this->lang->line('seo_page_title_helper');?></p>
          </div>

          <div class="form-group">
            <label for="keywords"><?php echo $this->lang->line('meta_keywords');?></label>
            <input class="form-control input-lg m-b" type="text" name="meta_keywords" placeholder="<?php echo $this->lang->line('meta_keywords_placeholder');?>" value="<?php echo set_value('meta_keywords'); ?>"/>
            <p class="help-block"><?php echo $this->lang->line('meta_keywords_helper');?></p>
          </div>

          <div class="form-group">
            <label for="post_description"><?php echo $this->lang->line('meta_description');?></label>
            <textarea class="form-control input-lg m-b" type="text" name="meta_description" rows="4" placeholder="<?php echo $this->lang->line('meta_description_placeholder');?>"><?php echo set_value('meta_description'); ?></textarea>
          </div>

        </div><!--Ends Seo Settings Tab Content -->

      </div><!--Ends Tab Content --> 
    </div>
  </section>
</div><!--Ends div class = "col-lg-8-->

<div class="col-lg-12">
  <section class="panel panel-default">
    <div class="panel-body">
      <div class="btn-group pull-right">

        <button type="submit" name="Save" id="submit" value="Save" class="btn btn-success btn-lg"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('save');?></button>

      </div>
    </div>
  </section>
</div>

<?php echo form_close();?>

</section><!--Ends scrollable padder -->
</section><!--Ends vbox -->

<script>
  //Use Selected Media As Inputs
  function use_selected_media() 
  {
    var checked = $('#ajax input:checkbox').is(':checked');

    //We use serializeArray to get Objects and not a single string like serialize does
    var media_details = $('#ajax input[name="media_details[]"]').serializeArray();

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>admin/blog/select_media',

      //We use {} to get array values as objects
      data: {media : media_details}, //The data your sending to some-page.php
      success: function(data)
      {

        // Show the selected images inside the div(media_values)
        // The controller function we call above(images_slider_module/select_media)
        // loads the view witch contains the images we have selected
        // The view is located inside (application/modules/modules/views/admin/includes/admin_images_slider)
        $("#media_values").html(data); 

        $("#modal-form").modal('hide');
        
      },
      error:function()
      {
        console.log("AJAX request was a failure");

      }
    });
  }  

</script>

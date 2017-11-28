<div class="modal fade" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">        
          <div class="col-lg-12"><!--Starts div class = "col-lg-4-->

            <section class="panel panel-default">

              <header class="panel-heading font-bold">
                <h3><i class="fa fa-file fa-2x"></i> Assign Pages to <?php echo $menu->title ?></h3>
              </header>

              <div class="table-responsive">

                <table class="table table-striped b-t b-light">
                  <thead>
                    <tr>

                      <th>Page</th>
                      <th>Assign page to menu</th>

                    </tr>
                  </thead>

                  <?php if (!empty($pages)) { ?>

                  <tbody>

                    <?php foreach ($pages as $page) { ?>

                    <tr>

                      <td>

                        <?php echo $page->title ?>

                      </td>

                      <td>
                        <?php 
                          // Define form input values.
                        $current_status = (in_array($page->id, $current_menu_pages)) ? 1 : 0; 
                        $new_status = (in_array($page->id, $current_menu_pages)) ? 'checked="checked"' : NULL;
                        $page_id = $page->id;
                        ?>

                        <label class="switch">
                          <input type="hidden" name="update_pages[<?php echo $page->id;?>][current_status]" value="<?php echo $current_status ?>"/>
                          <input type="hidden" name="update_pages[<?php echo $page->id;?>][new_status]" value="0"/>
                          <input type="hidden" name="update_pages[<?php echo $page->id;?>][page_id]" value="<?php echo $page->id;?>"/>

                          <input type="checkbox" name="update_pages[<?php echo $page->id;?>][new_status]" value="1" <?php echo $new_status ?>/>
                          <span></span>
                        </label>
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
                  <div class="col-sm-4 text-center">
                  </div>
                  <div class="col-sm-4 text-right text-center-xs pull-right">                
                    <button type="submit" name="Save" id="submit" value="Save" class="btn btn-success btn-sm"><i class="fa fa-check-circle pull-left"></i> <?php echo $this->lang->line('save');?></button>
                  </div>
                </div>
              </footer>
            </section>
          </div><!--Ends div class = "col-lg-4-->
        </div><!-- /.raw-content -->          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
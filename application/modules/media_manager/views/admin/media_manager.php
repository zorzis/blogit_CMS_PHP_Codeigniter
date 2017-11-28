<section class="vbox">

  <header class="header bg-white b-b b-light">
    <p><i class="fa fa-youtube-play"></i> Media Manager</p>
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

  </section><!--Ends scrollable padder -->
</section><!--Ends vbox -->
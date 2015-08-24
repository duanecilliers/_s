<?php

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php include _s_template_path(); ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php include _s_sidebar_path(); ?>
<?php get_template_part( 'template-parts', 'footer' ); ?>
<?php wp_footer(); ?>

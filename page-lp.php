<?php
	/* Template Name: LP */
	get_header();
?>

  <div class="fv">
    <h1><?php the_post_thumbnail('full'); ?></h1>
  </div>

  <main class="lp_inner">
    <?php the_content() ?>
  </main>

<?php get_footer(); ?>
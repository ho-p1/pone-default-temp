<?php
	/* Template Name: LP */
	get_header();
?>

  <div class="fv">
    <h1><?php the_post_thumbnail('full'); ?></h1>
  </div>

  <?php if( !empty( get_field('styles') ) ): ?>
  <main role="main" class="lp <?php echo '--' . get_field('styles'); ?> <?php if( get_field('classic-font') ){ echo '--classic'; } ?>">
  <?php else: ?>
  <main role="main" class="lp --base">
  <?php endif; ?>
    <?php the_content() ?>
  </main>

<?php get_footer(); ?>
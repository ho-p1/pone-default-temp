<?php get_header(); ?>

  <?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $the_query = new WP_Query(array(
    'post_type' => 'column',
      'post_status' => 'publish',
      'paged' => $paged,
      'posts_per_page' => 5,
  ));
  if ($the_query->have_posts()) : ?>
    <section class="sec column">
      <ul>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <li><a href="<?php the_permalink(); ?>">
          <strong><?php the_title(); ?></strong>
        </a></li>
        <?php endwhile; ?>
      </ul>
    </section>
  <?php endif;
  wp_reset_postdata(); ?>

<?php get_footer(); ?>
<?php
	get_header();
?>
  <div class="column">

    <div class="column_head">
      <h1><?php the_title(); ?></h1>
    </div>
    <div class="column_image">
      <?php the_post_thumbnail(); ?>
    </div>

    <main class="pages_wrap column_content">
      <?php
        if(have_posts()):
        while(have_posts()): the_post();
          the_content();
        endwhile;
        else:
        endif;
      ?>
    </main>

    <?php $relate = get_field('relate'); if( $relate ): ?>
    <section class="sec relate">
      <h2 class="sec_title">～関連記事はこちら～</h2>
      <ul>
        <?php foreach( $relate as $post): ?>
        <?php setup_postdata($post); ?>
          <li><a href="<?php the_permalink(); ?>">
            <span><?php the_post_thumbnail('full'); ?></span>
            <strong><?php the_title(); ?></strong>
          </a></li>
        <?php endforeach; ?>
      </ul>
    </section>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>

  </div>
<?php get_footer(); ?>
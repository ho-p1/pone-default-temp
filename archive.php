<?php
	get_header();
?>
  <div class="entry">

    <main class="pages_wrap entry_body">
    <?php if(have_posts()): ?>

      <ul class="entry-list">
        <?php while(have_posts()): the_post(); ?>
          <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
      </ul>

    <?php	else: ?>
      <p>お探しのページは見つかりませんでした。</p>
    <?php endif; ?>
    </main>

    <div class="pager">
      <?php if(function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>	
    </div>

  </div>
<?php get_footer(); ?>
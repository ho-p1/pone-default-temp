<?php
	get_header();
?>
<main class="pages_wrap">
  <div class="pages_head">
    <h1><?php the_title(); ?></h1>
  </div>

  <div class="pages_content">

    <?php the_content() ?>
    
    <?php if( is_page('2') ) : ?>
      <?php 
        $tags = SCF::get('tags');
        foreach ($tags as $tag) :
      ?>
        <h2><?php echo $tag['tags-title']; ?></h2>
        <?php echo $tag['tags-detail']; ?>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>

</main>
<?php get_footer(); ?>
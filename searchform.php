<section id="searchform" class="sec searchform">
<h2>あなたにピッタリの<br>エアコンクリーニング会社を探す</h2>
  <div class="searchform_inner">
    <form method="get" action="<?php bloginfo('url'); ?>">
      <input type="hidden" name="post_type" value="post">
      <input type="hidden" name="s">
      <?php if( is_search() ) : ?>
        <input type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>">
        <input type="hidden" name="scid" value="<?php echo $_GET['scid']; ?>">
        <input type="hidden" name="ads" value="<?php echo $_GET['ads']; ?>">
      <?php else : ?>
        <input type="hidden" name="pid" value="<?php echo $page_id = get_the_ID(); ?>">
        <?php if(get_field('search-slug')) : ?>
          <input type="hidden" name="scid" value="<?php the_field('search-slug'); ?>">
        <?php else: ?>
          <input type="hidden" name="scid" value="rank01">
        <?php endif; ?>

        <?php if( strstr( $_SERVER['REQUEST_URI'], 'ys') ) : ?>
          <input type="hidden" name="ads" value="ys">
        <?php else: ?>
          <input type="hidden" name="ads" value="gs">
        <?php endif; ?>
      <?php endif ; ?>
      <dl>
        <dt>値段</dt>
        <dd>
          <div class="searchform_input">
            <?php
              $args = array(
                'hide_empty' => false,
                'child_of' => 2,
                'orderby' => 'menu_order',
              );
              $terms = get_terms('filter', $args);
              foreach($terms as $term):
                $term_name = $term->name;
                $term_slug = $term->slug;
                $term_id = $term->term_id;
            ?>
            <label>
              <input type="radio" name="post_tag[]" value="<?php echo $term_slug; ?>">
              <span><?php echo $term_name; ?></span>
            </label>
            <?php endforeach; ?> 
          </div>
        </dd>
      </dl>
      <dl>
        <dt>オプション</dt>
        <dd>
          <div class="searchform_input">
            <?php
              $args = array(
                'hide_empty' => false,
                'child_of' => 3,
                'orderby' => 'menu_order',
              );
              $terms = get_terms('filter', $args);
              foreach($terms as $term):
                $term_name = $term->name;
                $term_slug = $term->slug;
                $term_id = $term->term_id;
            ?>
            <label>
              <input type="checkbox" name="post_tag[]" value="<?php echo $term_slug; ?>">
              <span><?php echo $term_name; ?></span>
            </label>
            <?php endforeach; ?> 
          </div>
        </dd>
      </dl>
      <div class="btn btn-base">
        <button type="submit">
          <strong>この条件で探す</strong>
        </button>
      </div>
    </form>
  </div>
</section>
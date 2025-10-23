<?php get_header(); ?>

<?php
//エスケープ用
function sethtmlspecialchars($data)
{
  if (is_array($data)) {
    return array_map('sethtmlspecialchars', $data);
  } else {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  }
}

$s = $_GET['s'];

if(isset($_GET['post_tag']) && $_GET['post_tag']) {
  $post_tag = $_GET['post_tag'];
}
if(isset($_GET['pid']) && $_GET['pid']) {
  $pid = sethtmlspecialchars($_GET['pid']);
}
if(isset($_GET['scid']) && $_GET['scid']) {
  $scid = sethtmlspecialchars($_GET['scid']);
}

if(isset($_GET['ads']) && $_GET['ads']) {
  $ads = sethtmlspecialchars($_GET['ads']);
}

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
  'paged' => $paged,
  'post_type' => array('post'),
  'post_status' => array('publish'),
  'category_name' => $scid,
  'order' => 'ASC',
  'orderby' => 'menu_order',
  'posts_per_page' => 99
);

//タクソノミー検索条件追加用配列
$tax_query = [];

if(isset($_GET['post_tag'])) {
  $tax_query[] = array(
    'taxonomy' => 'filter',
    'field' => 'slug',
    'terms' => $post_tag,
    'operator' => 'IN',
  );
}


//tax_queryに格納
if (count($tax_query) > 0) {
  $tax_query['relation'] = 'AND';
  $args += array('tax_query' => $tax_query);
}

$the_query = new WP_Query($args);

get_header(); ?>

<div class="lp_inner">

<section class="result">
  <h1 class="result_title">
    <img src="<?php bloginfo('template_directory');?>/images/search.png" alt="検索結果">
  </h1>

  <?php if ($the_query->have_posts()) : ?>
    <div class="result_wrap">
      <div class="sec items">
        <?php
          while ($the_query->have_posts()) : $the_query->the_post();
        ?>
          <article id="item-<?php echo $slug; ?>" class="item">
            <?php get_template_part('parts/items'); ?>
          </article>
        <?php endwhile; ?>
      </div>
    </div>
	<?php	endif; wp_reset_query(); ?>
  
  <?php 
    $recommend = get_field('recommend', $pid);
    if($recommend) :
  ?>
    <div class="result_recommend" data-num="<?php echo $recommend; ?>">
      <div class="result_recommend-box">
        <h2><img src="<?php bloginfo('template_directory');?>/images/recommend.png" alt="迷ったらコレ！"></h2>
        <div class="result_recommend-content">
          <?php
            $thumb = get_the_post_thumbnail( $recommend, 'full' );
            if( $thumb ) {
              echo '<div class="result_recommend-thumb"><a href="' . get_field('url', $recommend) . '">'. $thumb .'</a></div>';
            }
            $alternative_post = get_post( $recommend );
            echo apply_filters('the_content', $alternative_post->post_content);
          ?>
          <?php
            $btnMc = get_field('button-mc', $recommend);
            $btnText = get_field('button-text', $recommend);
            $btnColor = get_field('button-color', $recommend);
          ?>
          <div class="btn btn_<?php echo $btnColor; ?>">
            <?php if($btnMc): ?><span class="btn_mc"><?php echo $btnMc; ?></span><?php endif; ?>
            <a href="<?php the_field('url', $recommend); ?>"><?php echo $btnText; ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php
    get_template_part('searchform');
  ?>
</div>

<?php get_footer(); ?>
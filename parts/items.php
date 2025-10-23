<?php
$name = get_field('item_name');
$url = get_field('url');
$desc = get_field('item_desc');
$price = get_field('price');
$time = get_field('time');
$staffs = get_field('staffs');
$options = get_field('options');
$feature = get_field('feature');
$recommended = get_field('recommended');
$beforeAfter = get_field('before_after');

$btnMc = get_field('button-mc');
$btnText = get_field('button-text');
$btnColor = get_field('button-color');

$btnMc2 = get_field('button-mc2');
$btnText2 = get_field('button-text2');
$btnColor2 = get_field('button-color2');
?>

  <div class="item_rank"><svg class="icon icon-ranking"><use xlink:href="#icon-ranking"></use></svg></div>
  <div class="item_head">
    <p class="item_copy"><?php echo $desc; ?></p>
    <div class="item_name"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></div>
  </div>
  <div class="item_main">
    <div class="item_thumb">
      <a href="<?php echo $url; ?>"><?php echo get_the_post_thumbnail(); ?></a>
    </div>
    <div class="item_info">
      <dl>
        <dt>料金設定</dt>
        <dd>
          <svg class="icon icon-<?php echo $price['rate']; ?>"><use xlink:href="#icon-<?php echo $price['rate']; ?>"></use></svg>
          <span><?php echo $price['content']; ?></span>
        </dd>
      </dl>
      <dl>
        <dt>スタッフの質</dt>
        <dd>
          <svg class="icon icon-<?php echo $staffs['rate']; ?>"><use xlink:href="#icon-<?php echo $staffs['rate']; ?>"></use></svg>
          <span><?php echo $staffs['content']; ?></span>
        </dd>
      </dl>
      <dl>
        <dt>オプション</dt>
        <dd>
          <svg class="icon icon-<?php echo $options['rate']; ?>"><use xlink:href="#icon-<?php echo $options['rate']; ?>"></use></svg>
          <span><?php echo $options['content']; ?></span>
        </dd>
      </dl>
    </div>
  </div>

  <div class="item_recommended">
    <div class="item_recommended_ttl">おすすめポイント</div>
    <p><?php echo $recommended; ?></p>
  </div>

  <div class="btn btn_<?php echo $btnColor2; ?>">
    <?php if($btnMc2): ?><span class="btn_mc"><?php echo $btnMc2; ?></span><?php endif; ?>
    <a href="<?php echo $url; ?>"><?php echo $btnText2; ?></a>
  </div>
  
  <?php
    $column = get_field('reviewlink');
    if( $column['url'] ):
  ?>
    <?php if( $column['imagelink'] ): ?>
      <div class="review_box">
        <div class="review_box_inner">
          <p><img src="http://xn--ccklwen9lyiqcd2g.biz/wp-content/uploads/2025/05/review_image.png" alt="" width="750" height="500" class="alignnone size-full wp-image-891" /></p>
          <div class="review_box_btn"><a href="<?php echo $column['url']; ?>"><?php echo $column['btn']; ?></a></div>
        </div>
      </div>
    <?php else: ?>
      <div class="review_link">
        <a href="<?php echo $column['url']; ?>">
          <div class="review_link_thumb"><picture><source srcset="<?php echo $column['thumb_sp']; ?>" media="(max-width: 750px)"><img src="<?php echo $column['thumb_pc']; ?>" alt=""></picture></div>
          <dl class="review_link_title">
            <dt><?php echo $column['title']; ?></dt>
            <dd>
              <p><?php echo $column['content']; ?></p>
              <div class="review_link_btn"><?php echo $column['btn']; ?></div>
            </dd>
          </dl>
        </a>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <?php
    $flows = SCF::get('flow');
    if($flows[0]['flow_ttl']):
  ?>
    <div class="flow">
      <div class="flow_ttl">エアコンクリーニングの流れ</div>
      <div class="flow_slide">
        <?php foreach ($flows as $flow) { ?>
          <div class="flow_slide_item">
            <p class="flow_slide_image"><img src="<?php echo wp_get_attachment_url($flow['flow_image']); ?>" alt=""></p>
            <dl>
              <dt><?php echo $flow['flow_ttl']; ?></dt>
              <dd><?php echo $flow['flow_content']; ?></dd>
            </dl>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if($beforeAfter['before']): ?>
    <div class="ba">
      <div class="ba_ttl">ビフォーアフター</div>
      <div class="ba_wrap">
        <img src="<?php echo $beforeAfter['before']; ?>">
        <img src="<?php echo $beforeAfter['after']; ?>">
      </div>
      <p class="ba_desc text-s"><span><img src="/wp-content/uploads/2025/01/icon-control.png" alt="コントローラー"></span>このアイコンを左右に動かすとビフォーアフターが見れます</p>
    </div>
  <?php endif; ?>

<?php
  $reviews = SCF::get('review');
  if($reviews[0]['review-title']):
?>
  <div class="review">
    <h3>レビュー</h3>
    <div class="review_list">
      
      <?php
        foreach ($reviews as $review) :
        $img = wp_get_attachment_image_src($review['review-image'], 'large');
        $imgUrl = $img[0];
      ?>
      <dl class="review_box">
        <dt>
          <span><img src="<?php echo $imgUrl; ?>" alt="<?php echo $review['review-title']; ?>"></span>
          <p><?php echo $review['review-title']; ?></p>
        </dt>
        <dd>
          <?php echo $review['review-body']; ?>
        </dd>
      </dl>
      <?php endforeach; ?>

    </div>
    <div class="morebtn"></div>
  </div>
<?php endif; ?>

<?php if($flows[0]['flow_ttl'] || $beforeAfter['before'] || $reviews[0]['review-title']): ?>
  <div class="btn btn_<?php echo $btnColor; ?>">
    <?php if($btnMc): ?><span class="btn_mc"><?php echo $btnMc; ?></span><?php endif; ?>
    <a href="<?php echo $url; ?>"><?php echo $btnText; ?></a>
  </div>
<?php endif; ?>
<?php
	/* Template Name: LP */
	get_header();
?>

    <div class="fv">
      <h1><?php the_post_thumbnail('full'); ?></h1>
    </div>

    <main class="lp_inner">

        <?php the_content() ?>
        

      <?php 
        $recommend = get_field('recommend');
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
              
              <?php if( get_field('campaign_detail', $recommend) ): ?>
              <div class="item_campaign">
                <?php echo get_field('campaign_detail', $recommend); ?>
              </div>
              <?php endif; ?>

              <?php
                $btnMc = get_field('button-mc', $recommend);
                $btnText = get_field('button-text', $recommend);
                $btnColor = get_field('button-color', $recommend);
              ?>
              <div class="btn btn_<?php echo $btnColor; ?>">
                <?php if($btnMc): ?><span class="btn_mc bound2"><?php echo $btnMc; ?></span><?php endif; ?>
                <a class="bound" href="<?php the_field('url', $recommend); ?>"><?php echo $btnText; ?></a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

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

    </main>

<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<symbol id="icon-poor" viewBox="0 0 32 32">
<path d="M28.38 6.379l-2.758-2.759-9.621 9.621-9.621-9.621-2.759 2.758 9.621 9.621-9.621 9.621 2.759 2.759 9.621-9.621 9.621 9.621 2.758-2.759-9.621-9.621 9.621-9.621z"></path>
</symbol>
<symbol id="icon-search" viewBox="0 0 32 32">
<path d="M6.78 13.163c0-3.525 2.857-6.382 6.382-6.382s6.382 2.857 6.382 6.382-2.857 6.382-6.382 6.382-6.382-2.857-6.382-6.382zM13.162 2.527c-5.874 0.001-10.636 4.763-10.635 10.637s4.763 10.636 10.637 10.635c2.085-0 4.124-0.613 5.863-1.763l6.811 6.813c0.831 0.831 2.178 0.831 3.009 0s0.831-2.178 0-3.009l-6.813-6.811c3.239-4.9 1.893-11.499-3.007-14.738-1.74-1.15-3.78-1.764-5.866-1.764z"></path>
</symbol>
<symbol id="icon-exlink" viewBox="0 0 32 32">
<path d="M14.42 6.519c0.873 0 1.58 0.708 1.58 1.58s-0.707 1.58-1.58 1.58h-9.481v17.383h17.383v-9.481c0-0.873 0.707-1.58 1.58-1.58s1.58 0.707 1.58 1.58v9.481c0 1.745-1.415 3.16-3.16 3.16h-17.383c-1.745 0-3.16-1.415-3.16-3.16v-17.383c0-1.745 1.415-3.16 3.16-3.16h9.481zM28.642 1.778c0.873 0 1.58 0.707 1.58 1.58v7.901c0 0.873-0.707 1.58-1.58 1.58s-1.58-0.707-1.58-1.58v-4.087l-13.105 13.105c-0.628 0.606-1.628 0.589-2.234-0.039-0.591-0.612-0.591-1.583 0-2.196l13.105-13.105h-4.087c-0.873 0-1.58-0.707-1.58-1.58s0.707-1.58 1.58-1.58h7.901z"></path>
</symbol>
<symbol id="icon-excellent" viewBox="0 0 32 32">
<path d="M16 31.426c-8.506 0-15.426-6.92-15.426-15.426s6.92-15.426 15.426-15.426 15.425 6.92 15.425 15.426-6.92 15.426-15.425 15.426zM16 4.442c-6.373 0-11.558 5.185-11.558 11.558s5.185 11.558 11.558 11.558c6.373 0 11.557-5.185 11.557-11.558s-5.185-11.558-11.557-11.558z"></path>
<path d="M16 23.517c-4.145 0-7.517-3.372-7.517-7.517s3.372-7.517 7.517-7.517 7.517 3.372 7.517 7.517-3.372 7.517-7.517 7.517zM16 12.351c-2.012 0-3.649 1.637-3.649 3.649s1.637 3.649 3.649 3.649 3.649-1.637 3.649-3.649-1.637-3.649-3.649-3.649z"></path>
</symbol>
<symbol id="icon-average" viewBox="0 0 32 32">
<path d="M31.304 29.254h-30.607l15.304-26.507 15.304 26.507zM6.638 25.823h18.723l-9.362-16.215-9.362 16.215z"></path>
</symbol>
<symbol id="icon-good" viewBox="0 0 32 32">
<path d="M16 31.557c-8.578 0-15.557-6.979-15.557-15.557s6.979-15.557 15.557-15.557 15.557 6.979 15.557 15.557-6.979 15.557-15.557 15.557zM16 4.344c-6.427 0-11.656 5.229-11.656 11.656s5.229 11.656 11.656 11.656 11.656-5.229 11.656-11.656-5.229-11.656-11.656-11.656z"></path>
</symbol>
<symbol id="icon-none" viewBox="0 0 32 32">
<path d="M6.958 14.074h18.084v3.852h-18.084v-3.852z"></path>
</symbol>
<symbol id="icon-crown" viewBox="0 0 32 32">
<path d="M30.642 12.026c0-1.408-1.141-2.549-2.549-2.549s-2.549 1.141-2.549 2.549c0 0.914 0.483 1.714 1.207 2.164-0.602 1.779-1.902 4.906-3.539 4.681-2.084-0.285-2.553-3.659-1.77-9.589 0.924-0.344 1.603-1.212 1.657-2.259 0.072-1.407-1.010-2.604-2.415-2.676-1.407-0.072-2.604 1.010-2.676 2.416-0.047 0.93 0.412 1.768 1.135 2.249-0.379 6.038-1.446 8.774-3.144 8.774s-2.765-2.737-3.144-8.774c0.722-0.482 1.182-1.319 1.135-2.249-0.072-1.406-1.269-2.487-2.676-2.416-1.405 0.072-2.486 1.269-2.415 2.676 0.054 1.047 0.733 1.915 1.657 2.259 0.784 5.93 0.315 9.303-1.77 9.589-1.637 0.225-2.937-2.902-3.54-4.681 0.725-0.45 1.207-1.249 1.207-2.164 0-1.408-1.14-2.549-2.549-2.549s-2.549 1.141-2.549 2.549c0 1.153 0.767 2.126 1.816 2.441l3.119 13.189h19.415l3.119-13.189c1.049-0.315 1.816-1.288 1.816-2.441z"></path>
</symbol>
</defs>
</svg>
<?php get_footer(); ?>
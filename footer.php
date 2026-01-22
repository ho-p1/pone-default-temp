  
    </div>
  </div>
  
  <footer class="footer">
    <p><small>Copyright &copy; <?php echo date('Y');?> <?php bloginfo('name'); ?>. All Right Reserved.</small></p>
    <ul>
      <li><a href="<?php echo home_url('/company'); ?>">運営者情報</a></li>
      <li><a href="<?php echo home_url('/column'); ?>">コラム一覧</a></li>
    </ul>
  </footer>

<script src="<?php bloginfo('template_directory');?>/js/slick.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/scroll-hint.min.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', function () {
    new ScrollHint('.js-scrollable');
  });
  $(function() {
    $('.box_overflow').each(function() {
      const $box = $(this);
      const fullHeight = $box.outerHeight();
      const initialHeight = $box.data('ini') || 100; // デフォルト100
      $box.data('fullHeight', fullHeight);
      $box.css({
        'height': initialHeight + 'px',
        'overflow': 'hidden',
        'cursor': 'pointer'
      });
    });
    $('.box_overflow').on('click', function() {
      const $box = $(this);
      const fullHeight = $box.data('fullHeight');
      const initialHeight = $box.data('initial-height') || 100;

      if ($box.hasClass('open')) {
        $box.removeClass('open').animate({ height: initialHeight }, 300, function() {
          $box.css('overflow', 'hidden');
        });
      } else {
        $box.addClass('open').animate({ height: fullHeight }, 300, function() {
          $box.css('overflow', 'visible');
        });
      }
    });
  });
</script>
<script src="<?php bloginfo('template_directory');?>/js/common.js"></script>

<?php wp_footer(); ?>

<?php get_template_part('parts/svg.php'); ?>

</body>
</html>
  
    </div>
  </div>
  
  <footer class="footer">
    <p><small>Copyright &copy; <?php echo date('Y');?> <?php bloginfo('name'); ?>. All Right Reserved.</small></p>
    <ul>
      <li><a href="<?php echo home_url('/company'); ?>">運営者情報</a></li>
      <li><a href="<?php echo home_url('/column'); ?>">コラム一覧</a></li>
      <?php /*
      <li><a href="">調査概要</a></li>
      */ ?>
    </ul>
  </footer>

<script src="<?php bloginfo('template_directory');?>/js/slick.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.event.move.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.twentytwenty.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/scroll-hint.min.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', function () {
    new ScrollHint('.js-scrollable');
  });
  $(function(){
    $(".ba_wrap").twentytwenty();
  });
</script>
<script src="<?php bloginfo('template_directory');?>/js/common.js"></script>

<?php wp_footer(); ?>

<?php get_template_part('parts/svg.php'); ?>

</body>
</html>
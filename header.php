<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php if(get_field('noindex')): ?><meta name="robots" content="noindex,follow"><?php endif; ?>
<meta name="keywords" content=""<?php if(get_field('meta-keywords')) {the_field('meta-keywords');} ?>">
<meta name="description" content="<?php if(get_field('meta-description')) {the_field('meta-description');} else { bloginfo('description'); } ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
	if(is_home()){ bloginfo('name'); echo '｜'; bloginfo('description'); }
	elseif(is_page_template('page-search_result.php')){
		if(isset($GET_['post_tag'])): ?>「<?php
			foreach($post_tag as $val){
				if ($val === end($post_tag)) {
					echo get_term_by('slug',$val,"refine")->name;
				}else{
					echo get_term_by('slug',$val,"refine")->name.", ";
				}
		} ?>」<?php else: ?><?php endif; ?>の検索結果<?php echo ' | '; bloginfo('name');
	}
	else{
		if(get_field('page-title')){ the_field('page-title'); }
		else{ wp_title('|', true, 'right'); bloginfo('name'); }
	}
?></title>

<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/reset.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/style.min.css?<?php echo date("ymdHi",filemtime( get_template_directory()."/css/style.min.css")); ?>">
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/scroll-hint.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/slick.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" as="style" fetchpriority="high">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" media="print" onload='this.media="all"'>
<?php if(!is_user_logged_in()): ?>
<style>html,body{user-select:none;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;}</style>
<script type="text/javascript">
//右クリック禁止
document.oncontextmenu = function(){ return false; };
document.body.oncontextmenu = "return false;"

//ドラッグ禁止
document.onselectstart = function(){ return false; };
document.onmousedown = function(){ return false; };
document.body.onselectstart = "return false;"
document.body.onmousedown = "return false;"
</script>
<?php endif; ?>
<?php wp_head(); ?>
</head>

<?php if ( is_search() ) : ?>
<body class="is-scroll">
<?php else: ?>
<body>
<?php endif; ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WNSTQFT4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="head">
	<div class="head_inner">
		<?php
			$url = $_SERVER['HTTP_HOST'];
			if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$url) !== false)) :
		?>
			<a class="logo" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php echo bloginfo('name'); ?>"></a>
		<?php else : ?>
			<img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo('name'); ?>" class="logo">
		<?php endif; ?>
		<!-- <h1 class="head-logo"><a href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a></h1> -->
		<span class="head-pr">PR</span>
	</div>
</header>

<?php if ( is_page_template( 'page-lp.php' ) || is_search() ) : ?>
	<div id="wrap" class="lp">
		<div class="lp-inner">
<?php else: ?>
	<div id="wrap" class="pages">
<?php endif; ?>
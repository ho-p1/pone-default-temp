<?php

//CSSやJSのバージョン非表示
//===================================================================
function remove_cssjs_ver2( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );


// 絵文字に関連するJS、CSS無効
//===================================================================
add_action( 'init', 'wp_disable_emojis' );
function wp_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
}


// Gutenberg用のCSSを読み込まない ページスピード対策
//===================================================================
function my_delete_plugin_files() {
  wp_deregister_style('wp-block-library');
  wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'my_delete_plugin_files' );


// 絞り込み検索用ページ
//===================================================================
add_filter('template_include', 'my_search_template');
function my_search_template($template)
{
  if (is_search()) {
    $post_types = get_query_var('post_type');
    foreach ((array) $post_types as $post_type)
      $templates[] = "search-{$post_type}.php";
    $templates[] = 'search.php';
    $template = get_query_template('search', $templates);
  }
  return $template;
}

// Onclick属性を許可
//===================================================================
function custom_editor_settings( $initArray ){
	$initArray['body_id'] = 'primary';
	$initArray['body_class'] = 'post';
	$initArray['extended_valid_elements'] = '*[*]';
	$initArray['valid_children'] = '+body[style],+div[span],+span[span]+button[onClick],+input[onClick],+button[data-*]';
	$initArray['verify_html'] = false;
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );


// ソートボタン実装
//===================================================================
function add_meta_query_vars( $public_query_vars ) {
  $public_query_vars[] = 'meta_key';
  $public_query_vars[] = 'meta_value';
  return $public_query_vars;
  }
add_filter( 'query_vars', 'add_meta_query_vars' );


// オリジナルウィジェットを追加
//===================================================================
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget('custom_help_widget', 'お願いと注意事項', 'dashboard_text');
}
function dashboard_text() {
  $html = '
    ログインパスワードはセキュリティの観点から定期的（最低1ヶ月に１回）に変更をお願いします。
  ';
  echo $html;
}

// 投稿本文内の <img> タグに decoding="async" と loading 属性を自動付与
// - 1枚目の画像: loading="eager"
// - 2枚目以降の画像: loading="lazy"
//===================================================================
function add_image_attributes_to_content($content) {
    $count = 0;

    $content = preg_replace_callback(
        '/<img[^>]*>/i',
        function ($matches) use (&$count) {
            $img = $matches[0];
            $count++;

            // decoding="async" がない場合に追加
            if (!preg_match('/\bdecoding=/', $img)) {
                $img = preg_replace('/<img/i', '<img decoding="async"', $img, 1);
            }

            // loading 属性を設定（1枚目=eager、それ以降=lazy）
            if (!preg_match('/\bloading=/', $img)) {
                $loading = ($count === 1) ? 'eager' : 'lazy';
                $img = preg_replace('/<img/i', "<img loading=\"$loading\"", $img, 1);
            }

            return $img;
        },
        $content
    );

    return $content;
}
add_filter('the_content', 'add_image_attributes_to_content');



// WordPressの出力する画像（アイキャッチ・ギャラリー等）にも適用
//===================================================================
function add_image_attributes_to_wp_images($attr) {
    static $image_count = 0;
    $image_count++;

    if (empty($attr['decoding'])) {
        $attr['decoding'] = 'async';
    }

    // 1枚目のみ eager、それ以降 lazy
    if (empty($attr['loading'])) {
        $attr['loading'] = ($image_count === 1) ? 'eager' : 'lazy';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_image_attributes_to_wp_images');


<?php

//WordPressのバージョンや管理画面フッター文言非表示
//===================================================================
remove_action('wp_head','wp_generator');

add_filter('admin_footer_text', 'custom_admin_footer');
  function custom_admin_footer() {
}

// アイキャッチ画像を有効にする。
//===================================================================
add_theme_support('post-thumbnails');

// loading="lazy" 追加
//===================================================================
function add_decoding_and_loading_properties($content) {
  $content = preg_replace_callback('/<img([^>]*)>/i', function($matches) {
      return '<img loading="lazy" ' . $matches[1] . '>';
  }, $content);

  return $content;
}
add_filter('the_content', 'add_decoding_and_loading_properties');

// ダッシュボード非表示項目
//===================================================================
function remove_dashboard_widgets() {
  remove_action('welcome_panel', 'wp_welcome_panel'); // WordPress へようこそ !
  remove_meta_box('dashboard_php_nag', 'dashboard', 'normal'); // PHP の更新を推奨
  remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // サイトヘルスステータス
  remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // アクティビティ
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // 概要
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // クイックドラフト
  remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress イベントとニュース
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// 「投稿」の表記変更
//===================================================================
function Change_menulabel() {
  global $menu;
  global $submenu;
  $name = '案件';
  $menu[5][0] = $name;
  $submenu['edit.php'][5][0] = $name.'一覧';
  $submenu['edit.php'][10][0] = '新規'.$name.'投稿';
}
function Change_objectlabel() {
  global $wp_post_types;
  $name = '案件';
  $labels = &$wp_post_types['post']->labels;
  $labels->name = $name;
  $labels->singular_name = $name;
  $labels->add_new = _x('追加', $name);
  $labels->add_new_item = $name.'の新規追加';
  $labels->edit_item = $name.'の編集';
  $labels->new_item = '新規'.$name;
  $labels->view_item = $name.'を表示';
  $labels->search_items = $name.'を検索';
  $labels->not_found = $name.'が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に'.$name.'は見つかりませんでした';
}
add_action( 'init', 'Change_objectlabel' );
add_action( 'admin_menu', 'Change_menulabel' );


// 管理画面の固定ページ一覧を日付順でソートする
//===================================================================
function set_post_order_in_admin( $wp_query ) {
	global $pagenow;
		if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
		$wp_query->set( 'orderby', 'date' ); //ソート基準定義
		$wp_query->set( 'order', 'DESC' ); //ソート順定義（DESC:降順／ASC:昇順）
	}
}
add_filter('pre_get_posts', 'set_post_order_in_admin', 5 );


// 投稿画面のカテゴリー階層構造を保持
//===================================================================
function kaiza_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_action( 'wp_terms_checklist_args', 'kaiza_wp_category_terms_checklist_no_top' );


// カテゴリー選択：選択で先祖カテゴリーも選択
//===================================================================
add_action('admin_head-post-new.php', 'parent_check_script');
add_action('admin_head-post.php', 'parent_check_script');
function parent_check_script(){
?>
<script>
  jQuery(function($){
    jQuery('#taxonomy-category .children input').change(function(){
      function parentNodes(checked, nodes){
        parents = nodes.parent().parent().parent().prev().children('input');
        if(parents.length != 0) { //親カテゴリ有無の確認
          parents[0].checked = checked;
          parentNodes(checked, parents);  //さらに上位に親がいるかを再帰呼び出し
        }
      }
      var checked = jQuery(this).is(':checked');
      jQuery(this).parent().parent().siblings().children('label').children('input').each(function(){
        checked = checked || $(this).is(':checked');
      });
      parentNodes(checked, jQuery(this));
    });
  });
</script>
<?php
}

// ビジュアルエディターを無効化
//===================================================================
function visual_editor_all_disable_script(){
  add_filter('user_can_richedit', 'disable_visual_editor_filter');
}
function disable_visual_editor_filter(){
  return false;
}
add_action( 'load-post.php', 'visual_editor_all_disable_script' );
add_action( 'load-post-new.php', 'visual_editor_all_disable_script' );


// 管理画面の記事一覧でスラッグも検索できるようにする
//===================================================================
function extend_admin_search_with_slug($query) {
  global $pagenow, $wpdb;

  if (is_admin() && $pagenow == 'edit.php' && $query->is_main_query() && isset($_GET['s']) && !empty($_GET['s'])) {
      $search = sanitize_text_field($_GET['s']);

      // 元の検索文字列を保持
      $query->set('s', $search);

      // スラッグでの検索を追加
      add_filter('posts_where', function($where) use ($search, $wpdb) {
          // スラッグ一致検索をWHERE句に追加（LIKEで部分一致）
          $slug_like = '%' . $wpdb->esc_like($search) . '%';
          $where .= $wpdb->prepare(" OR {$wpdb->posts}.post_name LIKE %s", $slug_like);
          return $where;
      });
  }
}
add_action('pre_get_posts', 'extend_admin_search_with_slug');


// WPエディターにインラインSVGを許可
//===================================================================
function elements_attributes( $init ) {
  $ext = '*[*]';
    if ( isset( $init['valid_elements'] ) ) {
      $init['valid_elements'] .= ',' . $ext;
    } else {
      $init['valid_elements'] = $ext;
    }
  return $init;
}

// 投稿一覧のカラム非表示項目
//===================================================================
//Post
function customize_manage_posts_columns($columns) {
	unset($columns['tags']); // タグカラムの削除
	unset($columns['comments']); // コメントカラムの削除
	unset($columns['categories']); //  カテゴリーカラムの削除
	unset($columns['author']); //  投稿者カラムの削除
	return $columns;
}
add_filter( 'manage_posts_columns', 'customize_manage_posts_columns' );

//Page
add_filter( 'manage_pages_columns', 'edit_manage_pages_columns' );
if ( !function_exists( 'edit_manage_pages_columns' ) ):
  function edit_manage_pages_columns($columns) {
    unset($columns['tags']); // タグカラムの削除
    unset($columns['comments']); // コメントカラムの削除
    unset($columns['categories']); //  カテゴリーカラムの削除
    unset($columns['author']); //  投稿者カラムの削除
    return $columns;
  }
endif;


// ビジュアルエディタに切り替えで、空の span タグや i タグが消されるのを防止
//===================================================================
if ( ! function_exists('tinymce_init') ) {
  function tinymce_init( $init ) {
    $init['verify_html'] = false; // 空タグや属性なしのタグを消させない
    $initArray['valid_children'] = '+body[style], +div[div|span|a], +span[span]'; // 指定の子要素を消させない
    return $init;
  }
  add_filter( 'tiny_mce_before_init', 'tinymce_init', 100 );
}

// pタグとbrタグの自動挿入を解除
//===================================================================
remove_filter('the_content', 'wpautop');

// Contact Form 7で自動挿入されるPタグ、brタグを削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
} 

// ステータス：休止中 を追加
//===================================================================
add_action('init', 'registerCustomPostStatus');
function registerCustomPostStatus()
{
  register_post_status('stopped', array(
    'label'                     => '休止中', //編集画面等で表示される名前
    'label_count'               => _n_noop('休止中 (%s)', '休止中 (%s)'),
    'public'                    => false, //デフォルト値
    'protected'                 => false, //デフォルト値
    'private'                   => true, //デフォルト値
    'internal'                  => true,  //外部に公開しないため。
    '_builtin '                 => false, //デフォルト値
    'publicly_queryable'        => false, //デフォルトは'private'と同じ値
    'exclude_from_search'       => false, //デフォルトは'internal'と同じ値,検索対象外にしたいため。
    'show_in_admin_all_list'    => false, //デフォルトは'internal'と逆の値,投稿一覧の「すべて」の記事合計に含ませないため。
    'show_in_admin_status_list' => true, //デフォルトは'internal'と逆の値,投稿一覧のリストには表示させたいため。
    'date_floating'             => false, //デフォルト値
  ));
}

add_action('post_submitbox_misc_actions', 'wpPostStatusList');
function wpPostStatusList($post)
{
  $select = '';
  $label = '';
  if ($post->post_status == 'stopped') {
    $select = 'option.setAttribute("selected", "selected");';
    $label = "
      const post_status_display = document?.getElementById('post-status-display');
      if (post_status_display != null && post_status_display.textContent != null){
        post_status_display.textContent = '休止中';
      }
    ";
  }
  ?>
  <script>
    window.addEventListener("DOMContentLoaded", function() {
      const postStatus = document.getElementById("post_status");
      const option = document.createElement("option");
      option.text = "休止中";
      <?php echo $select; ?>
      option.setAttribute("value", "stopped");
      postStatus?.appendChild(option);
      <?php echo $label; ?>;
    });
  </script>
<?php
}


add_action( 'admin_print_footer_scripts-edit.php', 'my_add_status_option_js' );
function my_add_status_option_js() {
?>
  <script>
  jQuery(document).ready(function($) {
    var $select = $('select[name="_status"]');
    if ($select.length) {
      $select.append('<option value="stopped">休止中</option>');
    }
  });
  </script>
<?php
}


// 固定ページ・投稿一覧のカラムにスラッグ追加
//===================================================================
//Post
function add_posts_columns_slug($columns) { 
  $columns['slug'] = 'スラッグ';
  $columns['status'] = '状態';
  return $columns; 
} 
function add_posts_columns_slug_row($column_name, $post_id) { 
  if( $column_name == 'slug' ) { 
    $slug = get_post($post_id) -> post_name; 
    echo esc_attr($slug); 
  }
  if ( 'status' == $column_name ) {
    if (get_post_status($post_id) === 'publish') {
      echo '<span class="status_flag publish">公開</span>';
    } elseif (get_post_status($post_id) === 'draft') {
      echo '<span class="status_flag draft">下書き</span>';
    } elseif (get_post_status($post_id) === 'future') {
      echo '<span class="status_flag future">予約投稿</span>';
    } elseif (get_post_status($post_id) === 'private') {
      echo '<span class="status_flag private">非公開</span>';
    } elseif (get_post_status($post_id) === 'stopped') {
      echo '<strong class="status_flag stopped">休止中</strong>';
    }
  }
} 
add_filter( 'manage_posts_columns', 'add_posts_columns_slug' ); 
add_action( 'manage_posts_custom_column', 'add_posts_columns_slug_row', 10, 2 );

//Page
function add_page_column_slug_title( $columns ) {
	$columns[ 'slug' ] = "スラッグ";
  $columns['status'] = '状態';
	return $columns;
}
function add_page_column_slug( $column_name, $post_id ) {
	if( $column_name == 'slug' ) {
		$post = get_post( $post_id );
		$slug = $post->post_name;
		echo esc_attr( $slug );
	}
  if ( 'status' == $column_name ) {
    if (get_post_status($post_id) === 'publish') {
      echo '<span class="status_flag publish">公開</span>';
    } elseif (get_post_status($post_id) === 'draft') {
      echo '<span class="status_flag draft">下書き</span>';
    } elseif (get_post_status($post_id) === 'future') {
      echo '<span class="status_flag future">予約投稿</span>';
    } elseif (get_post_status($post_id) === 'private') {
      echo '<span class="status_flag private">非公開</span>';
    } elseif (get_post_status($post_id) === 'stopped') {
      echo '<strong class="status_flag stopped">休止中</strong>';
    }
  }
}
add_filter( 'manage_pages_columns', 'add_page_column_slug_title' );
add_action( 'manage_pages_custom_column', 'add_page_column_slug', 10, 2 );


// 独自スタイルを追加
//===================================================================
function my_admin_style() {
  echo '<style>
  #title {
    width: 40%;
  }
  #cb {
    width: 3%;
  }
  #slug, #status {
    width: 10%;
  }
  .slug.column-slug {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .status_flag {
    display: inline-block;
    padding: 5px 10px;
    background: #666;
    border: 1px solid transparent;
    color: #fff;
    border-radius: 50px;
    line-height: 1;
    width: 60px;
    text-align: center;
  }
  .status_flag.publish {
    background: #fff;
    border: 1px solid #ccc;
    color: inherit;
  }
  .status_flag.future {
    background: #4A9782;
  }
  .status_flag.draft {
    background: #34699A;
  }
  .status_flag.private {
    background: #ccc;
    color: #666;
  }
  .status_flag.stopped {
    background: #DC3C22;
  }
  </style>'.PHP_EOL;
}
add_action('admin_print_styles', 'my_admin_style');
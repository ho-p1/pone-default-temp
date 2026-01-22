<?php
//===================================================================
// ショートコード
//===================================================================

// ショートコードの入れ子を許可
//===================================================================
add_filter('the_content', function ($text){
	if( ( is_single() || is_page() ) && !is_admin() && $text != null ){
		$text = do_shortcode($text);
	}
	return $text;
}, 100);

// icon SVG
//===================================================================
function add_icon( $atts ) {
  $icon = shortcode_atts( array(
    'name' => 'good',
    'color' => null,
    'size' => '1em',
    'class' => null,
  ), $atts );
  if( (!empty($icon['color'])) ) {
    $message = '<svg class="icon icon-' . $icon['name'] . ' ' . $icon['class'] . '" style="fill:' . $icon['color'] . ';width:' . $icon['size'] . ';height:' . $icon['size'] . ';"><use xlink:href="#icon-' . $icon['name'] . '"></use></svg>';
  } else {
    $message = '<svg class="icon icon-' . $icon['name'] . ' ' . $icon['class'] . '" style="width:' . $icon['size'] . ';height:' . $icon['size'] . ';"><use xlink:href="#icon-' . $icon['name'] . '"></use></svg>';
  }
  return $message;
}
add_shortcode('icon', 'add_icon');


// 年月日取得
//===================================================================
function sc_year(){
  $atts = shortcode_atts(array(
      'intval' => '0',
      'format' => 'Y年'
  ), $atts, 'year');
  $year = intval($atts['year']);
  $year = date($atts['format'], strtotime("{$year} year"));
}
add_shortcode('year','sc_year');

function sc_month(){
  $atts = shortcode_atts(array(
      'intval' => '0',
      'format' => 'Y月'
  ), $atts, 'month');
  $month = intval($atts['month']);
  $month = date($atts['format'], strtotime("{$month} month"));
}
add_shortcode('month','sc_month');

function sc_day(){
  $atts = shortcode_atts(array(
      'intval' => '0',
      'format' => 'Y日'
  ), $atts, 'day');
  $day = intval($atts['day']);
  $day = date($atts['format'], strtotime("{$day} day"));
}
add_shortcode('day','sc_day');

// 指定日数前の日付取得
//===================================================================
function get_days_ago_shortcode($atts) {
  $atts = shortcode_atts(array(
      'days' => '0',
      'format' => 'Y年n月j日'
  ), $atts, 'days_ago');
  $days = intval($atts['days']);
  $date = date($atts['format'], strtotime("-{$days} days"));
  return esc_html($date);
}
add_shortcode('days_ago', 'get_days_ago_shortcode');
  

// パラメータからキーワードを取得
//===================================================================
function get_param_keywords($atts) {
  $atts = shortcode_atts(array(
    'before' => null,
    'txt' => null,
    'after' => null,
  ), $atts);
  if(isset($_GET['kw'])) {
    $kw = $atts['before'] . $_GET['kw'] . $atts['after'];
  } else {
    $kw = $atts['txt'];
  }
  return $kw;
}
add_shortcode('kw', 'get_param_keywords');


// 吹き出し
//===================================================================
function add_decoration_bubble( $atts, $content = null ) {
  $styles = shortcode_atts( array(
    'icon' => 'https://placehold.jp/40/c7c7c7/ffffff/300x300.png?text=now%20painting',
    'name' => null,
    'align' => 'left',
    'bg' => '#f8f8f8',
    'border' => '#eee',
  ), $atts );
  return '<div class="bubble bubble--'. $styles['align'] .'" style="--bubble-bg:'. $styles['bg'] .';--bubble-border:'. $styles['border'] .';"><div class="bubble_icon"><div class="bubble_icon_img"><img src="'. $styles['icon'] .'"></div><div class="bubble_icon_text">'. $styles['name'] .'</div></div><div class="bubble_body">' . $content . '</div></div>';
}
add_shortcode('bubble', 'add_decoration_bubble');

// CTAボタン（2個並び）
//===================================================================
function add_cta2btn( $atts, $content = null ) {
  $btn = shortcode_atts( array(
    'yes' => '確認する',
    'yesurl' => null,
    'yescolor' => '#3bc300',
    'no' => '確認しない',
    'nocolor' => '#48a6a7',
    'class' => null,
  ), $atts );
  return '<div class="cta_2btn_wrap '. $btn['class'] .'" style="--yes:'. $btn['yescolor'] .';--no:'. $btn['nocolor'] .';"><div class="cta_2btn_content">'. $content .'</div><div class="cta_2btn"><div class="cta_2btn-base cta_2btn-no"><a tabindex="-1">'. $btn['no'] .'</a></div><div class="cta_2btn-base cta_2btn-start bound"><a href="'. $btn['yesurl'] .'">'. $btn['yes'] .'</a></div></div></div>';
}
add_shortcode('cta2btn', 'add_cta2btn');

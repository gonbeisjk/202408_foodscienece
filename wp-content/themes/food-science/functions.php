<?php

/**
 * タイトルタグを出力する
 */
add_theme_support('title-tag');

/**
 * アイキャッチ画像を使用可能にする
 */
add_theme_support('post-thumbnails');

/**
 * カスタムメニュー機能を使用可能にする
 */
add_theme_support('menus');

/**
 * タイトルの区切り文字を変更
 */
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator()
{
  return '|';
}

/**
 * Concatc Form 7の自動整形機能をオフにする
 */
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
  return false;
}

/**
 * ショートコードサンプル
 */
function my_shortcode_sample($args)
{
  // もし$argsがなかった時のデフォルト値
  $default = [
    'bgcolor' => 'transparent',
  ];
  $args = shortcode_atts($default, $args);

  $html = <<<HTML
    <div style="background-color: {$args['bgcolor']};">
      <h3 class="shortcode-heading">ショートコードサンプル</h3>
      <p>ダミー文章、ダミー文章、ダミー文章、ダミー文章、ダミー文章、ダミー文章、</p>
    </div>
HTML;

  return $html;
}
// 1: ショートコード名, 2: 関数名
add_shortcode('my-shortcode', 'my_shortcode_sample');


add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
  // 管理画面、メインクエリ以外は除外
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  // トップページの場合
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return;
  }
}

<?php

add_action('after_setup_theme', 'my_theme_support');
function my_theme_support()
{
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
   * HTML5をサポートする
   */
  add_theme_support('html5');

  /**
   * ブロックエディターにCSSを読み込む
   */
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');
}


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

  // タクソノミー一覧ページmenuの場合
  // if($query->is_tax('menu')) {...}
}


/**
 * タイトルの「保護中」の文字を削除する
 */
add_filter('protected_title_format', 'my_protected_title');
function my_protected_title()
{
  return '%s';
}

add_filter('the_password_form', 'my_password_form');
function my_password_form()
{
  remove_filter('the_content', 'wpautop');
  $wp_login_url = wp_login_url();
  $html = <<<XYZ
  <p>パスワードを入力してください。</p>
  <form action="{$wp_login_url}?action=postpass" method="post" class="post-password-form">
    <input type="password" name="post_password">
    <input type="submit" name="Submit" value="送信">
  </form>
XYZ;
  return $html;
}


add_filter('allowed_block_types_all', 'my_allowed_block_types_all', 1, 2);
function my_allowed_block_types_all($allowed_blocks, $editor_context)
{
  // var_dump($allowed_blocks);
}

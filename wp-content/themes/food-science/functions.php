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

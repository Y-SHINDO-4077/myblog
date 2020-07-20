<?php
//アイキャッチ画像の有効化
add_theme_support('post-thumbnails');
//アイキャッチ画像の画像サイズ制御
add_image_size('category-thumb',450,9999);
add_image_size('category-big',900,9999);
add_image_size('category-medium',300,9999);
add_image_size('category-700',700,9999);

//ウィジェットを追加する
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => 'ウィジェット1',
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '',
	      'after_widget'  => '',
	      'before_title'  => '',
	      'after_title'   => '',
        ) );


    register_sidebar( array(
        'name' => 'ウィジェット2',
        'id' => 'sidebar-2',
        'description' => '',
        'before_widget' => '',
	      'after_widget'  => '',
	      'before_title'  => '',
	      'after_title'   => '',
        ) );
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );


//css,js,fontawesomeを読み込む
function theme_name_scripts(){
  wp_enqueue_style('style-name',get_stylesheet_uri());
  wp_enqueue_script('script-name',get_template_directory_uri().'/js/app.js',array('jquery'),'1.0.0',true);
  wp_enqueue_style('fontawesome','https://use.fontawesome.com/releases/v5.2.0/css/all.css');
  //WordPress 本体の jQuery を登録解除
  wp_deregister_script( 'jquery');
  //jQuery を CDN から読み込む
  wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), NULL,
    true //</body> 終了タグの前で読み込み
  );
}
add_action('wp_enqueue_scripts','theme_name_scripts');

//navbutton
function navbutton_scripts(){
  wp_enqueue_script('navbutton_script',get_template_directory_uri().'/js/navbar.js',array('jquery'),'',true);
}
add_action('wp_enqueue_scripts','navbutton_scripts');

//カスタムメニューの追加
register_nav_menus(array(
  'primary_menu'=>'メインメニュー',
  'footer_menu' =>'フッターメニュー'
));

//カスタム投稿タイプの設定
add_action('init','register_cpt_books');

function register_cpt_books(){
  $labels =array(
    'name' => _x('読んだ本','read_books'),
    'singlar_name' => _x('読んだ本','read_book'),
    'menu_name'=>_x('読んだ本','read_books'),//メニュー名のテキスト
    'add_new'=> _x('新規追加','book'),//新規追加ボタン
    'add_new_item' => __('新しく読んだ本を追加'),//新規作成画面でのヘッダーテキスト
    'edit_item'=>__('読んだ本を編集'),//編集画面でのヘッダーテキスト
    'new_item'=>__('新しく読んだ本'),
    'view_item'=>__('読んだ本を編集'),//管理メニューでのヘッダでの表示方法を指定
    'all_itmes'=>__('すべての読んだ本'),
    'search_items' =>__('読んだ本を探す'),//検索ボタン
    'not_found'=>__('読んだ本はありません'),
    'not_found_in_trash'=>('ゴミ箱に読んだ本はありません'),
  );
  $args =array(
    'labels'=>$labels,
    'public'=>true,//管理者がカスタム投稿タイプを登録可能に
    'has_archive'=>true,//アーカイブを有効にする
    'show_ui'=>true,
    'show_in_menu'=>true,
    'show_in_nav_menu'=>true,
    'publicly_queryable'=>true,//
    'hierarchical'=>false,//親構造を持たせるかどうか
    'menu_postion'=>5,//投稿の下に表示
    'rewrite'=>array('slug'=>'book'),
    'supports'=>array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'custom-fields',
      'comments'
    )                       //投稿に何を対応させるのか

  );
  register_post_type('read_books',$args);
}


//アイキャッチ画像を利用する
add_theme_support('post-thumbnails',array('read_books'));
set_post_thumbnail_size(700,700,true);

//カスタムタクソノミーの設定
add_action('init','create_book_taxonomies',0);
function create_book_taxonomies(){
  $labels = array(
    'name' => _x('ジャンル','genres'),
    'singlar_name'=>_x('ジャンル','genre'),
    'search_items'=>__('ジャンルで検索'),
    'popular_items'=>__('人気のジャンル'),
    'all_items' =>__('すべてのジャンル'),
    'parent_item'=>null,
    'parent_item_colon'=>null,
    'edit_item'=>__('ジャンルを編集する'),
    'update_item'=>__('ジャンルを更新する'),
    'add_new_item'=>__('新規のジャンルを追加する'),
    'new_item_name'=>__('新しいジャンル'),
    'not_found'=>__('ジャンルはありません'),
    'menu_name'=>__('ジャンル'),
  );
  $args = array(
    'hierarchical'=>false,
    'labels'=>$labels,
    'show_ui'=>true,
    'show_admin_column'=>true,
    'show_in_quick_edit'=>true,
    'show_tagcloud'=>true,
    'update_count_callback' =>'_update_post_term_count',
    'query_var'=>true,
    'rewrite'=>array('slug'=>'genre'),
  );
  register_taxonomy('genre','read_books',$args);
}

// パンくずリスト
function breadcrumb() {
    $home = '<li><a href="'.get_bloginfo('url').'" >HOME</a></li>';

    echo '<ul>';
    if ( is_front_page() ) {
        // トップページの場合
    }
    else if ( is_category() ) {
        // カテゴリページの場合
        $cat = get_queried_object();
        $cat_id = $cat->parent;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        echo $home;
        foreach($cat_list as $value){
            echo $value;
        }
        the_archive_title('<li>', '</li>');
    }
    else if ( is_archive() ) {
    // 月別アーカイブ・タグページの場合
    echo $home;
    the_archive_title('<li>', '</li>');
    }
    else if ( is_single() ) {
    // 投稿ページの場合
    $cat = get_the_category();
        if( isset($cat[0]->cat_ID) ) $cat_id = $cat[0]->cat_ID;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        echo $home;
        foreach($cat_list as $value){
            echo $value;
        }
        the_title('<li>', '</li>');
    }
    else if( is_page() ) {
    // 固定ページの場合
    echo $home;
    the_title('<li>', '</li>');
    }
    else if( is_search() ) {
    // 検索ページの場合
    echo $home;
    echo '<li>「'.get_search_query().'」の検索結果</li>';
    }
    else if( is_404() ) {
    // 404ページの場合
    echo $home;
    echo '<li>ページが見つかりません</li>';
    }
    echo "</ul>";
}

// アーカイブの余計なタイトルを削除
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_month() ) {
        //$title = single_month_title( '', false );
        $title = get_the_date('Y年n月');
    }
    return $title;
});

//最近の投稿　ウィジェットにカスタム投稿タイプも取得できるようにする
Class My_Widget extends WP_Widget_Recent_Posts
{
  private function set_post_type(){
    //default post
    $args = array(
      'public' => true,
      '_builtin' =>true
    );
    $post_types = get_post_types($args,'objects');
    unset($post_types['page']);
    unset($post_types['attachment']);

    //custom post
    $args = array(
      'public' => true,
      '_builtin' =>false
    );
    $custom_post_types = get_post_types($args,'objects');

    $post_types = array_marge($post_types,$custom_post_types);

    return (array) $post_types;

  }
}

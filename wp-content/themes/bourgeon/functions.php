<?php
if ( ! isset( $content_width ) ) {
  $content_width = 700;
}

//======================================================================
// 1. Theme set up
//======================================================================
if ( ! function_exists( 'bourgeon_setup' ) ) {
  function bourgeon_setup() {
    // タイトルタグを出力します
    add_theme_support( 'title-tag' );

    // アイキャッチを使用できるようにします。
    add_theme_support( 'post-thumbnails' );

    // アイキャッチ画像のサイズを設定します
    set_post_thumbnail_size( 200, 200, true );

    // アップロードした画像のサムネイルのサイズを設定します
    add_image_size( 'medium_thumbnail',240, 240, true );
    add_image_size( 'large_thumbnail',320, 320, true );

    // フィードのリンクを出力します
    add_theme_support( 'automatic-feed-links' );

    // エディタースタイル
    add_editor_style();

    // カスタムメニューの位置を定義します
    register_nav_menus(
      array(
        'utility' => 'ユーティリティナビ',
        'global'  => 'グローバルナビ',
        'footer'  => 'フッターナビ',
      )
    );

    // カスタムヘッダー
    $custom_header_support = array(
      'width'               => 1000,
      'height'              => 450,
      'header-text'         => false,
      'default-image'       => get_template_directory_uri() . '/images/default_header.jpg',
      'admin-head-callback' => 'admin_header_style',
    );
    add_theme_support( 'custom-header', $custom_header_support );
  }
}
add_action( 'after_setup_theme', 'bourgeon_setup' );

function bourgeon_admin_header_style() {
?>
  <style type="text/css">
    #headimg {
      max-width: <?php echo get_custom_header()->width; ?>px;
      height: <?php echo get_custom_header()->height; ?>px;
    }
  </style>
<?php
}

//======================================================================
// 2. Enqueues scripts and styles.
//======================================================================

function bourgeon_scripts() {
  wp_enqueue_style( 'bourgeon-style', get_stylesheet_uri() );
  wp_enqueue_script( 'bourgeon-html5', get_template_directory_uri() . '/js/html5shiv.js', array() );
}
add_action( 'wp_enqueue_scripts', 'bourgeon_scripts' );

//======================================================================
// 3. Create post type and taxonomies
//======================================================================

function bourgeon_create_post_type() {
  register_post_type( 'product',
    array(
      'labels' => array(
         'name'          => '商品',
         'singular_name' => '商品',
      ),
      'public'        => true,
      'menu_position' => 5,
      'has_archive'   => true,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'custom-fields',
      ),
    )
  );

  register_post_type( 'seminar',
    array(
      'labels' => array(
        'name'          => 'セミナー情報',
        'singular_name' => 'セミナー情報',
      ),
      'public' => true,
      'menu_position' => 5,
      'has_archive'   => true,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'custom-fields',
      ),
    )
  );

  register_post_type( 'info',
    array(
      'labels' => array(
        'name'          => 'お知らせ',
        'singular_name' => 'お知らせ',
      ),
      'public'        => false,
      'show_ui'       => true,
      'menu_position' => 5,
      'has_archive'   => true,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
      ),
    )
  );
}
add_action( 'init', 'bourgeon_create_post_type', 1 );

function bourgeon_create_taxonomies() {
  $labels = array(
    'name'          => '商品の分類',
    'singular_name' => '商品の分類',
  );

  register_taxonomy( 'type', array( 'product' ),
    array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
    )
  );

  // セミナーにタグのように階層で分類できないタクソノミーを追加
  $labels = array(
    'name'          => 'セミナーの対象',
    'singular_name' => 'セミナーの対象',
  );

  register_taxonomy( 'target', array( 'seminar' ),
    array(
      'hierarchical' => false,
      'labels'       => $labels,
      'show_ui'      => true,
    )
  );
}
add_action( 'init', 'bourgeon_create_taxonomies', 0 );

//======================================================================
// 3. Register sidebar
//======================================================================

function bourgeon_widgets_init() {
  register_sidebar(
    array(
      'name'           => 'サイドバーウィジェットエリア',
      'id'             => 'primary-widget-area',
      'description'    => 'サイドバーのウィジェットエリア',
      'before_widget'  => '<aside id="%1$s" class="widget-container %2$s">',
      'after_widget'   => '</aside>',
      'before_title'   => '<h3 class="widget-title">',
      'after_title'    => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'           => 'おすすめウィジェットエリア',
      'id'             => 'feature-widget-area',
      'description'    => 'トップページ上部のウィジェットエリア',
      'before_widget'  => '<section id="%1$s" class="widget-container %2$s">',
      'after_widget'   => '</section>',
      'before_title'   => '<h2 class="widget-title">',
      'after_title'    => '</h2>',
    )
  );
}
add_action( 'widgets_init', 'bourgeon_widgets_init' );

//======================================================================
// 2. Create post type and taxonomies
//======================================================================

if ( ! function_exists( 'bourgeon_comment' ) ) :
  function bourgeon_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case '' :
?>
              <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>">
                  <div class="comment-author vcard">
<?php
        echo get_avatar( $comment, 40 );
        printf( '<cite class="fn">%s</cite>', get_comment_author_link() );
?>
                  </div><!-- .comment-author .vcard -->
<?php
        if ( $comment->comment_approved == '0' ) :
?>
                  <em class="comment-awaiting-moderation"><?php echo 'このコメントは管理者の承認待ちです。'; ?></em>
                  <br>
<?php
        endif;
?>
                  <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<?php
        echo get_comment_date() . ' at ' . get_comment_time(); ?></a><?php edit_comment_link( '編集', ' ' );
?>
                  </div><!-- .comment-meta .commentmetadata -->
                  <div class="comment-body"><?php comment_text(); ?></div>
                  <div class="reply">
<?php
        comment_reply_link(
          array_merge(
            $args, array(
              'depth'     => $depth,
              'max_depth' => $args['max_depth'],
            )
          )
        );
?>
                  </div><!-- .reply -->
                </div><!-- #comment-##  -->
<?php
        break;
      case 'pingback'  :
      case 'trackback' :
?>
              <li class="post pingback">
                <p>ピンバック： <?php comment_author_link(); ?><?php edit_comment_link( '編集', ' ' ); ?></p>
<?php
        break;
    endswitch;
  }
endif;

//======================================================================
// 2.Other functions
//======================================================================

function bourgeon_page_body_id() {
  if ( is_page() ) {
    global $post;
    if ( $post->ancestors ) {
      $root = $post->ancestors[count( $post->ancestors ) - 1];
      $root_post = get_post( $root );
      $body_id = esc_attr( $root_post->post_name );
    } else {
      $body_id = esc_attr( $post->post_name );
      }
   echo 'id="' . $body_id . '"';
  }
}

function bourgeon_add_page_body_class( $classes ) {
  if ( is_page() ) {
    global $post;
    $classes[] = esc_attr( $post->post_name );
  }
  return $classes;
}
add_filter( 'body_class', 'bourgeon_add_page_body_class' );

function bourgeon_is_subpage() {
  global $post;
  if ( is_page() && $post->post_parent ) {
    return $post->post_parent;
  } else {
    return false;
  };
}

function bourgeon_new_excerpt_more( $more ) {
  return '  ・・・<a class="more" href="' . get_permalink() . '">続きを読む</a>';
}
add_filter( 'excerpt_more', 'bourgeon_new_excerpt_more' );

function bourgeon_remove_more_link_scroll( $link ) {
  $link = preg_replace( '/#more-[0-9]+/', '', $link );
  return $link;
}
add_filter( 'the_content_more_link', 'bourgeon_remove_more_link_scroll' );

function bourgeon_my_connection_types() {
if ( !function_exists( 'p2p_register_connection_type' ) ) {
  return;
}
  p2p_register_connection_type(
    array(
      'name' => 'posts_to_pages',
      'from' => 'post',
      'to'   => 'page',
    )
  );
}
add_action( 'p2p_init', 'bourgeon_my_connection_types' );

function bourgeon_archive_product_four_articles( $wp_query ) {
  if ( ! is_admin() && $wp_query->is_main_query() ) {
    if ( $wp_query->is_post_type_archive( 'product' ) ) {
      $wp_query->set( 'posts_per_page', 4 );
    }
  }
}
add_action( 'pre_get_posts', 'bourgeon_archive_product_four_articles' );

function bourgeon_bread_crumbs( $bread_crumb_arr ) {
  if ( is_tax( 'type' ) ) {
    $top = array_shift( $bread_crumb_arr );
    array_unshift(
      $bread_crumb_arr, $top, array(
        'link'  => get_post_type_archive_link( 'product' ),
        'title' => '商品一覧',
      )
    );
  } elseif ( is_singular( 'product' ) || is_post_type_archive( 'product' ) ) {
    $bread_crumb_arr[1]['title'] = '商品一覧';
  }

  return $bread_crumb_arr;
}
add_filter( 'bread_crumb_arr', 'bourgeon_bread_crumbs' );

function bourgeon_contact_shortcode() {
  $output = <<< EOF
<div class="inquiry-bnr bnr-l">
  <h2>お問い合わせ</h2>
  <p>お問い合わせはお電話、またはお問い合わせフォームよりお気軽に！</p>
  <div class="bnr-box">
    <p class="info"><span class="tel-number">TEL 03-0000-0000</span><br>営業時間　10：00〜19:00 </p>
    <div class="btn"><a href=""><span class="icon">お問い合わせフォーム</span></a></div>
  </div>
</div>
EOF;
  return $output;
}
add_shortcode( 'contact', 'bourgeon_contact_shortcode' );

function bourgeon_googlemap_protocol( $url ) {
  if ( strpos( $url, 'www.google.com/maps/' ) !== false ) {
    $url = preg_replace( '#^http://#', 'https://', $url );
  }
  return $url;
}
add_filter( 'http_external_url', 'bourgeon_googlemap_protocol' );

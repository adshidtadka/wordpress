<?php get_header(); ?>
    <div class="inner">
      <div id="content">
<?php
if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h2 class="entry-title"><?php the_title(); ?></h2>
          </header>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        </article>
<?php
  // get_template_part( 'sample/page' );
  endwhile;
endif;

// 店舗情報 shopの時のみ子ページを表示
if ( is_page( 'shop' ) ) :
?>
        <h3>支店のご案内</h3>
<?php
  $args = array(
    'post_type'   => 'page',
    'post_parent' => $post->ID,
    'orderby'     => 'menu_order',
    'order'       => 'asc',
  );
  $shop_chils_pages = new WP_Query( $args );
  if ( $shop_chils_pages->have_posts() ) :
    while ( $shop_chils_pages->have_posts() ) :
      $shop_chils_pages->the_post();
?>
        <div class="shop-list">
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <?php the_excerpt(); ?>
        </div>
<?php
    endwhile;
  endif;
endif;
wp_reset_postdata();

$args = array(
    'connected_type'  => 'posts_to_pages',
    'connected_items' => get_queried_object(),
    'nopaging'        => true,
);
$connected = new WP_Query( $args );
if ( $connected->have_posts() ) :
?>
        <h3>関連するページ</h3>
          <ul>
<?php
  while ( $connected->have_posts() ) :
    $connected->the_post();
?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
  endwhile;
?>
          </ul>
<?php
endif;
wp_reset_postdata();
?>
      </div>
<?php get_sidebar( 'page' ); ?>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

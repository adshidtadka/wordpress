      <div id="side">
        <div class="widget-area">
          <h2 class="widget-title">更新情報</h2>
<?php
$args = array(
    'post_type'      => array( 'post', 'news', 'page', 'product', 'seminar', ),
    'posts_per_page' => 5,
    'orderby'        => 'modified',
);
$modified_posts = new WP_Query( $args );
if ( $modified_posts->have_posts() ) :
?>
          <ul>
<?php
  while ( $modified_posts->have_posts() ) :
    $modified_posts->the_post();
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
          <h2 class="widget-title">商品月別アーカイブ</h2>
          <ul>
<?php
wp_get_archives( 'type=monthly&post_type=product' );
?>
          </ul>
          <h2 class="widget-title">商品の分類</h2>
          <ul>
<?php
wp_list_categories(
  array(
    'taxonomy' => 'type',
    'title_li' => '',
  )
);
?>
          </ul>
        </div>
<?php
if ( is_active_sidebar( 'primary-widget-area' ) ) :
?>
        <div id="secondary" class="widget-area">
<?php
  dynamic_sidebar( 'primary-widget-area' );
?>
        </div>
<?php
endif;
?>
      </div>

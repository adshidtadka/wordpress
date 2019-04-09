<?php get_header(); ?>
    <div class="inner">
      <div class="feature cf">
<?php
if ( is_active_sidebar( 'feature-widget-area' ) ) :
  dynamic_sidebar( 'feature-widget-area' );
endif;
?>
      </div>
<?php
$args = array(
  'post_type'      => 'product',
  'posts_per_page' => 4,
);
$product_posts = new WP_Query( $args );
if ( $product_posts->have_posts() ) :
?>
      <article class="product">
        <div class="cf">
          <h2>新着商品</h2>
<?php
  while ( $product_posts->have_posts() ) :
    $product_posts->the_post();
?>
          <div class="product-list">
            <a href="<?php the_permalink(); ?>">
              <div class="product-info">
                <h3><?php the_title(); ?></h3>
                <div class="product-image">
<?php
    $product_photo = get_field( 'product-photo01' );
    $product_photo_thum = $product_photo['sizes'];
    if ( get_field( 'product-photo01' ) ) :
?>
                  <img src="<?php echo esc_url( $product_photo_thum['medium_thumbnail'] ); ?>" alt="<?php echo esc_attr( $product_photo['alt'] ); ?>">
<?php
    else :
?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/no-image240.png" alt="準備中">
<?php
    endif;
?>
                </div>
              </div>
            </a>
          </div>
<?php
  endwhile;
  wp_reset_postdata();
?>
        </div>
        <p class="right"><a href="/product/">商品一覧を見る</a></p>
      </article>
<?php
endif;
?>
      <div class="information cf">
<?php
$args = array(
  'post_type'      => 'seminar',
  'posts_per_page' => 4,
);
$seminar_posts = new WP_Query( $args );
if ( $product_posts->have_posts() ) :
?>
       <article  class="seminar">
          <h2>セミナー情報</h2>
          <dl>
<?php
  while ( $seminar_posts->have_posts() ) :
    $seminar_posts->the_post();
    $terms = get_the_terms( $post->ID, 'target' );
?>
            <dt>
<?php
  if ( ! is_wp_error( $terms ) && $terms ) :
    foreach ( $terms as $term ) :
?>
              <span class="label seminar-<?php echo $term->slug; ?>"><?php echo $term->name; ?></span>
<?php
    endforeach;
  endif;
  if ( get_field( 'seminar-date' ) ) :
?>
              <span class="date">開講日：<?php echo esc_html( get_field( 'seminar-date' ) ); ?></span>
<?php
  endif;
?>
            </dt>
            <dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
<?php
  endwhile;
  wp_reset_postdata();
?>
          </dl>
        </article>
<?php
endif;
?>
<?php
$args = array(
  'post_type'      => 'info',
  'posts_per_page' => 3,
);
$news_posts = new WP_Query( $args );
if ( $news_posts->have_posts() ) :
?>
        <article class="news">
          <h2>ニュース</h2>
          <dl>
<?php
  while ( $news_posts->have_posts() ) :
    $news_posts->the_post();
?>
            <dt><span class="date"><?php the_time( 'Y.m.d' ); ?></span></dt>
            <dd><?php the_content(); ?></dd>
<?php
  endwhile;
  wp_reset_postdata();
?>
          </dl>
<?php
endif;
?>
<?php
$args = array(
  'post_type'      => 'post',
  'posts_per_page' => 2,
);
$blog_posts = new WP_Query( $args );
if ( $blog_posts->have_posts() ) :
?>
          <h2>ブログ</h2>
          <dl>
<?php
  while ( $blog_posts->have_posts() ) :
    $blog_posts->the_post();
?>
            <dt><span class="date">
<?php
  if ( $blog_posts->current_post < 1 ) :
?>
            <span class="label new">New!</span>
<?php
  endif;
?>
            <?php the_time( 'Y.m.d' ); ?></span></dt>
            <dd><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></dd>
<?php
  endwhile;
  wp_reset_postdata();
?>
          </dl>
<?php
endif;
?>
        </article>
      </div>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

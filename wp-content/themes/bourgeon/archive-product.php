<?php get_header(); ?>
    <header class="page-header">
      <div class="inner">
<?php
if ( is_tax() ) :
?>
        <h1 class="page-title">「<?php single_term_title(); ?>」の一覧</h1>
<?php
else :
?>
        <h1 class="page-title">商品一覧</h1>
<?php
endif;
?>
      </div>
    </header>
    <div class="inner">
      <div id="content">
<?php
if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          </header>
<?php
    $product_photo = get_field( 'product-photo01' );
    $product_photo_thum = $product_photo['sizes'];
?>
          <div class="product-photo-thumbnail">
<?php
    if ( $product_photo ) :
?>
            <img src="<?php echo esc_url( $product_photo_thum['thumbnail'] ); ?>" alt="<?php echo esc_attr( $product_photo['alt'] ); ?>">
<?php
    else:
?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="準備中">
<?php
    endif;
?>
          </div>
          <div class="entry-content">
<?php
    if ( get_field( 'product-lead' ) ) :
?>
            <p class="product-lead"><?php echo esc_html( get_field( 'product-lead' ) ); ?></p>
<?php
    endif;
?>
            <div class="terms">
<?php
    $terms = get_the_terms( $post->ID, 'type' );
    if ( ! is_wp_error( $terms ) && $terms ) :
      foreach ( $terms as $term ) :
?>
              <span class="label product-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></span>
<?php
      endforeach;
    endif;
?>
            </div>
            <?php the_excerpt(); ?>
          </div>
        </article>
<?php
  endwhile;
endif;
?>
<?php
if ( $wp_query->max_num_pages > 1 ) :
?>
        <div class="navigation">
<?php
  if ( ( ! get_query_var( 'paged' ) && 1 == $wp_query->max_num_pages ) || ( get_query_var( 'paged' ) < $wp_query->max_num_pages ) ) :
?>
          <div class="alignleft"><?php next_posts_link( '&laquo; 前へ' ); ?></div>
<?php
  endif;
  if ( get_query_var( 'paged' ) ) :
?>
          <div class="alignright"><?php previous_posts_link( '次へ &raquo;' ); ?></div>
<?php
  endif;
?>
        </div>
<?php
endif;
?>
      </div>
<?php get_sidebar(); ?>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

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
            <p class="product-lead"><?php echo esc_html( get_field( 'product-lead' ) ); ?></p>
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
          </header>
          <section class="entry-content">
<?php
    $product_photo01 = get_field( 'product-photo01' );
    $product_photo02 = get_field( 'product-photo02' );
    $product_photo03 = get_field( 'product-photo03' );
?>
            <div class="product-detailed">
              <div class="product-photo">
                <div class="product-photo-big">
<?php
    if ( $product_photo01 ) :
?>
                  <img src="<?php echo esc_url( $product_photo01['url'] ); ?>" alt="<?php echo esc_attr( $product_photo01['alt'] ); ?>">
<?php
    else :
?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/no-image310.jpg" alt="No image">
<?php
    endif;
?>
                </div>
                <div class="product-photo-small">
<?php
      if ( $product_photo02 ) :
?>
                  <img src="<?php echo esc_url( $product_photo02['url'] ); ?>" alt="<?php echo esc_attr( $product_photo02['alt'] ); ?>">
<?php
    else :
?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/no-image156.jpg" alt="No image">
<?php
    endif;
?>
<?php
      if ( $product_photo03 ) :
?>
                  <img src="<?php echo esc_url( $product_photo03['url'] ); ?>" alt="<?php echo esc_attr( $product_photo03['alt'] ); ?>">
<?php
    else :
?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/no-image156.jpg" alt="No image">
<?php
      endif;
?>
                </div>
              </div>
              <div class="product-info">
                <?php the_content(); ?>
              </div>
            </div>
<?php
    if ( get_field( 'product-price' ) || get_field( 'product-color' ) || get_field( 'product-size' ) ) :
?>
            <h2>商品詳細</h2>
            <table class="details">
<?php
      if ( get_field( 'product-price' ) ) :
?>
              <tr>
                <th>値段</th>
                <td><?php echo esc_html( get_field( 'product-price' ) ); ?>円</td>
              </tr>
<?php
      endif;
      if ( get_field( 'product-color' ) ) :
?>
              <tr>
                <th>カラー</th>
                <td><?php echo esc_html( get_field( 'product-color' ) ); ?></td>
              </tr>
<?php
      endif;
      if ( get_field( 'product-size' ) ) :
?>
              <tr>
                <th>サイズ</th>
                <td><?php echo esc_html( get_field( 'product-size' ) ); ?></td>
              </tr>
<?php
      endif;
?>
            </table>
<?php
    endif;
?>
            <p class="right"><a href="/product/">商品一覧へ</a></p>
          </section>
        </article>
<?php
  endwhile;
endif;
?>
      </div>
<?php get_sidebar(); ?>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

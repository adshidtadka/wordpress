<?php get_header(); ?>
    <header class="page-header">
      <div class="inner">
        <h1 class="page-title">セミナー情報</h1>
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
<?php
    $terms = get_the_terms( $post->ID, 'target' );
    if ( ! is_wp_error( $terms ) && $terms ) :
      foreach ( $terms as $term ) :
?>
            <span class="label seminar-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></span>
<?php
      endforeach;
    endif;
?>
          </header>
          <div class="entry-content">
            <div class="alignleft">
<?php
    if ( has_post_thumbnail() ) :
      the_post_thumbnail( 'thumbnail' );
    else :
?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="準備中">
<?php
    endif;
?>
            </div>
<?php
    if ( get_field( 'seminar-date' ) ) :
?>
            <p class="info">開講日 : <?php echo esc_html( get_field( 'seminar-date' ) ); ?></p>
<?php
    endif;
?>
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

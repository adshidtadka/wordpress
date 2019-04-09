<?php get_header(); ?>
    <div class="inner">
      <div id="content">
<?php
if ( have_posts() ) :
  while ( have_posts() ) :
    the_post()
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="terms">
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
            </div>
          </header>
          <section class="entry-content">
            <?php the_content(); ?>
<?php
    if ( get_field( 'seminar-date' ) || get_field( 'seminar-time' ) || get_field( 'seminar-lecturer' ) || get_field( 'seminar-place' ) || get_field( 'seminar-map' ) || get_field( 'seminar-price' ) ) :
?>
            <h3>セミナー詳細</h3>
            <table class="details">
<?php
      if ( get_field( 'seminar-date' ) ) :
?>
              <tr>
                <th>開講日</th>
                <td><?php echo esc_html( get_field( 'seminar-date' ) ); ?></td>
              </tr>
<?php
      endif;
      if ( get_field( 'seminar-time' ) ) :
?>
              <tr>
                <th>時間</th>
                <td><?php echo esc_html( get_field( 'seminar-time' ) ); ?></td>
              </tr>
<?php
      endif;
      if ( get_field( 'seminar-lecturer' ) ) :
?>
              <tr>
                <th>講師</th>
                <td><?php echo esc_html( get_field( 'seminar-lecturer' ) ); ?></td>
              </tr>
<?php
      endif;
      if ( get_field( 'seminar-place' ) ) :
?>
              <tr>
                <th>場所</th>
                <td><?php echo esc_html( get_field( 'seminar-place' ) ); ?></td>
              </tr>
<?php
      endif;
      if ( get_field( 'seminar-map' ) ) :
?>
              <tr>
                <th>地図</th>
                <td><?php echo apply_filters( 'the_content', get_field( 'seminar-map' ) ); ?></td>
              </tr>
<?php
      endif;
      if ( get_field( 'seminar-price' ) ) :
?>
              <tr>
                 <th>受講料</th>
                <td><?php echo esc_html( get_field( 'seminar-price' ) ); ?></td>
              </tr>
<?php
      endif;
?>
            </table>
<?php
    endif;
?>
          </section>
          <nav id="nav-below" class="navigation" >
            <ul>
              <?php previous_post_link( '<li class="nav-previous">%link</li>', '&laquo; %title' ); ?>
              <?php next_post_link( '<li class="nav-next">%link</li>', '%title &raquo;' ); ?>
            </ul>
          </nav>
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

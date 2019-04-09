<?php get_header(); ?>
<?php
if ( have_posts() ) :
?>
    <header class="page-header">
      <div class="inner">
        <h1 class="page-title">Blog</h1>
      </div>
    </header>
    <div class="inner">
      <div id="content">
<?php
  while ( have_posts() ) :
    the_post();
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-meta">
              <span class="icon genericon-month"><?php the_time( get_option( 'date_format' ) ); ?></span> |
              <span class="icon genericon-user"><?php the_author(); ?></span>
            </div>
          </header>
          <div class="entry-content cf">
            <?php the_content( '続きを読む &raquo;', true ); ?>
          </div>
          <footer class="entry-footer">
            <div class="entry-meta">
              <span class="cat-links"><span class="genericon genericon-category"></span><?php the_category( ', ' ); ?></span>
              <span class="tag-links"><?php the_tags( ' | <span class="genericon genericon-tag"></span>', ', ' ); ?></span>
            </div>
          </footer>
        </article>
<?php
  endwhile;
  if( $wp_query->max_num_pages > 1 ) :
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
<?php
endif;
?>
<?php get_sidebar(); ?>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

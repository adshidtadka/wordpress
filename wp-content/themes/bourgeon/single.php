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
            <div class="entry-meta">
              <div class="entry-date">
                <span class="genericon genericon-month"></span><?php the_time( get_option( 'date_format' ) ); ?> | <span class="genericon genericon-user"></span><?php the_author(); ?>
                </div>
            </div>
          </header>
          <div class="entry-content">
            <?php the_content(); ?>
<?php
    if ( $post->weather ) :
?>
            <h3>カスタムフィールド「今日の天気」を取得</h3>
            <p><?php echo esc_html( $post->weather ); ?></p>
<?php
    endif;
    if ( $post->books ) :
?>
            <h3>カスタムフィールド「読んだ本」を取得</h3>
            <p><?php echo esc_html( $post->books ); ?></p>
<?php
    endif;
?>
<?php
    wp_link_pages( 'before=<nav class="pages-link">&after=</nav>&link_before=<span>&link_after=</span>' );
?>
          </div>
<?php
    if ( is_singular( 'post' ) ) :
?>
          <footer class="entry-footer">
            <div class="entry-meta">
              <span class="cat-links"><span class="genericon genericon-category"></span><?php the_category( ', ' ); ?></span>
              <span class="tag-links"><?php the_tags( ' | <span class="genericon genericon-tag"></span>', ', ' ); ?></span>
            </div>
          </footer>
<?php
    endif;
?>
        </article>
        <nav id="nav-below" class="navigation" >
          <ul>
            <?php previous_post_link( '<li class="nav-previous">%link</li>', '&laquo; %title' ); ?>
            <?php next_post_link( '<li class="nav-next">%link</li>', '%title &raquo;' ); ?>
          </ul>
        </nav>
<?php
    comments_template( '', true );
  endwhile;
endif;
$current_tags = get_the_tags();
if ( $current_tags ) :
  foreach ( $current_tags as $tag ) {
    $current_tag_list[] = $tag->term_id;
  }

  $args = array(
    'tag__in'        => $current_tag_list,
    'post__not_in'   => array( $post->ID ),
    'posts_per_page' => 5,
  );
  $related_posts = new WP_Query( $args );

  if( $related_posts->have_posts() ) :
?>
        <h3>関連記事</h3>
          <ul id="related-posts">
<?php
    while ( $related_posts->have_posts() ) :
      $related_posts->the_post();
?>
            <li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php
    endwhile;
?>
          </ul>
<?php
  else :
?>
          <p>関連記事はありません</p>
<?php
  endif;
  wp_reset_postdata();
endif;
?>
      </div>
<?php get_sidebar(); ?>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

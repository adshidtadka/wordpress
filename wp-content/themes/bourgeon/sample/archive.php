<?php get_header(); ?>
<?php
if ( have_posts() ) :
?>
    <header class="page-header">
      <div class="inner">
        <h1 class="page-title"><?php
  if ( is_category() ) {
    echo 'カテゴリー「' . single_cat_title( '', false ) . '」の投稿一覧';
  } elseif ( is_tag() ) {
    echo 'タグ「' . single_tag_title( '', false ) . '」の投稿一覧';
  } elseif ( is_day() ) {
    echo '「' . get_the_date( 'Y年n月j日' ) . '」の投稿一覧';
  } elseif ( is_month() ) {
    echo '「' . get_the_date( 'Y年n月' ) . '」の投稿一覧';
  } elseif ( is_year() ) {
    echo '「' . get_the_date( 'Y年' ) . '」の投稿一覧';
  } elseif ( is_tax() ) {
    echo '「' . single_term_title( '', false ) . '」の一覧';
  } elseif ( is_search() ) {
    echo '「' . get_search_query() . '」の検索結果一覧';
  } else {
    echo 'Blog';
  }
?></h1>
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
            <div class="thumbnail">
<?php
    if ( has_post_thumbnail() ) :
      the_post_thumbnail();
    else :
?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="noimage">
<?php
    endif;
?>
            </div>
            <?php the_excerpt(); ?>
          </div>
          <footer class="entry-footer">
            <div class="entry-meta">

              <span class="cat-links icon genericon-category"><?php
    $taxonomies = get_object_taxonomies( $post, 'names' );
    if ( $taxonomies ) :
      $tax_name = $taxonomies[0];
      the_terms( $post->ID, $tax_name, '', '' );
    endif;
?></span>
<?php
    if ( has_tag() ) :
?>
              <span class="tag-links"><?php the_tags( '  | <span class="icon genericon-tag">', ', ', '</span>' ); ?></span>
<?php
    endif;
?>
            </div>
          </footer>
        </article>
<?php
  endwhile;
  if ( class_exists( 'WP_SiteManager_page_navi' ) ) {
    WP_SiteManager_page_navi::page_navi( 'items=7&prev_label=前へ&next_label=次へ&first_label=最初&last_label=最後&show_num=1&num_position=after' );
  }
?>
      </div>
<?php
else :
?>
    <header class="page-header">
      <div class="inner">
        <h1 class="page-title"><?php
  if ( is_search() ) {
    echo '「' . get_search_query() . '」の検索結果はありませんでした。';
  }
?></h1>
      </div>
    </header>
    <div class="inner">
<?php
endif;
?>
<?php get_sidebar(); ?>
    </div>
  </div><!-- #main -->
<?php get_footer(); ?>

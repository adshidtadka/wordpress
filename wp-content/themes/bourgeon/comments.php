<?php
if ( post_password_required() ) {
  return;
}
?>
        <section id="comments">
<?php
if ( have_comments() ) :
?>
          <h2 id="comments-title"><span class="genericon genericon-comment"></span>コメント</h2>
            <p class="comments-info"><?php the_title(); ?>" に<?php echo number_format_i18n( get_comments_number() ); ?>件のコメントがあります</p>
            <ol class="commentlist">
<?php
  wp_list_comments(
    array(
      'callback' => 'bourgeon_comment',
    )
  );
?>
            </ol>
<?php
  if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
            <nav class="navigation">
              <ul>
                <li class="nav-previous"><?php previous_comments_link( '&larr; 古いコメント' ); ?></li>
                <li class="nav-next"><?php next_comments_link( '新しいコメント &rarr;' ); ?></li>
              </ul>
            </nav>
<?php
  endif;
  if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
          <p class="no-comments">現在コメントは受け付けておりません。</p>
<?php
  endif;
endif;
comment_form();
?>
        </section>

          <h2>デフォルトリストの例</h2>
          <ul>
<?php
  wp_list_pages( );
?>
          </ul>
          <h2>管理画面の「順序」に従い タイトル無しで表示</h2>
          <ul>
<?php
  wp_list_pages( 'sort_column=menu_order&title_li=' );
?>
          </ul>
          <hr>
<?php
  $ancestor = array_pop( get_post_ancestors( $post->ID ) ); //祖先ページのIDの配列から一番最後のもののIDを取得（最上位の祖先ページ）
  if ( ! $ancestor ) {
    $ancestor = $id;
  }
?>
          <h2><a href="<?php echo get_permalink( $ancestor ); ?>"><?php echo get_the_title( $ancestor ); ?></a></h2>
          <ul>
<?php
  wp_list_pages( "title_li=&child_of=$ancestor" );
  wp_list_pages( "title_li=&exclude_tree=$ancestor" );
?>
          </ul>
<?php
  if ( $post->post_parent ) {
    $parents_num = count( $post->ancestors );
    $root_id = $post->ancestors[$parents_num - 1];
  } else {
    $root_id = $post->ID;
  }
?>
          <h2><?php echo get_the_title( $root_id ); ?></h2>
          <ul>
<?php
  wp_list_pages(
    array(
      'title_li' => '',
      'include'  => $root_id,
    )
  );
  wp_list_pages(
    array(
      'title_li' => '',
      'child_of' => $root_id,
    )
  );
?>
          </ul>

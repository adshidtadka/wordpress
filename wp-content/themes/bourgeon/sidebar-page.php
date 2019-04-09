      <div id="side">
        <div class="sub-menu">
          <ul>
<?php
wp_list_pages( 'title_li=コンテンツ&exclude=' . get_option( 'page_on_front' ) );
?>
          </ul>
<?php // get_template_part( 'sample/sidebar-page-1' ); ?>
        </div>
<?php // get_template_part( 'sample/sidebar-page-2' ); ?>
      </div><!-- #side -->

  if ( is_active_sidebar( 'primary-widget-area' ) ) :
?>
        <div id="secondary" class="widget-area">
<?php
    dynamic_sidebar( 'primary-widget-area' );
?>
        </div>
<?php
  endif;
?>

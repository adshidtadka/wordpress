<?php
if ( bourgeon_is_subpage() ) :
?>
        <p>これは子ページです</p>
<?php
endif;
if ( is_page( 8 ) ) :
?>
        <p>ページID8のページの時のみ表示されます</p>
<?php
endif;

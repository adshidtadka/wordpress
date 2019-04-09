<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
<?php wp_head(); ?>
</head>
<body <?php bourgeon_page_body_id(); ?> <?php body_class(); ?>>
  <header class="site-header">
    <div class="inner">
      <div class="site-info">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
      </div>
<?php
wp_nav_menu(
  array(
    'container'      => 'nav',
    'container_id'   => 'utility-nav',
    'theme_location' => 'utility',
  )
);
?>
    </div>
  </header>

  <nav id="global-navigation">
<?php
wp_nav_menu(
  array(
    'theme_location'  => 'global',
    'container'       => 'div',
    'container_class' => 'inner',
    'depth'           =>  1,
  )
);
?>
  </nav>

<?php
if ( is_front_page() ) :
?>
  <div id="header-image">
    <div class="inner">
      <img src="<?php header_image(); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="">
    </div>
  </div>
<?php
endif;
?>

  <div id="main">
<?php
if ( ! is_front_page() ) :
?>
    <div class="bread">
      <div class="inner">
<?php
  if ( class_exists( 'WP_SiteManager_bread_crumb' ) ) {
    WP_SiteManager_bread_crumb::bread_crumb( 'home_label=トップ&indent=2' );
  }
?>
      </div>
    </div>
<?php
endif;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>
    <?php bloginfo("name"); ?>
    <?php wp_title(); ?>
  </title>

  <meta name="viewpoint" content="width=device-width" , initial-scale=1.0>

  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet" type='text/css'>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="siteinfo">
      <div class="container">
        <h1>
          <a href="<?php echo home_url(); ?>">
            <?php bloginfo("name"); ?>
          </a>
        </h1>
        <p>
          <?php bloginfo("description"); ?>
        </p>
      </div>
    </div>
    <?php if( !is_front_page()): ?>
    <?php if (get_header_image()): ?>
    <img src="<?php header_image(); ?>" width="<?php echo get_custom_header() ->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="backgroud image">
    <?php endif; ?>
    <?php endif ; ?>

    <div class="container">
      <nav>
        <?php wp_nav_menu('theme_location=navigation'); ?>
      </nav>
    </div>
  </header>

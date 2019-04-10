<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>
    <?php bloginfo("name"); ?>
    <?php wp_title(); ?>
  </title>

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
  </header>

  <div class="container">
    <?php if(have_posts()): while (have_posts()): the_post(); ?>
    <article <?php post_class(); ?>>

      <h1><?php the_title(); ?></h1>

      <?php the_content(); ?>

    </article>

    <?php endwhile; endif; ?>
  </div>
  <!-- container -->

  <footer>
    <div class="container">
      <small>
        Copyright &copy; <?php bloginfo("name"); ?>
      </small>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>

</html>

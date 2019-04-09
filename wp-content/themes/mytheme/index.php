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
        <?php if (is_category()):?>
            <h1 class="archive-title">
                <i class="fa fa-folder-open"></i>
                <?php single_cat_title(); ?>
            </h1>
        <?php endif; ?>

        <?php if(is_month()): ?>
            <h1 class="archive-title">
                <i class="fa fa-clock"></i>
                <?php echo get_the_date('Y月n日'); ?>に投稿した記事
            </h1>
        <?php endif ?>

        <?php if(have_posts()): while (have_posts()): the_post(); ?>
        <article <?php post_class(); ?>>

            <?php if(is_single()): ?>
                <h1><?php the_title(); ?></h1>
            <?php else: ?>
                <h1>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h1>
            <?php endif; ?>

            <div class="postinfo">
                <i class="fa fa-clock"></i>
                <time datetime="<?php echo get_the_date("Y-m-d") ?>">
                    <?php echo get_the_date(); ?>
                    <?php the_time(); ?>
                </time>

                <span class="postcat">
                    <i class="fa fa-folder-open"></i>
                    <?php the_category(","); ?>
                </span>

                <span class="postcom">
                    <i class="fa fa-comment"></i>
                    <a href="<?php comments_link(); ?>">
                        <?php comments_number(
                            'コメント',
                            'コメント(1件)',
                            'コメント(%件)'
                        ); ?>
                    </a>
                </span>
            </div>

            <?php the_content(); ?>

            <?php if(is_single()): ?>
                <div class="pagenav">
                    <span class="old">
                        <?php previous_post_link(
                            '%link',
                            '<i class="fas fa-chevron-circle-left"></i> %title'
                        ); ?>
                    </span>

                    <span class="new">
                        <?php next_post_link(
                            '%link',
                            '%title <i class="fas fa-chevron-circle-right"></i>'
                        ); ?>
                    </span>
                </div>
            <?php endif; ?>

        <?php comments_template(); ?>
        </article>

        <?php endwhile; endif; ?>

        <?php if ($wp_query->max_num_pages > 1): ?>
            <div class="pagenav">
                <span class="old">
                    <?php next_posts_link(
                        '<i class="fas fa-chevron-circle-left"></i> 古い記事'
                        ); ?>
                </span>

                <span class="new">
                    <?php previous_posts_link(
                        '<i class="fas fa-chevron-circle-right"></i> 新しい記事'
                    ); ?>
                </span>
            </div>
        <?php endif; ?>

        <div class="blogmenu">
            <ul>
                <?php dynamic_sidebar(); ?>
                <li class="widget">
                    <ul>   
                        <li>
                            <a href="<?php bloginfo('rss_url'); ?>">
                                <i class="fa fa-rss-square"></i>
                                RSS
                            </a>
                        </li>
                    </ul>    
                </li>
            </ul>
        </div>
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
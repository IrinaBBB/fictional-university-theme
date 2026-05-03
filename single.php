<?php get_header(); ?>


<div class="container container--narrow page-section">
    <?php while (have_posts()):
        the_post(); ?>
    <h1>Single template</h1>
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
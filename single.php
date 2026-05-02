<?php get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>
    <h1>Single Post</h1>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
<?php get_header(); ?>


<?php pageBanner([
    'title' => 'All events',
    'subtitle' => 'See what is going on in our world',
]); ?>

    <div class="container container--narrow page-section">
        <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <?php get_template_part('template-parts/content', 'event'); ?>
        <?php endwhile; ?>
        <?php echo paginate_links(); ?>
        <hr class="section-break">
        <div>Looking for recap of past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past
                events archive.</a></div>
    </div>

<?php get_footer(); ?>
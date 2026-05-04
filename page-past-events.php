<?php get_header(); ?>
<?php pageBanner([
    'title' => 'Past Events',
    'subtitle' => 'A recap of past events'
]); ?>

    <div class="container container--narrow page-section">
        <?php $today = date('Ymd') ?>
        <?php $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            'posts_per_page' => 1,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'asc',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '<',
                    'value' => $today,
                    'type' => 'numeric'
                )
            )
        )); ?>

        <?php while ($pastEvents->have_posts()): ?>
            <?php $pastEvents->the_post(); ?>
            <?php get_template_part('template-parts/content', 'event'); ?>
        <?php endwhile; ?>
        <?php echo paginate_links(array(
            'total' => $pastEvents->max_num_pages
        )); ?>
    </div>

<?php get_footer(); ?>
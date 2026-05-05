<?php

get_header();

while (have_posts()) :
    the_post();

    pageBanner();
    ?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('campus')); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Campuses home
                </a>

                <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <?php
        $latitude = get_field('latitude') ?: 59.9139;
        $longitude = get_field('longitude') ?: 10.7522;
        ?>

        <div class="osm-map" style="height: 400px;">
            <div
                    class="marker"
                    data-lat="<?php echo esc_attr($latitude); ?>"
                    data-lng="<?php echo esc_attr($longitude); ?>">
                <h3><?php the_title(); ?></h3>
            </div>
        </div>

        <?php
        $relatedPrograms = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'related_campuses',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));
        ?>

        <?php if ($relatedPrograms->have_posts()) : ?>

            <hr class="section-break">

            <h2 class="headline headline--medium">
                Programs Available at <?php the_title(); ?>
            </h2>

            <ul class="link-list min-list">
                <?php while ($relatedPrograms->have_posts()) : ?>
                    <?php $relatedPrograms->the_post(); ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>

                <?php endwhile; ?>
            </ul>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </div>

<?php
endwhile;

get_footer();
?>
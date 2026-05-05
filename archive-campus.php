<?php get_header(); ?>

<?php
pageBanner([
    'title' => 'Our campuses',
    'subtitle' => 'We have several conveniently located campuses'
]);
?>

    <div class="container container--narrow page-section">

        <div class="campus-list">

            <?php while (have_posts()) : the_post(); ?>

                <?php
                $latitude = get_field('latitude') ?: 59.9139;
                $longitude = get_field('longitude') ?: 10.7522;
                ?>

                <div class="campus-card">

                    <div class="campus-card__content">
                        <h2 class="headline headline--small">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <p>
                            <?php
                            if (has_excerpt()) {
                                echo esc_html(get_the_excerpt());
                            } else {
                                echo esc_html(wp_trim_words(get_the_content(), 25));
                            }
                            ?>
                        </p>

                        <a class="nu gray" href="<?php the_permalink(); ?>">
                            Learn more
                        </a>
                    </div>

                    <div class="campus-card__map">
                        <div class="osm-map campus-mini-map" style="height: 180px;">
                            <div
                                    class="marker"
                                    data-lat="<?php echo esc_attr($latitude); ?>"
                                    data-lng="<?php echo esc_attr($longitude); ?>">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </div>
                    </div>

                </div>

            <?php endwhile; ?>

        </div>

        <?php echo paginate_links(); ?>

    </div>

<?php get_footer(); ?>
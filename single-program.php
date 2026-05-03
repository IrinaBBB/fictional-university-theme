<?php get_header(); ?>

<?php
while (have_posts()) :
    the_post();

    $today = date('Ymd');

    $relatedEvents = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'NUMERIC',
            ),
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            ),
        ),
    ));
    ?>

    <div class="page-banner">
        <div class="page-banner__bg-image"
             style="background-image: url(<?php echo esc_url(get_theme_file_uri('/images/ocean.jpg')); ?>)">
        </div>

        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">
                <p>Don't forget to replace me later.</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('program')); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    All Programs
                </a>

                <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <?php if ($relatedEvents->have_posts()) : ?>

            <hr class="section-break">

            <h2 class="headline headline--medium">
                Upcoming <?php the_title(); ?> Events
            </h2>

            <?php
            while ($relatedEvents->have_posts()) :
                $relatedEvents->the_post();

                $eventDate = new DateTime(get_field('event_date'));
                ?>

                <div class="event-summary">
                    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month">
                            <?php echo esc_html($eventDate->format('M')); ?>
                        </span>
                        <span class="event-summary__day">
                            <?php echo esc_html($eventDate->format('d')); ?>
                        </span>
                    </a>

                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h5>

                        <p>
                            <?php
                            if (has_excerpt()) {
                                echo esc_html(get_the_excerpt());
                            } else {
                                echo esc_html(wp_trim_words(get_the_content(), 18));
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
                        </p>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <p>No upcoming events related to this program.</p>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
<?php

get_header();

while (have_posts()) {
    the_post(); ?>
    <?php pageBanner([

    ]); ?>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Events home
                </a>
                <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>
        <?php
        $latitude = get_field('latitude');
        $longitude = get_field('longitude');

        if (!$latitude) {
            $latitude = 59.9139;
        }

        if (!$longitude) {
            $longitude = 10.7522;
        }
        ?>

        <div id="map" style="height: 400px;"></div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const lat = <?php echo esc_js($latitude); ?>;
                const lng = <?php echo esc_js($longitude); ?>;

                const map = L.map('map').setView([lat, lng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup('<?php echo esc_js(get_the_title()); ?>')
                    .openPopup();
            });
        </script>
    </div>
<?php }

get_footer();

?>


<?php
function pageBanner($args = [])
{
    $title = $args['title'] ?? get_the_title();
    $subtitle = $args['subtitle'] ?? get_field('page_banner_subtitle');

    if (isset($args['photo'])) {
        $bgImageUrl = $args['photo'];
    } else {
        $bgImage = get_field('page_banner_background_image');

        if ($bgImage && !is_archive() && !is_home()) {
            $bgImageUrl = $bgImage['sizes']['pageBanner'];
        } else {
            $bgImageUrl = get_theme_file_uri('/images/ocean.jpg');
        }
    }
    ?>

    <div class="page-banner">
        <div
                class="page-banner__bg-image"
                style="background-image: url('<?php echo esc_url($bgImageUrl); ?>')">
        </div>

        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($subtitle): ?>
                <div class="page-banner__intro">
                    <p><?php echo esc_html($subtitle); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php } ?>

<?php
function university_files()
{
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
//    register_nav_menu('headerMenuLocation', 'Header Menu Location');
//    register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
//    register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'university_features');


function university_adjust_queries($query)
{
    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $today = date('Ymd');

        $query->set('posts_per_page', 2);
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }

    if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {

        $query->set('orderby', 'title');
        $query->set('order', 'asc');
        $query->set('posts_per_page', -1);

    }
}

add_action('pre_get_posts', 'university_adjust_queries');
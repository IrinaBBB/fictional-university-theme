<?php

get_header();

while (have_posts()) {
    the_post(); ?>
    <?php pageBanner(); ?>

    <div class="container container--narrow page-section">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait'); ?>
                </div>
                <div class="two-thirds">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <hr class="section-break">
        <?php $relatedPrograms = get_field('related_programs') ?>

        <?php if ($relatedPrograms): ?>
            <h2 class="headline headline--medium ">Subjects taught</h2>
            <!--        --><?php //print_r($relatedPrograms); ?>
            <ul class="link-list min-list">

                <?php foreach ($relatedPrograms as $program): ?>
                    <li>
                        <a href="<?php echo get_the_permalink($program); ?>">
                            <?php echo get_the_title($program); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php }

get_footer();

?>
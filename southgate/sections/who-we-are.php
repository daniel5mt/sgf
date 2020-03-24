<?php
/**
 * Template part for displaying section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */

?>

<!-- * =============== who we are =============== * -->
<section id="<?php echo esc_html(get_field('hashbang_for_who_we_are_section')) ?>"
         class="bg-primary intro-sec curve-wrap position-relative section-divider">
    <div class="container content-wrap ">

        <div class="text-white text-center intro-content">
            <?php the_field('quote') ?>
        </div>

        <h2 class="text-white mb-4"><?php echo esc_html(get_field('who_we_are_heading')) ?></h2>

        <div class="content-sec">
            <?php the_field('who_we_are_content') ?>
            <?php if (get_field('who_we_are_content_after_read_more')): ?>
                <div id="multiCollapseWhoWeAre" class="collapse">
                    <?php the_field('who_we_are_content_after_read_more') ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (get_field('who_we_are_content_after_read_more')): ?>
            <div class="text-center pb-5">
                <button type="button" class="btn btn-blue mt-3" data-toggle="collapse"
                        data-target="#multiCollapseWhoWeAre" aria-expanded="false"
                        aria-controls="multiCollapseWhoWeAre"><?php _e('Read More', 'southgate') ?>
                </button>
            </div>
        <?php endif; ?>

        <!--        TSF Council-->
        <div>
            <h3 class="line-divider"><span
                    class="bg-primary position-relative px-5"><?php echo esc_html(get_field('tsf_council_heading')) ?></span>
            </h3>
            <div class="row council-sec">
                <?php
                $users = get_field("tsf_council_members");

                if ($users): $i = 0;
                    foreach ($users as $user): ?>

                        <?php if ($i == 0): ?>
                            <div class="col-sm-6">
                                <h4><?php echo esc_html($user->display_name) ?>
                                    <span class="d-block mt-2 font-italic">
                                        <?php echo esc_html(get_field('designation', 'user_'.$user->ID)) ?>
                                    </span>
                                </h4>
                                <p><?php the_field('bio_details', 'user_'.$user->ID) ?></p>
                                <a href="<?php echo esc_url(get_author_posts_url($user->ID)) ?>" role="button"
                                   class="btn btn-white mt-3"><?php _e('Full Bio', 'southgate') ?></a>
                            </div>

                        <?php elseif ($i == 1): ?>
                            <div class="col-sm-6 pl-sm-5">
                                <h4><?php echo esc_html($user->display_name) ?>
                                    <span class="d-block mt-2 font-italic">
                                        <?php echo esc_html(get_field('designation', 'user_'.$user->ID)) ?>
                                    </span>
                                </h4>
                                <p><?php the_field('bio_details', 'user_'.$user->ID) ?></p>
                                <a href="<?php echo esc_url(get_author_posts_url($user->ID)) ?>" role="button"
                                   class="btn btn-white mt-3"><?php _e('Full Bio', 'southgate') ?></a>
                            </div>

                        <?php else: ?>
                            <div class="col-sm-4">
                                <h4><?php echo esc_html($user->display_name) ?></h4>
                                <p class="font-italic"><?php echo esc_html(get_field('designation', 'user_'.$user->ID)) ?></p>
                                <p><?php the_field('bio_details', 'user_'.$user->ID) ?></p>
                                <a href="<?php echo esc_url(get_author_posts_url($user->ID)) ?>" role="button"
                                   class="btn btn-white mt-3"><?php _e('Full Bio', 'southgate') ?></a>
                            </div>

                        <?php endif; ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </div>
        <!--        / TSF Council-->

    </div>
</section>
<!-- * =============== /who we are =============== * -->

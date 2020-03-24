<?php
/**
 * Template part for displaying section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */

?>

<!-- * =============== Signatories sec =============== * -->
<section id="<?php echo esc_html(get_field('hashbang_for_signatories_section')) ?>"
         class="bg-blue position-relative section-divider sign-sec">
    <div class="container">
        <h2 class="text-white"><?php echo esc_html(get_field('signatories_heading')) ?></h2>

        <div class="sign-sec-wrap">

            <?php // Initial Signatories Group
            $initialSignatories = get_field('initial_signatories_group');
            ?>
            <h3 class="text-primary mb-5 text-capitalize">
                <?php echo esc_html($initialSignatories['initial_signatories_heading']) ?>
            </h3>
            <?php
            $initialSignatoriesList = $initialSignatories['initial_signatories_list'];
            if ($initialSignatoriesList) :
                ?>
                <div class="row mx-auto">
                    <?php
                    foreach ($initialSignatoriesList as $item) {
                        echo '<div class="col-6 col-sm-3">';
                        echo '<h5>'.esc_html($item['name']).'</h5>';
                        echo '<p class="font-italic">'.esc_html($item['designation']).'</p>';
                        echo '<p>'.esc_html($item['place']).'</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php // Signers Group
            $signers = get_field('signers_group');
            ?>
            <h3 class="text-primary w-100 mt-5 mb-5 text-capitalize">
                <?php echo esc_html($signers['signers_heading']); ?>
            </h3>
            <?php if ($signers['show_signers']) : ?>
                <?php
                $approvedSigners = new WP_Query([
                    'post_type' => TSF_SIGNERS_CPT_SLUG,
                    'post_status' => ['publish'],
                    'posts_per_page' => 999,
                ]);
                if ($approvedSigners->have_posts()) : $i = 0;
                    $totalSigners = $approvedSigners->post_count; ?>
                    <div class="row mx-auto">
                        <?php
                        while ($approvedSigners->have_posts()) :
                            $approvedSigners->the_post();
                            $i++;

                            if ($i == 13) {
                                echo '<div id="multiCollapseSigners" class="collapse row w-100 mx-auto">';
                            }

                            $isIndividualForm = get_field('form_type') === 'individual';
                            echo '<div class="col-6 col-sm-3">';
                            if ($isIndividualForm) {
                                echo '<h5>'.esc_html(get_field('individual_name')).'</h5>';
                                echo '<p class="font-italic">'.esc_html(get_field('individual_title')).'</p>';
                                echo '<p>'.esc_html(get_field('location_city')).'</p>';
                            } else {
                                // isChurchForm
                                echo '<h5>'.esc_html(get_field('church_name')).'</h5>';
                                echo get_field('church_denomination') ?
                                    ('<p class="font-italic">'.esc_html(get_field('church_denomination')).'</p>') : '';
                                echo '<p>'.esc_html(get_field('location_city')).'</p>';
                            }
                            echo '</div>';

                            if ($totalSigners == $i && $totalSigners >= 13) {
                                echo '</div>';
                            }
                        endwhile;
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="text-center mt-5">
                <?php if ($signers['show_signers'] && isset($approvedSigners) && $approvedSigners->have_posts()) : ?>
                    <button type="button" data-backdrop="static" data-keyboard="false" class="btn btn-bg-white mx-2 px-5" data-toggle="collapse"
                            data-target="#multiCollapseSigners" aria-expanded="false"
                            aria-controls="multiCollapseSigners"><?php _e('See All Signers', 'southgate') ?>
                    </button>
                <?php endif; ?>

                <?php if ($signers['sign_now_form']) : ?>
                    <button type="button" class="btn btn-outline-primary mx-2"
                            data-toggle="modal" data-target="#sign-now">
                        <?php _e('Sign Now', 'southgate') ?>
                    </button>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<!-- * =============== /Signatories sec =============== * -->

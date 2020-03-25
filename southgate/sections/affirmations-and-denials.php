<?php
/**
 * Template part for displaying section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */

?>

<!-- * =============== affirmations-sec =============== * -->
<section id="<?php echo esc_html(get_field('hashbang_for_affirmations_&_denials_section')); ?>"
         class="container affirmations-sec section-divider">
    <h2 class="position-relative"><?php echo esc_html(get_field('affirmations_&_denials_heading')); ?></h2>

    <!-- HEADINGS -->
    <div id="accordion">

        <?php if (have_rows('a&d_group')): $headingCount = 0; $sectionCount = 0;
            while (have_rows('a&d_group')) : the_row();
                $headingCount++;

                $heading = get_sub_field('a&d_heading');
                $headingHashTag = sanitize_title($heading, 'heading-'.$headingCount);
                ?>
                <div class="card border-0 tsf-heading">

                    <div id="<?php echo $headingHashTag ?>" class="card-header">
                        <h3 class="mb-0">
                            <a class="collapsed tsf-heading-title" role="button" data-toggle="collapse"
                               href="<?php echo "/#$headingHashTag" ?>"
                               data-target="#collapse-<?php echo $headingHashTag ?>" aria-expanded="false"
                               aria-controls="collapse-<?php echo $headingHashTag ?>">
                                <?php echo esc_html($heading) ?>
                                <i class="fa fa-angle-down position-absolute" aria-hidden="true"></i>
                            </a>
                        </h3>
                    </div>
                    <div id="collapse-<?php echo $headingHashTag ?>" class="collapse tsf-heading-content"
                         data-parent="#accordion" aria-labelledby="<?php echo $headingHashTag ?>">
                        <div class="card-body px-0">

                            <!-- SUB-HEADINGS -->
                            <div id="accordion-<?php echo "$headingCount" ?>" class="inner-content-1">
                                <?php
                                // check for sub repeater rows
                                if (have_rows('a&d_sub_heading_group')): $subHeadingCount = 0;
                                    while (have_rows('a&d_sub_heading_group')) : the_row();
                                        $subHeadingCount++;

                                        $subHeading = get_sub_field('a&d_sub_heading');
                                        $subHeadingHashTag = sanitize_title($subHeading,
                                            'sub-heading-'.$subHeadingCount);
                                        $subHeadingHashTag = $headingHashTag.'-'.$subHeadingHashTag;
                                        ?>
                                        <div class="card border-0 tsf-sub-heading">

                                            <div id="<?php echo $subHeadingHashTag ?>" class="card-header">
                                                <h4 class="mb-0">
                                                    <a class="collapsed tsf-sub-heading-title" role="button"
                                                       data-toggle="collapse"
                                                       href="<?php echo "/#$subHeadingHashTag" ?>"
                                                       data-target="#collapse-<?php echo $subHeadingHashTag ?>"
                                                       aria-expanded="false"
                                                       aria-controls="collapse-<?php echo $subHeadingHashTag ?>">
                                                        <?php echo esc_html($subHeading) ?>
                                                        <i class="fa fa-angle-down position-absolute text-primary"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-<?php echo $subHeadingHashTag ?>"
                                                 class="collapse tsf-sub-heading-content"
                                                 data-parent="#accordion-<?php echo "$headingCount" ?>"
                                                 aria-labelledby="<?php echo $subHeadingHashTag ?>">
                                                <div class="card-body">

                                                    <!-- SECTIONS -->
                                                    <div id="accordion-<?php echo "$headingCount-$subHeadingCount" ?>"
                                                         class="inner-content-1-1">
                                                        <?php
                                                        $sectionsPosts = get_sub_field('a&d_sections');

                                                        if ($sectionsPosts): ?>
                                                            <?php foreach ($sectionsPosts as $post): $sectionCount++;
                                                                setup_postdata($post);

                                                                $sectionHashTag = $subHeadingHashTag.'-section-'.$sectionCount;
                                                                ?>
                                                                <div class="card border-0 tsf-section">
                                                                    <div id="<?php echo $sectionHashTag ?>"
                                                                         class="card-header">
                                                                        <h5 class="mb-0">
                                                                            <a class="collapsed text-secondary tsf-section-title"
                                                                               role="button"
                                                                               data-toggle="collapse"
                                                                               href="<?php echo "/#$sectionHashTag" ?>"
                                                                               data-target="#collapse-<?php echo $sectionHashTag ?>"
                                                                               aria-expanded="false"
                                                                               aria-controls="collapse-<?php echo $sectionHashTag ?>">
                                                                                <?php echo "Section $sectionCount" ?>
                                                                                <i class="fa fa-angle-down text-secondary position-absolute ml-3"
                                                                                   aria-hidden="true"></i>
                                                                            </a>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapse-<?php echo $sectionHashTag ?>"
                                                                         class="collapse tsf-section-content"
                                                                         data-parent="#accordion-<?php echo "$headingCount-$subHeadingCount" ?>"
                                                                         aria-labelledby="<?php echo $sectionHashTag ?>">
                                                                        <div class="card-body tooltip-wrap">
                                                                            <?php
                                                                            $sectionContent = get_the_content();

                                                                            if (have_rows('tooltip_group')):
                                                                                while (have_rows('tooltip_group')) : the_row();
                                                                                    $search = '<span class="tsf-tooltip">'.
                                                                                        get_sub_field('word').
                                                                                        '</span>';
                                                                                    $replace = '<span data-toggle="tooltip" title="<h3>  .esc_html(get_sub_field('word')).'</h3><p>'.
                                                                                        esc_html(get_sub_field('tooltip_description')).'</p>">'.
                                                                                        esc_html(get_sub_field('word')).
                                                                                        '</span>';
                                                                                    $sectionContent = str_replace($search, $replace, $sectionContent);
                                                                                endwhile;
                                                                            endif;

                                                                            echo $sectionContent;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php endforeach; ?>
                                                            <?php wp_reset_postdata(); ?>
                                                        <?php endif;      //sectionGroup ?>
                                                    </div>
                                                    <!-- / SECTIONS -->

                                                </div>
                                            </div>

                                        </div>
                                    <?php
                                    endwhile;
                                endif;     //subHeadingGroup ?>
                            </div>
                            <!-- / SUB-HEADINGS -->

                        </div>
                    </div>

                </div>
            <?php endwhile;
        endif;      //headingGroup ?>

    </div>
    <!-- / HEADINGS -->

</section>
<!-- * =============== /affirmations-sec =============== * -->

<?php
/**
 * Template part for displaying section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */

?>

<!-- * =============== Banner =============== * -->
<div class="content-wrap text-center banner-sec section-divider">
    <p><?php the_field('paragraph') ?></p>
    <div>
        <h1 class="text-primary world-mission mb-4"><?php echo esc_html(get_field('subtitle_1')) ?> 
            <span class="d-block"><?php echo esc_html(get_field('subtitle_2')) ?></span>
        </h1>
        <div>
            <?php $statement = get_field('read_the_statement_file') ?>
            <?php if ($statement['url']): ?>
                <a href="<?php echo esc_url($statement['url']) ?>" class="btn btn-blue mx-2" role="button">
                    <?php echo esc_html($statement['text']) ?>
                </a>
            <?php endif; ?>

            <?php if (get_field('sign_now_form')): ?>
                <button type="button" data-backdrop="static" data-keyboard="false" class="btn btn-outline-primary mx-2"
                        data-toggle="modal" data-target="#sign-now">
                    <?php _e('Sign Now', 'southgate') ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- * =============== /Banner =============== * -->

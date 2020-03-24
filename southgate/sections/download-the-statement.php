<?php
/**
 * Template part for displaying section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */

?>

<!-- * =============== download sec =============== * -->
<?php $file = get_field('file') ?>
<?php if ($file): ?>
    <section id="<?php echo esc_html(get_field('hashbang_for_download_the_statement_section')) ?>"
             class="bg-primary download-sec position-relative text-center parallax-bg"
             style="background-image:url('<?php echo get_template_directory_uri().'/images/bg-world.png' ?>')">
        <div class="container">
            <a href="<?php echo esc_attr($file['url']) ?>" class="btn btn-blue btn-lg" download>
                <?php echo esc_html(get_field('download_the_statement_heading')) ?>
            </a>
        </div>
    </section>
<?php endif; ?>

<!-- * =============== /download sec =============== * -->

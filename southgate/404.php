<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package southgate
 */

get_header();
?>

    <section id="primary" class="container content-area text-center">

        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'southgate'); ?></h1>

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?',
                    'southgate'); ?></p>

            <?php
            get_search_form();
            ?>

        </div><!-- .page-content -->

    </section><!-- #primary -->

<?php
get_footer();

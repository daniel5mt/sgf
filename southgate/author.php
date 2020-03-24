<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */

get_header();
?>

<?php
$currentAuthor = (get_query_var('author_name'))
    ? get_user_by('slug', get_query_var('author_name'))
    : get_userdata(get_query_var('author'));
?>

    <section id="primary" class="container content-area text-center tsf-author-content">

        <header class="page-header">
            <h1 class="page-title text-primary"><?php echo esc_html($currentAuthor->display_name) ?></h1>
            <h4><?php _e('TSF Council Member') ?></h4>
        </header>
        <div>
            <?php the_field('full_bio', 'user_'.$currentAuthor->ID) ?>
        </div>

    </section>

<?php
get_footer();

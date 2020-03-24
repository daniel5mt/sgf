<?php
/**
 * Front Page of site
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package southgate
 */
?>
<?php get_header(); ?>

<?php
get_template_part('sections/who-we-are');
get_template_part('sections/affirmations-and-denials');
get_template_part('sections/download-the-statement');
get_template_part('sections/signatories');
?>

<?php
get_footer();

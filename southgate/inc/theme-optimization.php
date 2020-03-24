<?php
/*
 * Theme Optimization
 */

add_action('wp_enqueue_scripts', 'southgate_optimization_scripts', 1);
function southgate_optimization_scripts()
{
    // Force move js to footer
    remove_action('wp_head', 'wp_print_scripts');
    //remove_action('wp_head', 'wp_print_head_scripts', 9);     //remove if g-form is not used
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    wp_deregister_script('wp-embed');
}

remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

// Remove emoji css and js
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('emoji_svg_url', '__return_false');

// Remove wp default comment widget css
add_filter('show_recent_comments_widget_style', '__return_false', 9);
// Remove Inline Style Of WordPress Gallery Shortcode
add_filter('use_default_gallery_style', '__return_false');
// Remove the WordPress version from RSS feeds
add_filter('the_generator', '__return_false');

// Remove unwanted tags from <head>
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'adjacent_posts_rel_link', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'rest_output_link_wp_head', 10);

remove_action('template_redirect', 'rest_output_link_header', 11);

remove_action('login_head', 'wp_shake_js', 12);

add_action('admin_bar_menu', function ($wp_admin_bar) {
    $wp_admin_bar->remove_menu('wp-logo');
}, 99);

// Remove un-wanted dashboard widgets
add_action('admin_init', function () {
    remove_action('welcome_panel', 'wp_welcome_panel');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');      //WordPress.com Blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');      //Other WordPress News
    remove_action('try_gutenberg_panel', 'wp_try_gutenberg_panel');
});

add_filter('admin_footer_text', '__return_empty_string');

add_action('widgets_init', function () {
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_RSS');
}, 9);

// Prevent gutenberg style to load inside theme
add_action('wp_print_styles', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}, 100);

/*
 * TinyMCE Filters
 */
add_filter('tiny_mce_before_init', function ($init, $editor_id = '') {
    $init['wpautop'] = false;
    $init['indent'] = true;
    $init['tadv_noautop'] = true;

    return $init;
}, 10, 2);

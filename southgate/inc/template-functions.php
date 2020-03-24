<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package southgate
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function southgate_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'southgate_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function southgate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'southgate_pingback_header' );

/*
 * Retrieve hierarchical Menu's listings
 */
function wp_get_menu_tree($elements, $parentId = 0)
{
    $branch = [];
    foreach ($elements as $element) {
        if ($element->menu_item_parent == $parentId) {

            $children = wp_get_menu_tree($elements, $element->ID);
            if ($children) {
                $element->children = $children;
            }
            $branch[$element->ID] = $element;
        }
    }
    return array_values($branch);
}

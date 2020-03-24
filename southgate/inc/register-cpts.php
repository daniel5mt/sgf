<?php
/*
 * Register Custom Post Types
 */

// Affirmations & Denials Post Type
add_action('init', 'cptui_register_cpt_affirmations_denials');
function cptui_register_cpt_affirmations_denials()
{
    /**
     * Post Type: Affirmations & Denials.
     */

    $labels = array(
        "name" => __("Affirmations & Denials", "southgate"),
        "singular_name" => __("Affirmations & Denials", "southgate"),
    );

    $args = array(
        "label" => __("Affirmations & Denials", "southgate"),
        "labels" => $labels,
        "description" => "Affirmations & Denials",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "rewrite" => array("slug" => "affirmations-and-denials", "with_front" => true),
        "query_var" => true,
        "menu_position" => 21,
        "menu_icon" => "dashicons-menu",
        "supports" => array("title", "editor", "author"),
    );

    register_post_type(TSF_AFFIRMATIONSDENIALS_CPT_SLUG, $args);
}

// Signers Post Type
add_action('init', 'cptui_register_cpt_signers');
function cptui_register_cpt_signers()
{
    /**
     * Post Type: Signers.
     */

    $labels = array(
        "name" => __("Signers", "southgate"),
        "singular_name" => __("Signer", "southgate"),
    );

    $args = array(
        "label" => __("Signers", "southgate"),
        "labels" => $labels,
        "description" => "Signers",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "signers", "with_front" => false),
        "query_var" => false,
        "menu_position" => 24,
        "menu_icon" => "dashicons-businessman",
        "supports" => array("title", "thumbnail", "custom-fields"),
    );

    register_post_type(TSF_SIGNERS_CPT_SLUG, $args);
}

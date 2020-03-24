<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package southgate
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php gravity_form_enqueue_scripts(TSF_SIGN_NOW_GFORM_ID, true); ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<main>

    <?php if (is_front_page()): ?>
        <img src="<?php echo get_template_directory_uri().'/images/bg-pattern.png' ?>" alt="background-pattern"
             class="bg-pattern">
    <?php endif; ?>

    <div class="position-relative">
        <?php if (is_front_page()): ?>
            <img src="<?php echo get_template_directory_uri().'/images/circle-pattern.png' ?>" alt="circle-pattern"
                 class="circle-pattern-img d-none d-md-block">
        <?php endif; ?>

        <div class="container intro-content">
            <!-- * =============== header =============== * -->
            <header class="main-header">
                <?php
                // get menu as array
                $menu_object = wp_get_nav_menu_object('main-menu');
                $array_menu = wp_get_nav_menu_items($menu_object->term_id);
                $menu_items = wp_get_menu_tree($array_menu);
                ?>

                <nav class="navbar navbar-expand-md position-static">
                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php if (has_custom_logo()): ?>
                            <?php
                            // get logo from customizer
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                            ?>
                            <img src="<?php echo esc_url($image[0]) ?>" class="o-contain" alt="logo">
                        <?php endif; ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsHeader"
                            aria-controls="navbarsHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsHeader">
                        <ul class="navbar-nav ml-auto">
                            <?php for ($i = 0; $i < count($menu_items); $i++): ?>
                                <?php $menu_item = $menu_items[$i]; ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo esc_attr(implode(' ', $menu_item->classes)) ?>"
                                       href="<?php echo esc_url($menu_item->url) ?>" <?php echo $menu_item->target ? ' target="_blank"' : '' ?>>
                                        <?php echo esc_html($menu_item->title) ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            <li class="nav-item">
                                <button type="button" data-backdrop="static" data-keyboard="false"
                                        class="text-primary nav-link border-0 bg-transparent"
                                        data-toggle="modal" data-target="#sign-now">
                                    <?php _e('Sign Now', 'southgate') ?>
                                </button>
                            </li>
                        </ul>
                        <div id="moving-dot"></div>
                    </div>

                </nav>
            </header>
            <!-- * =============== /header =============== * -->

            <?php if (is_front_page()):
                get_template_part('sections/banner');
            endif; ?>
        </div>

        <?php if (is_front_page()): ?>
            <img src="<?php echo get_template_directory_uri().'/images/tsf.png' ?>" alt="tsf-pattern"
                 class="pattern-img d-none d-md-block">
        <?php endif; ?>
    </div>

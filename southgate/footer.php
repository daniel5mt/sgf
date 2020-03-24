<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package southgate
 */

?>
</main>

<!-- * =============== footer =============== * -->
<footer class="bg-primary section-divider position-relative footer-sec">
    <div class="container text-white d-flex">
        <div>
            <!-- for showing contact information-->
            <?php dynamic_sidebar('footer'); ?>
        </div>

        <?php
        // get menu as array
        $menu_object = wp_get_nav_menu_object('social-menu');
        $array_menu = wp_get_nav_menu_items($menu_object->term_id);
        $menu_items = wp_get_menu_tree($array_menu);
        ?>
        <div class="social-icons ml-auto">

            <?php for ($i = 0; $i < count($menu_items); $i++): ?>
                <?php $menu_item = $menu_items[$i]; ?>
                <a href="<?php echo esc_url($menu_item->url) ?>" <?php echo $menu_item->target ? ' target="_blank" rel="noopener"' : '' ?>><i
                        class="<?php echo esc_attr(implode(' ', $menu_item->classes)) ?>"></i>
                    <span class="sr-only"><?php echo esc_html($menu_item->title) ?></span>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</footer>
<!-- * =============== /footer =============== * -->

<!-- Modal -->
<?php get_template_part('template-parts/form', 'sign-up'); ?>
<!-- /Modal -->

<?php wp_footer(); ?>

</body>
</html>

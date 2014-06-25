<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/bootstrap.css
 * 2. /theme/assets/css/bootstrap-responsive.css
 * 3. /theme/assets/css/virtue.css
 * 4. /theme/assets/css/skin.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.9.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.6.2.min.js
 * 3. /theme/assets/js/plugins.js (in footer)
 * 4. /theme/assets/js/main.js    (in footer)
 */
function kadence_scripts() {
  wp_enqueue_style('kadence_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', false, "204");
  wp_enqueue_style('kadence_theme', get_template_directory_uri() . '/assets/css/virtue.css', false, "204");
global $virtue; if(isset($virtue['skin_stylesheet'])) {$skin = $virtue['skin_stylesheet'];} else { $skin = 'default.css';} 
 wp_enqueue_style('virtue_skin', get_template_directory_uri() . '/assets/css/skins/'.$skin.'', false, null);

  if (is_child_theme()) {
   wp_enqueue_style('roots_child', get_stylesheet_uri(), false, null);
  } 

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js', false, null, false);
  wp_register_script('kadence_plugins', get_template_directory_uri() . '/assets/js/plugins.js', false, '200', true);
  wp_register_script('kadence_main', get_template_directory_uri() . '/assets/js/main.js', false, null, true);
  wp_enqueue_script('jquery');
  wp_enqueue_script('modernizr');
  wp_enqueue_script('kadence_plugins');
  wp_enqueue_script('kadence_main');
  
   if(class_exists('woocommerce')) {
  wp_deregister_script('wc-add-to-cart-variation');
  wp_register_script( 'wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/add-to-cart-variation-ck.js' , array( 'jquery' ), false, '200', true );
    wp_localize_script( 'wc-add-to-cart-variation', 'wc_add_to_cart_variation_params', apply_filters( 'wc_add_to_cart_variation_params', array(
      'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ),
      'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ),
    ) ) );
  wp_enqueue_script( 'wc-add-to-cart-variation');
  }


}
add_action('wp_enqueue_scripts', 'kadence_scripts', 100);

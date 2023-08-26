<?php

function mystyle_sheet()
{
    wp_enqueue_style('my-style', get_stylesheet_directory_uri() . '/style.css', false, '2.0', 'all');
}
add_action('wp_enqueue_scripts', 'mystyle_sheet');



// register menus
function register_menus()
{
    register_nav_menus(
        array(
            'primary-menu' => __('Header Menu', 'textdomain'),
            'secondary-menu' => __('Footer Menu', 'textdomain'),
        )
    );
}
add_action('after_setup_theme', 'register_menus');


// site logo
add_theme_support('custom-logo');


// Add a custom contact method
function add_custom_contact_method($user_contact_methods)
{
    $user_contact_methods['phone_number'] = 'Phone Number';
    return $user_contact_methods;
}
add_filter('user_contactmethods', 'add_custom_contact_method');


//register sidebar
function custom_theme_register_sidebars()
{
    register_sidebar(
        array(
            'name' => 'menu_side_bar',
            // Name of the sidebar
            'id' => 'sidebar-1',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Nav Widget',
            // Name of the sidebar
            'id' => 'sidebar_2',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget2">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget2-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'custom_theme_register_sidebars');

// admin bar show
add_filter('show_admin_bar', '__return_false');


// getcategories image and title
function product_cats()
{
    $taxonomy = 'product_cat'; // WooCommerce product category taxonomy
    $args = array(
        'orderby' => 'name',
    );

    $product_categories = get_terms($taxonomy, $args);

    foreach ($product_categories as $category) {
        $image_id = get_term_meta($category->term_id, 'thumbnail_id', true); // Assuming the image is stored as 'thumbnail_id'

        if (!empty($image_id)) {
            $image_url = wp_get_attachment_url($image_id);
            echo '<div class="categoryitem">';
            echo '<a href="' . esc_url(get_term_link($category)) . '">';
            echo '<h3 class="categoryitemtitle">' . esc_html($category->name) . '</h3>';
            echo '<img src="' . esc_attr($image_url) . '" alt="Category Image">';
            echo '</a>';
            echo '<div class="categoryarrow"><a href="' . esc_url(get_term_link($category)) . '"></a></div>';
            echo '</div>';
        }
    }
}



// display individual category posts
function get_individual_category_post()
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        // To retrieve all products, set to -1
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                // Change to 'product_tag' for tags
                'field' => 'name',
                'terms' => 'smartphones',
            ),
        ),
    );

    // The Query
    $query = new WP_Query($args);

    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $data = get_the_terms(the_ID(), 'product_cat');
            echo '<pre>';
            print_r($data);
            
            // Display or manipulate product information here
            the_ID();
            the_title();
            the_post_thumbnail();

        }
    } else {
        // No posts found
    }
    // Restore original Post Data
    wp_reset_postdata();
}
?>

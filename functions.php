<?php

function mystyle_sheet()
{
    wp_enqueue_style('custom_css', get_stylesheet_directory_uri() . '/style.css', false, '2.0', 'all'); //custom css
    wp_enqueue_script('jquerysource', get_stylesheet_directory_uri() . '/assets/js/jquerysource.js');
    wp_enqueue_script('custom_js', get_stylesheet_directory_uri() . '/assets/js/custom.js'); //my custom jquery
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'mystyle_sheet');



// register menus
function register_menus()
{
    register_nav_menus(
        array(
            'primary-menu' => __('Header Menu', 'textdomain'),
            // 'secondary-menu' => __('Footer Menu', 'textdomain'),
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
    register_sidebar(
        array(
            'name' => 'Shop',
            // Name of the sidebar
            'id' => 'sidebar_3',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget3">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget3-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => 'Information',
            // Name of the sidebar
            'id' => 'sidebar_4',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget4">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget3-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => 'Preposition',
            // Name of the sidebar
            'id' => 'sidebar_5',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget5">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget3-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => 'Newsletter',
            // Name of the sidebar
            'id' => 'sidebar_6',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget6">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget3-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => 'Copyright',
            // Name of the sidebar
            'id' => 'sidebar_7',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget6">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget3-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => 'Payments',
            // Name of the sidebar
            'id' => 'sidebar_8',
            // Unique ID for the sidebar
            'description' => 'This is the main sidebar area.',
            'before_widget' => '<div class="widget6">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget3-title">',
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
        'post_per_page' => 1
    );

    $product_categories = get_terms($taxonomy, $args);

    foreach ($product_categories as $category) {
        $image_id = get_term_meta($category->term_id, 'thumbnail_id', true); // Assuming the image is stored as 'thumbnail_id'

        if (!empty($image_id)) {
            $image_url = wp_get_attachment_url($image_id);
            $background_color = get_term_meta($category->term_id, 'background_color', false);

            echo '<div class="categoryitem" style="background-color:' . $background_color[0] . ';">';
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
add_action('smartphone_products', 'get_individual_category_post');
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
            // $price = get_post_meta(get_the_ID(), '_price', true); ?>


            <?php $product = wc_get_product(get_the_ID()); /* get the WC_Product Object */?>
            <div class="bestsellerproduct">
                <div class="productimg">
                    <a href='<?php the_permalink(); ?>'>
                        <?php
                        echo get_the_post_thumbnail(get_the_ID(), array(140, 140));
                        ?>
                    </a>
                </div>
                <div class="producttitle">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
                <div class="productprice">
                    <p>
                        <?php echo $product->get_price_html(); ?>
                    </p>
                    <?php if ($product->is_type('variable')) {
                        woocommerce_variable_add_to_cart();
                    } else {
                        echo "<a class='single_product_link' href='" . $product->add_to_cart_url() . "'>add to cart</a>";
                    }
                    ?>
                </div>
            </div>



            <?php
        }
    } else {
        // No posts found
    }
    // Restore original Post Data
    wp_reset_postdata();
}
?>
<?php
// function customImageSize()
// {
//     add_image_size('custom-image', 140, 140, true);
// }
// add_action('after_setup_theme', 'customImageSize');


// function custom_modify_product_image()
// {
//     if (is_shop() || is_product_category() || is_product_tag()) {
//         add_filter('post_thumbnail_size', function ($size) {
//             return 'custom-image';
//         });
//     }
// }
// add_action('woocommerce_product_query', 'custom_modify_product_image');

?>
<?php
// latestposts get
function latestposts()
{

    $args = array(
        'post_type' => 'post',
        'post_per_page' => 3,
        'orderby' => 'date'
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="latestpost">
                <div class="postimage">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="post_content">
                    <div class="post_content_author_and_date">
                        <span class="post_content_author">
                            <?php the_author(); ?>
                        </span>
                        <span class="post_content_date">
                            <?php echo get_the_date(); ?>
                        </span>
                    </div>
                    <div class="post_content_title">
                        <h5><a href=<?php the_permalink(); ?>><?php the_title() ?></a></h5>
                    </div>
                    <div class="post_content_content">
                        <? //php the_content(); ?>
                        <?php
                        echo wp_trim_words(get_the_content(), 17, );
                        ?>
                    </div>
                    <div class="post_content_fullread">
                        <h5><a href='<?php the_permalink(); ?>'>Full Read</a></h5>
                        <div class="post_content_arrow_main">
                            <div class="content_arrow">
                                <!-- <a href=""></a> -->
                                <a class="arrow" href="<?php the_permalink(); ?>"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} ?>
<?php
function create_survey_post_type()
{
    register_post_type(
        'survey',
        array(
            'labels' => array(
                'name' => __('Surveys'),
                'singular_name' => __('Survey')
            ),
            'public' => true,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        )
    );
}
add_action('init', 'create_survey_post_type');



//  url for ajax
function enqueue_ajax_script()
{
    wp_enqueue_script('ajax-script', get_template_directory_uri() . '/js/ajax-script.js', array('jquery'), '1.0', true);
    wp_localize_script(
        'ajax-script',
        'ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            // This sets the 'ajax_url' variable
            'nonce' => wp_create_nonce('survey_nonce') // You can add a nonce for security
        )
    );
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_script');



// ajax survey wp function
add_action('wp_ajax_submit_survey', 'submit_survey'); //login walo k liye
add_action('wp_ajax_nopriv_submit_survey', 'submit_survey'); // not Registered k liye


function submit_survey()
{
    $surveyData = $_POST['survey_data'];

    $post_id = wp_insert_post(
        array(
            'post_type' => 'survey',
            'post_status' => 'publish',
            'post_title' => 'Information of ' . $surveyData[0],

        )
    );
    if ($post_id) {
        update_post_meta($post_id, 'name', $surveyData[0]);
        update_post_meta($post_id, 'raceethinicity', $surveyData[1]);
        update_post_meta($post_id, 'biological_sex', $surveyData[2]);
        update_post_meta($post_id, 'date_of_birth', $surveyData[3]);
        update_post_meta($post_id, 'zipcode', $surveyData[4]);
        update_post_meta($post_id, 'marital_status', $surveyData[5]);
        update_post_meta($post_id, 'number_of_children', $surveyData[6]);
        update_post_meta($post_id, 'education', $surveyData[7]);
        update_post_meta($post_id, 'emloyment_status', $surveyData[8]);
        update_post_meta($post_id, 'contact', $surveyData[9]);
        update_post_meta($post_id, 'email', $surveyData[10]);

        $array_result = array(
            'message' => 'Data Submitted Successfully'
        );
        wp_send_json($array_result);
    } else {
        $array_result = array(
            'message' => 'Data Not Submitted'
        );
        wp_send_json($array_result);
    }

    wp_die();
}
;
?>

<?php
// <!-- display post meta in table from custom post type -->
function getSurveydata()
{
    $args = array(
        'post_type' => 'survey',
        'order' => 'ASC',
        'post_per_page' => -1,
        // 'no_paging' => true
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()):
        while ($the_query->have_posts()):
            $the_query->the_post();
            // Content goes here ?>
            <tr>
                <td>
                    <?php echo get_field('name') ?>
                </td>
                <td>
                    <?php echo get_field('raceethinicity') ?>
                </td>
                <td>
                    <?php echo get_field('biological_sex') ?>
                </td>
                <td>
                    <?php echo get_field('date_of_birth') ?>
                </td>
                <td>
                    <?php echo get_field('zipcode') ?>
                </td>
                <td>
                    <?php echo get_field('marital_status') ?>
                </td>
                <td>
                    <?php echo get_field('number_of_children') ?>
                </td>
                <td>
                    <?php echo get_field('education') ?>
                </td>
                <td>
                    <?php echo get_field('emloyment_status') ?>
                </td>
                <td>
                    <?php echo get_field('contact') ?>
                </td>
                <td>
                    <?php echo get_field('email') ?>
                </td>
            </tr>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        // Handle the case when no posts are found
    endif;
}
?>
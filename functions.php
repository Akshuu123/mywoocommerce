<?php
@ini_set('upload_max_size', '256M');
@ini_set('post_max_size', '256M');
@ini_set('max_execution_time', '300');

use function PHPSTORM_META\type;

function mystyle_sheet()
{
    wp_enqueue_style('custom_css', get_stylesheet_directory_uri() . '/style.css'); //custom css
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
// add_theme_support('show-admin-bar');

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
            // $price = get_post_meta(get_the_ID(), '_price', true); 
?>


            <?php $product = wc_get_product(get_the_ID()); /* get the WC_Product Object */ ?>
            <div class="bestsellerproduct">
                <div class="productimg">
                    <a href='<?php the_permalink(); ?>'>
                        <?php
                        echo get_the_post_thumbnail(get_the_ID(), array(140, 140));
                        ?>
                    </a>
                </div>
                <div class="producttitle">
                    <h3><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a></h3>
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
                        <? //php the_content(); 
                        ?>
                        <?php
                        echo wp_trim_words(get_the_content(), 17,);
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



//  url for ajax table data
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
    // $upload=wp_upload_bits()
    $form_data = $_POST['form_data'];
    parse_str($form_data, $form_data);
    print_r($form_data);

    $post_id = wp_insert_post(
        array(
            'post_type' => 'survey',
            'post_status' => 'publish',
            'post_title' => 'Information of ' . $form_data['name'],

        )
    );
    if ($post_id) {
        //     // upload image
        // $file = $_FILES['file'];

        if (!empty($file['name'])) {
            $upload_overrides = array('test_form' => false);
            $uploaded_file = wp_handle_upload($filee, $upload_overrides);

            // Check for errors during upload
            if (!isset($uploaded_file['error'])) {
                // File was successfully uploaded
                $filepath = $uploaded_file['file'];

                // Assuming you have already obtained $post_id
                // ...

                // Update post meta with file information
                update_post_meta($post_id, 'file', $filepath);

                $fileurl = $uploaded_file['url']; // Use the URL directly from wp_handle_upload

                $array_result = array(
                    'message' => 'Data Submitted Successfully', $fileurl
                );
                wp_send_json($array_result);
            } else {
                echo 'Error uploading the file: ' . $uploaded_file['error'];
            }
        }

        update_post_meta($post_id, 'name', $form_data['name']);
        update_post_meta($post_id, 'raceethinicity', $form_data['race_ethnicity']);
        update_post_meta($post_id, 'biological_sex', $form_data['biological_Sex']);
        update_post_meta($post_id, 'date_of_birth', $form_data['date_of_birth']);
        update_post_meta($post_id, 'zipcode', $form_data['zipcode']);
        update_post_meta($post_id, 'marital_status', $form_data['marital_status']);
        update_post_meta($post_id, 'number_of_children', $form_data['children']);
        update_post_meta($post_id, 'education', $form_data['education']);
        update_post_meta($post_id, 'emloyment_status', $form_data['employment']);
        update_post_meta($post_id, 'contact', $form_data['contact']);
        update_post_meta($post_id, 'email', $form_data['email']);

        // upload file
        // update_post_meta($post_id, 'file', $fileurl);

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
};
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

    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
            $the_query->the_post();
            // Content goes here 
?>
            <tr>
                <td>
                    <img src="<?php echo get_field('file'); ?>">
                </td>
                <td>
                    <?php echo get_field('name'); ?>
                </td>
                <td>
                    <?php echo get_field('raceethinicity');
                    ?>
                </td>
                <td>
                    <?php echo get_field('biological_sex');
                    ?>
                </td>
                <td>
                    <?php echo get_field('date_of_birth');
                    ?>
                </td>
                <td>
                    <?php echo get_field('zipcode');
                    ?>
                </td>
                <td>
                    <?php echo get_field('marital_status');
                    ?>
                </td>
                <td>
                    <?php echo get_field('number_of_children');
                    ?>
                </td>
                <td>
                    <?php echo get_field('education');
                    ?>
                </td>
                <td>
                    <?php echo get_field('emloyment_status');
                    ?>
                </td>
                <td>
                    <?php echo get_field('contact');
                    ?>
                </td>
                <td>
                    <?php echo get_field('email');
                    ?>
                </td>
            </tr>
<?php
        endwhile;
        wp_reset_postdata();
    // Handle the case when no posts are found
    endif;
}

?>

<?php
function enqueue_custom_scripts()
{
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);
    wp_localize_script('custom-script', 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


add_action('wp_ajax_search_posts', 'search_posts_ajax');
add_action('wp_ajax_nopriv_search_posts', 'search_posts_ajax');

function search_posts_ajax()
{
    $searchTerm = $_POST['searchTerm'];

    $args = array(
        's' => $searchTerm, // parameter for search
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    // get_posts() to retrieve all posts
    $posts = get_posts($args);

    // foreach lga k post se jo cheez chaiye wo nikal li
    $response = array();
    foreach ($posts as $post) { // yha se
        $response[] = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'link' => get_permalink($post->ID),
            'imgurl' => get_the_post_thumbnail_url($post, array(100, 100))
        );
    }
    wp_send_json($response);
}
?>


<?php
// create custom rest API 
add_action('rest_api_init', 'register_custom_endpoint');
function register_custom_endpoint()
{
    //for custom posts computer post type
    register_rest_route('custom/v1', '/computers', array(
        'methods'  => 'GET',
        'permission_callback' => '__return_true',
        'callback' => 'custom_get_computer_posts',
        // 'show_in_rest'=>true
    ));
    //single post of computer post type
    // function custom_register_computer_endpoints() {
    //     register_rest_route('custom/v1', '/computers/(?P<id>[\d]+)', array(
    //         'methods'  => 'GET',
    //         'callback' => [ '$this', 'custom_get_computer_by_id_callback'],
    //         'show_in_rest'=>true
    //     ));
    // }

    //get category
    register_rest_route(
        'postss',
        '/category',
        array(
            'methods' => 'GET',
            'callback' => 'get_custom_categories',
            'permission_callback' => '__return_true',
            'show_in_rest' => true
        )
    );
}
/** Get custom post with rest */
function custom_get_computer_posts($data)
{
    $args = array(
        'post_type' => 'computer',
        'posts_per_page' => -1, // Retrieve all posts
        'post_status' => 'drafts' //draft me hai

    );

    $posts = new WP_Query($args);

    if ($posts->have_posts()) {
        // get posts of computer in loop
        while ($posts->have_posts()) {
            $posts->the_post();

            $result = array(
                'post_id' => get_the_ID(),
                'title' => get_the_title(),
                'content' => get_the_content()

            );
            $formatted_posts[] = $result;
        };
    };

    // $formatted_posts = array('testingg');

    return new WP_REST_Response($formatted_posts, 200);
}
/**Get custom single of computer post type  */
// function custom_get_computer_by_id_callback($data) {
//     $computer_id = absint($data['id']); // Get the computer ID from the request parameters
//     // Retrieve the computer post by ID
//     // $computer_post = get_post($computer_id);

//     // if (!$computer_post) {
//     //     return new WP_REST_Response(array(), 404);
//     // }

//     // $formatted_computer = array(
//     //     'id'      => $computer_post->ID,
//     //     'title'   => $computer_post->post_title,
//     //     'content' => $computer_post->post_content,
//     //     // Add more fields as needed
//     // );

//     return new WP_REST_Response($computer_id, 200);
// }

/**get custom category with rest */
function get_custom_categories($request)
{

    $categories = get_categories();
    // $response_data = array('message' => '');
    foreach ($categories as $categorie) {
        $categories_name[] = $categorie->name;
        $categories_link[] = esc_url(get_category_link($categorie->term_id));
        $categories_image[] = 'jdsflkaj';
    }

    $response = array(
        'message' => 'Api is workings',
        'categories' => array(
            'category_name' => $categories_name,
            'category_link' => $categories_link,
            'category_image' => $categories_image
        )
        // 'jay shree ram'
    );
    return rest_ensure_response([$response, $request]);
}
// link je bna http://localhost/woocommerce/wp-json/ postss/category


?>
<?php
// echo '<pre>';

function custom_theme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_theme_setup', 'custom_theme_add_woocommerce_support');




// create role
function wporg_simple_role()
{
    add_role(
        'super_admin',
        'SuperAdmin',
        array(
            'read'         => true,
            'edit_posts'   => true,
            'upload_files' => true,
        ),
    );
}

// Add the simple_role.
add_action('init', 'wporg_simple_role');

// Add custom Taxonomie
function add_custom_taxonomies()
{
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('location', 'survey', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x('Locations', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'search_items' =>  __('Search Locations'),
            'all_items' => __('All Locations'),
            'parent_item' => __('Parent Location'),
            'parent_item_colon' => __('Parent Location:'),
            'edit_item' => __('Edit Location'),
            'update_item' => __('Update Location'),
            'add_new_item' => __('Add New Location'),
            'new_item_name' => __('New Location Name'),
            'menu_name' => __('Locations'),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'locations', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));
}

add_action('init', 'add_custom_taxonomies', 0);

function this_is_data()
{
    echo '<h1> this is data</h1>';
}
add_action('mydata', 'this_is_data', 10);

// survey metabox
// Function to display the meta box content
// Function to display the custom meta box content
function custom_user_info_meta_box($post)
{
    $username = get_post_meta($post->ID, '_user_username', true);
    $user_address = get_post_meta($post->ID, '_user_address', true);
?>
    <label for="user_username">Username:</label>
    <span id="user_username" name="user_username"><?php echo esc_attr($username); ?></span>
    <br>
    <label for="user_address">User Address:</label>
    <span id="user_address" name="user_address" style="width: 100%;"><?php echo esc_attr($user_address); ?></span>
<?php
}

// Function to save the custom meta box data
function save_user_info_meta_box($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['user_username'])) {
        update_post_meta($post_id, '_user_username', sanitize_text_field($_POST['user_username']));
    }

    if (isset($_POST['user_address'])) {
        update_post_meta($post_id, '_user_address', sanitize_textarea_field($_POST['user_address']));
    }
}

// Hook to add the custom meta box
function add_user_info_meta_box()
{
    add_meta_box(
        'user_info_meta_box',
        'User Information',
        'custom_user_info_meta_box',
        'survey',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_user_info_meta_box');
add_action('save_post', 'save_user_info_meta_box');
// echo '<pre />';
// print_r(wp_upload_dir());



// test.php
function enqueue_custom_scriptss()
{
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), null, true);

    // Pass AJAX URL to script.js
    wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scriptss');

add_action('wp_ajax_custom_upload', 'custom_upload');
add_action('wp_ajax_nopriv_custom_upload', 'custom_upload');


add_theme_support('post-formats', array('aside', 'gallery'));

// Add theme support for 'align-wide'
function my_theme_setup()
{
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'my_theme_setup');


// add filter
// Define a callback function

function my_custom_content_modifier($content)
{
    // Check if it's the post with ID 123
    if (is_page('test')) {
        // Add custom text at the end of the post content
        $modified_content = $content . '<p>This content has been modified for this page.</p>' . $content;

        // Return the modified content
        return $modified_content;
    }

    // If it's not the specified post, return the original content
    return $content;
}

add_filter('the_content', 'my_custom_content_modifier');


// custom title modifier
function my_custom_title_modifiy($title)
{
    if (is_page('test')) {
        $title_len_count = strlen($title);
        $modified_content = " This is Modified " . $title . " page and title count is " . $title_len_count;
        return $modified_content;
    }
    return $title;
}
add_filter('the_title', 'my_custom_title_modifiy');


/* Custom Post Type for Computer */
function custom_post_type_computer_init()
{
    $labels = array(
        'name'                  => _x('Computers', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('Computer', 'Post type singular name', 'textdomain'),
        'menu_name'             => _x('Computers', 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x('Computer', 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New Computer', 'textdomain'),
        'new_item'              => __('New Computer', 'textdomain'),
        'edit_item'             => __('Edit Computer', 'textdomain'),
        'view_item'             => __('View Computer', 'textdomain'),
        'all_items'             => __('All Computers', 'textdomain'),
        'search_items'          => __('Search Computers', 'textdomain'),
        'parent_item_colon'     => __('Parent Computers:', 'textdomain'),
        'not_found'             => __('No Computers found.', 'textdomain'),
        'not_found_in_trash'    => __('No Computers found in Trash.', 'textdomain'),
        'featured_image'        => _x('Computer Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives'              => _x('Computer archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'insert_into_item'      => _x('Insert into Computer', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this Computer', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
        'filter_items_list'     => _x('Filter Computers list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
        'items_list_navigation' => _x('Computers list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
        'items_list'            => _x('Computers list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'Computer'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'        => true,
    );

    register_post_type('Computer', $args);
}

add_action('init', 'custom_post_type_computer_init');

/** Register Taxonomy for Computer Post Type*/
function categories_taxonomy()
{
    register_taxonomy(
        'genre',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'computer',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Genre', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'Genre',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            )
        )
    );
}
add_action('init', 'categories_taxonomy');

/**Handling Ajax */
add_action('wp_ajax_customform', 'handle_custom_form');
add_action('wp_ajax_nopriv_customform', 'handle_custom_form');

function handle_custom_form()
{
    $data = $_POST['formdata'];
    //data parse kiya
    parse_str($data, $form_data);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['SERVER_NAME'] == 'localhost') {

        //condition lgayi
        $post_data = array(
            'post_title'            => $form_data['question'],
            'post_content'          => $form_data['answer'],
            'post_status'           => 'draft', //draft kiya hai
            'post_type'             => 'computer', //mera custom post type

        );
        $post_id = wp_insert_post($post_data); //data insert kiya
        if ($post_id) {
            //remove p tag
            $content =  apply_filters('the_content', get_post_field('post_content', $post_id));
            $formatted_text = str_replace(['<p>', '</p>'], '', $content);

            // Data Submitted k baad response 
            $message = array(
                'message' => 'Data Submitted Successfully',
                'formdata' => array(
                    'question' => get_the_title($post_id),
                    'answer' => $formatted_text
                ), 'post_id' => $post_id
            );

            wp_send_json($message);
        } else {

            $message = array('message' => 'Data Not Submitted');
            wp_send_json_error($message);
        }

        // Error hanle data insert krte time
        $message = array('message' => 'Something Error while inserting Data');
        wp_send_json_error($message);
    }
}




/**custom input field form Single Product */
// function custom_input_form()
//{ ?>
    <!-- <div class="custom_input_form">
        <label for="printed_text">Printed Text</label>
        <input type="text" name="custom_text" id="custom_text">
    </div> -->
<?//php
    // return;
// }
?>
<?php
// Add engraving text field to product page
function add_engraving_text_field()
{
    echo '<label for="engraving_text">Engraving Text:</label>';
    echo '<input type="text" id="engraving_text" name="engraving_text">'; //engraving field bnayi
}
add_action('woocommerce_before_add_to_cart_button', 'add_engraving_text_field');

// Store engraving text in cart item
function store_engraving_text_in_cart($cart_item_data, $product_id, $variation_id)
{
    if (isset($_POST['engraving_text'])) {
        $cart_item_data['engraving_text'] = sanitize_text_field($_POST['engraving_text']);
    }
    return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'store_engraving_text_in_cart', 10, 3);

// validation engraving
function add_engrave_text_validation()
{
    if (empty($_REQUEST['engraving_text'])) {
        wc_add_notice(__('<b>Please Enter engraved Text<b>', 'woocommerce'), 'error');
        return false;
    }
    return true;
}
add_action('woocommerce_add_to_cart_validation', 'add_engrave_text_validation', 10, 5);

// Display engraving text on cart page
function display_engraving_text_on_cart($product_name, $cart_item, $cart_item_key)
{
    if (isset($cart_item['engraving_text'])) {
        echo '<div><b>Engraving Text:</b> ' . $cart_item['engraving_text'] . '</div>';
    }
    return $product_name;
}
add_filter('woocommerce_cart_item_name', 'display_engraving_text_on_cart', 10, 3);

// Add engraving text to order item on checkout page
function add_engraving_text_to_order_item($item, $cart_item_key, $values, $order)
{
    if (isset($values['engraving_text'])) {
        $item->add_meta_data('Engraving Text', $values['engraving_text']);
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'add_engraving_text_to_order_item', 10, 4);

function insert_empty_cart_button()
{
    // Echo our Empty Cart button
    echo '<input type="submit" class="button" name="empty_cart" value="Empty Cart" />';
};
add_action('woocommerce_proceed_to_checkout', 'insert_empty_cart_button');


// Change "Add to Cart" > "Add to Bag" in Shop Page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_shop_page_add_to_cart_callback' );  
function woocommerce_shop_page_add_to_cart_callback() {
    return __( 'Add to Quote', 'text-domain' );
}

// Change "Add to Cart" > "Add to Bag" in Single Page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_single_page_add_to_cart_callback' ); 
function woocommerce_single_page_add_to_cart_callback() {
    return __( 'Add to Quote', 'text-domain' ); 
}

// redirect to checkout page
function bbloomer_redirect_checkout_add_cart() {
   return wc_get_checkout_url();
}
add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );

// display product variations in shop page
function handsome_bearded_guy_select_variations() {
    
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
   add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', 30 );
}
add_action( 'woocommerce_before_shop_loop', 'handsome_bearded_guy_select_variations' );

// remove coupen from checkout 
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); 


// cart and checkout inline styles
add_action( 'wp_head', 'custom_inline_styles', 900 );
function custom_inline_styles(){
    if ( is_checkout() || is_cart() ){
        ?><style>
        .product-item-thumbnail { float:left; padding-right:10px;}
        .product-item-thumbnail img { margin: 0 !important;}
        dt.variation-Description { display: none;}
        </style><?php
    }
}

// Product thumbnail in checkout
add_filter( 'woocommerce_cart_item_name', 'product_thumbnail_in_checkout', 20, 3 );
function product_thumbnail_in_checkout( $product_name, $cart_item, $cart_item_key ){
    if ( is_checkout() )
    {
        $thumbnail   = $cart_item['data']->get_image(array( 80, 80));
        $image_html  = '<div class="product-item-thumbnail">'.$thumbnail.'</div> ';

        $product_name = $image_html . $product_name;
    }
    return $product_name;
}


// 

<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header>
            <div class="container">
                <div class="topnav">
                    <div class="topbar_main">
                        <div class="site_tag">
                            <p>
                                <?php bloginfo('description'); ?>
                            </p>
                        </div>
                        <div class="iconphonemain">
                            <i class="fa fa-phone"></i>
                            <div class="callnow">
                                <span>
                                    <?php echo get_user_meta(1, 'phone_number', true); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_inner">
                <div class="site-logo">
                    <?php echo the_custom_logo(); ?>
                </div>
                <nav>
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'primary-menu',
                            'menu_class' => 'headermenu'
                        )
                    ); ?>
                </nav>
                <div class="sidebar_menus">
                    <?php dynamic_sidebar('sidebar_2'); ?>
                </div>
            </div>
        </header>
<?php /* Template Name: Home */?>
<?php
get_header(); ?>

<section class="bannersection">
    <div class="container">
        <div class="bannermain">
            <div class="bannerleft">
                <div class="bannertitle">
                    <h1>
                        <?php echo get_post_meta(get_the_ID(), 'title', true); ?>
                    </h1>
                </div>
                <div class="bannerparagraph">
                    <?php the_content(); ?>
                </div>
                <div class="bannerbutton">
                    <?php
                    $link = get_field('link');
                    if ($link): ?>
                        <a class="button" href="<?php echo esc_url($link['url']); ?>">Buy Now</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bannerright">
                <?php the_post_thumbnail('thumbnail'); ?>
            </div>
        </div>

    </div>
</section>
<section class="varietyphonesection">
    <div class="container">
        <div class="varietyphone">
            <div class="varietydiv">
                <div class="varietyicon">
                    <i class="fa-sharp fa-solid fa-mobile"></i>
                </div>
                <div class="varietytitle">
                    <h4>Variety of Phones</h4>
                </div>
                <div class="varietyparagraph">
                    <p>We provide a huge selection of the best phones, tablets and earphones straight to your door.</p>
                </div>
            </div>
            <div class="varietydiv">
                <div class="varietyicon">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                </div>
                <div class="varietytitle">
                    <h4>Secured Payments</h4>
                </div>
                <div class="varietyparagraph">
                    <p>We accept all major credit and debit cards and process all orders as quickly as possible with our
                        real time ordering system.</p>
                </div>
            </div>
            <div class="varietydiv">
                <div class="varietyicon">
                    <i class="fa fa-truck"></i>
                </div>
                <div class="varietytitle">
                    <h4>Home Delievery</h4>
                </div>
                <div class="varietyparagraph">
                    <p>Once your order has been processed, you will receive your drinks very quickly..</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sectionphone -->
<section class="quickphone">
    <div class="container">
        <div class="innerquickphone">
            <div class="quicktitle">
                <h4>Quick And Easy Home Delivery</h4>
            </div>
            <div class="innerquickparagraph">
                <p>Akshay Store is premiere late night delivery company, we make it quick and convenient to get phone
                    delivered straight to your door. Skip the long queues in your store and let us deliver the new
                    technology to your door!</p>
            </div>
            <div class="innerquickbtn">
                <a class="innerquicklink" href="#">Shop Now</a>
            </div>
        </div>
    </div>
</section>
<!-- categorysection -->
<section class="categorysection">
    <div class="container">
        <div class="categoryinnsersection">
            <div class="categoryshopmain">
                <h4>Shop By Category</h4>
            </div>
            <div class="categoryshopcontent">
                <?php product_cats(); ?>
            </div>
        </div>
    </div>
</section>

<!-- one category posts -->
<section class="categorysection">
    <div class="container">
        <div class="categoryinnsersection onecategoryposts">
            <div class="categoryshopmain">
                <h4>Shop By Sellers</h4>
            </div>
            <div class="categoryshopcontent onecategorypost_main">
                <?php get_individual_category_post(); ?>
            </div>
        </div>
    </div>
</section>
<section>
    <?php get_footer(); ?>
</section>
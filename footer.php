<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<section class="footer">
	<div class="container">
		<div class="footer_columns">
			<div class="sidebar_footer">
				<?php dynamic_sidebar('sidebar_3'); ?>
				<?php dynamic_sidebar('sidebar_4'); ?>
				<?php dynamic_sidebar('sidebar_5'); ?>
				<?php dynamic_sidebar('sidebar_6'); ?>
			</div>
			<div class="footer_card">
				<div class="footer_card_reserved">
				<?php dynamic_sidebar('sidebar_7'); ?>
				</div>
				<div class="footer_card_payments">
				<?php dynamic_sidebar('sidebar_8'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
<?php wp_footer(); ?>
</body>
</html>
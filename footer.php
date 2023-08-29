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
			<div class="footer_column">
				<div class="sidebar_menus">
					<?//php $sidebarinformation=get_sidebar('sidebar_3'); 
					// print_r($sidebarinformation);
					?>
					
					<?//php dynamic_sidebar('sidebar_3'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
<?php wp_footer(); ?>
</body>

</html>
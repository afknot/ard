<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ard
 */

?>

	</div><!-- #content -->
	</div><!-- #nav-content-cols -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
		<p><?php echo get_bloginfo( 'name' ); ?> &nbsp;|&nbsp; <a href="mailto:info@ard.com">info@ard.com</a> &nbsp;|&nbsp; Baltimore, MD<br>
		Copyright &copy <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?>. All Rights Reserved. <a href="http://madewithloveinbaltimore.org" target="_blank">Made with &hearts; in Baltimore</a></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

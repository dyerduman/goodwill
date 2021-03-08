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
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- jquery library for font sizer -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- script for font sizer controls and size settings -->
		<script>
	$(document).ready(function() {
  var size = parseInt($('body, .entry-content').css('font-size').replace("px", ""), 10);
  var incrementAmount = 4;
  var increments = 4;
  $("#largerFont").click(function(){
    var curSize = parseInt($('body, .entry-content').css('font-size').replace("px", ""), 10);

    $('body, .entry-content').css('font-size', curSize + incrementAmount);
    if ((curSize + incrementAmount) >= (size + (incrementAmount * increments))) {
        $("#largerFont").prop("disabled", true);
    }
    $("#smallerFont").prop("disabled", false);

    return false;
  });
  $("#smallerFont").click(function(){
    var curSize = parseInt($('body, .entry-content').css('font-size').replace("px", ""), 10);

    $('body, .entry-content').css('font-size', curSize - incrementAmount);
    if ((curSize - incrementAmount) <= (size - (incrementAmount * increments))) {
        $("#smallerFont").prop("disabled", true);
    }
    $("#largerFont").prop("disabled", false);

    return false;
  });
});
	</script>
		<?php
		wp_body_open();
		?>
<!-- fixed superheader for accessibility controls -->
<div class="header-inner super-header">
<!-- font sizer -->
<div class="font-sizer">
    <span>Font Size:</span>
    <button id="smallerFont" title="Decrease Font Size"><sup>&#945;</sup></button>
    <button id="largerFont" title="Increase Font Size"><sup>&#945;</sup></button>
</div>
				<div class="language">
					<ul>
						<?php

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'expanded',
										)
									); ?>
					</ul>
				<!-- Google Translator plugin shortcode -->
				<?php echo do_shortcode('[google-translator]'); ?>
				</div>
			</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'twentytwentyone' ); ?></a>

	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= true === get_theme_mod( 'display_title_and_tagline', true ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>
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
<!-- fixed superheader for accessibility controls -->
<div class="header-inner super-header">
<!-- font sizer -->
<div class="font-sizer">
    <p>Font Size:</p>
    <button id="smallerFont" class="notranslate" title="Decrease Font Size"><sup>&#65;</sup></button>
    <button id="largerFont" class="notranslate" title="Increase Font Size"><sup>&#65;</sup></button>
</div>
<!-- Dark Mode aka contrast toggle  -->

	<p>Contrast:</p>
	<button id="dark-mode-toggler" class="fixed-bottom" aria-pressed="false" onclick="toggleDarkMode()"><span aria-hidden="true">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.7 28.7" role="img" aria-labelledby="high-contrast-svg-title">
<title id="high-contrast-svg-title">
Toggle High Contrast	</title>
<path d="M14.3 0C6.5 0 0 6.5 0 14.3c0 7.9 6.5 14.3 14.3 14.3 7.9 0 14.3-6.5 14.3-14.3C28.7 6.5 22.2 0 14.3 0zm0 3.6c6 0 10.8 4.8 10.8 10.8 0 6-4.8 10.8-10.8 10.8V3.6z"></path>
</svg></span></button>
<!-- for adding French and English as default languages from Appearnce > Menus > Languages  -->
				<div class="language">
					<!--<ul>
						<?php

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'secondary',
										)
									); ?>
					</ul>-->
				<!-- Google Translator plugin shortcode -->
				<?php echo do_shortcode('[google-translator]'); ?>
				</div>
			</div>
<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">

	<!--<div class="quicklinks">
		<ul>
	<?php

				wp_nav_menu(
					array(
						'container'  => '',
						'items_wrap' => '%3$s',
						'theme_location' => 'tertiary',
					)
				); ?>
			</ul>-->
			</div>
			<div class="identity">
	<?php get_template_part( 'template-parts/header/site-branding' ); ?>
	<?php get_template_part( 'template-parts/header/site-nav' ); ?>
			</div>
</header><!-- #masthead -->

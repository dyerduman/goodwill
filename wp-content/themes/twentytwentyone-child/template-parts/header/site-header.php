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
    <span>Font Size:</span>
    <button id="smallerFont" title="Decrease Font Size"><sup>&#945;</sup></button>
    <button id="largerFont" title="Increase Font Size"><sup>&#945;</sup></button>
</div>
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

	<?php get_template_part( 'template-parts/header/site-branding' ); ?>
	<?php get_template_part( 'template-parts/header/site-nav' ); ?>

</header><!-- #masthead -->

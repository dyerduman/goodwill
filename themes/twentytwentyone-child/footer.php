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
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
		<div class="site-info">
			<div class="site-name">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<?php if ( get_bloginfo( 'name' ) && get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
						<?php if ( is_front_page() && ! is_paged() ) : ?>
							<?php bloginfo( 'name' ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-name -->
			<div class="powered-by">
				<p>Copyright &copy; <?php echo date("Y");?>, <strong><em>Goodwill, the Amity Group</strong></em> </p>
				<?php
				printf(
					/* translators: %s: WordPress.
					esc_html__( 'Proudly developed to WCAG 2.0 standards by %s.', 'twentytwentyone' ),
					'<a href="' . esc_url( __( 'https://dyerduman.design/', 'twentytwentyone' ) ) . '">Dyer &amp; Duman Design</a>'
				);*/
				esc_html__( 'Proudly developed to WCAG 2.0 standards.', 'twentytwentyone' ),
				'<a href="' . esc_url( __( 'https://dyerduman.design/', 'twentytwentyone' ) ) . '">Dyer &amp; Duman Design</a>'
			);
				?>
			</div><!-- .powered-by -->
			<a id="to-the-top" href="javascript:">
				<!-- to the top -->
									<!--<span class="to-the-top-long">
										<?php
										/* translators: %s: HTML character for up arrow. */
										printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">⌃</span>' );
										?>
									</span> .to-the-top-long -->
									<!--<span class="to-the-top-short">
										<?php
										/* translators: %s: HTML character for up arrow. */
										printf( __( 'Top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">⌃</span>' );
										?>
									</span> .to-the-top-short -->
										<?php
										/* translators: %s: HTML character for up arrow. */
										printf( __( '%s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">⌃</span>' );
										?>
								</a><!-- .to-the-top -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- smooth scroll animation script -->
<script>
// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 100 //minus height of .super-header plus some white space
        }, 950, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
</script>

<!--viewport css animation script -->
<script>
$('.aos-fade-up').each(function(i) {
    $(this).attr('data-aos', 'fade-up');
});
$('.aos-duration').each(function(i) {
    $(this).attr('data-aos-duration', '900');
});
$('.aos-delay').each(function(i) {
    $(this).attr('data-aos-delay', '300');
});
$('.aos-delay-max').each(function(i) {
    $(this).attr('data-aos-delay', '1000');
});
  AOS.init();
</script>

<!-- to the top script -->
<script>
		$(document).scroll(function() {

  if ($(this).scrollTop() >= 200) {


    $('#to-the-top').fadeIn(200);
  } else {


    $('#to-the-top').fadeOut(200);
  }

});

$('#to-the-top').click(function() {
  $('body,html').animate({
    scrollTop: 0
  }, 500, 'swing');
});
</script>

<!-- JS: debounce and scroll position -->
<script type="text/javascript">
// The debounce function receives our function as a parameter
const debounce = (fn) => {

  // This holds the requestAnimationFrame reference, so we can cancel it if we wish
  let frame;

  // The debounce function returns a new function that can receive a variable number of arguments
  return (...params) => {

    // If the frame variable has been defined, clear it now, and queue for next frame
    if (frame) {
      cancelAnimationFrame(frame);
    }

    // Queue our function call for the next frame
    frame = requestAnimationFrame(() => {

      // Call our function and pass any params we received
      fn(...params);
    });

  }
};


// Reads out the scroll position and stores it in the data attribute
// so we can use it in our stylesheets
const storeScroll = () => {
  document.documentElement.dataset.scroll = window.scrollY;
}

// Listen for new scroll events, here we debounce our `storeScroll` function
document.addEventListener('scroll', debounce(storeScroll), { passive: true });

// Update scroll position for first time
storeScroll();
</script>
</body>
</html>

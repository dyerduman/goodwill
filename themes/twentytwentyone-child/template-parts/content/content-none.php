<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<section class="no-results not-found">
	<header class="page-header alignwide">
		<?php if ( is_search() ) : ?>

			<h1 class="page-title">
				<?php
				printf(
					/* translators: %s: Search term. */
					esc_html__( 'Results for "%s"', 'twentytwentyone' ),
					'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		<?php elseif (is_category('blog') || is_category('resources') || is_category('news') || is_category('workshops') || is_category('job-fairs')) :
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		} ?>
				<h1 class="page-title">Content Not Found</h1>
				<div class="tab">
					<input type="checkbox" id="chck1">
					 <label class="tab-label" for="chck1">Filter and Search</label>
		<div class="tools archives tab-content">
<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'blog',
					'menu_class'      => 'menu-wrapper',
					'container_class' => 'blog-filter',
					'items_wrap'      => '<ul>%3$s</ul>',
					'fallback_cb'     => false,
				)
			);

		?>
		<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search <strong>Community Board</strong>', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
			<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'twentytwentyone' ); ?>" />
		<input type="hidden" name="cat" id="cat" value="40" />
	</form>
</div>
</div>
		<?php else : ?>
			<?php
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>
			<h1 class="page-title"><?php esc_html_e( 'Job Positions Currently Not Available', 'twentytwentyone' ); ?></h1>
			<div class="tab">
				<input type="checkbox" id="chck1">
				 <label class="tab-label" for="chck1">Filter and Search</label>
			<div class="tools archives tab-content">
			<?php wp_nav_menu(
				array(
					'theme_location'  => 'job-board',
					'menu_class'      => 'menu-wrapper',
					'container_class' => 'blog-filter',
					'items_wrap'      => '<ul>%3$s</ul>',
					'fallback_cb'     => false,
				)
			);
		?>
		<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search Job Board', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
			<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search Jobs', 'submit button', 'twentytwentyone' ); ?>" />
			<input type="hidden" name="cat" id="cat" value="22" />
		</form>
	</div>
</div>
		<?php endif; ?>
	</header><!-- .page-header -->

	<div class="page-content default-max-width">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php
			printf(
				'<p>' . wp_kses(
					/* translators: %s: Link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwentyone' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentytwentyone' ); ?></p>
			<?php get_search_form(); ?>

		<?php elseif (is_category('blog') || is_category('resources') || is_category('news') || is_category('workshops') || is_category('job-fairs')) : ?>

			<p>There is no information currently available in this category.</p>
			<p>Please continue to monitor this page for updates, and follow <strong><em>@GoodwillAmity</strong></em> on our social media channels to stay up to date with announcements.</p>

			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul id="social" class="footer-navigation-wrapper">
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
					); ?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->


		<?php else : ?>
			<p>There are no job positions currently available in this category.</p>
			<p>Please continue to monitor this page for updates, and follow <strong><em>@GoodwillAmity</strong></em> on our social media channels to stay up to date with announcements.</p>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul id="social" class="footer-navigation-wrapper">
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
					); ?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->

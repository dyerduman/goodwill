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
<?php if (is_search() ) :
	/********
	the job board search tool 404 page content
	********/
	?>
	<header class="page-header alignwide">
		<?php yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			 ?>
			<h1 class="page-title">
				<?php
				printf(
					/* translators: %s: Search term. */
					esc_html__( 'Search results for "%s"', 'twentytwentyone' ),
					'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
</header>
<?php endif; ?>
<!-- .page-header -->
<div class="search-result-count alignwide">
			<?php if (is_search() && is_category('blog')) :
				/********
				the community board (aka blog) search tool form and filter
				********/
				?>
			<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search <strong>Community Board</strong>', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
					<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
					<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'twentytwentyone' ); ?>" />
				<input type="hidden" name="cat" id="cat" value="40" />
			</form>
			<div class="blog-filter">
				<p>Filter search results:</p>
				<ul>
					<li class="all"><a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=<?php 	printf(esc_html( get_search_query() )); ?>">All</a></li>
					<li class="blog"><a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/?s=<?php 	printf(esc_html( get_search_query() )); ?>">Community Board</a></li>
					<li class="jobs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>job-board/?s=<?php 	printf(esc_html( get_search_query() )); ?>">Job Board</a></li>
				</ul>
			</div>
			<?php endif; ?>

				<?php if (is_search() && is_category('job-board')) :
					/********
					the job board search tool form and filter
					********/
					?>
					<p>	<?php
						printf(
							esc_html(
								/* translators: %d: The number of search results. */
								_n(
									'We found %d result for your search.',
									'We found %d results for your search.',
									(int) $wp_query->found_posts,
									'twentytwentyone'
								)
							),
							(int) $wp_query->found_posts
						);
						?></p>
					<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search <strong>Job Board</strong>', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
						<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
						<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search Jobs', 'submit button', 'twentytwentyone' ); ?>" />
					<input type="hidden" name="cat" id="cat" value="22" />
				</form>
					<div class="blog-filter">
						<p>Filter search results:</p>
						<ul>
							<li class="all"><a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=<?php 	printf(esc_html( get_search_query() )); ?>">All</a></li>
							<li class="blog"><a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/?s=<?php 	printf(esc_html( get_search_query() )); ?>">Community Board</a></li>
							<li class="jobs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>job-board/?s=<?php 	printf(esc_html( get_search_query() )); ?>">Job Board</a></li>
						</ul>
					</div>
				</div>
				<?php endif; ?>
<!-- .search-count -->


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
		endif; ?>

		<?php if (is_search() && is_category('blog')) :
			/********
			the community board (aka blog) search tool 404 page content
			********/
			?>
			<div class="page-content default-max-width">
			<p>There is no information currently available matching your search terms, in this category.</p>
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
		</div><!-- .page-content -->
	<?php elseif (is_search() && is_category('job-board')) :
		/********
		the job board search tool 404 page content
		********/
		?>
			<div class="page-content default-max-width">
		<p>There are no job positions currently available matching your search terms.</p>
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
		</div> <!-- .page-content -->
<?php endif;
/********
the job board category specific 404 page content
********/
 if (!is_search() && !is_category('blog') ) : ?>
 <header class="page-header alignwide">
	 <?php
			 yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			?>
		 <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		 <h2>No Job Positions Currently Available</h2>
		 <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		 <div class="tab">
 			<input type="checkbox" id="chck1">
 			 <label class="tab-label" for="chck1">Filter and Search</label>
				 <div class="tools archives tab-content">
				 <?php
				 wp_nav_menu(
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
 			 	<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search <strong>Job Board</strong>', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
 			 	<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
 			 	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search Jobs', 'submit button', 'twentytwentyone' ); ?>" />
 			 	<input type="hidden" name="cat" id="cat" value="22" />
 			 </form>
			 </div>
		 </div>
</header>
 <div class="page-content default-max-width">
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
	</div><!-- .page-content -->
<?php elseif
/********
the site-wide search tool 404 page content
********/
 (is_search() && !is_category('blog') && !is_category('job-board') ) : ?>
 <div class="page-content default-max-width">
		<p>There is no content available that matches your search terms.</p>
		<p>Follow <strong><em>@GoodwillAmity</strong></em> on our social media channels to stay up to date with announcements.</p>
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
	</div><!-- .page-content -->

<?php endif;?>
</section><!-- .no-results -->

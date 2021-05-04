<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

if ( have_posts() ) {
	?>
	<header class="page-header alignwide">
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
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
	</header><!-- .page-header -->

	<div class="search-result-count alignwide">
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
		<?php if (!is_category('blog') && !is_category('job-board')) : ?>
			<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search <strong>All</strong>', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
					<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
					<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'twentytwentyone' ); ?>" />
			</form>
		<?php elseif (is_category('blog')) : ?>
			<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search <strong>Community Board</strong>', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
					<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
					<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'twentytwentyone' ); ?>" />
				<input type="hidden" name="cat" id="cat" value="40" />
			</form>

			<?php endif; ?>

				<?php if (is_category('job-board')) : ?>
					<form role="search" <?php echo $twentytwentyone_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form archives" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search Job Board', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
						<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
						<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search Jobs', 'submit button', 'twentytwentyone' ); ?>" />
					<input type="hidden" name="cat" id="cat" value="22" />
				</form>
				<?php endif; ?>
		<div class="blog-filter">
			<p>Filter search results:</p>
			<ul>
				<li class="all"><a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=<?php 	printf(esc_html( get_search_query() )); ?>">All</a></li>
				<li class="blog"><a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/?s=<?php 	printf(esc_html( get_search_query() )); ?>">Community Board</a></li>
				<li class="jobs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>job-board/?s=<?php 	printf(esc_html( get_search_query() )); ?>">Job Board</a></li>
			</ul>
		</div>
	</div><!-- .search-result-count -->
	<?php
	// Start the Loop.
	while ( have_posts() ) {
		the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part(
			'template-parts/content/content-excerpt',
			get_post_format()
		);

	} // End the loop.

	// Previous/next page navigation.
	twenty_twenty_one_the_posts_navigation();

	// If no content, include the "No posts found" template.
} else { ?>
	
<?php	get_template_part( 'template-parts/content/content-none' );
}

get_footer();

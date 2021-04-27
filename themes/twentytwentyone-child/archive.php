<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

	<header class="page-header alignwide">
		<?php
	if ( function_exists('yoast_breadcrumb') ) {
	  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
	}
	?>
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php if ( $description ) : ?>
			<p class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></p>
		<?php endif; ?>
		<div class="tab">
			<input type="checkbox" id="chck1">
			 <label class="tab-label" for="chck1">Filter and Search</label>
			<div class="tools archives tab-content">
		<?php
		if (is_category('blog') || is_category('resources') || is_category('news') || is_category('workshops') || is_category('job-fairs')) :
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
<?php
	elseif (get_body_class('category-job-board')) : //see "Filter: Category Parent and Child" in functions.php for all children of category-job-board
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
	<label for="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>"><?php _e( 'Search Job Board', 'twentytwentyone' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
	<input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search Jobs', 'submit button', 'twentytwentyone' ); ?>" />
	<input type="hidden" name="cat" id="cat" value="22" />
</form>
<?php endif; ?></div>
	</div>
	</header><!-- .page-header -->
<?php if (!is_category('job-board')) : ?>
<section class="posts">
<?php endif; ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); ?>
	<?php endwhile; ?>

	<?php twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>
<?php if (( is_active_sidebar( 'sidebar-2' )  ) && (is_category("job-board"))) : ?>

 <div id="post-a-job" class="widget-area" role="complementary">

  <?php dynamic_sidebar( 'sidebar-2' ); ?>

 </div>

<?php endif; ?>
<?php if (!is_category('job-board')) : ?>
</section>
<?php endif; ?>
<?php get_footer(); ?>

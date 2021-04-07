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
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
		<?php
		if (is_category('blog')) :
		wp_nav_menu(
			array(
				'theme_location'  => 'blog',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'blog-filter',
				'items_wrap'      => '<ul>%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	elseif (is_category('job-board')) :
	wp_nav_menu(
		array(
			'theme_location'  => 'job-board',
			'menu_class'      => 'menu-wrapper',
			'container_class' => 'blog-filter',
			'items_wrap'      => '<ul>%3$s</ul>',
			'fallback_cb'     => false,
		)
	); endif;
		?>
	</header><!-- .page-header -->
<section class="posts">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); ?>
	<?php endwhile; ?>

	<?php twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>
</section>
<?php get_footer(); ?>

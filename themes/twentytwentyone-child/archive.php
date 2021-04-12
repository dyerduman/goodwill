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
	elseif (is_category('job-board') || is_category('hamilton')) :
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
	<div>Search</div>
	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<input type="text" name="s" id="s" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="Enter keywords &hellip;" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"<?php } ?> /><br />

<?php $query_types = get_query_var('post_type'); ?>

<input type="checkbox" name="post_type[]" value="articles" <?php if (in_array('articles', $query_types)) { echo 'checked="checked"'; } ?> /><label>Articles</label>
<input type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_types)) { echo 'checked="checked"'; } ?> /><label>Blog</label>
<input type="checkbox" name="post_type[]" value="books" <?php if (in_array('books', $query_types)) { echo 'checked="checked"'; } ?> /><label>Books</label>
<input type="checkbox" name="post_type[]" value="videos" <?php if (in_array('videos', $query_types)) { echo 'checked="checked"'; } ?> /><label>Videos</label>

<input type="submit" id="searchsubmit" value="Search" />
</form>
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
</section>
<?php get_footer(); ?>

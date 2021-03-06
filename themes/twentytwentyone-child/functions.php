<?php
/* enqueue scripts and style from parent theme */

function twentytwentyone_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_uri(),
	array( 'twenty-twenty-one-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_styles');

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'twentytwentyone-child'),
    'languages' => __( 'Languages', 'twentytwentyone-child' ),
    'tertiary' => __( 'Tertiary', 'twentytwentyone-child' ),
		'blog' => __( 'Blog', 'twentytwentyone-child' ),
		'job-board' => __( 'Job Board', 'twentytwentyone-child' ),
 ) );

/*add function to make shortcode of registered menus*/
function print_menu_shortcode($atts, $content = null) {
extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));
return wp_nav_menu( array( 'menu' => $name, 'menu_class' => 'myclass', 'echo' => false ) );
}

add_shortcode('menu', 'print_menu_shortcode');


/*removing "category" from archive title*/
add_filter( 'get_the_archive_title', function ($title) {
        if ( is_category() ) {
                $title = single_cat_title( '', false );
            } elseif ( is_tag() ) {
                $title = single_tag_title( '', false );
            } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>' ;
            } elseif ( is_tax() ) { //for custom post types
                $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
            } elseif (is_post_type_archive()) {
                $title = post_type_archive_title( '', false );
            }
        return $title;
    });
/*remove parent category from permalinks
add_action( ‘init’, ‘build_taxonomies’, 0 );
function build_taxonomies() {
register_taxonomy( ‘category’, ‘post’, array(
‘hierarchical’ => true,
‘update_count_callback’ => ‘_update_post_term_count’,
‘query_var’ => ‘category_name’,
‘rewrite’ => did_action( ‘init’ ) ? array(
‘hierarchical’ => false,
‘slug’ => get_option(‘category_base’) ? get_option(‘category_base’) : ‘category’,
‘with_front’ => false) : false,
‘public’ => true,
‘show_ui’ => true,
‘_builtin’ => true,
) );
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {

  register_taxonomy( 'category', 'post', array(
        'hierarchical' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => 'category_name',
        'rewrite' => did_action( 'init' ) ? array(
                    'hierarchical' => false,
                    'slug' => get_option('category_base') ? get_option('category_base') : 'category',
                    'with_front' => false) : false,
        'public' => true,
        'show_ui' => true,
        '_builtin' => true,
    ) );

}
/*allowing sticky posts on category archives pages*/
function get_term_sticky_posts()
{
    // First check if we are on a category page, if not, return false
    if ( !is_category() )
        return false;

    // Secondly, check if we have stickies, return false on failure
    $stickies = get_option( 'sticky_posts' );

    if ( !$stickies )
        return false;

    // OK, we have stickies and we are on a category page, continue to execute. Get current object (category) ID
    $current_object = get_queried_object_id();

    // Create the query to get category specific stickies, just get post ID's though
    $args = [
        'nopaging' => true,
        'post__in' => $stickies,
        'cat' => $current_object,
        'ignore_sticky_posts' => 1,
        'fields' => 'ids'
    ];
    $q = get_posts( $args );

    return $q;
}

add_action( 'pre_get_posts', function ( $q )
{
    if (    !is_admin() // IMPORTANT, make sure to target front end only
         && $q->is_main_query() // IMPORTANT, make sure we only target the main query
         && $q->is_category() // Only target category archives
    ) {
        // Check if our function to get term related stickies exists to avoid fatal errors
        if ( function_exists( 'get_term_sticky_posts' ) ) {
            // check if we have stickies
            $stickies = get_term_sticky_posts();

            if ( $stickies ) {
                // Remove stickies from the main query to avoid duplicates
                $q->set( 'post__not_in', $stickies );

                // Check that we add stickies on the first page only, remove this check if you need stickies on all paged pages
                if ( !$q->is_paged() ) {

                    // Add stickies via the the_posts filter
                    add_filter( 'the_posts', function ( $posts ) use ( $stickies )
                    {
                        $term_stickies = get_posts( ['post__in' => $stickies, 'nopaging' => true] );

                        $posts = array_merge( $term_stickies, $posts );

                        return $posts;
                    }, 10, 1 );
                }
            }
        }
    }
});
/**
 * Register footer widget area.
 *
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentytwentyone_child_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Additional Tools', 'twentytwentyone-child' ),
    'id'            => 'sidebar-2',
    'description'   => __( '', 'twentytwentyone-child' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
	register_sidebar( array(
    'name'          => __( 'Footer CTA Banner', 'twentytwentyone-child' ),
    'id'            => 'sidebar-3',
    'description'   => __( '', 'twentytwentyone-child' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'twentytwentyone_child_widgets_init' );

/* Filter: Category Parent and Child
add class 'category-job-board' into body tag of all children of job-board category*/
add_filter( 'body_class','category_job_board' );
function category_job_board( $classes ) {

    if ( is_category( 'toronto' ) || (is_category('halton')) || (is_category('hamilton-wentworth')) || (is_category('niagara')) || (is_category('peel')) || (is_category('brant')) || (is_category('goodwill')) || (is_category('brantford')) || (is_category('brockton')) || (is_category('mount-pleasant')) || (is_category('paris')) || (is_category('ancaster')) || (is_category('dundas')) || (is_category('hamilton')) || (is_category('mount-hope')) || (is_category('stoney-creek')) || (is_category('winona')) || (is_category('burlington')) || (is_category('milton')) || (is_category('oakville')) || (is_category('fort-erie')) || (is_category('lincoln')) || (is_category('niagara-falls')) || (is_category('niagara-on-the-lake')) || (is_category('pelham')) || (is_category('port-colborne')) || (is_category('smithsville')) || (is_category('st-catharines')) || (is_category('thorold')) || (is_category('wainfleet')) || (is_category('brampton')) || (is_category('caledon'))  || (is_category('mississauga'))  || (is_tag('remote')) || (is_tag('onsite')) ) {
        $classes[] = 'category-job-board';
    }

    return $classes;

}
/* Filter Primary Navigation Employment Services
add body class "category-employment-services" into body to allow for color coded current page indicatiors*/
add_filter( 'body_class','category_employment_services' );
function category_employment_services( $classes ) {

    if ( is_page( 'employment-services' ) || (is_page('job-seekers')) || (is_page('employers')) || (is_category('job-board')) ) {
        $classes[] = 'category-employment-services';
    }
    return $classes;
}

/* Filter Primary Navigation Employment Services
add body class "category-shop-goodwill" into body to allow for color coded current page indicatiors*/
add_filter( 'body_class','category_shop_goodwill' );
function category_shop_goodwill( $classes ) {

    if ( is_page( 'shop' ) || is_page('donate') ) {
        $classes[] = 'category-shop-goodwill';
    }
    return $classes;
}
/* Filter Primary Navigation Employment Services
add body class "category-shop-goodwill" into body to allow for color coded current page indicatiors*/
add_filter( 'body_class','category_business_services' );
function category_business_services( $classes ) {

    if ( is_page( 'businesses' )) {
        $classes[] = 'category-business-services';
    }
    return $classes;
}
/* Filter Primary Navigation Employment Services
add body class "category-employment-services" into body to allow for color coded current page indicatiors*/
add_filter( 'body_class','category_contact_news' );
function category_contact_news( $classes ) {

    if (is_page( 'contact' ) || is_page('explore-goodwill') || is_category('blog') || is_category('workshops') || is_category('resources') || is_category('news') || is_category('job-events')) {
        $classes[] = 'category-contact-news';
    }
    return $classes;
}


/*Filter: Post Metadata – remove parent category (Job Board or Community Board)*/
add_filter('get_the_terms', 'hide_categories_terms', 10, 3);
function hide_categories_terms($terms, $post_id, $taxonomy){

    // define which category IDs you want to hide
    $excludeIDs = array(22, 40);

    // get all the terms
    $exclude = array();
    foreach ($excludeIDs as $id) {
        $exclude[] = get_term_by('id', $id, 'category');
    }

    // filter the categories
    if (!is_admin()) {
        foreach($terms as $key => $term){
            if($term->taxonomy == "category"){
                foreach ($exclude as $exKey => $exTerm) {
                    if($term->term_id == $exTerm->term_id) unset($terms[$key]);
                }
            }
        }
    }

    return $terms;
}
/* Show a different number of posts per page depending on the context */
function custom_posts_per_page($query) {
    if (is_archive() && is_category('blog')) {
        $query->set('posts_per_page', 7);
    }
		$classes = get_body_class();
		if (in_array('paged',$classes) || is_search()) {
        $query->set('posts_per_page', 6);
    } //endif
} //function

//this adds the function above to the 'pre_get_posts' action
add_action('pre_get_posts', 'custom_posts_per_page');

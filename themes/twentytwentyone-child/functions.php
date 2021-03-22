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
		'actions' => __( 'Actions', 'twentytwentyone-child' ),
 ) );

/*add function to make shortcode of registered menus*/
function print_menu_shortcode($atts, $content = null) {
extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));
return wp_nav_menu( array( 'menu' => $name, 'menu_class' => 'myclass', 'echo' => false ) );
}

add_shortcode('menu', 'print_menu_shortcode');

/*attempting to extend blocks with AOS data attribute

const { addFilter } = wp.hooks;

ffunction addAttributes( extraProps, blockType, attributes ) {
if(blockType.name !== 'core/group') {
return extraProps;
}
extraProps['data-aos'] = 'fade-up';
extraProps['data-aos-duration'] = '1500';

return extraProps;
}

addFilter(
'blocks.getSaveContent.extraProps',
'test/applyAOSClasses',
addAttributes
);

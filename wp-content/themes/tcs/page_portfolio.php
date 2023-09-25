<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Page"
*/

/**
 * Template Name: Portfolio - Page
 * Content Pages
 */
remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_after_header', 'portfolio_content' );
function portfolio_content(){
    echo '<section class="portfolio-tcs">';
        echo '<div class="wrap">';
            $settings = array(
                'posts_per_page' => -1, 
                'post_type' => 'portfolio', 
                'orderby' => 'date', 
                'order' => 'DESC', 
            );
            $wp_query = new WP_Query( $settings );
            if(have_posts()):
                echo '<div class="row portfolio-list">';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    if(get_post_thumbnail_id(get_the_ID())) {
                        echo '<div class="col l4 m6 s12">';
                            echo '<div class="portfolio-item" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' )[0].');">';
                                echo '<h3>'.get_the_title().'</h3>';
                                echo '<p>'.get_the_excerpt().'</p>';
                                echo '<a href="'.get_the_permalink().'" class="base-button color-transparent"><span>View Project</span> <i class="fas fa-caret-right"></i></a>';
                            echo '</div>';
                        echo '</div>';
                    }
                endwhile;
                echo '</div>';
            endif;
            wp_reset_query();
        echo '</div>';
    echo '</section>';
}

genesis();
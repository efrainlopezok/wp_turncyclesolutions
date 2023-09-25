<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Page"
*/

/**
 * Template Name: Testimonials - Page
 * Content Pages
 */
remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_after_header', 'testimonials_content' );
function testimonials_content(){
    echo '<section class="testimonials-tcs">';
        echo '<div class="wrap">';
            $settings = array(
                'posts_per_page' => -1, 
                'post_type' => 'testimonials', 
                'orderby' => 'date', 
                'order' => 'ASC', 
            );
            $wp_query = new WP_Query( $settings );
            if(have_posts()):
                echo '<div class="testimonials-list">';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    echo '<div class="testimonial-item">';
                        echo '<p>'.get_the_excerpt().'</p>';
                        echo '<span><strong>'.get_field('author').'</strong> '.get_field('title').'</span>';
                    echo '</div>';
                endwhile;
                echo '</div>';
            endif;
            wp_reset_query();
        echo '</div>';
    echo '</section>';
}

genesis();
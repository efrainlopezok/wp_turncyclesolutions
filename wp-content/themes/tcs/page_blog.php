<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Page"
*/

/**
 * Template Name: Blog - Page
 * Content Pages
 */
remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_after_header', 'blog_content' );
function blog_content(){
    echo '<section class="blog-tcs">';
        echo '<div class="wrap">';
            $settings = array(
                'posts_per_page' => -1, 
                'post_type' => 'post', 
                'orderby' => 'date', 
                'order' => 'DESC', 
            );
            $wp_query = new WP_Query( $settings );
            if(have_posts()):
                echo '<div class="blog-list">';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    if(get_post_thumbnail_id(get_the_ID())) {
                        echo '<div class="blog-item">';
                            echo '<a href="'.get_the_permalink().'">';
                                echo '<div class="background-blog" style="background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' )[0].');"></div>';
                                echo '<h3>'.get_the_title().'</h3>';
                                echo '<p>'.get_the_date('l, F j, Y').'</p>';
                            echo '</a>';
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
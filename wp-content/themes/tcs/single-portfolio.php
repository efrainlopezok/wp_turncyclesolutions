<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Page"
*/

/**
 * Content Pages
 */
remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_after_header', 'portfolio_single_content' );
function portfolio_single_content(){
    echo '<section class="portfolio-single-tcs">';
        echo '<div class="wrap">';
            echo '<div class="row">';
                echo '<div class="col l6 m6 s12">';
                    echo get_the_content();
                echo '</div>';
                echo '<div class="col l6 m6 s12">';
                    echo '<div class="row gallery-items">';
                    foreach(get_field('portfolio_gallery') as $image){
                        echo '<div class="col l6 m6 s12">';
                            echo '<a href="'.$image['url'].'" class="gallery-portfolio">';
                                echo '<img src="'.$image['url'].'" />';
                            echo '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                    // print_r(get_field('portfolio_gallery'));
                echo '</div>';
                echo '<div class="col l12 m12 s12">';
                    echo '<div class="nav-single-portfolio">';
                        previous_post_link();
                        next_post_link(); 
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';
}

genesis();
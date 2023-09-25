<?php
/**
* Template Name: Portfolio TCS Page
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Home Page test"
*/




// Add our custom loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'cd_goh_loop' );
function cd_goh_loop() {
    $home_features = get_field('home_features');
    if($home_features):
        $common_area_features = $home_features['common_area_features'];
        if($common_area_features['value']=='default') {
            $common_features = get_field('common_features','option');
            $feature_1_title = $common_features['common_feature_1_title'];
            $feature_1_content = $common_features['common_feature_1_content'];
            $feature_1_button = $common_features['common_feature_1_button'];
            $feature_1_background = $common_features['common_feature_1_bg'];
            $feature_2_title = $common_features['common_feature_2_common_feature_1_title'];
            $feature_2_content = $common_features['common_feature_2_common_feature_1_content'];
            $feature_2_button = $common_features['common_feature_2_common_feature_1_button'];
            $feature_2_background = $common_features['common_feature_2_common_feature_1_bg'];
        } else {
            $feature_1_title = $home_features['feature_1_title'];
            $feature_1_content = $home_features['feature_1_content'];
            $feature_1_button = $home_features['feature_1_button'];
            $feature_1_background = $home_features['feature_1_background'];
            $feature_2_title = $home_features['feature_2_feature_1_title'];
            $feature_2_content = $home_features['feature_2_feature_1_content'];
            $feature_2_button = $home_features['feature_2_feature_1_button'];
            $feature_2_background = $home_features['feature_2_feature_1_background'];
        }
    ?>
    <?php
    endif;
    $home_services = get_field('services');
    if($home_services): 
    ?>
    <section class="section-portfolion-two">
        <div class="container">
            <div class="row valign-wrapper portfolio-list">
                <?php
                $args = array( 
                    'post_type'      => 'portfolio',
                    'post_status'    => 'publish',
                    'posts_per_page' => 6,
                    'orderby'        => 'post_date',
                    'order'          => 'DESC',
                );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts()):
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $img_service_url = wp_get_attachment_image_src( get_post_thumbnail_id($service_id), 'portfolio-list');
                        $img_service = '';
                        if (has_post_thumbnail($service_id)) {
                            $img_service = $img_service_url[0];
                        }else{
                            $img_service = get_stylesheet_directory_uri()."/assets/images/image-default.png";
                        }
                        echo '<div class="col l3 m3 s12">';
                            echo '<a href="'.get_the_permalink().'">';
                                echo '<div class="port-cont">';
                                    echo '<div class="portfolio-list-content" style="background-image:url('.$img_service.')">';
                                        echo '<div class="overlay"></div>';
                                        echo '<span>Learn More <i class="fas fa-caret-right"></i></span>';
                                    echo '</div>';
                                    echo '<div class="portfolio-list-info">';
                                        echo '<h4>'.get_the_title().'</h4>';
                                    echo '</div>';                                    
                                echo '</div>';
                            echo '</a>';
                        echo '</div>';
                    endwhile;
                    wp_reset_query();
                endif;   
                ?>
            </div>
        </div>   
    </section>
    <?php
    endif;

    $amazon_donate = get_field('amazon_donate');
    if($amazon_donate): 
    ?>
    <section class="section-amazon-donate">
        <div class="row valign-wrapper animatedParent">
            <div class="col l6 m6 s12 no-padding amazon-bg animated bounceInLeft box" style="background-image: url('<?php echo $amazon_donate['amazon_donate_background_column1'];?>')">
                <div class="filter-green">
                    <h3><?php echo $amazon_donate['amazon_donate_title']; ?></h3>
                    <?php echo do_shortcode($amazon_donate['amazon_donate_content']);?>
                    <?php echo do_shortcode('[button color="transparent" url="'.$amazon_donate['amazon_donate_button']['url'].'" target="'.$amazon_donate['amazon_donate_button']['target'].'"]'.$amazon_donate['amazon_donate_button']['title'].'[/button]');?>
                </div>
            </div>
            <div class="col l6 m6 s12 no-padding amazon-bg animated bounceInRight box" style="background-image: url('<?php echo $amazon_donate['amazon_donate_fields_amazon_donate_background_column1'];?>')">
                <div class="filter-blue">
                    <h3><?php echo $amazon_donate['amazon_donate_fields_amazon_donate_title']; ?></h3>
                    <?php echo do_shortcode($amazon_donate['amazon_donate_fields_amazon_donate_content']);?>
                    <?php echo do_shortcode('[button color="transparent" url="'.$amazon_donate['amazon_donate_fields_amazon_donate_button']['url'].'" target="'.$amazon_donate['amazon_donate_fields_amazon_donate_button']['target'].'"]'.$amazon_donate['amazon_donate_fields_amazon_donate_button']['title'].'[/button]');?>
                </div>
            </div>
        </div>
    </section>
    <?php
    endif;
    /*$home_events = get_field('home_events');
    if($home_events): 
        $common_area_events = $home_events['common_area_events'];
        if($common_area_events['value']=='default') {
            $common_news_events = get_field('common_news_events','option');
            $list_events = $common_news_events['list_events'];
        } else {
            $list_events = $home_events['list_events'];
        }
    ?>
    <section class="section-events" style="background-image: url('<?php echo get_site_url().'/wp-content/uploads/2018/06/path-top-bg.png';?>')">
         <div class="container">
            <div class="events-slider desktop">
             <?php 
             if($list_events):
                foreach($list_events as $row) {
                    ?>
                     <div class="row valign-wrapper">
                        <div class="col l6 m7 s12">
                            <h4><?php echo __('News & Events'); ?></h4>
                            <h2><?php echo $row['list_events_title'] ?></h2>
                            <?php echo do_shortcode($row['list_events_content']);?>
                            <p><a href="<?php echo $row['list_events_link']['url'] ?>"><?php echo $row['list_events_link']['title'] ?> <i class="fas fa-angle-right"></i></a></p>
                        </div>
                        <div class="col l6 m5 s12">
                            <img class="circle-image" src="<?php echo $row['list_events_image'];?>">
                        </div>
                    </div>
                    <?php
                }
             endif;
             ?>
            </div>
            <div class="events-slider mobile">
             <?php 
             if($list_events):
                foreach($list_events as $row) {
                    ?>
                     <div class="row">
                        <div class="cols12">
                            <h4><?php echo __('News & Events'); ?></h4>
                            <h2><?php echo $row['list_events_title'] ?></h2>
                            <img class="circle-image" src="<?php echo $row['list_events_image'];?>">
                            <p></p>
                            <?php echo do_shortcode($row['list_events_content']);?>
                            <p><a href="<?php echo $row['list_events_link']['url'] ?>"><?php echo $row['list_events_link']['title'] ?> <i class="fas fa-angle-right"></i></a></p>
                        </div>
                    </div>
                    <?php
                }
             endif;
             ?>
            </div>
         </div>
    </section>  
    <?php 
    endif;
    $publication = get_field('publication');
    if($publication):
        ?>
    <section class="section-publication" style="background-image: url('<?php echo get_site_url().'/wp-content/uploads/2018/06/path-bottom-bg.png';?>')">
         <div class="container">
                <div class="row  valign-wrapper desktop">
                    <div class="col l6 m5 s12">
                        <img class="circle-image" src="<?php echo $publication['publication_image'];?>">
                    </div>
                    <div class="col l6 m7 s12">
                    <h4><?php echo __('Featured Publication'); ?></h4>
                        <h2><?php echo $publication['publication_title'] ?></h2>
                        <?php echo do_shortcode($publication['publication_content']);?>
                        <p><a href="<?php echo $publication['publication_link']['url'] ?>"><?php echo $publication['publication_link']['title'] ?> <i class="fas  fa-angle-right"></i></a></p>
                    </div>
                </div>

                <div class="row  valign-wrapper mobile">
                    <div class="col s12">
                    <h4><?php echo __('Featured Publication'); ?></h4>
                        <h2><?php echo $publication['publication_title'] ?></h2>
                        <img class="circle-image" src="<?php echo $publication['publication_image'];?>">
                        <p></p>
                        <?php echo do_shortcode($publication['publication_content']);?>
                        <p><a href="<?php echo $publication['publication_link']['url'] ?>"><?php echo $publication['publication_link']['title'] ?> <i class="fas  fa-angle-right"></i></a></p>
                    </div>
                </div>
        </div>
    </section>  
        <?php
    endif;*/
}

genesis();
<?php
/**
* Template Name: Home Page
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Home Page"
*/

remove_action( 'genesis_after_header', 'display_page_featured_image' );
add_action( 'genesis_after_header', 'display_featured_image' );
function display_featured_image() {
    if( $hero_block	= get_field('hero')):
        $bg =  get_field('video_background');
        $bg_option =  get_field('video_option');
        ?>
        <?php if ($bg_option == 1): ?>
            <section class="section-hero video">
                 <video autoplay muted loop id="video-bg" >
                  <source src="<?php echo $bg['url'];  ?>" type="video/mp4">
                </video>
                <div class="container">
                    <div class="row valign-wrapper">
                        <div class="txt-content">
                            <?php echo do_shortcode($hero_block['hero_content']); ?>
                            <?php echo do_shortcode('[button color="green" url="'.$hero_block['hero_button']['url'].'" target="'.$hero_block['hero_button']['target'].'"]'.$hero_block['hero_button']['title'].'[/button]');?>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <section class="section-hero" style="background-image: url('<?php echo $hero_block['hero_image']?>')">
                <div class="container">
                    <div class="row valign-wrapper">
                        <div class="txt-content">
                            <?php echo do_shortcode($hero_block['hero_content']); ?>
                            <?php echo do_shortcode('[button color="green" url="'.$hero_block['hero_button']['url'].'" target="'.$hero_block['hero_button']['target'].'"]'.$hero_block['hero_button']['title'].'[/button]');?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif ?>
        <?php
    endif;
}


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
    <section class="section-features">
        <div class="container">
            <div class="row animatedParent">
                <div class="col l6 s12 animated bounceInUp box">
                    <div class="box-feature box-green" style="background-image: url(<?php echo $feature_1_background?>);">
                        <h3><?php echo $feature_1_title;?></h3>
                        <?php echo do_shortcode( $feature_1_content );?>
                    </div>
                    <?php echo do_shortcode('[button color="green" url="'.$feature_1_button['url'].'" target="'.$feature_1_button['target'].'"]'.$feature_1_button['title'].'[/button]');?>
                </div>
                <div class="col l6 s12 animated bounceInUp box">
                    <div class="box-feature box-blue" style="background-image: url(<?php echo $feature_2_background?>);">
                        <h3><?php echo $feature_2_title;?></h3>
                        <?php echo do_shortcode($feature_2_content);?>
                    </div>
                    <?php echo do_shortcode('[button color="blue" url="'.$feature_2_button['url'].'" target="'.$feature_2_button['target'].'"]'.$feature_2_button['title'].'[/button]');?>
                </div>
            </div>
        </div>    
    </section>
    <?php
    endif;
    $home_services = get_field('services');
    if($home_services): 
    ?>
    <section class="section-services">
        <div class="container">
            <h6><?php echo  $home_services['sub_title']; ?></h6>
            <h2><?php echo  $home_services['title']; ?></h2>
            <div class="row valign-wrapper services-list">
                <?php
                $args = array( 
                    'post_type'      => 'service',
                    'post_status'    => 'publish',
                    'posts_per_page' => 8,
                    // 'orderby'         => 'menu_order',
                    'orderby'        => 'post_date',
                    'order'          => 'DESC',
                );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts()):
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $img_service_url = wp_get_attachment_image_src( get_post_thumbnail_id($service_id), 'services-list');
                        $img_service = '';
                        $link = get_field('link_page');
                        
                        if (has_post_thumbnail($service_id)) {
                            $img_service = $img_service_url[0];
                        }else{
                            $img_service = get_stylesheet_directory_uri()."/assets/images/image-default.png";
                        }
                        echo '<div class="col l3 m4 s12">';
                            echo '<div class="service-list-content">';
                                echo '<div class="overlay"></div>';
                                echo '<a href="'.$link['url'].'">';
                                    echo '<img src="'.$img_service.'" />';
                                    echo '<span>Learn More <i class="fas fa-caret-right"></i></span>';
                                echo '</a>';
                                echo '<a href="'.$link['url'].'">';
                                    echo '<h4>'.get_the_title().'</h4>';
                                echo '</a>';
                            echo '</div>';
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
    $home_testimonials = get_field('testimonials');
    if($home_testimonials): 
    ?>
    <section class="section-testimonials" style="background-image: url(<?php echo get_stylesheet_directory_uri().'/images/testimonial-bg.png';?>);">
        <div class="container">
            <h6><?php echo  $home_testimonials['sub_title']; ?></h6>
            <h2><?php echo  $home_testimonials['title']; ?></h2>
            <div class="testimonials-slider">
                <?php foreach($home_testimonials['testimonials'] as $testimonial):?>
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p class="text-center"><?php echo $testimonial['testimonial'];?></p>
                        <span class="author"><strong><?php echo $testimonial['author'];?></strong></span>
                        <span class="author-title"><?php echo $testimonial['title_author'];?></span>
                    </div>
                <?php endforeach;?>
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
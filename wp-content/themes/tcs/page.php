<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Page"
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
        echo '<div class="col l9 m8 s12">';
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
            echo '<div class="col l3 m4 s12">';
                genesis_widget_area('sidebar');
            echo '</div>';
        echo '</div>';
    echo '</section>';
}
// add_action('genesis_after_footer', 'style_checkout');
// function style_checkout(){
//     echo '<style>
//     .page.woocommerce-checkout select{
//         display: block;
//     }
//     </style>';
// }
// Add our custom loop
/*remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'page_content_loop' );
function page_content_loop() {
    // check if the flexible content field has rows of data
    if( have_rows('page_content') ):
        $counter = 0;
        // loop through the rows of data
        while ( have_rows('page_content') ) : the_row();
        $counter++;
            if( get_row_layout() == 'content' ):
                if(get_sub_field('id_section'))
                    $section_id = 'id="'.get_sub_field('id_section').'" ';
                if(get_sub_field('class_section'))
                $section_class = ' '.get_sub_field('class_section');
                $section_layout = get_sub_field('layout_section');
                if(get_sub_field('link_color'))
                    echo '<style>section.section-'.$counter.' a{color: '.get_sub_field('link_color').';}</style>';
                $section_link_color = get_sub_field('link_color');
                $padding = 'style="padding-top:'.get_sub_field('padding_top').'px; padding-bottom:'.get_sub_field('padding_bottom').'px;"';
                echo '<section '.$section_id.' class="section-'.$counter.$section_class.'">';
                    echo '<div class="container" '.$padding.'>';
                        echo do_shortcode(get_sub_field('content'));
                    echo '</div>';
                echo '</section>';
            elseif( get_row_layout() == 'columns' ): 
                if(get_sub_field('id_section'))
                    $section_id = 'id="'.get_sub_field('id_section').'" ';
                if(get_sub_field('class_section'))
                $section_class = ' '.get_sub_field('class_section');
                $section_layout = get_sub_field('layout_section');
                if(get_sub_field('link_color'))
                    echo '<style>section.section-'.$counter.' a{color: '.get_sub_field('link_color').';}</style>';
                $padding = 'style="padding-top:'.get_sub_field('padding_top').'px; padding-bottom:'.get_sub_field('padding_bottom').'px;"';
                echo '<section '.$section_id.' class="section-'.$counter.$section_class.'">';
                    echo '<div class="container" '.$padding.'>';
                        echo '<div class="row">';
                            foreach(get_sub_field('columns') as $column){
                                // print_r($column);
                                echo '<div class="col '.$column['column_width'].'">';
                                    echo '<div class="'.$column['column_class'].'">';
                                        echo do_shortcode($column['column_content']);
                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            elseif( get_row_layout() == 'filter_box' ):
                if(get_sub_field('id_section'))
                    $section_id = 'id="'.get_sub_field('id_section').'" ';
                // if(get_sub_field('class_section'))
                // $section_class = ' '.get_sub_field('class_section');
                $section_layout = get_sub_field('layout_section');
                if(get_sub_field('link'))
                $section_link = get_sub_field('link');
                $padding = 'style="padding-top:'.get_sub_field('padding_top').'px; padding-bottom:'.get_sub_field('padding_bottom').'px;"';
                echo '<section '.$section_id.' class="section-'.$counter.' section-filter" style="background-image: url('.get_sub_field('background_image').');">';
                    echo '<div class="'.get_sub_field('filter_type').'">';
                    echo '<div class="container" '.$padding.'>';
                        echo do_shortcode(get_sub_field('content'));
                        if($section_link)
                            echo '<a href="'.$section_link['url'].'" class="base-button color-transparent"><span>'.$section_link['title'].'</span> <i class="fas fa-angle-right"></i></a>';
                    echo '</div>';
                echo '</section>';
            endif;
        endwhile;
    endif;
    
    ?>
    
    <?php
    
    $amazon_donate = get_field('amazon_donate');
    if($amazon_donate): 
    ?>
    <section class="section-amazon-donate">
        <div class="row valign-wrapper">
            <div class="col s6 no-padding amazon-bg" style="background-image: url('<?php echo $amazon_donate['amazon_donate_background_column1'];?>')">
                <div class="filter-green">
                    <h3><?php echo $amazon_donate['amazon_donate_title']; ?></h3>
                    <?php echo do_shortcode($amazon_donate['amazon_donate_content']);?>
                    <?php echo do_shortcode('[button color="transparent" url="'.$amazon_donate['amazon_donate_button']['url'].'" target="'.$amazon_donate['amazon_donate_button']['target'].'"]'.$amazon_donate['amazon_donate_button']['title'].'[/button]');?>
                </div>
            </div>
            <div class="col s6 no-padding amazon-bg" style="background-image: url('<?php echo $amazon_donate['amazon_donate_fields_amazon_donate_background_column1'];?>')">
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
    $home_events = get_field('home_events');
    if($home_events): 
    ?>
    <section class="section-events" style="background-image: url('<?php echo $home_events['list_events'][0]['list_events_background'];?>')">
         <div class="container">
            <div class="events-slider">
             <?php 
             if($list_events = $home_events['list_events']):
                foreach($list_events as $row) {
                    ?>
                     <div class="row valign-wrapper">
                        <div class="col s6">
                            <h4><?php echo __('News & Events'); ?></h4>
                            <h2><?php echo $row['list_events_title'] ?></h2>
                            <?php echo do_shortcode($row['list_events_content']);?>
                            <p><a href="<?php echo $row['list_events_link']['url'] ?>"><?php echo $row['list_events_link']['title'] ?> <i class="fas fa-angle-right"></i></a></p>
                        </div>
                        <div class="col s6">
                            <img class="circle-image" src="<?php echo $row['list_events_image'];?>">
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
    <section class="section-publication" style="background-image: url('<?php echo $publication['publication_background'];?>')">
         <div class="container">
                <div class="row  valign-wrapper">
                    <div class="col s6">
                        <img class="circle-image" src="<?php echo $publication['publication_image'];?>">
                    </div>
                    <div class="col s6">
                    <h4><?php echo __('Featured Publication'); ?></h4>
                        <h2><?php echo $publication['publication_title'] ?></h2>
                        <?php echo do_shortcode($publication['publication_content']);?>
                        <p><a href="<?php echo $publication['publication_link']['url'] ?>"><?php echo $publication['publication_link']['title'] ?> <i class="fas  fa-angle-right"></i></a></p>
                    </div>
                </div>
        </div>
    </section>  
        <?php
    endif;
}*/

genesis();
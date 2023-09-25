<?php


// Register and load the widget
function ndss_unit_details_widget() {
    register_widget( 'ndss_unit_details_widget' );
}
add_action( 'widgets_init', 'ndss_unit_details_widget' );
 
// Creating the widget 
class ndss_unit_details_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'ndss_unit_details_widget', 
 
// Widget name will appear in UI
__('NDSS Unit Details Widget', 'ndss_unit_details_widget_domain'), 
 
// Widget description
array( 'description' => __( 'NDSS Unit Widget to show the data', 'ndss_unit_details_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $widget_class = $instance['widget_class'];
    
    /**
     * Get Unit Information
     */
    
    // $unit_id = get_query_var('unit');
    $unit_id = $_GET['unit'];
    // $location_id = get_query_var('location');
    $location_id = $_GET['location'];
    // if($unit_id!='' && $location_id!=''){    
        global $wpdb;
        /* Single Location Details */
        $table_name = $wpdb->prefix . "location_information";
        $location_query = "SELECT * FROM $table_name WHERE SiteID=%d LIMIT 1";
        $location_details = $wpdb->get_results($wpdb->prepare($location_query, $location_id));  
        // print_r($location_details);

        // $GLOBALS['lat'] = $location_details[0]->dcLatitude;
        // $GLOBALS['long'] = $location_details[0]->dcLongitude;

        /* Single Unit Detail */
        $unit_table_name = $wpdb->prefix . "unit_information";
        $unit_query = "SELECT * FROM $unit_table_name WHERE SiteID=%d AND UnitID=%d";
        $unit_details = $wpdb->get_results($wpdb->prepare($unit_query, $location_id,$unit_id));

        /* Single Unit Detail */
        $reservation_table_name = $wpdb->prefix . "reservation";
        $reservation_query = "SELECT * FROM $reservation_table_name WHERE SiteID=%d AND UnitID=%d";

        /* Single Location Default icons */
        $def_ico_table_name = $wpdb->prefix . "location_default_icons";
        $def_ico_query = "SELECT default_icons FROM $def_ico_table_name WHERE site_id=%d";
        $def_ico_details = $wpdb->get_results($wpdb->prepare($def_ico_query, $location_id));
        $def_icos=array();
        foreach ($def_ico_details as $def_ico_detail){
            $def_icos[]=get_field('icons',$def_ico_detail->default_icons);
        }

        /* Single Location Variable icons */

        $var_ico_table_name = $wpdb->prefix . "location_variable_icons";
        $var_ico_query = "SELECT variable_icons,variable_type FROM $var_ico_table_name WHERE site_id=%d";
        $var_ico_details = $wpdb->get_results($wpdb->prepare($var_ico_query, $location_id));

        $var_icons=array();

        foreach ($var_ico_details as $var_ico_detail){
            $var_icons[$var_ico_detail->variable_type]=$var_ico_detail->variable_icons;
        }

        $equivalent_text='';

        foreach ($unit_details as $unit_detail) {
            if ($unit_detail->dcWidth < 10) {
                $equivalent_text = 'Space Equivalent to a small walk-in closet';
            } elseif ($unit_detail->dcWidth >= 10 && $unit_detail->dcWidth < 12) {
                $equivalent_text = 'Space Equivalent to a bedroom.';
            } elseif ($unit_detail->dcWidth >= 12 && $unit_detail->dcWidth < 15) {
                $equivalent_text = 'Space Equivalent to a 1 car garage.';
            } else {
                $equivalent_text = 'Space ideal for a single vehicle.';
            }
        }

        $loc_stype_table_name = $wpdb->prefix . "location_stypename";
        $loc_stype_query = "SELECT stypename_id,stypename FROM $loc_stype_table_name WHERE site_id=%d AND discount=1";
        $loc_stype_details = $wpdb->get_results($wpdb->prepare($loc_stype_query, $location_id));
        $other_move_in_costs_table_name = $wpdb->prefix . "other_move_in_costs";
        $other_move_in_costs_query = "SELECT * FROM $other_move_in_costs_table_name WHERE site_id=%d";
        $other_move_in_costs_details = $wpdb->get_results($wpdb->prepare($other_move_in_costs_query, $location_id));

        $loc_stype_ids=array();

        foreach($loc_stype_details as $loc_stype_detail){
            $loc_stype_ids[]=$loc_stype_detail->stypename_id;
        }

        $on_site = $location_details[0]->onsite_rate;
        if ($on_site)
            $on_site_rate = $unit_details[0]->$on_site;
        else
            $on_site_rate = $unit_details[0]->dcBoardRate;
                                                                    
        $on_site_rate = ceil($on_site_rate); 
        $web_rate=$on_site_rate;                                                                    
        if(in_array($unit_details[0]->UnitTypeID, $loc_stype_ids)){                                                                     
        $web_rate = get_web_rate($location_details[0]->discount, $on_site_rate);
        }

        if ($location_details[0]->roundoff) {
            $web_rate = ceil($web_rate);
        }
    // print_r($location_details);
 
    echo '<section class="widget rent-unit shadow-widget">';
        echo '<div class="unit-detail">';
            echo '<div class="unit-head">';
                echo '<div class="one-half first">';
                    echo '<h2>Unit Details</h2>';
                echo '</div>';
                echo '<div class="one-half text-right">';
                    echo '<a href="'.home_url().'/'.$location_details[0]->slug.'" class="btn-change">Change Unit</a>';
                echo '</div>';
            echo '</div>';
            echo '<div class="unit-f-details">';
                echo '<div class="unit-description">';
                    echo '<div class="unit-box">';
                    $is_vehicle_type = false;
                    if (strpos($unit_details[0]->sTypeName, 'Parking') !== false) {
                        $is_vehicle_type = true;
                    }
                    $total_quantity_avlb = getTotalQuantity($location_id,$unit_details[0]->dcWidth,$unit_details[0]->dcLength,$is_vehicle_type);
                    $concession_id = "-999";	
                    if(isSpecialDiscountApplied($location_id,$unit_details[0]->UnitID)){
                        if($total_quantity_avlb>=$location_details[0]->no_qty){
                            $concession_id = $location_details[0]->concession_id;
                        }else{
                            $concession_id = $location_details[0]->else_concession_id;
                        }	
                    }
                     $_SESSION['SPECIAL_CONCESSION_ID'] = $concession_id;   
                    // $_SESSION['INSURANCE_PLAN_ID'] = $location_details[0]->insurance_id;
                    $width=round($unit_details[0]->dcWidth,1);
                    $height=round($unit_details[0]->dcLength,1);
                    echo $width.' x '.$height.' <br> #'.$unit_details[0]->sUnitName;
                    // print_r($unit_details);
                    echo '</div>';
                    echo '<div class="until-dsc">';
                        echo '<h2>'.$width.' x '.$height.' '.$unit_details[0]->sTypeName.'</h2>';
                        echo '<small>'.($width*$height).' sq ft unit available.<br>';
                        echo $equivalent_text.'</small>';                        
                    echo '</div>';
                echo '</div>';
                echo '<div class="unit-services">';
                    // echo '<i class="service service-parking-car"></i>';
                    // echo '<i class="service service-secure"></i>';
                    // echo '<i class="service service-transport"></i>';
                    // echo '<i class="service service-temperature"></i>';
                    // echo '<i class="service service-guide"></i>';
                    // echo '<i class="service service-24h"></i>';
                    // echo '<i class="service service-box"></i>';
                    // echo '<i class="service service-savebox"></i>';
                    // echo '<i class="service service-parking"></i>';
                    // echo '<i class="service service-electric"></i>';
                    // echo '<i class="service service-guard"></i>';
                    // echo '<img src="assets/images/services.png" />';
                    foreach($def_icos as $def_ico){
                        echo '<img src="'.$def_ico.'" alt="'.$def_ico['title'].'" title="'.$def_ico['title'].'" class="img-ico" />';
                    }                                                

                    if($unit_details[0]->bClimate==true){
                        $id=$var_icons['bClimate'];
                        echo '<img src="'.get_field('icons',$id).'" title="'.get_the_title($id).'" alt="'.get_the_title($id).'" class="img-ico" />';
                    }                                                   

                    if($unit_details[0]->bInside==true){
                        $id=$var_icons['bInside'];
                        echo '<img src="'.get_field('icons',$id).'" title="'.get_the_title($id).'" alt="'.get_the_title($id).'" class="img-ico" />';
                    }

                    if($unit_details[0]->bAlarm==true){
                        $id=$var_icons['bAlarm'];
                        echo '<img src="'.get_field('icons',$id).'" title="'.get_the_title($id).'" alt="'.get_the_title($id).'" class="img-ico" />';
                    }

                    if($unit_details[0]->iFloor==true){
                        $id=$var_icons['iFloor'];
                        echo '<img src="'.get_field('icons',$id).'" title="'.get_the_title($id).'" alt="'.get_the_title($id).'" class="img-ico" />';
                    }

                    if($unit_details[0]->iDoorType==0){
                        $iDoor_id=$var_icons['iDoorType_0'];
                    } else if($unit_details[0]->iDoorType==1){
                        $iDoor_id=$var_icons['iDoorType_1'];
                    } else if($unit_details[0]->iDoorType==2){
                        $iDoor_id=$var_icons['iDoorType_2'];
                    }
                    echo '<img src="'.get_field('icons',$iDoor_id).'" title="'.get_the_title($iDoor_id).'" alt="'.get_the_title($iDoor_id).'" class="img-ico" />';

                echo '</div>';
            echo '</div>';

            // echo '<hr />';

            // echo '<div class="unit-price">';
            //     echo '<h2>Pricing Details</h2>';

            //     echo '<h3>Monthly Rental Fee</h3>';

            //     echo '<div class="one-half first">Exclusive Web Rate</div>';
            //     echo '<div class="one-half text-right">$'.number_format($on_site_rate, 2).'</div>';

            //     echo '<div class="one-half first">Saving</div>';
            //     echo '<div class="one-half text-right text-red">-$'.number_format($on_site_rate-$web_rate,2).'</div>';

            //     echo '<h3 class="ptop">One-Off Move-in Costs</h3>';

            //     echo '<div class="one-half first">Administrative Fees</div>';
            //     echo '<div class="one-half text-right text-red">-$'.number_format($location_details[0]->admin_fee,2).'</div>';
            //     $web_rate=$web_rate+$location_details[0]->admin_fee;
                
            //     foreach ($other_move_in_costs_details as $other_move_in_costs_detail){ 
            //         $web_rate=$web_rate+$other_move_in_costs_detail->price;
            //         echo '<div class="one-half first">'.$other_move_in_costs_detail->cost_type.'</div>';
            //         echo '<div class="one-half text-right text-red">-$'.number_format($other_move_in_costs_detail->price,2).'</div>';
            //     }

            //     echo '<div class="bottom-row-until">';
            //         echo '<div class="one-half first">';
            //             echo '<h3>Total Move-in Cost</h3>';
            //         echo '</div>';
            //         echo '<div class="one-half text-right">';
            //             echo '<h3>$'.number_format($web_rate,2).'</h3>';
            //         echo '</div>';
            //     echo '</div>';

            // echo '</div>';
        echo '</div>';
    echo '</section>';

}

         
// Widget Backend 
public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {$title = $instance[ 'title' ];}
    else {$title = __( '', 'ndss_unit_details_widget_domain' );}
    if ( isset( $instance[ 'widget_class' ] ) ) {$widget_class = $instance[ 'widget_class' ];}
    else {$widget_class = __( '', 'ndss_unit_details_widget_domain' );}
    // Widget admin form
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title of Coupon:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="Your Title" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'widget_class' ); ?>"><?php _e( 'Class:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'widget_class' ); ?>" name="<?php echo $this->get_field_name( 'widget_class' ); ?>" type="text" value="<?php echo esc_attr( $widget_class ); ?>" placeholder="Widget Class" />
    </p>
    <?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['widget_class'] = ( ! empty( $new_instance['widget_class'] ) ) ? strip_tags( $new_instance['widget_class'] ) : '';
    return $instance;
}
} // Class ndss_unit_details_widget ends here
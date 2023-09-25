<?php


// Register and load the widget
function ndss_single_info_details_widget() {
    register_widget( 'ndss_single_info_details_widget' );
}
add_action( 'widgets_init', 'ndss_single_info_details_widget' );
 
// Creating the widget 
class ndss_single_info_details_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'ndss_single_info_details_widget', 
 
// Widget name will appear in UI
__('NDSS Single Info Details Widget', 'ndss_single_info_details_widget_domain'), 
 
// Widget description
array( 'description' => __( 'NDSS Single Information Widget to show basic info about the Location', 'ndss_single_info_details_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $widget_class = $instance['widget_class'];
    
    /**
     * Get information from url
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
    $ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $url = "http://freegeoip.net/json/$ip";
    $ch  = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($ch);
    curl_close($ch);
    $lat = "";
    $lon = "";
    $formattedAddress = "";
    if ($data) {
        $location = json_decode($data);

        $lat = $location->latitude;
        $lon = $location->longitude;
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
        $json = @file_get_contents($url);
        $data=json_decode($json);
        $status = $data->status;
        //echo "abcd".$data->results[0]->formatted_address; 
        if($status=="OK"){
            $formattedAddress = $data->results[0]->formatted_address;
        }else{
            $formattedAddress = "";
        }
    }
    echo '<section class="unit-map-widget shadow-widget">';
        echo '<div class="unit-map-description">';
            echo '<div class="map-container desktop">';
                echo '<div class="ndss-single-map-contenetor"><div id="ndss-single-info-map"></div></div>';
                // echo '<img src="assets/images/storage-map.png" />';
                echo '<div class="unit-place">';
                    echo '<img src="'.$location_details[0]->image.'" />';
                    echo '<div><a href="/self-storage"><span>Change Location</span></a></div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="map-container mobile">';
                if($location_details[0]->image)
                    echo '<img src="'.$location_details[0]->image.'" class="ndss-widg-img" />';
                else
                    echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/default-loction.png" class="ndss-widg-img" />';
                echo '<div class="unit-place">';
                    // echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/map-marked.png" />';
                    echo '<div class="ndss-map-contenetor"><div id="ndss-single-map"></div></div>';
                    echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/red-marker-little.png" class="single-marker-map" />';
                    // echo '<div><span>Get Directions123</span></div>';
                    echo '<form id="google_driving" action="https://maps.google.com/maps" method="get"  target="popup"><input type="hidden" value="'.$formattedAddress.'"style="" name="saddr" id="start" /><input type="hidden"  name="daddr" value="'.$location_details[0]->

sSiteAddr1 . ',' . $location_details[0]->sSiteCity . ',' . $location_details[0]->

sSiteRegion . ' ' . $location_details[0]->sSitePostalCode .'"/><input type="submit" value="GET DIRECTIONS" class="white-btns constant" /></form>';
                echo '</div>';
            echo '</div>';

            echo '<div class="unit-descritpion">';
                echo '<h2>'.$location_details[0]->sSiteCity.' Storage</h2>';
                echo '<small>'.$location_details[0]->sSiteAddr1.', '.$location_details[0]->sSiteCity.', '.$location_details[0]->sSiteRegion.' '.$location_details[0]->sSitePostalCode.'</small>';
                echo '<div class="mobile unit-phone">'.$location_details[0]->sSitePhone.'</div>';
                echo '<div class="two-thirds first unit-email">';
                    echo '<a href="mailto: '.$location_details[0]->sEmailAddress.'">'.$location_details[0]->sEmailAddress.'</a>';
                echo '</div>';
                echo '<div class="one-third unit-phone text-right desktop">';
                    echo $location_details[0]->sSitePhone;
                echo '</div>';
                /**
                 * Reviews
                 */
                $review_table_name = $wpdb->prefix . "review";
                $review_total_query = "SELECT sum(rating) as review_count  FROM $review_table_name WHERE site_id=%d and status = %s ";
                $review_total_details = (array )$wpdb->get_results($wpdb->prepare($review_total_query, $location_id, 'Approved'));
                $review_query = "SELECT *  FROM $review_table_name WHERE site_id=%d and status = %s ";
                $review_details = (array )$wpdb->get_results($wpdb->prepare($review_query, $location_id, 'Approved'));
                $review_num = count($review_details);
                if ($review_num == 0) {
                    $total_review_count = 0;
                } else {
                    $total_review_count = intval($review_total_details[0]->review_count / $review_num);
                }
                $to_loop = 5 - $total_review_count;
                echo '<div class="reviews-container mobile">';
                    echo '<span><a href="'.$location_details[0]->google.'" target="_blank" class="ndss-google-share"><i class="fa fa-google-plus"></i></a></span>';
                    for ($i = 0; $i < $total_review_count;$i++){
                        echo '<span class="fa fa-star"></span>';
                    }
                    for ($i = 0; $i < $to_toop;$i++){
                        echo '<span class="fa fa-star empty"></span>';
                    }
                    echo '<span class="total-reviews">'.$total_review_count.'.0/5.0  <span>('.$review_num.' Reviews)</span></span>';
                    echo '<br><br>';
                echo '</div>';
                /* End Reviews*/
            echo '</div>';
        echo '</div>';
    echo '</section>';

    echo '<script>
        jQuery( document ).ready(function() {
            var uluru = {lat: '.$location_details[0]->dcLatitude.', lng: '.$location_details[0]->dcLongitude.'};
            var map = new google.maps.Map(document.getElementById("ndss-single-map"), {
                zoom: 10,
                center: uluru,
                disableDefaultUI: true
            });
            var maps = new google.maps.Map(document.getElementById("ndss-single-info-map"), {
                zoom: 10,
                center: uluru,
                disableDefaultUI: true
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map,
                icon: "'.get_stylesheet_directory_uri().'/assets/images/red-marker-little.png",
            });
            var markers = new google.maps.Marker({
                position: uluru,
                map: maps,
                icon: "'.get_stylesheet_directory_uri().'/assets/images/red-marker-little.png",
            });
        });
    </script>';
}

         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {$title = $instance[ 'title' ];}
else {$title = __( '', 'ndss_single_info_details_widget_domain' );}
if ( isset( $instance[ 'widget_class' ] ) ) {$widget_class = $instance[ 'widget_class' ];}
else {$widget_class = __( '', 'ndss_single_info_details_widget_domain' );}
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
} // Class ndss_single_info_details_widget ends here
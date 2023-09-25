<?php


// Register and load the widget
function ndss_location_details_widget() {
    register_widget( 'ndss_location_details_widget' );
}
add_action( 'widgets_init', 'ndss_location_details_widget' );
 
// Creating the widget 
class ndss_location_details_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'ndss_location_details_widget', 
 
// Widget name will appear in UI
__('NDSS Location Details Widget', 'ndss_location_details_widget_domain'), 
 
// Widget description
array( 'description' => __( 'NDSS Navigation Widget to put your content', 'ndss_location_details_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $widget_class = $instance['widget_class'];
    $text_content = $instance['text_content'];

    /**
     * Get information from url
     */
    global $wpdb; 

    $url = $_SERVER['REQUEST_URI'];
    $custom_slug = explode('/', $url);
    $location_slug = $custom_slug[count($custom_slug)-3].'/'.$custom_slug[count($custom_slug)-2];
    
    $id = getLocationBySlug($location_slug);
    if(!$id){
        $id = getLocationBySlug($location_slug.'/'); $id_single = getLocationBySlug($location_slug.'/');
    }
    // $id = '6657';
    if ($id) {
        $table_name = $wpdb->prefix . "location_information";    
        $location_query = "SELECT * FROM $table_name WHERE SiteID=%d LIMIT 1";
        $location_details = $wpdb->get_results($wpdb->prepare($location_query, $id));
    }

    if(!$id){
        $location_id = $_GET['location'];
        $id = $_GET['location'];
        $table_name = $wpdb->prefix . "location_information";
        $location_query = "SELECT * FROM $table_name WHERE SiteID=%d LIMIT 1";
        $location_details = $wpdb->get_results($wpdb->prepare($location_query, $location_id));  
    }

    // print_r($location_details);
 
    $ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $url1 = "http://freegeoip.net/json/$ip";
    $ch  = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url1);
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
        $url2 = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lon).'&sensor=false';
        $json = @file_get_contents($url2);
        $data=json_decode($json);
        $status = $data->status;
        //echo "abcd".$data->results[0]->formatted_address; 
        if($status=="OK"){
            $formattedAddress = $data->results[0]->formatted_address;
        }else{
            $formattedAddress = "";
        }
    }

    echo '<section class="unit-map-widget shadow-widget '.$widget_class.'">';
        echo '<div class="unit-map-description">';

            echo '<div class="map-container">';
                if($location_details[0]->image)
                    echo '<img src="'.$location_details[0]->image.'" class="ndss-widg-img" />';
                else
                    echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/default-loction.png" class="ndss-widg-img" />';
                echo '<div class="unit-place" style="cursor:pointer;" onclick="jQuery(\'#google_driving\').trigger(\'submit\');">';
                    // echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/map-marked.png" />';
                    echo '<div class="ndss-map-contenetor"><div id="ndss-single-map"></div></div>';
                    echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/red-marker-little.png" class="single-marker-map" />';
                    echo '<div><form id="google_driving" action="https://maps.google.com/maps" method="get"  target="popup"><input type="hidden" value="'.$formattedAddress.'"style="" name="saddr" id="start" /><input type="hidden"  name="daddr" value="'.$location_details[0]->

sSiteAddr1 . ',' . $location_details[0]->sSiteCity . ',' . $location_details[0]->

sSiteRegion . ' ' . $location_details[0]->sSitePostalCode .'"/><span><input type="submit" value="Get Directions" class="white-btns constant" style="font-weight: 600;font-size: 13px;line-height: 18px;text-align: center;color: #fff;padding:0;margin:0;background-color:#0f5dba;margin-top:-3px;text-transform:capitalize;" /></span></form></div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="unit-descritpion">';
                // echo '<h2>'.$location_details[0]->sSiteCity.' Storage</h2>';
                echo '<h2>Next Door Self Storage</h2>';
                echo '<small>'.$location_details[0]->sSiteAddr1.', '.$location_details[0]->sSiteCity.', '.$location_details[0]->sSiteRegion.' '.$location_details[0]->sSitePostalCode.'</small>';
                echo '<div class="unit-phone">'.$location_details[0]->sSitePhone.'</div>';
                echo '<div class="unit-email">';
                    echo '<a href="mailto:'.$location_details[0]->sEmailAddress.'">'.$location_details[0]->sEmailAddress.'</a>';
                echo '</div>';
                /**
                 * Reviews
                 */
                // API set location
                $placeid = get_field('google_place_id');;
                // $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$placeid&key=AIzaSyAK1uBre1l0RGmHKpvTbMwLPcrUPDfuCm8";
                $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$placeid&key=AIzaSyDwrByqyICZonLGiG5xHf2YKTcGedx6LT8"; 
                //call api
                $json = file_get_contents($url);
                $json = json_decode($json);
                // print_r($json->result->rating);
                $api_rating = $json->result->rating;
                
                $review_table_name = $wpdb->prefix . "review";
                $review_total_query = "SELECT sum(rating) as review_count  FROM $review_table_name WHERE site_id=%d and status = %s ";
                $review_total_details = (array )$wpdb->get_results($wpdb->prepare($review_total_query, $id, 'Approved'));
                $review_query = "SELECT *  FROM $review_table_name WHERE site_id=%d and status = %s ";
                $review_details = (array )$wpdb->get_results($wpdb->prepare($review_query, $id, 'Approved'));
                $review_num = count($review_details);
                // if ($review_num == 0) {
                //     $total_review_count = 0;
                // } else {
                //     $total_review_count = intval($review_total_details[0]->review_count / $review_num);
                // }
                $to_loop = 5 - $total_review_count;
                echo '<div class="reviews-container">';
                    echo '<span><a href="'.$location_details[0]->google.'" target="_blank" class="ndss-google-share"><i class="fa fa-google-plus"></i></a></span>';
                    for ($i = 0; $i < 5;$i++){
                        if($api_rating > $i)
                            echo '<span class="fa fa-star"></span>';
                        else 
                            echo '<span class="fa fa-star empty"></span>';
                    }
                    // echo '&nbsp;<span>'.$api_rating.'.0/5.0  ('.$review_num.' Reviews)</span>';
                    if(is_int($api_rating))
                        echo '&nbsp;<span class="total-reviews">'.$api_rating.'.0/5.0  <span>(X Reviews)</span></span>';
                    else 
                        echo '&nbsp;<span>'.$api_rating.'/5.0  (X Reviews)</span>';
                    echo '<br><br>';
                echo '</div>';
                /* End Reviews*/
            
                echo '<hr class="no-mobile">';
                
                /**
                * Office And Access Hours
                */
                $storage_hours = array(); $storage_hours_count = 0;
                $office_hour_table_name = $wpdb->prefix . "office_hour";
                $office_hour_query = "SELECT * FROM $office_hour_table_name WHERE site_id=%d 
                    ORDER BY CASE          
                        WHEN Day = 'Monday' THEN 1
                        WHEN Day = 'Tuesday' THEN 2
                        WHEN Day = 'Wednesday' THEN 3
                        WHEN Day = 'Thursday' THEN 4
                        WHEN Day = 'Friday' THEN 5
                        WHEN Day = 'Saturday' THEN 6
                        WHEN Day = 'Sunday' THEN 7
                    END ASC";
                $office_hour_details = $wpdb->get_results($wpdb->prepare($office_hour_query, $id));
                if (!empty($office_hour_details)) {
                    foreach ($office_hour_details as $office) {
                        $storage_hours[$storage_hours_count]['day']=$office->day;
                        if ($office->closed == 1) {
                            $storage_hours[$storage_hours_count]['office_hour']='CLOSED';
                        } else {
                            if($office->end_time){
                                $storage_hours[$storage_hours_count]['office_hour']=$office->start_time.' - '.$office->end_time;
                            } else {
                                $storage_hours[$storage_hours_count]['office_hour']=$office->start_time;
                            }
                        }
                        $storage_hours_count++;
                    }
                }

                $storage_hours_count = 0;
                $access_hour_table_name = $wpdb->prefix . "access_hour";
                $access_hour_query = "SELECT * FROM $access_hour_table_name WHERE site_id=%d 
                    ORDER BY CASE
                        WHEN Day = 'Monday' THEN 1
                        WHEN Day = 'Tuesday' THEN 2
                        WHEN Day = 'Wednesday' THEN 3
                        WHEN Day = 'Thursday' THEN 4
                        WHEN Day = 'Friday' THEN 5
                        WHEN Day = 'Saturday' THEN 6
                        WHEN Day = 'Sunday' THEN 7
                    END ASC";
                $access_hour_details = $wpdb->get_results($wpdb->prepare($access_hour_query, $id));
                if (!empty($access_hour_details)) {
                    foreach ($access_hour_details as $access) {
                        if ($access->closed == 1) { 
                            $storage_hours[$storage_hours_count]['access_hour']='CLOSED';
                        } else { 
                            if(trim($access->start_time) == 'Open 24 Hours') 
                                $storage_hours[$storage_hours_count]['access_hour']='open-24';
                            if($access->end_time){
                                $storage_hours[$storage_hours_count]['access_hour']=$access->start_time.' - '.$access->end_time;
                            } else {
                                $storage_hours[$storage_hours_count]['access_hour']=$access->start_time;
                            }
                        }
                        $storage_hours_count++;
                    }
                }
                
                echo '<div class="atention-hours no-mobile">';
                    echo '<div class="description-hours description-title">';
                        echo '<div class="day"></div>';
                        echo '<div class="office-hours">Office Hours</div>';
                        echo '<div class="access-hours">Access Hours</div>';
                    echo '</div>';
                    foreach($storage_hours as $shours){
                        if($shours['day']!=''){
                            echo '<div class="description-hours">';
                                echo '<div class="day">'.$shours['day'].'</div>';
                                echo '<div class="office-hours">'.$shours['office_hour'].'</div>';
                                echo '<div class="access-hours">'.$shours['access_hour'].'</div>';
                            echo '</div>';
                        }
                    }
                echo '</div>';
                /* End Reviews*/
            
                echo '<hr class="no-mobile">';
                
                /**
                * Benefit Icons
                */
                echo '<div class="benefit-storage no-mobile">';
                    echo '<div class="description-benefit">';
                        $icons_data = array(
                            'post_type' => 'icons',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'order_by' => 'menu_order');
                        $icon_list = new WP_Query($icons_data);
                        while ($icon_list->have_posts()):
                            $icon_list->the_post();
                            echo '<div class="benefit-item">';
                                echo '<img src="'.get_field('icons').'" /> '.get_the_title();
                            echo '</div>';
                        endwhile;
                        wp_reset_postdata();
                    echo '</div>';
                echo '</div>';

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
            var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon: "'.get_stylesheet_directory_uri().'/assets/images/red-marker-little.png",
            });
        });
    </script>';
} 


         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {$title = $instance[ 'title' ];}
else {$title = __( '', 'ndss_location_details_widget_domain' );}
if ( isset( $instance[ 'widget_class' ] ) ) {$widget_class = $instance[ 'widget_class' ];}
else {$widget_class = __( '', 'ndss_location_details_widget_domain' );}
if ( isset( $instance[ 'text_content' ] ) ) {$text_content = $instance[ 'text_content' ];}
else {$text_content = __( '', 'ndss_location_details_widget_domain' );}
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
<p>
<label for="<?php echo $this->get_field_id( 'text_content' ); ?>"><?php _e( 'Text Description:' ); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id( 'text_content' ); ?>" name="<?php echo $this->get_field_name( 'text_content' ); ?>" ><?php echo esc_attr( $text_content ); ?></textarea>
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['widget_class'] = ( ! empty( $new_instance['widget_class'] ) ) ? strip_tags( $new_instance['widget_class'] ) : '';
$instance['text_content'] = ( ! empty( $new_instance['text_content'] ) ) ? $new_instance['text_content'] : '';
return $instance;
}
} // Class ndss_location_details_widget ends here
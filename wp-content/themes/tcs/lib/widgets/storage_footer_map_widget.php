<?php


// Register and load the widget
function ndss_footer_map_widget() {
    register_widget( 'ndss_footer_map_widget' );
}
add_action( 'widgets_init', 'ndss_footer_map_widget' );
 
// Creating the widget 
class ndss_footer_map_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'ndss_footer_map_widget', 
 
// Widget name will appear in UI
__('NDSS Footer Map Widget', 'ndss_footer_map_widget_domain'), 
 
// Widget description
array( 'description' => __( 'NDSS Footer Map Widget to show office', 'ndss_footer_map_widget_domain' ), ) 
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
    
    echo '<section class="footer-map-widget '.$widget_class.'">';
        echo '<!-- Box Location Search -->';
        echo '<div id="bh-sl-map-container-footer" class="bh-sl-map-container-footer">';
            echo '<div id="bh-sl-map-footer" class="bh-sl-map-footer"></div>';
                    echo '<div class="bh-sl-loc-list-footer">';
                        echo '<ul class="list"></ul>';
                    echo '</div>';
        echo '</div>';
        echo '<!-- /Box Location Search -->';
    echo '</section>';

}

         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {$title = $instance[ 'title' ];}
else {$title = __( '', 'ndss_footer_map_widget_domain' );}
if ( isset( $instance[ 'widget_class' ] ) ) {$widget_class = $instance[ 'widget_class' ];}
else {$widget_class = __( '', 'ndss_footer_map_widget_domain' );}
if ( isset( $instance[ 'text_content' ] ) ) {$text_content = $instance[ 'text_content' ];}
else {$text_content = __( '', 'ndss_footer_map_widget_domain' );}
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
} // Class ndss_footer_map_widget ends here
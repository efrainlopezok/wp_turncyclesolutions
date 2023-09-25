<?php


// Register and load the widget
function ndss_category_widget(){
    register_widget( 'ndss_category_widget' );
}
add_action( 'widgets_init', 'ndss_category_widget' );
 
// Creating the widget 
class ndss_category_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'ndss_category_widget', 
 
// Widget name will appear in UI
__('NDSS Category Widget', 'ndss_category_widget_domain'), 
 
// Widget description
array( 'description' => __( 'NDSS Category Widget to put your content', 'ndss_category_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$widget_class = $instance['widget_class'];
$text_content = $instance['text_content'];
 
echo '<section class="'.$widget_class.'">';
    echo '<h2>'.$title.'</h2>';
    echo '<ul>
        <li><a href="/category/aliquam-vel-massa-non/">Aliquam vel massa non</a></li>
        <li><a href="/category/convallis-non-ex/">Convallis non ex</a></li>
        <li><a href="/category/euismod-tempor/">Euismod tempor</a></li>
        <li><a href="/magna-mattis-natoque-penatibus/">Magna mattis natoque penatibus</a></li>
        <li><a href="/nam-id-velit-sit-amet-tellus/">Nam id velit sit amet tellus</a></li>
    </ul>';
echo '</section>';
}

         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {$title = $instance[ 'title' ];}
else {$title = __( '', 'ndss_category_widget_domain' );}
if ( isset( $instance[ 'widget_class' ] ) ) {$widget_class = $instance[ 'widget_class' ];}
else {$widget_class = __( '', 'ndss_category_widget_domain' );}
if ( isset( $instance[ 'text_content' ] ) ) {$text_content = $instance[ 'text_content' ];}
else {$text_content = __( '', 'ndss_category_widget_domain' );}
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
$instance['text_content'] = ( ! empty( $new_instance['text_content'] ) ) ? strip_tags( $new_instance['text_content'] ) : '';
return $instance;
}
} // Class ndss_category_widget ends here
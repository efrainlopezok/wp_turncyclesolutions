<?php


// Register and load the widget
function tcs_imagelink_widget() {
    register_widget( 'tcs_widget' );
}
add_action( 'widgets_init', 'tcs_imagelink_widget' );
 
// Creating the widget 
class tcs_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'tcs_widget', 
 
// Widget name will appear in UI
__('TCS Image Link Widget', 'tcs_widget_domain'), 
 
// Widget description
array( 'description' => __( 'TCS Image Link Widget to show your image and link', 'tcs_widget_domain' ), ) 
);
}
 
// Creating widget front-end

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$content = $instance['content'];

$image = get_field('get_your_image', 'widget_' . $args['widget_id']);
$link = get_field('ger_your_link', 'widget_' . $args['widget_id']);

echo '<section class="widget-link-image">';
    echo '<div class="image-content">';
        echo '<img src="'.$image.'" />';
        echo '<div class="text-content">';
            echo '<h4>'.$title.'</h4>';
            echo '<p>'.$content.'</p>';
        echo '</div>';
    echo '</div>';
    echo '<a class="base-button color-green" href="'.$link['url'].'" target="'.$link['target'].'"><span>'.$link['title'].'</span><i class="fas fa-caret-right"></i></a>';
echo '</section>';
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {$title = $instance[ 'title' ];}
else {$title = __( '', 'tcs_widget_domain' );}
if ( isset( $instance[ 'content' ] ) ) {$class_widget = $instance[ 'content' ];}
else {$class_widget = __( '', 'tcs_widget_domain' );}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="Your Title" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" type="text" value="<?php echo esc_attr( $terms_page ); ?>" placeholder="Content of the Box" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
return $instance;
}
} // Class ndss_widget ends here
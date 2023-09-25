<?php
/*
Button
---------------------------------------------------------------------------------------------------- */
// Example usage 1
// [button href="YOUR LINK" target="self"]Button Text[/button]
// Example usage 2
// [button href="YOUR LINK" target="self" text="Button Text"]

function myprefix_button_shortcode( $atts, $content = null ) {
	
	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'url'    => '',
		'title'  => '',
		'target' => '',
        'text'   => '',
        'align'  => 'left',
		'color'  => 'green',
	), $atts ) );

	// Use text value for items without content
	$content = $text ? $text : $content;

	// Return button with link
	if ( $url ) {

		$link_attr = array(
			'href'   => esc_url( $url ),
			'title'  => esc_attr( $title ),
			'target' => ( 'blank' == $target ) ? '_blank' : '',
			'class'  => 'base-button color-'.esc_attr( $color ),
		);

		$link_attrs_str = '';

		foreach ( $link_attr as $key => $val ) {

			if ( $val ) {

				$link_attrs_str .= ' '. $key .'="'. $val .'"';

			}

		}


		return '<p style="text-align: '.$atts['align'].'"><a'. $link_attrs_str .'><span>'. do_shortcode( $content ) .'</span> <i class="fas fa-caret-right"></i></a></p>';

	}

	// No link defined so return button as a span
	else {

		return '<p style="text-align: '.$atts['align'].'"><span class="myprefix-button"><span>'. do_shortcode( $content ) .'</span></span></p>';

	}

}
add_shortcode( 'button', 'myprefix_button_shortcode' );

function transparent_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url'    => '',
		'title'  => '',
		'target' => '',
        'text'   => '',
		'color'  => 'white',
	), $atts ) );

	return '<a href="'.$url.'" class="btn-transparent '.$color.'" target="'.$target.'" title="'.$title.'">'.$content.'</a>';

}
add_shortcode( 'button_link', 'transparent_button_shortcode' );

/**********************
*   Product List Shortcode
**********************/
add_shortcode('product-list', 'product_list_shortcode');
function product_list_shortcode($atts, $content) {    
	global $post;
	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'limit'    => '-1',
	), $atts ) );
    
    $settings = array(
        'posts_per_page' => $limit, 
        'post_type' => 'product', 
        'orderby' => 'date', 
        'order' => 'DESC', 
    );

    global $wp_query;
    
    $wp_query = new WP_Query( $settings );
        
    $list = '<div class="row product-list">';
    $wp_query = new WP_Query( $settings );
    if(have_posts()):
        while ( have_posts() ) : the_post();
            $list .= '
            <div class="col s4 product-item">
				<div class="product-contenetor">
					<div class="product-content">
						<a href="'.get_field('link').'"><h4>'.get_the_title().'</h4></a>
						<p>'.get_the_excerpt().'</p>
					</div>
					<a class="link-product" href="'.get_field('link').'" >Buy Now</a>
                </div>
            </div>';
        endwhile;        
        // do_action( 'genesis_after_endwhile' );
    endif;
    wp_reset_query();
    $list.= '</div>';

    return $list;
}

/**********************
*   Product Slider Shortcode
**********************/
add_shortcode('product-slider', 'product_slider_shortcode');
function product_slider_shortcode($atts, $content) {    
	global $post;
	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'limit'    => '-1',
	), $atts ) );
    
    $settings = array(
        'posts_per_page' => $limit, 
        'post_type' => 'product', 
        'orderby' => 'date', 
        'order' => 'DESC', 
    );

    global $wp_query;
    
    $wp_query = new WP_Query( $settings );
        
    $list = '<div class="product-slider">';
    $wp_query = new WP_Query( $settings );
    if(have_posts()):
		while ( have_posts() ) : the_post();
            $list .= '
            <div class="product-item">
				<div class="product-content">
					<div class="product-contenetor">
						<div class="product-content">
							<a href="'.get_permalink().'"><h4>'.get_the_title().'</h4></a>
							<p>'.get_the_excerpt().'</p>
						</div>
					</div>
                </div>
            </div>';
        endwhile;        
        // do_action( 'genesis_after_endwhile' );
    endif;
    wp_reset_query();
    $list.= '</div>';

    return $list;
}

/*  Binnacle shortcode
******************************/
function binnacle_member_shortcode() {
    global $wpdb;

    $page = filter_var($_GET['cpage'], FILTER_VALIDATE_INT );
    $page = $page === false? 1 : $page;

    $table = $wpdb->prefix . 'binnacle_member';
    $tblUsr = $wpdb->prefix . 'users';
    $total  = $wpdb->get_var("SELECT count(*) FROM $table GROUP BY user_id");
    $per_page = 20;
    $rows  = $wpdb->get_results("SELECT b.*, u.display_name FROM $table b JOIN $tblUsr u ON b.user_id = u.ID"
                ." GROUP BY b.user_id ORDER BY b.edited_at DESC limit ".(($page - 1) * $per_page).", {$per_page}", ARRAY_A
    );
    $pages = ceil($total / $per_page);

    ob_start();
    ?>
    <h2>Member Edits</h2>
        <!-- Binnacle list -->
        <table class="responsive-table">
            <tr>
                <th>User</th>
                <th>Last Edition</th>
                <th></th>
            </tr>
        <?php if($rows):?>

            <?php foreach ($rows as $row): 
                $metadata = unserialize($row['metadata']);
            ?>
            <tr>
                <td><?php echo $row['display_name']; ?> </td>
                <td><?php echo date( 'm/d/Y h:i',strtotime($row['edited_at'])); ?> </td>
                <td align="right">
                    <a  href="<?php echo add_query_arg( array('uid'=>$row['user_id']), site_url( '/member-binnacle-detail' ) ); ?>" title="Detail">detail
                    </a>
                    <!-- <a href="#" title="Delete" data-binnacle-remove="" id="<?php echo $row['ID']; ?>">delete</a> -->
                    <div id="<?php echo 'binnacle_'.$row['ID']; ?>" class="binnacle-modal" >
                        <div class="m-dialog">
                            <div class="m-content">
                                <div class="m-body">
                                    <h3>Binnacle detail</h3>
                                    <table>
                                        <tr>
                                            <th>action</th>
                                            <td><?php echo $row['action']; ?> </td>
                                        </tr>
                                        <?php foreach ($metadata as $key=>$val): ?>
                                        <tr>
                                            <th><?php echo $key; ?></th>
                                            <td><?php echo $val; ?></td>
                                        </tr>
                                        <?php endforeach; ?>    
                                    </table>
                                </div>
                            </div>
                        </div>  
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </table>
        <!-- End Binnacle list -->

    <!-- pagination -->
    <?php 
    echo '<div class="blog-pagination">';
    echo paginate_links( array(
        'base' => add_query_arg( 'cpage', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => $pages,
        'current' => $page
    ));
    echo '</div>';
    ?>
    <!-- End pagination -->

    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode( 'binnacle_members', 'binnacle_member_shortcode' );

function binnacle_member_detail_shortcode() {
    global $wpdb;

    $page = filter_var($_GET['cpage'], FILTER_VALIDATE_INT );
    $user_id = filter_var($_GET['uid'], FILTER_VALIDATE_INT );

    $user_id = $user_id === false? 0 : $user_id;
    $page = $page === false? 1 : $page;

    $table = $wpdb->prefix . 'binnacle_member';
    $tblUsr = $wpdb->prefix . 'users';
    $per_page = 12;

    $total = $wpdb->get_var("SELECT count(*) FROM $table b WHERE b.user_id = {$user_id}");
    $rows  = $wpdb->get_results("SELECT b.*, u.display_name FROM $table b JOIN $tblUsr u ON b.user_id = u.ID"
                ." WHERE b.user_id = {$user_id}"
                ." ORDER BY b.edited_at DESC limit ".(($page - 1) * $per_page).", {$per_page}", ARRAY_A
    );
    $pages = ceil($total / $per_page);

    ob_start();

    $fields = [
            'first_name'  => 'First Name',
            'last_name'   => 'Last Name',
            'user_email'  => 'Email',
            'country_region'  => 'Country',
            'address'         => 'Address',
            'address2'        => 'Address2',
            'city'            => 'City',
            'state_province'  => 'State',
            'zipcode'         => 'Zip Code',
            'phone'           => 'Phone',
            'billing_company' => 'Billing Company',
            'billing_first_name' => 'Billing First Name',
            'billing_last_name' => 'Billing Last Name',
        ];
    ?>
    <!-- Binnacle list -->
    <table class="responsive-table">
        <tr>
            <th>Date</th>
            <th>Changes</th>
            <th>Action</th>
            <th></th>
        </tr>
    <?php if($rows): ?>

        <?php foreach ($rows as $row): 
            $metadata = unserialize($row['metadata']);
            $diff_data = unserialize($row['diff_data']);
        ?>
        <tr>
            <td><span class="binnacle-date"><?php echo date( 'm/d/Y h:i',strtotime($row['edited_at'])); ?></span> </td>
            <td>
                <table class="tbl-binnacle-fields">
                    <tr>
                        <?php foreach ($diff_data as $key => $value):?>
                        <td><p class="binacle-field-title"><?php echo $fields[$key]; ?></p>
                            <span class="old-value"><?php echo $metadata[$key]? $metadata[$key]: '&nbsp;'; ?></span>
                            <p class="binnacle-field-change"><?php echo $value? $value : '&nbsp;'; ?></p>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
            <td><?php echo str_replace('_', ' ', $row['action']); ?></td>
            <td align="right">
                <a href="#modal_delete_binnacle" class="modal-trigger" title="Delete" data-binnacle-confirm-remove="<?php echo date( 'm/d/Y h:i',strtotime($row['edited_at'])); ?>" id="<?php echo $row['ID']; ?>">delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </table>
    
    <!-- delete confirmation modal -->
    <div id="modal_delete_binnacle" class="modal">
        <div class="modal-content">
            <button class="close"><i class="far fa-times-circle modal-close"></i></button>
          <h2 class="center ">Confirm Deletion</h2>
          <p id="confirm_delete_message" class="center">&nbsp;</p>
          <div class="center">
              <a href="#!" class="modal-close base-button color-red" data-binnacle-remove="">Delete</a>
              <button class="modal-close base-button color-blue">Cancel</button>
          </div>
          <p>&nbsp;</p>
        </div>
    </div>
    <!-- End delete confirmation modal -->

    <!-- pagination -->
    <?php 
    echo '<div class="blog-pagination">';
    echo paginate_links( array(
        'base' => add_query_arg( 'cpage', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => $pages,
        'current' => $page
    ));
    echo '</div>';
    ?>
    <!-- End pagination -->

    <p><a href="<?php echo site_url( '/member-binnacle'); ?>">Back</a></p>
    <!-- End Binnacle list -->
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode( 'binnacle_member_detail', 'binnacle_member_detail_shortcode' );
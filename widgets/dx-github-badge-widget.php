<?php
/**
 * A sample widget initialization 
 * 
 * The widget name is DX GitHub Badge
 * 
 * @author metodiew
 *
 */
class DX_GitHub_Badge_Widget extends WP_Widget {

    /**
     * Register the widget
     */
    public function __construct() {
        parent::__construct(
            'dx_github_badge_widget',
            __( 'DX GitHub Badge Widget' , 'dxghb' ),
            array( 
            	'classname' => 'dx_github_badge', 
            	'description' => __( 'DX GitHub Badge Widget', 'dxghb' ) 
            ),
            array()
        );
    }

    /**
     * Output of widget
     * 
     * The $args array holds a number of arguments passed to the widget 
     */
    public function widget ( $args, $instance ) {
        extract( $args );

        // Get widget field values
        $widget_title = apply_filters( 'widget_title', $instance[ 'widget_title' ] );

        // Start widget body
        $widget_output = '';
        
        if ( ! empty( $instance['github_username'] ) ) {
        	$widget_output .= '
		    	<iframe
		    		src="http://githubbadge.appspot.com/' . $instance['github_username'] . '?s=1&a=0"
		    		style="
			    		width: ' . $instance["width"] .';
		    			height: ' . $instance["height"] . ';
			    		border: ' . $instance["border"] . ';
			    		overflow: hidden;
			    	"
		    		frameBorder="0">
		    	</iframe>
	    	';
        }
        
        // End sample widget body creation
        
        if ( ! empty( $widget_output ) ) {
        	echo $before_widget;
        	
        	if ( $widget_title ) {
        		echo $before_title . $widget_title . $after_title;
        	}
        	?>
        	<div class="dx_github_badge_widget">
        		<?php echo $widget_output; ?>
        	</div>
        	<?php
			echo $after_widget;
        }
    }

    /**
     * Updates the new instance when widget is updated in admin
     *
     * @return array $instance new instance after update
     */
    public function update ( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
        $instance['github_username'] = strip_tags( $new_instance['github_username'] );
        $instance['width'] = strip_tags( $new_instance['width'] );
        $instance['height'] = strip_tags( $new_instance['height'] );
        $instance['border'] = strip_tags( $new_instance['border'] );
        
        return $instance;
    }

    /**
     * Widget Form
     */
    public function form ( $instance ) {
    	
    	//$instance_defaults = get_option( 'widget_dx_github_badge_widget' );

		$instance_defaults = array(
			'widget_title' => '',
			'github_username' => '',
			'width' => '200px',
			'height' => '127px',
			'border' => '0'
		);
    	
    	$instance = wp_parse_args( $instance, $instance_defaults );

        $widget_title = esc_attr( $instance[ 'widget_title' ] );
        $github_username = esc_attr( $instance[ 'github_username' ] );
        $width = esc_attr( $instance[ 'width' ] );
        $height = esc_attr( $instance['height'] );
        $border = esc_attr( $instance['border'] );
        ?>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>">
				<?php _e( 'Widget Title:', 'dxghb' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo $widget_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'github_username' ); ?>">
				<?php _e( 'GitHub Username:', 'dxghb' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'github_username' ); ?>" name="<?php echo $this->get_field_name( 'github_username' ); ?>" type="text" value="<?php echo $github_username; ?>" placeholder="Enter GitHub Username here" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width', 'dxghb' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height', 'dxghb' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'border' ); ?>"><?php _e( 'border', 'dxghb' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'border' ); ?>" name="<?php echo $this->get_field_name( 'border' ); ?>" type="text" value="<?php echo $border; ?>" />
		</p>
	<?php
    }
}

// Register the widget for use
register_widget( 'DX_GitHub_Badge_Widget' );
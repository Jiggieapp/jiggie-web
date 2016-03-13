<?php
class STFlickrWidget extends WP_Widget{
	public function __construct(){
		
		parent::__construct( false, 'ST Fickr Widget' );
		add_action('wp_enqueue_scripts',array($this,'add_scripts'));
		
	}
	static function st_add_widget()
	{
		register_widget( 'STFlickrWidget' );
	}
	public function add_scripts()
	{
		# code...
		wp_register_script('flickr-widget',get_template_directory_uri().'/inc/widgets/flickr_widget/flickr_widget.js',array('jquery'),null,true);
		wp_enqueue_script('flickr-widget');
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $st_flickwidget_id;
		if(!$st_flickwidget_id)
		{
            $st_flickwidget_id=time();
		}else
		{
            $st_flickwidget_id+=1;
		}
		$title = apply_filters( 'widget_title', $instance['title'] );
		$user_id = isset($instance['user_id'])?$instance['user_id']:false;
		$number_images = isset($instance['number_images'] )?$instance['number_images'] :9;
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if($user_id)
		{
			
			global $list_flickrs;
			$list_flickrs[]=array(
					'user_id'=>$user_id,
					'number_images'=>$number_images,
					'flickr_widget_id'=>$st_flickwidget_id
				);
			wp_localize_script('flickr-widget','list_flickrs',$list_flickrs);
			$html='<ul class="flickr_items clearfix flickr_'.$st_flickwidget_id.' list-unstyled"></ul>';
			echo $html;
		}
		
		
		
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		global $st_textdomain;
		if(isset($instance['title']))
		{
			$title=$instance['title'];
		}else
		{
			$title='Flickr';
		}
		if ( isset( $instance[ 'user_id' ] ) ) {
			$user_id = $instance[ 'user_id' ];
		}else
		{
			$user_id=0;
		}
		if ( isset( $instance[ 'number_images' ] ) ) {
			$number_images = $instance[ 'number_images' ];
		}else
		{
			$number_images=9;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:',$st_textdomain ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e( 'Flickr User ID:',$st_textdomain ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" type="text" value="<?php echo esc_attr( $user_id ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number_images' ); ?>"><?php _e( 'Number of Images (1 to 20, default is 9):',$st_textdomain ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number_images' ); ?>" name="<?php echo $this->get_field_name( 'number_images' ); ?>" type="text" value="<?php echo esc_attr( $number_images ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['user_id'] = ( ! empty( $new_instance['user_id'] ) ) ? strip_tags( $new_instance['user_id'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number_images'] = ( ! empty( $new_instance['number_images'] ) ) ? strip_tags( $new_instance['number_images'] ) : '';
		return $instance;
	}
}
add_action( 'widgets_init', array('STFlickrWidget','st_add_widget'));
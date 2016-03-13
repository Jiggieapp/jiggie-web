<?php
class STTwitterWidget extends WP_Widget
{
	function __construct(){
		parent::__construct(false, 'ST Twitter Widget');
		require_once 'TwitterAPIExchange.php';
	}
	static function st_add_widget()
	{
		register_widget( 'STTwitterWidget' );
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
		$default=array(
				'title'=>'recent tweet',
				'number_tweet'=>5,
				'user_id'=>'evanto'
			);
		$instance=wp_parse_args($instance,$default);
		extract($instance);
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if($user_id)
		{
			
			//get twitter
			$settings = array(
			    'oauth_access_token' => "460485056-XHfLUud3fQToKfseTnoaiSLrWrdKnsiEyiCaJHLX",
			    'oauth_access_token_secret' => "GmYQbQcDXdiWBJFH39GgyG7i7fxVcfaQQT0YgCgh015f7",
			    'consumer_key' => "18ihEuNsfOJokCLb8SAgA",
			    'consumer_secret' => "7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk"
			);
			$num=$number_tweet;
			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$getfield = '?screen_name='.$user_id.'&count='.$num;
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$recent_twitter = $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();

			$twitters = json_decode($recent_twitter,true);	
			$output = array();
			$output[]='<ul class="tweet_list list-unstyled">';
			if (!isset($twitters['errors']) && count($twitters)>0) {
					foreach( $twitters as $twitter ) {
						$output[] = '<li class="tweet">';									
							$output[] = "<i class='fa fa-twitter'></i><div class='tweet_text'>".$twitter['text']."</div>";	
							$output[] ="<div class='tweet-time'><a href='http://twitter.com/".$user_id."/status/".$twitter['id']."'>" .human_time_diff(strtotime($twitter['created_at']) ) . ' ago</a></div>';
						$output[] = '</li>';
					}
				}
			$output[]='</ul>';
			echo implode("\n",$output);		
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
		$default=array(
				'title'=>'Recent tweet',
				'number_tweet'=>5,
				'user_id'=>'evanto'
			);
		$instance=wp_parse_args($instance,$default);
		extract($instance);
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:',$st_textdomain ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e( 'Twitter User:',$st_textdomain ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" type="text" value="<?php echo esc_attr( $user_id ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number_tweet' ); ?>"><?php _e( 'Number of Tweet (default is 5):',$st_textdomain ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number_tweet' ); ?>" name="<?php echo $this->get_field_name( 'number_tweet' ); ?>" type="text" value="<?php echo esc_attr( $number_tweet ); ?>">
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
		$instance['number_tweet'] = ( ! empty( $new_instance['number_tweet'] ) ) ? strip_tags( $new_instance['number_tweet'] ) : '';
		return $instance;
	}
}
add_action( 'widgets_init', array('STTwitterWidget','st_add_widget'));
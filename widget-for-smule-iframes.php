<?php
/*
Plugin Name: Widget for Smule iFrames
Plugin URI: https://www.sownloader.com/plugins
Description: Allows you to put Smule performances as iFrame into your Wordpress blog as widget.
Author: Marvin Klein
Author URI: https://sownloader.com
Version: 1.0
*/
class widget_for_smule_iframes extends WP_Widget 
{     
	// Frontend-Design Funktionen
	public function __construct(){
		parent::__construct(
			'smule_iframe', // Base ID
			'Smule iFrame Widget', // Name
			array( 'description' => __( 'This plugin allows you to put Smule performances as iFrame to your Wordpress blog as widget', 'smule_widget' ), ) // Args
		);
	}
    
	public function widget( $args, $instance ) {
		// Funktionen für die Ausgabe des Codes auf der Website
		extract( $args );
			$title 		= apply_filters('widget_title', $instance['title']);
			$url        = $instance['url'];	
		
		echo $before_widget;
        if ($title)
			echo $before_title . $title . $after_title;
 		else
			echo $before_title . "<h2>Smule Performance</h2>" . $after_title;
		if($url)
			echo '<iframe frameborder="0" width="100%" height="125" src="' . $url .'"></iframe>';
		else
			echo 'Empty URL.';
      
 		echo $after_widget;
	}
    
	public function form( $instance ) {
		// Erstellt das Kontroll-Formular im WP-Dashboard
		$default_values	= array("title"=> "Smule Performance", "url" => "");
		$instance		= wp_parse_args((array)$instance,$default_values);
		$title			= esc_attr($instance['title']);
		$url			= esc_attr($instance['url']);
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Titel:', 'smule_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:', 'smule_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
	</p>
<?php	
	}
    
	// Updating der Widget-Funktionen
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['url'] 		= strip_tags( $new_instance['url'] );
	
		return $instance;  
	}
   
}
// Die Registrierung unseres Widgets
function widget_for_smule_iframes_init() {
	register_widget('widget_for_smule_iframes');
}
add_action('widgets_init', 'widget_for_smule_iframes_init');
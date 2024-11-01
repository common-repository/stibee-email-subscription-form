<?php

class Wp_Stibee_Shortcode {
    public function __construct()
    {
        add_shortcode('stibee_form', array($this, 'wp_stibee_shortcode'));

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-stibee-subscribeform.php';

		$this->subscribeform = new Wp_Stibee_Subscribeform();
    }
     
    public function wp_stibee_shortcode()
    {
        ob_start();
        $this->subscribeform->wp_stibee_Subscribeform();
        return ob_get_clean();
    }
}

$wpStibeeShortcode = new Wp_Stibee_Shortcode();
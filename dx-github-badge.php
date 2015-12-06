<?php
/**
 * Plugin Name: DX GitHub Badge
 * Plugin URI: https://github.com/metodiew/DX-GitHub-Badge
 * Description: Display simple GitHub profile badge. Works with placing a shortcode or using a Widget
 * Author: Stanko Metodiev
 * Author URI: http://metodiew.com/
 * Version: 1.1
 * License: GPL2+
 * Text Domain: dxghb
 * 
 */

/**
 * The main class for the DX GitHub Badge
 * 
 * @author metodiew
 *
 */
class DX_GitHub_Badge {
	
	/**
	 * 
	 * The plugin constructor function
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'add_dx_gh_badge_shortcode' ) );
		add_action( 'widgets_init', array( $this, 'add_dx_gh_badge_widget' ) );
		add_action( 'admin_menu', array( $this, 'add_dx_github_badge_help_page' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dx_enqueue_style_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dx_enqueue_admin_style_css' ) );
	}
	
	/**
	 * Add the widget file
	 */
	public function add_dx_gh_badge_widget() {
		include_once 'widgets/dx-github-badge-widget.php';
	}
	
	/**
	 *  include Help Page
	 */
	public function dx_github_badge_help_callback() {
		include_once 'dx-github-badge-help.php';
	}
	
	/**
	 * Add Shortcode 
	 */
	public function add_dx_gh_badge_shortcode() {
		add_shortcode( 'dx_display_gh_badge', array( $this, 'dx_display_gh_badge' ) );
	}

	/**
	 * Display GitHub Badge Shortcode
	 */
    public function dx_display_gh_badge( $atts ) {
    	
    	extract( shortcode_atts( array(
			'user' 		=> '',
			'width' 	=> '200',
    		'height'	=> '127',
    		'border'	=> '0'
		), $atts ) );
    	
    	$output = '';
    	
    	if ( ! empty( $user ) ) {
    		$output.= '
		    	<iframe
		    		src="http://githubbadge.appspot.com/' . $user . '?s=1&a=0"
		    		style="
			    		width: ' . $width . 'px;
		    			height: ' . $height . 'px;
			    		border: ' . $border . ';
			    		overflow: hidden;
			    	"
		    		frameBorder="0">
		    	</iframe>
	    	';
    	}
    	
		return $output;
    }
    
    /**
     * Add page to Settings menu in Dashboard
     */
    public function add_dx_github_badge_help_page() {
    	add_options_page( 'DX GitHub Badge', 'DX GitHub Badge', 'publish_posts', 'dx_github_badge_help', array( &$this, 'dx_github_badge_help_callback' ) );
    }
    
    /**
     * Register style
     */
	public function dx_enqueue_style_css() {
        wp_enqueue_style( 'dxghb-style', plugins_url( '/style/style.css' , __FILE__ ) );
        wp_enqueue_style( 'dxghb-style' );
    }
    
    /**
     * Register admin style
     */
    public function dx_enqueue_admin_style_css() {
    	wp_enqueue_style( 'dxghb-admin-style', plugins_url( '/style/admin-style.css', __FILE__ ) );
    	wp_enqueue_style( 'dxghb-admin-style' );
    }

}
	
new DX_GitHub_Badge();
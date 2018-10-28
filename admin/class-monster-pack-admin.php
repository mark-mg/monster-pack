<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/mark-mg
 * @since      1.0.0
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/admin
 * @author     Mark Anthony Adriano <mark.anthony@monstergroup.com.au>
 */
class Monster_Pack_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.2
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/monster-pack-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name . 'ace', plugin_dir_url( __FILE__ ) . 'js/ace/ace.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/monster-pack-admin.js', array( $this->plugin_name . 'ace' ,'jquery' ), $this->version, false );

	}

	/**
	 * Add CSS Meta Box to each Admin screen we want.
	 *
	 * @since 1.0.0
	 */
	public function add_css_meta_box() {

		$screens = apply_filters( 'monster-pack_post_types', array( 'post','page' ) );

		foreach ( $screens as $screen ) {
			add_meta_box(
				'_monster_pack_content',
				__( 'Custom CSS', 'monster-pack' ),
				array( $this, 'metabox_callback'),
				$screen
			);
		}
	}

	/**
	 * Pull in the metabox content for display.
	 *
	 * @since 1.0.0
	 * @param $post
	 *
	 */
	public function metabox_callback( $post ) {

		require_once plugin_dir_path( __FILE__ ) . 'partials/monster-pack-css-metabox.php';

	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @since 1.0.0
	 * @param int $post_id The ID of the post being saved.
	 *
	 */
	public function save_metabox( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['monster-pack_css_metabox_nonce'] ) )
			return $post_id;

		$nonce = $_POST['monster-pack_css_metabox_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'monster-pack_css_metabox' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}


		/*
		 * A customized sanitize_text_field to keep whitespace
		 */
		$css = $_POST['css_metabox_field'];

		$filtered = wp_check_invalid_utf8( $css );

		if ( strpos($filtered, '<') !== false ) {
			$filtered = wp_pre_kses_less_than( $filtered );
			$filtered = wp_strip_all_tags( $filtered, false );
		} else {
			$filtered = trim( $filtered );
		}

		$found = false;
		while ( preg_match('/%[a-f0-9]{2}/i', $filtered, $match) ) {
			$filtered = str_replace($match[0], '', $filtered);
			$found = true;
		}

		if ( $found ) {
			// Strip out the whitespace that may now exist after removing the octets.
			$filtered = trim( preg_replace('/ +/', ' ', $filtered) );
		}


		// Update the meta field.
		update_post_meta( $post_id, '_monster_pack_content', $filtered );
	}

}

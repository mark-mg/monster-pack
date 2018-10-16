<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/mark-mg
 * @since      1.0.0
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/admin/partials
 */

// Add an nonce field so we can check for it later.
wp_nonce_field( 'monster-pack_css_metabox', 'monster-pack_css_metabox_nonce' );

// Use get_post_meta to retrieve an existing value from the database.
$value = get_post_meta( $post->ID, '_monster_pack_content', true );
?>
<div class="monster-pack-editor-wrapper">
	<div id="js__sps-ace-editor" style="position: absolute; top: 0; left: 0;bottom: 0;right: 0;"></div>
</div>

<?php

echo '<textarea id="css_metabox_field" name="css_metabox_field" style="display: none;" />' . esc_attr( $value ) . '</textarea>';
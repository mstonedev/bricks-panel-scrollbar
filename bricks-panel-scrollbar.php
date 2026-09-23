<?php
/**
 * Plugin Name: Bricks Builder Custom Scrollbar
 * Plugin URI:  https://yourdomain.com
 * Description: Restores and customizes the Bricks Builder side panels scrollbars, ensuring they always render cleanly on the right side of each sidebar.
 * Version:     1.2.0
 * Author:      Your Name
 * License:     GPL2
 */

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Register Settings in Settings > General
 */
add_action( 'admin_init', function() {
    add_settings_section(
        'bricks_scrollbar_settings_section',
        'Bricks Panel Scrollbar Settings',
        function() { echo '<p>Customize the look of your Bricks Builder settings panel and structure panel scrollbars.</p>'; },
        'general'
    );

    // Register Thumb Color
    register_setting( 'general', 'bricks_scrollbar_thumb_color', array( 'default' => '#555555' ) );
    add_settings_field(
        'bricks_scrollbar_thumb_color',
        'Scrollbar Thumb Color',
        function() {
            $value = get_option( 'bricks_scrollbar_thumb_color', '#555555' );
            echo '<input type="color" name="bricks_scrollbar_thumb_color" value="' . esc_attr( $value ) . '" />';
        },
        'general',
        'bricks_scrollbar_settings_section'
    );

    // Register Track Color
    register_setting( 'general', 'bricks_scrollbar_track_color', array( 'default' => '#2c2c2c' ) );
    add_settings_field(
        'bricks_scrollbar_track_color',
        'Scrollbar Track Color',
        function() {
            $value = get_option( 'bricks_scrollbar_track_color', '#2c2c2c' );
            echo '<input type="color" name="bricks_scrollbar_track_color" value="' . esc_attr( $value ) . '" />';
        },
        'general',
        'bricks_scrollbar_settings_section'
    );

    // Register Scrollbar Width
    register_setting( 'general', 'bricks_scrollbar_width', array( 'default' => '6' ) );
    add_settings_field(
        'bricks_scrollbar_width',
        'Scrollbar Width (px)',
        function() {
            $value = get_option( 'bricks_scrollbar_width', '6' );
            echo '<input type="number" name="bricks_scrollbar_width" min="2" max="20" value="' . esc_attr( $value ) . '" style="width: 70px;" /> px';
        },
        'general',
        'bricks_scrollbar_settings_section'
    );
});

/**
 * 2. Inject Dynamic CSS into the Bricks Builder frame targeting BOTH panels
 */
add_action('wp_print_scripts', function() {
    if ( function_exists('bricks_is_builder') && bricks_is_builder() ) {
        $thumb_color = get_option( 'bricks_scrollbar_thumb_color', '#555555' );
        $track_color = get_option( 'bricks_scrollbar_track_color', '#2c2c2c' );
        $width       = get_option( 'bricks_scrollbar_width', '6' ) . 'px';
        
        $hover_color = ( strtolower( $thumb_color ) === '#555555' ) ? '#777777' : $thumb_color . 'cc';
        ?>
        <style>
            /* 
               Target both panels and force left-to-right direction layout, 
               which guarantees scroll tracks pin to the right edge of each sidebar container.
            */
            div#bricks-panel-inner,
            div#bricks-structure .panel-content {
                direction: ltr !important; 
                height: 100% !important;
                overflow-x: hidden !important;
                overflow-y: scroll !important;
                overscroll-behavior: none !important;
                scrollbar-width: thin !important;
                scrollbar-color: <?php echo esc_html($thumb_color); ?> <?php echo esc_html($track_color); ?> !important;
            }

            /* Ensure text content alignment inside the wrappers stays natural */
            div#bricks-panel-inner *,
            div#bricks-structure .panel-content * {
                direction: initial;
            }

            /* Webkit layout overrides for both panels */
            div#bricks-panel-inner::-webkit-scrollbar,
            div#bricks-structure .panel-content::-webkit-scrollbar {
                display: block !important;
                width: <?php echo esc_html($width); ?> !important;
                height: <?php echo esc_html($width); ?> !important;
            }

            /* Visual Track layout for both panels */
            div#bricks-panel-inner::-webkit-scrollbar-track,
            div#bricks-structure .panel-content::-webkit-scrollbar-track {
                background: <?php echo esc_html($track_color); ?> !important;
            }
             
            /* Draggable Handle Layout for both panels */
            div#bricks-panel-inner::-webkit-scrollbar-thumb,
            div#bricks-structure .panel-content::-webkit-scrollbar-thumb {
                background: <?php echo esc_html($thumb_color); ?> !important; 
                border-radius: 10px !important;
            }

            /* Interactive Highlight Hover Flag for both panels */
            div#bricks-panel-inner::-webkit-scrollbar-thumb:hover,
            div#bricks-structure .panel-content::-webkit-scrollbar-thumb:hover {
                background: <?php echo esc_html($hover_color); ?> !important; 
            }
        </style>
        <?php
    }
}, 999);

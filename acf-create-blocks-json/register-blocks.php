<?php

define('CUSTOM_THEME_DIRECTORY', get_stylesheet_directory() );
define('CUSTOM_THEME_URL', get_stylesheet_directory_uri() );

// load separate block asset
add_filter ( 'should_load_separate_core_block_assets' , '__return_true' );

// init ACF blocks
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    $blocks_directory = CUSTOM_THEME_DIRECTORY . '/templates/blocks/';
    if(is_dir($blocks_directory)) {
        $list = array_diff( scandir( $blocks_directory ), array( '..', '.' ) );
        if(!empty($list)) {
            foreach($list as $block_dir) {
                $jsonFile = $blocks_directory . $block_dir . '/block.json';
                if(file_exists($jsonFile)) {
                    $block_data = json_decode( file_get_contents($jsonFile) );
                    $version = !empty($block_data->version) ? $block_data->version : '1.0.0';
                    register_block_type( $blocks_directory . $block_dir );

                    if(file_exists($blocks_directory . $block_dir . '/scripts.js') && !is_admin()) {
                        wp_register_script($block_data->name, CUSTOM_THEME_URL . '/templates/blocks/' . $block_dir . '/scripts.js', [], $version, true);
                    }
                    if(file_exists($blocks_directory . $block_dir . '/styles.css') && !is_admin()) {
                        wp_register_style($block_data->name, CUSTOM_THEME_URL . '/templates/blocks/' . $block_dir . '/styles.css', [], $version, 'all');
                    }
                }
            }
        }
    }
}

<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( !class_exists('Nbdesigner_Settings_Colors') ) {    
    class Nbdesigner_Settings_Colors{
        public static function get_options() {
            return apply_filters('nbdesigner_colors_settings', array(
                'color-setting' => array(
                    array(
                        'title'         => esc_html__( 'Show all color', 'web-to-print-online-designer'),
                        'id'            => 'nbdesigner_show_all_color',
                        'description'   => esc_html__('Choose "Yes" that will show all color or "No" that will show color palette with list predefined colors.', 'web-to-print-online-designer'),
                        'default'       => 'yes',
                        'type'          => 'radio',
                        'options'       => array(
                            'yes'   => esc_html__('Yes', 'web-to-print-online-designer'),
                            'no'    => esc_html__('No', 'web-to-print-online-designer')
                        )
                    ),
                    array(
                        'title'         => esc_html__('Hexadecimal Color Names', 'web-to-print-online-designer'),
                        'description'   => wp_kses(__('Color palette, <a href="https://www.w3schools.com/colors/colors_names.asp" target="_blank">color name reference</a>.', 'web-to-print-online-designer'), array( 'a' => array('href' => array(),'target' => array()) ) ),
                        'id'            => 'nbdesigner_hex_names',
                        'css'           => 'width:500px;',
                        'default'       => '',
                        'type'          => 'values-group',
                        'options'       => array(
                            'hex_key'   => esc_html__('Hexadecimal Color', 'web-to-print-online-designer'),
                            'name'      => esc_html__('Name', 'web-to-print-online-designer')
                        ),
                        'prefixes'      => array(
                            'hex_key'   => '',
                            'name'      => ''
                        ),
                        'regexs'        => array(
                            'name'      => '^[^, ]+$'
                        )
                    ),
                    array(
                        'title'         => esc_html__( 'Enable color pick Eyedropper', 'web-to-print-online-designer'),
                        'id'            => 'nbdesigner_enable_eyedropper',
                        'description'   => '',
                        'default'       => 'no',
                        'type'          => 'radio',
                        'options'       => array(
                            'yes'   => esc_html__('Yes', 'web-to-print-online-designer'),
                            'no'    => esc_html__('No', 'web-to-print-online-designer')
                        )
                    ),
                )
            ));
        }
    }
}

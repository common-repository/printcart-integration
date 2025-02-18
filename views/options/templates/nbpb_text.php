<?php if (!defined('ABSPATH')) exit; ?>
<?php echo '<script type="text/ng-template" id="nbd.nbpb_text">'; ?>
    <div class="nbd-field-info">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Default text', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <input type="text" ng-model="field.general.nbpb_text_configs.default_text" name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][default_text]"/>
        </div>
    </div>
    <div class="nbd-field-info">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Allow change font family', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <select name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][allow_font_family]" ng-model="field.general.nbpb_text_configs.allow_font_family">
                <option value="y"><?php esc_html_e('Yes', 'web-to-print-online-designer'); ?></option>
                <option value="n"><?php esc_html_e('No', 'web-to-print-online-designer'); ?></option>
            </select>
        </div>
    </div>
    <div class="nbd-field-info" ng-show="field.general.nbpb_text_configs.allow_font_family == 'y'">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Allow all fonts', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <select name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][allow_all_font]" ng-model="field.general.nbpb_text_configs.allow_all_font">
                <option value="y"><?php esc_html_e('Yes', 'web-to-print-online-designer'); ?></option>
                <option value="n"><?php esc_html_e('No', 'web-to-print-online-designer'); ?></option>
            </select>
            <br /><?php esc_html_e('Manage fonts', 'web-to-print-online-designer'); ?> <a target="_blank" href="<?php echo esc_url(admin_url('admin.php?page=nbdesigner_manager_fonts')); ?>"><?php esc_html_e('here', 'web-to-print-online-designer'); ?></a>
        </div>
    </div>
    <div class="nbd-field-info" ng-show="field.general.nbpb_text_configs.allow_font_family == 'y' && field.general.nbpb_text_configs.allow_all_font == 'n'">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Custom fonts', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <?php
                $custom_fonts = array();
                if(file_exists( NBDESIGNER_DATA_DIR . '/fonts.json') ){
                    $custom_fonts = (array)json_decode( file_get_contents( NBDESIGNER_DATA_DIR . '/fonts.json' ) );
                }
                $enable_printcart_api = NBD_Printcart_API::enable_printcart_api();
                if( $enable_printcart_api ) {
                    $fonts_data = NBD_Printcart_API::fetchFonts();
                    $custom_fonts = isset( $fonts_data['data'] ) ? $fonts_data['data'] : array();
                }
            ?>
            <select nbd-select2 name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][custom_fonts][]" ng-model="field.general.nbpb_text_configs.custom_fonts" multiple="multiple">
                <?php foreach($custom_fonts as $font): ?>
                <?php 
                    $font_id = $font->id;
                    $font_name = $font->name;
                    if( $enable_printcart_api ) {
                        $font_id = isset($font['id']) ? $font['id'] : '';
                        $font_name = isset($font['name']) ? $font['name'] : '';
                    }
                ?>
                <option value="<?php echo( $font_id ); ?>"><?php echo( $font_name ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="nbd-field-info" ng-show="field.general.nbpb_text_configs.allow_font_family == 'y' && field.general.nbpb_text_configs.allow_all_font == 'n'">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Google fonts', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <?php
                $google_fonts = array();
                if(file_exists( NBDESIGNER_DATA_DIR . '/googlefonts.json') ){
                    $google_fonts = (array)json_decode( file_get_contents( NBDESIGNER_DATA_DIR . '/googlefonts.json' ) );
                }
            ?>
            <select nbd-select2 name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][google_fonts][]" ng-model="field.general.nbpb_text_configs.google_fonts" multiple="multiple">
                <?php foreach($google_fonts as $font): ?>
                <option value="<?php echo( $font->id ); ?>"><?php echo( $font->name ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="nbd-field-info">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Allow change color', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <select name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][allow_change_color]" ng-model="field.general.nbpb_text_configs.allow_change_color">
                <option value="y"><?php esc_html_e('Yes', 'web-to-print-online-designer'); ?></option>
                <option value="n"><?php esc_html_e('No', 'web-to-print-online-designer'); ?></option>
            </select>
        </div>
    </div>
    <div class="nbd-field-info" ng-show="field.general.nbpb_text_configs.allow_change_color == 'y'">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Allow all colors', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <select name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][allow_all_color]" ng-model="field.general.nbpb_text_configs.allow_all_color">
                <option value="y"><?php esc_html_e('Yes', 'web-to-print-online-designer'); ?></option>
                <option value="n"><?php esc_html_e('No', 'web-to-print-online-designer'); ?></option>
            </select>
        </div>
    </div>
    <div class="nbd-field-info" ng-show="field.general.nbpb_text_configs.allow_change_color == 'y' && field.general.nbpb_text_configs.allow_all_color == 'n'">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Colors', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <div class="nbd-table-wrap">
                <table class="nbd-table nbpb-text-configs" style="text-align: center;">
                    <thead>
                        <tr>
                            <th><?php esc_html_e('Color name', 'web-to-print-online-designer'); ?></th>
                            <th><?php esc_html_e('Color', 'web-to-print-online-designer'); ?></th>
                            <th><?php esc_html_e('Action', 'web-to-print-online-designer'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(clIndex, color) in field.general.nbpb_text_configs.colors">
                            <td>
                                <input type="text" class="nbd-short-ip" ng-model="color.name" name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][colors][{{clIndex}}][name]"/>
                            </td>
                            <td>
                                <input type="text" class="nbd-short-ip" nbd-color-picker="color.color" ng-model="color.color" name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][colors][{{clIndex}}][color]"/>
                            </td>
                            <td>
                                <a class="button nbd-mini-btn" ng-click="remove_text_configs_color(fieldIndex, clIndex)" title="<?php esc_html_e('Delete', 'web-to-print-online-designer'); ?>"><span class="dashicons dashicons-no-alt"></span></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <a ng-click="add_text_configs_color(fieldIndex)" class="button button-primary"><?php esc_html_e('Add color', 'web-to-print-online-designer'); ?></a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="nbd-field-info">
        <div class="nbd-field-info-1">
            <div><b><?php esc_html_e('Show in view', 'web-to-print-online-designer'); ?></b></div>
        </div>
        <div class="nbd-field-info-2">
            <div class="nbd-table-wrap">
                <table class="nbd-table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th ng-repeat="view in options.views">{{view.name}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ng-repeat="view in options.views">
                                <input ng-model="field.general.nbpb_text_configs.views[$index].display" name="options[fields][{{fieldIndex}}][general][nbpb_text_configs][views][{{$index}}][display]" type="checkbox" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php echo '</script>';
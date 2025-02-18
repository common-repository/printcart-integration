<?php if (!defined('ABSPATH')) exit; ?>
<div class="nbd-option-field nbd-field-dropdown-wrap <?php echo( $class ); ?>" data-id="<?php echo( $field['id'] ); ?>" ng-if="nbd_fields['<?php echo( $field['id'] ); ?>'].enable">
    <?php include( $currentDir .'/options-builder/field-header.php' ); ?>
    <div class="nbd-field-content">
        <div class="__nbd-dropdown-wrap">
            <select ng-change="check_valid();updateMapOptions('<?php echo( $field['id'] ); ?>')" name="nbd-field[<?php echo( $field['id'] ); ?>]{{nbd_fields['<?php echo( $field['id'] ); ?>'].form_name}}" class="nbo-dropdown" ng-model="nbd_fields['<?php echo( $field['id'] ); ?>'].value">
            <?php 
                foreach ($field['general']['attributes']["options"] as $key => $attr): 
                    $enable_subattr = isset($attr['enable_subattr']) ? $attr['enable_subattr'] : 0;
                    $attr['sub_attributes'] = isset( $attr['sub_attributes'] ) ? $attr['sub_attributes'] : array();
                    $show_subattr = ($enable_subattr == 'on' && count($attr['sub_attributes']) > 0) ? true : false;
                    $field['general']['attributes']["options"][$key]['show_subattr'] = $show_subattr;
            ?>
                <option value="<?php echo( $key ); ?>" nbo-disabled="!status_fields['<?php echo( $field['id'] ); ?>'][<?php echo( $key ); ?>].enable" nbo-disabled-type="attr" 
                    <?php 
                        if( isset($form_values[$field['id']]) ){
                            $fvalue = (is_array($form_values[$field['id']]) && isset($form_values[$field['id']]['value'])) ? $form_values[$field['id']]['value'] : $form_values[$field['id']];
                            selected( $fvalue, $key ); 
                        }else{
                            selected( isset($attr['selected']) ? $attr['selected'] : 'off', 'on' ); 
                        }
                    ?>><?php echo( $attr['name'] ); ?>
                </option>
            <?php endforeach; ?>
            </select> 
        </div>
        <div class="nbo-invalid-option" 
            ng-class="nbd_fields['<?php echo( $field['id'] ); ?>'].valid === false ? 'active' : ''"
            ng-if="nbd_fields['<?php echo( $field['id'] ); ?>'].valid === false">{{nbd_fields['<?php echo( $field['id'] ); ?>'].invalidOption}} <?php esc_html_e('is not available', 'web-to-print-online-designer'); ?></div>
        <?php 
            foreach ($field['general']['attributes']["options"] as $key => $attr): 
                if( $attr['show_subattr'] ):
                    $sattr_display_type = isset( $attr['sattr_display_type'] ) ? $attr['sattr_display_type'] : 'd';
                    switch($sattr_display_type){
                        case 's':
                            $tempalte = $currentDir .'/options-builder/sattr_swatch'.$prefix.'.php';
                            $wrap_class = 'nbd-swatch-wrap';
                            break;
                        case 'l':
                            $tempalte = $currentDir .'/options-builder/sattr_label.php';
                            $wrap_class = 'nbd-label-wrap';
                            break;
                        case 'r':
                            $tempalte = $currentDir .'/options-builder/sattr_radio.php';
                            $wrap_class = 'nbd-radio';
                            break;
                        default:
                            $tempalte = $currentDir .'/options-builder/sattr_dropdown.php';
                            $wrap_class = '';
                            break;
                    }
        ?>
        <div ng-if="nbd_fields['<?php echo( $field['id'] ); ?>'].value == '<?php echo( $key ); ?>'" class="nbo-sub-attr-wrap <?php echo( $wrap_class ); ?>">
        <?php include($tempalte); ?>
        </div>
        <?php endif; endforeach; ?>
    </div>
</div>
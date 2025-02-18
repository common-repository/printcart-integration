<?php if (!defined('ABSPATH')) exit; ?>
<tr nbo-adv-dropdown class="nbd-option-field nbd-field-ad-dropdown-wrap <?php echo( $class ); ?> nbd-field-shape" data-id="<?php echo( $field['id'] ); ?>" ng-if="nbd_fields['<?php echo( $field['id'] ); ?>'].enable">
    <td>
        <label for='nbd-field-<?php echo( $field['id'] ); ?>'>
            <?php echo( $field['general']['title'] ); ?>
            <?php if( $field['general']['required'] == 'y' ): ?>
            <span class="nbd-required">*</span>
            <?php endif; ?>
        </label> 
        <?php if( $field['general']['description'] != '' ): ?>
        <span data-position="<?php echo( $tooltip_position ); ?>" data-tip="<?php echo( $field['general']['description'] ); ?>" class="nbd-help-tip"></span>
        <?php endif; ?>
    </td>
    <td class="nbd-field-content">
        <div>
            <select ng-change="check_valid()" name="nbd-field[<?php echo( $field['id'] ); ?>]" class="nbo-dropdown" ng-model="nbd_fields['<?php echo( $field['id'] ); ?>'].value">
            <?php 
                foreach ($field['general']['attributes']["options"] as $key => $attr): 
            ?>
                <option value="<?php echo( $key ); ?>"
                    <?php 
                        if( isset($form_values[$field['id']]) ){
                            $fvalue = (is_array($form_values[$field['id']]) && isset($form_values[$field['id']]['value'])) ? $form_values[$field['id']]['value'] : $form_values[$field['id']];
                            selected( $fvalue, $key ); 
                        }else{
                            selected( isset($attr['selected']) ? $attr['selected'] : 'off', 'on' ); 
                        }
                    ?>><?php echo( $attr['name'] ); ?></option>
            <?php endforeach; ?>
            </select> 
            <div class="nbo-ad-result">
                <span class="nbo-ad-result-shape" ng-bind-html="nbd_fields['<?php echo( $field['id'] ); ?>'].shape | svg_trusted"></span>
                <span class="nbo-ad-result-name">{{nbd_fields['<?php echo( $field['id'] ); ?>'].value_name}}</span>
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M16.594 8.578l1.406 1.406-6 6-6-6 1.406-1.406 4.594 4.594z"/>
                </svg>
            </div>
            <div class="nbo-ad-pseudo-list">
                <?php 
                    foreach ($field['general']['attributes']["options"] as $key => $attr): 
                ?>
                <div class="nbo-ad-list-item" 
                     ng-click="select_adv_attr('<?php echo( $field['id'] ); ?>', '<?php echo( $key ); ?>');updateMapOptions('<?php echo( $field['id'] ); ?>')"
                     ng-class="nbd_fields['<?php echo( $field['id'] ); ?>'].value == '<?php echo( $key ); ?>' ? 'active' : ''"
                     nbo-disabled="!status_fields['<?php echo( $field['id'] ); ?>'][<?php echo( $key ); ?>].enable" nbo-disabled-type="class" >
                    <?php echo( $attr['shape'] ); ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="nbo-invalid-option" 
                ng-class="nbd_fields['<?php echo( $field['id'] ); ?>'].valid === false ? 'active' : ''"
                ng-if="nbd_fields['<?php echo( $field['id'] ); ?>'].valid === false">{{nbd_fields['<?php echo( $field['id'] ); ?>'].invalidOption}} <?php esc_html_e('is not available', 'web-to-print-online-designer'); ?>
            </div>
        </div>
    </td>
</tr>
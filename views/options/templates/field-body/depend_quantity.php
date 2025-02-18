<?php if (!defined('ABSPATH')) exit; ?>
<?php echo '<script type="text/ng-template" id="field_body_depend_quantity">'; ?>
    <div class="nbd-field-info">
        <div class="nbd-field-info-1">
            <div><label><b><?php esc_html_e('Depend quantity breaks', 'web-to-print-online-designer'); ?></b></label></div>
        </div>
        <div class="nbd-field-info-2">
            <div>
                <select name="options[fields][{{fieldIndex}}][general][depend_quantity]" ng-model="field.general.depend_quantity.value">
                    <option ng-repeat="op in field.general.depend_quantity.options" value="{{op.key}}">{{op.text}}</option>
                </select>
            </div>
        </div>
    </div>
<?php echo '</script>';
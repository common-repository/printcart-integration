<?php if (!defined('ABSPATH')) exit; ?>
<div class="section-container">
    <p class="section-title"><input class="nbd-ip-readonly" value="<?php esc_html_e('Quantity', 'web-to-print-online-designer'); ?>" readonly=""></p>
    <div class="nbd-section-wrap">
        <div class="nbd-field-info">
            <div class="nbd-field-info-1">
                <label><b><?php esc_html_e('Replace default quantity input', 'web-to-print-online-designer'); ?></b></label>
            </div>  
            <div class="nbd-field-info-2">
                <select name="options[quantity_enable]" ng-model="options.quantity_enable">
                    <option value="y"><?php esc_html_e('Yes', 'web-to-print-online-designer'); ?></option>
                    <option value="n"><?php esc_html_e('No', 'web-to-print-online-designer'); ?></option>
                </select>
            </div>
        </div>
        <div class="nbd-field-info" ng-show="options.quantity_enable == 'y'">
            <div class="nbd-field-info-1">
                <label><b><?php esc_html_e('Display type', 'web-to-print-online-designer'); ?></b></label>
            </div>
            <div class="nbd-field-info-2">
                <select name="options[quantity_type]" ng-model="options.quantity_type">
                    <option value="r"><?php esc_html_e('Range slider', 'web-to-print-online-designer'); ?></option>
                    <option value="d"><?php esc_html_e('Dropdown', 'web-to-print-online-designer'); ?></option>
                    <option value="s"><?php esc_html_e('Select box', 'web-to-print-online-designer'); ?></option>
                    <option value="ra"><?php esc_html_e('Radio input', 'web-to-print-online-designer'); ?></option>
                </select>
            </div>
        </div>
        <div class="nbd-field-info" ng-show="options.quantity_type == 'r' && options.quantity_enable == 'y'">
            <div class="nbd-field-info-1">
                <p><label><b><?php esc_html_e('Step value', 'web-to-print-online-designer'); ?></b><nbd-tip data-tip="<?php esc_html_e('Enter the step for the handle.', 'web-to-print-online-designer'); ?>" ></nbd-tip></label></p>                                              
            </div>
            <div class="nbd-field-info-2">
                <div class="nbd-table-wrap" style="overflow: hidden;">
                    <table class="nbd-table">
                        <tr>
                            <th><?php esc_html_e('Min', 'web-to-print-online-designer'); ?></th>
                            <th><?php esc_html_e('Max', 'web-to-print-online-designer'); ?></th>
                            <th><?php esc_html_e('Step', 'web-to-print-online-designer'); ?></th>
                        </tr>   
                        <tr>
                            <td><input type="text" name="options[quantity_min]" class="nbd-short-ip" ng-model="options.quantity_min"/></td>
                            <td><input type="text" name="options[quantity_max]" class="nbd-short-ip" ng-model="options.quantity_max"/></td>
                            <td><input type="text" name="options[quantity_step]" class="nbd-short-ip" ng-model="options.quantity_step"/></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="nbd-field-info">
            <div class="nbd-field-info-1">
                <label><b><?php esc_html_e('Discount type base on quantity breaks', 'web-to-print-online-designer'); ?></b></label>
            </div>  
            <div class="nbd-field-info-2">
                <select name="options[quantity_discount_type]" ng-model="options.quantity_discount_type">
                    <option value="f"><?php esc_html_e('Fixed', 'web-to-print-online-designer'); ?></option>
                    <option value="p"><?php esc_html_e('Percentage', 'web-to-print-online-designer'); ?></option>
                </select>
            </div>
        </div>
        <div class="nbd-field-info">
            <div class="nbd-field-info-1">
                <label>
                    <b><?php esc_html_e('Quantity breaks', 'web-to-print-online-designer'); ?></b>
                    <nbd-tip data-tip="<?php esc_html_e('This option allows you to create different price tiers for product based on the quantity a customer buys. For example, set it so a customer needs to buy 5 or more to get 10% off, buy 10 or  to get 15% off, and so on.', 'web-to-print-online-designer'); ?>"></nbd-tip>
                </label>
            </div>
            <div class="nbd-field-info-2">
                <div class="nbd-table-wrap" style="overflow: hidden;">
                    <table class="nbd-table">
                        <tr>
                            <th><?php esc_html_e('Break', 'web-to-print-online-designer'); ?></th>
                            <th><?php esc_html_e('Discount', 'web-to-print-online-designer'); ?> ( {{options.quantity_discount_type == 'f' ? '-' : '-%'}} / <?php esc_html_e('item', 'web-to-print-online-designer'); ?>)</th>
                            <th><?php esc_html_e('Default', 'web-to-print-online-designer'); ?></th>
                            <th><?php esc_html_e('Action', 'web-to-print-online-designer'); ?></th>
                        </tr>
                        <tr ng-repeat="break in options.quantity_breaks">
                            <td><input name="options[quantity_breaks][{{$index}}][val]" type="number" string-to-number class="nbd-short-ip" ng-model="break.val" ng-min="1"/></td>
                            <td><input name="options[quantity_breaks][{{$index}}][dis]" class="nbd-short-ip" type="text" ng-model="break.dis"/></td>
                            <td><input ng-checked="break.default" ng-click="update_default_quantity( $index )" name="options[quantity_breaks][{{$index}}][default]" type="checkbox" /></td>
                            <td><a class="button nbd-mini-btn"  ng-click="remove_price_break($index)" title="<?php esc_html_e('Delete', 'web-to-print-online-designer'); ?>"><span class="dashicons dashicons-no-alt"></span></a></td>
                        </tr>
                    </table>
                </div>
                <div style="margin-top: 5px;">
                    <a class="button" ng-click="add_price_break()"><span class="dashicons dashicons-plus"></span> <?php esc_html_e('Add more', 'web-to-print-online-designer'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
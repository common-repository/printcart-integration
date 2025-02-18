<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="nbdesiger-tiny-mce-dialog" tabindex="-1" action="" title="" style="display: none; ">
    <div class="nbdesign-shortcode-row">
        <label for="nbdesigner-shortcode-number"><?php  esc_html_e('Number of templates per row', 'web-to-print-online-designer'); ?></label>
        <input class="short" id="nbdesigner-shortcode-number" type="number" min="1"  max="6" step="1" value="3">
    </div>
    <div class="nbdesign-shortcode-row">
        <label for="nbdesigner-pagination"><?php  esc_html_e('Pagination', 'web-to-print-online-designer'); ?></label>
        <input id="nbdesigner-pagination" type="checkbox" checked="checked"> 
    </div>    
    <div id="nbdesigner-number-row" class="nbdesign-shortcode-row">
        <label for="nbdesigner-shortcode-row"><?php  esc_html_e('Number of rows per page', 'web-to-print-online-designer'); ?></label>
        <input class="short" id="nbdesigner-shortcode-number-row" type="number" min="1" step="1" value="5"> 
    </div>
    <div class="nbdesign-shortcode-row">
        <button class="button-primary" id="nbdesigner-shortcode-create"><?php  esc_html_e('Create', 'web-to-print-online-designer'); ?></button>
    </div>
</div>

<div id="nbdesiger-tiny-mce-dialog-template" tabindex="-1" action="" title="" style="display: none; ">
    <div class="nbdesign-shortcode-row">
        <label for="nbdesigner-shortcode-number"><?php  esc_html_e('Number of templates per row', 'web-to-print-online-designer'); ?></label>
        <input class="short" id="nbdesigner-shortcode-number" type="number" min="1"  max="6" step="1" value="3">
    </div>
    <div id="nbdesigner-limit-template" class="nbdesign-shortcode-row">
        <label for="nbdesigner-shortcode-row"><?php  esc_html_e('Template Limit', 'web-to-print-online-designer'); ?></label>
        <input class="short" id="nbdesigner-shortcode-limit-template" type="number" min="1" step="1" value="5">
    </div>
    <div class="nbdesign-shortcode-row">
        <button class="button-primary" id="nbdesigner-shortcode-template-create"><?php  esc_html_e('Create', 'web-to-print-online-designer'); ?></button>
    </div>
</div>
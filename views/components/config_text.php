<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="config_text" class="shadow od_tab nbdesigner_config" ng-style="{'display': pop.text}">
    <ul class="config_list">
        <li><a href="#typography"><span class="fa fa-font" aria-hidden="true"></span></a></li>
        <li><a href="#text-style"><span class="fa fa-italic" aria-hidden="true"></span></a></li>
        <li><a href="#text-decoration"><span class="fa fa-tint" aria-hidden="true"></span></a></li>
        <li><a href="#text-decoration1"><span class="fa fa-text-height" aria-hidden="true"></span></a></li>
        <li><a href="#text-dimension"><span class="fa fa-crop" aria-hidden="true"></span></a></li>
        <li><a href="#rotate-curved"><span class="fa fa-circle-thin" aria-hidden="true"></span></a></li>		
    </ul>
    <div class="list-indicator"></div>
    <div id="typography" class="content">
        <div class="nb-col-6">
            <textarea class="form-control" ng-model="editable.text" ng-change="ChangeText()"></textarea>
        </div>
        <div class="nb-col-6" ng-show="settings['nbdesigner_text_change_font'] == 1">
            <fieldset class="shadow" ng-click="loadFont()" data-target="#dg-fonts" data-toggle="modal">
                <legend>{{(langs['FONT']) ? langs['FONT'] : "Fonts"}}:</legend>
                <a ng-style="{'font-family': (editable.fontFamily) ? editable.fontFamily + ', sans-serif' : 'Tahoma, sans-serif'}">{{currentFont.name}}</a>
                <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s pull-right"></span>
            </fieldset>
        </div>
    </div>
    <div id="text-style" class="content">
        <span class="fa fa-italic shadow item-config hover-shadow" ng-click="toggleItalic()" ng-show="settings['nbdesigner_text_italic'] == 1"></span>
        <span class="fa fa-bold shadow item-config hover-shadow" ng-click="toggleBold()" ng-show="settings['nbdesigner_text_bold'] == 1"></span>
        <span class="fa fa-underline shadow item-config hover-shadow" ng-click="toggleTextDecoration('underline')" ng-show="settings['nbdesigner_text_underline'] == 1"></span>
        <span class="fa fa-strikethrough shadow item-config hover-shadow" ng-click="toggleTextDecoration('line-through')" ng-show="settings['nbdesigner_text_through'] == 1"></span>
        <span class="fa fa-font shadow item-config hover-shadow" ng-click="toggleTextDecoration('overline')" style="text-decoration: overline;" ng-show="settings['nbdesigner_text_overline'] == 1"></span>
        <span class="shadow item-config hover-shadow text-case" ng-click="toggleTextCase()" ng-show="settings['nbdesigner_text_case'] == 1">
            <svg aria-hidden="true" class="octicon octicon-text-size" height="16" version="1.1" viewBox="0 0 18 16" width="18">
                <path fill-rule="evenodd" d="M13.62 9.08L12.1 3.66h-.06l-1.5 5.42h3.08zM5.7 10.13S4.68 6.52 4.53 6.02h-.08l-1.13 4.11H5.7zM17.31 14h-2.25l-.95-3.25h-4.07L9.09 14H6.84l-.69-2.33H2.87L2.17 14H0l3.3-9.59h2.5l2.17 6.34L10.86 2h2.52l3.94 12h-.01z"></path>
            </svg>            
        </span>
        <span class="fa fa-align-left shadow item-config hover-shadow" ng-click="align('left')" ng-show="settings['nbdesigner_text_align_left'] == 1"></span>
        <span class="fa fa-align-center shadow item-config hover-shadow" ng-click="align('center')" ng-show="settings['nbdesigner_text_align_right'] == 1"></span>
        <span class="fa fa-align-right shadow item-config hover-shadow" ng-click="align('right')" ng-show="settings['nbdesigner_text_align_center'] == 1"></span>
    </div>
    <div id="text-decoration" class="content">
        <div class="nb-col-2" ng-show="settings['nbdesigner_text_color'] == 1">
            <p class="label-config">{{(langs['TEXT_COLOR']) ? langs['TEXT_COLOR'] : "Text color"}}</p>
            <?php  if($enableColor == 'yes'): ?>
            <spectrum-colorpicker
                ng-model="colorOptional" 
                ng-change="changeColor(colorOptional)" 
                options="{
                    showPaletteOnly: false, 
                    togglePaletteOnly: false, 
                    showPalette: false, 
                    showInput: true}">
            </spectrum-colorpicker>
             <?php else: ?>
            <spectrum-colorpicker
                ng-model="colorOptional" 
                ng-change="changeColor(colorOptional)" 
                options="{
                    showPaletteOnly: true, 
                    togglePaletteOnly: false, 
                    hideAfterPaletteSelect:true,
                    showInput: true,
                    palette: colorPalette}">
            </spectrum-colorpicker>
            <?php endif; ?>
        </div>
        <div class="nb-col-30" ng-show="settings['nbdesigner_text_background'] == 1">
            <p class="label-config">{{(langs['BACKGROUND']) ? langs['BACKGROUND'] : "Background"}}</p>
            <?php  if($enableColor == 'yes'): ?>
            <spectrum-colorpicker
                ng-model="background" 
                ng-change="setBackground()" 
                options="{
                    showPaletteOnly: false, 
                    togglePaletteOnly: false, 
                    showPalette: false, 
                    showInput: true}">
            </spectrum-colorpicker>
            <?php else: ?>
            <spectrum-colorpicker
                ng-model="background" 
                ng-change="setBackground()" 
                options="{
                    showPaletteOnly: true, 
                    togglePaletteOnly: false, 
                    hideAfterPaletteSelect:true,
                    palette: colorPalette}">
            </spectrum-colorpicker>
            <?php endif; ?>            
            <span class="shadow hover-shadow item-config fa fa-recycle e-shadow" ng-click="setBackground('remove')" data-toggle="tooltip" data-original-title="{{(langs['REMOVE_BACKGROUND']) ? langs['REMOVE_BACKGROUND'] : 'Remove background'}}"></span>
        </div>			
        <div class="nb-col-2 has-popover-option" ng-show="settings['nbdesigner_enable_textpattern'] == 'yes'">
            <p class="label-config">{{(langs['PATTERN']) ? langs['PATTERN'] : "Pattern"}}</p>
            <span class="pattern item-config hover-shadow e-shadow" data-target="#dg-pattern" data-toggle="modal" ng-click="loadPattern()"></span>
            <span class="toggle-popup-option fa fa-chevron-down hover-shadow e-shadow c-option" ng-show="editable.pattern"></span>
            <div class="popup-option">
                <div class="inner">
                    <span class="shadow hover-shadow item-config" ng-click="changePatternRepeat('repeat')" >XY</span>
                    <span class="shadow hover-shadow item-config" ng-click="changePatternRepeat('repeat-x')">X</span>
                    <span class="shadow hover-shadow item-config" ng-click="changePatternRepeat('repeat-y')">Y</span>
                    <span class="shadow hover-shadow item-config" ng-click="changePatternRepeat('no-repeat')">O</span>				
                </div>
                <div class="after"></div>
            </div>
        </div>
        <div class="nb-col-30 has-popover-option" ng-show="settings['nbdesigner_text_shadow'] == 1">
            <p class="label-config">{{(langs['SHADOW']) ? langs['SHADOW'] : "Shadow"}}</p>
            <?php  if($enableColor == 'yes'): ?>
            <spectrum-colorpicker
                ng-model="shadow.color" 
                ng-change="changeShadow()" 
                options="{
                    showPaletteOnly: false, 
                    togglePaletteOnly: false, 
                    showPalette: false, 
                    showInput: true}">
            </spectrum-colorpicker>
            <?php else: ?>
            <spectrum-colorpicker
                ng-model="shadow.color" 
                ng-change="changeShadow()" 
                options="{
                    showPaletteOnly: true, 
                    togglePaletteOnly: false, 
                    hideAfterPaletteSelect:true,
                    palette: colorPalette}">
            </spectrum-colorpicker>
            <?php endif; ?>            
            <span class="toggle-popup-option fa fa-chevron-down hover-shadow e-shadow c-option"></span>
            <div class="popup-option">
                <div class="inner">
                    <div class="nb-col-3">
                        <p class="label-config">{{(langs['DIMENSION_X']) ? langs['DIMENSION_X'] : "Dimension X"}}</p>
                        <div class="container-dg-slider"><div class="dg-slider" id="shadow_x"></div></div>					
                    </div>
                    <div class="nb-col-3">
                        <p class="label-config">{{(langs['DIMENSION_Y']) ? langs['DIMENSION_Y'] : "Dimension Y"}}</p>
                        <div class="container-dg-slider"><div class="dg-slider" id="shadow_y"></div></div>					
                    </div>
                    <div class="nb-col-3">
                        <p class="label-config">{{(langs['SHADOW_BLUR']) ? langs['SHADOW_BLUR'] : "Shadow blur"}}</p>
                        <div class="container-dg-slider"><div class="dg-slider" id="shadow_blur"></div></div>					
                    </div>
                    <div class="nb-col-3">
                        <p class="label-config">{{(langs['OPACITY']) ? langs['OPACITY'] : "Opacity"}}</p>
                        <div class="container-dg-slider"><div class="dg-slider" id="shadow_alpha"></div></div>						
                    </div>				
                </div>
                <div class="after"></div>
            </div>			
        </div>		
    </div>
    <div id="text-decoration1" class="content">
        <div class="nb-col-2" ng-show="settings['nbdesigner_text_line_height'] == 1">
            <p class="label-config">{{(langs['LINE_HEIGHT']) ? langs['LINE_HEIGHT'] : "Line height"}}</p>
            <input type="text" ng-model="editable.lineHeight" ng-change="setLineHeight()" class="input-config shadow hover-shadow" 
                   data-toggle="tooltip" data-original-title="{{(langs['LINE_HEIGHT_TOOLTIP']) ? langs['LINE_HEIGHT_TOOLTIP'] : 'Line heightChange vertical spacing between text lines'}}"
                   />
        </div>
        <div class="nb-col-2" ng-show="settings['nbdesigner_text_font_size'] == 1">
            <p class="label-config">{{(langs['FONT_SIZE']) ? langs['FONT_SIZE'] : "Font size"}}</p>
            <div class="btn-group dropup">
                <input type="text" ng-model="editable.ptFontSize" ng-change="setFontSize()" class="input-config shadow hover-shadow" data-toggle="dropdown"/>
                <ul class="dropdown-menu dropup  shadow hover-shadow" style="height: auto;max-height: 200px;overflow-x: hidden;">
                    <li ng-repeat="size in listFontSizeInPt"><a href="javascript:void(0);" ng-click="editable.ptFontSize = size;setFontSize()">{{size}}</a></li>
                </ul>
            </div>
        </div>		
        <div class="nb-col-30" ng-show="settings['nbdesigner_text_opacity'] == 1">
            <p class="label-config">{{(langs['OPACITY']) ? langs['OPACITY'] : "Opacity"}}</p>
            <div class="container-dg-slider"><div class="opacity-slider dg-slider" id="opacity-text"></div></div>
        </div>
        <div class="nb-col-30 has-popover-option" ng-show="settings['nbdesigner_text_outline'] == 1">
            <p class="label-config">{{(langs['OUTLINE']) ? langs['OUTLINE'] : "Outline"}}</p>
            <?php  if($enableColor == 'yes'): ?>
            <spectrum-colorpicker
                ng-model="colorStrokeOptional" 
                ng-change="changeStroke(colorStrokeOptional, null)" 
                options="{
                    showPaletteOnly: false, 
                    togglePaletteOnly: false, 
                    showPalette: false, 
                    showInput: true}">
            </spectrum-colorpicker>
            <?php else: ?>
            <spectrum-colorpicker
                ng-model="colorStrokeOptional" 
                ng-change="changeStroke(colorStrokeOptional, null)" 
                options="{
                    showPaletteOnly: true, 
                    togglePaletteOnly: false, 
                    hideAfterPaletteSelect:true,
                    palette: colorPalette}">
            </spectrum-colorpicker>
            <?php endif; ?>              
            <span class="toggle-popup-option fa fa-chevron-down hover-shadow e-shadow c-option"></span>
            <div class="popup-option">
                <div class="inner">			
                    <div class="container-dg-slider"><div class="dg-slider" id="dg-outline-width"></div></div>
                </div>
                <div class="after"></div>
            </div>
        </div>		
    </div>	
    <div id="text-dimension" class="content">
        <div class="nb-col-4">
            <p class="label-config">Letter spacing</p>
            <div class="container-dg-slider"><div class="dg-slider" id="letter-spacing"></div></div>            
        </div>
        <div class="nb-col-4" ng-show="settings['nbdesigner_text_proportion'] == 1">
            <p class="label-config">{{(langs['UNLOCK_PROPORTION']) ? langs['UNLOCK_PROPORTION'] : "Unlock proportion"}}</p>
            <div class="switch">
                <input id="text-lock" class="cmn-toggle cmn-toggle-round" type="checkbox" ng-model="lockProportion"  ng-change="unlockProportion()">
                <label for="text-lock"></label>
            </div>  
        </div>			
    </div>
    <div id="rotate-curved" class="content">
        <div class="nb-col-30" ng-show="settings['nbdesigner_text_rotate'] == 1">
            <p class="label-config label-rotate">{{(langs['ROTATE']) ? langs['ROTATE'] : "Rotate"}}</p>
            <div class="rotation-text"><input type="text" id="rotation-text" data-min="0" data-max="359"></div>
        </div>
        <div class="nb-col-40" ng-show="settings['nbdesigner_enable_curvedtext'] == 'yes'">
            <p class="label-config">{{(langs['CURVED_TEXT']) ? langs['CURVED_TEXT'] : "Curved text"}}</p>
            <div class="container-dg-slider"><div class="dg-slider" id="text-arc"></div></div>
            <p ng-if="langMode == 'rtl'" class="label-config">{{(langs['RTL']) ? langs['RTL'] : "RTL"}}</p>
            <div ng-if="langMode == 'rtl'">
                <input id="rtl_lang" class="cmn-toggle cmn-toggle-round" type="checkbox"  ng-click="changeTextDirection()" ng-model="rtlLang">
                <label for="rtl_lang"></label>                
            </div>
        </div>		
        <div class="nb-col-30 has-popover-option" ng-show="settings['nbdesigner_enable_curvedtext'] == 'yes'">
            <p class="label-config">{{(langs['REVERSE']) ? langs['REVERSE'] : "Reverse"}}</p>
            <div class="switch nb-col-6">
                <input id="curve_reverse" class="cmn-toggle cmn-toggle-round" type="checkbox"  ng-click="reverseCurve()">
                <label for="curve_reverse"></label>
            </div> 	
            <span class="toggle-popup-option fa fa-chevron-down hover-shadow e-shadow c-option pull-right" ng-style="{display: editable.effect}"></span>
            <div class="popup-option">
                <div class="inner">	
                    <div class="nb-col-30">
                        <p class="label-config">{{(langs['CHANGE_SPACING']) ? langs['CHANGE_SPACING'] : "Change spacing"}}</p>
                        <input type="text" ng-model="editable.spacing" ng-change="setSpacing()" class="input-config shadow hover-shadow" data-toggle="tooltip" data-original-title="{{(langs['CHANGE_SPACING']) ? langs['CHANGE_SPACING'] : 'Change spacing'}}"/>		
                    </div>
                    <div class="nb-col-70">
                        <span class="shadow hover-shadow text-item" ng-click="changeEffect('arc')">{{(langs['ARC']) ? langs['ARC'] : "Arc"}}</span>
                        <span class="shadow hover-shadow text-item" ng-click="changeEffect('STRAIGHT')">{{(langs['STRAIGHT']) ? langs['STRAIGHT'] : "Straight"}}</span>
                        <span class="shadow hover-shadow text-item" ng-click="changeEffect('smallToLarge')">{{(langs['SMALL_TO_LARGE']) ? langs['SMALL_TO_LARGE'] : "Small to large"}}</span>
                        <span class="shadow hover-shadow text-item" ng-click="changeEffect('largeToSmallTop')">{{(langs['LARGE_TO_SMALL_TOP']) ? langs['LARGE_TO_SMALL_TOP'] : "Large to small top"}}</span>
                        <span class="shadow hover-shadow text-item" ng-click="changeEffect('largeToSmallBottom')">{{(langs['LARGE_TO_SMALL_BOTTOM']) ? langs['LARGE_TO_SMALL_BOTTOM'] : "Large to small bottom"}}</span>
                    </div>
                </div>
                <div class="after"></div>
            </div>	
        </div>	
    </div>	
</div>
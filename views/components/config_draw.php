<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="config_draw" class="shadow od_tab nbdesigner_config" ng-style="{'display': pop.draw}">
    <ul class="config_list" id="draw_config_list">
        <li ng-show="settings['nbdesigner_draw_shape'] == 1"><a href="#free_draw" ng-click="changeDrawMode()"><span class="fa fa-paint-brush" aria-hidden="true"></span></a></li>   
        <li ng-show="settings['nbdesigner_draw_brush'] == 1"><a href="#draw_shape" ng-click="disableDrawMode()"><span class="fa fa-star" aria-hidden="true"></span></a></li>                       
    </ul>
    <div class="list-indicator"></div>
    <div id="draw_shape" class="nbdesigner_config_content content">
        <div class="nb-col-2">
            <p class="label-config">{{(langs['GEOMETRICAL']) ? langs['GEOMETRICAL'] : "Geometrical"}}</p>
            <div class="btn-group dropup">
                <button class="btn btn-primary dropdown-toggle shadow hover-shadow" type="button" data-toggle="dropdown">{{(langs['SHAPE']) ? langs['SHAPE'] : "Shape"}}&nbsp;<span class="caret"></span></button>
                <ul class="dropdown-menu dropup shadow hover-shadow">
                    <li ng-show="settings['nbdesigner_draw_shape_rectangle'] == 1"><a href="javascript:void(0);" ng-click="addRect()">{{(langs['RECTANGLE']) ? langs['RECTANGLE'] : "Rectangle"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_shape_circle'] == 1"><a href="javascript:void(0);" ng-click="addCircle()">{{(langs['CIRCLE']) ? langs['CIRCLE'] : "Circle"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_shape_triangle'] == 1"><a href="javascript:void(0);" ng-click="addTriangle()">{{(langs['TRIANGLE']) ? langs['TRIANGLE'] : "Triangle"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_shape_line'] == 1"><a href="javascript:void(0);" ng-click="addLine()">{{(langs['LINE']) ? langs['LINE'] : "Line"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_shape_polygon'] == 1"><a href="javascript:void(0);" ng-click="addPolygon('star')">{{(langs['POLYGON']) ? langs['POLYGON'] : "Polygon"}}</a></li>                
                    <li ng-show="settings['nbdesigner_draw_shape_hexagon'] == 1"><a href="javascript:void(0);" ng-click="addPolygon('hex')">{{(langs['HEXAGON']) ? langs['HEXAGON'] : "Hexagon"}}</a></li>                
                </ul>                
            </div>
        </div>
        <div class="nb-col-30" style="padding-left: 15px;">
            <p class="label-config">{{(langs['COLOR']) ? langs['COLOR'] : "Color"}}</p>
            <?php  if($enableColor == 'yes'): ?>
            <spectrum-colorpicker
                ng-model="colorShape" 
                ng-change="setShapeColor(colorShape)" 
                options="{
                    showPaletteOnly: false, 
                    togglePaletteOnly: false, 
                    showPalette: false, 
                    showInput: true}">
            </spectrum-colorpicker>  
            <?php else: ?>
            <spectrum-colorpicker
                ng-model="colorShape" 
                ng-change="setShapeColor(colorShape)" 
                options="{
                    showPaletteOnly: true, 
                    togglePaletteOnly: false, 
                    hideAfterPaletteSelect:true,
                    palette: colorPalette}">
            </spectrum-colorpicker>       
            <?php endif; ?>           
        </div>  
        <div class="nb-col-2" ng-show="shapeMode">
            <p class="label-config label-rotate">{{(langs['ROTATE']) ? langs['ROTATE'] : "Rotate"}}</p>
            <div class="rotation-text"><input type="text" id="rotation-shape" data-min="0" data-max="359"></div>
        </div>  
        <div class="nb-col-30" ng-show="shapeMode">
            <p class="label-config">{{(langs['OPACITY']) ? langs['OPACITY'] : "Opacity"}}</p>
            <div class="container-dg-slider"><div class="dg-slider" id="opacity_shape"></div></div>					
        </div>         
    </div>
    <div id="free_draw" class="nbdesigner_config_content content">
        <div class="nb-col-2 has-popover-option">
            <p class="label-config">{{(langs['MODE']) ? langs['MODE'] : "Mode"}}</p>
            <div class="btn-group dropup">
                <button class="btn btn-primary dropdown-toggle shadow hover-shadow" type="button" data-toggle="dropdown">{{(langs['BRUSH']) ? langs['BRUSH'] : "Brush"}}&nbsp;<span class="caret"></span></button>
                <ul class="dropdown-menu dropup  shadow hover-shadow">
                    <li ng-show="settings['nbdesigner_draw_brush_pencil'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('Pencil')">{{(langs['PENCIL']) ? langs['PENCIL'] : "Pencil"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_circle'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('Circle')">{{(langs['CIRCLE']) ? langs['CIRCLE'] : "Circle"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_spray'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('Spray')">{{(langs['SPRAY']) ? langs['SPRAY'] : "Spray"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_pattern'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('Pattern')">{{(langs['PATTERN']) ? langs['PATTERN'] : "Pattern"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_hline'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('hline')">{{(langs['HORIZONTAL_LINE']) ? langs['HORIZONTAL_LINE'] : "Horizontal line"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_vline'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('vline')">{{(langs['VERTICAL_LINE']) ? langs['VERTICAL_LINE'] : "Vertical line"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_square'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('square')">{{(langs['SQUARE']) ? langs['SQUARE'] : "Square"}}</a></li>
                    <li ng-show="settings['nbdesigner_draw_brush_diamond'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('diamond')">{{(langs['DIAMOND']) ? langs['DIAMOND'] : "Diamond"}}</a></li>                    
                    <li ng-show="settings['nbdesigner_draw_brush_texture'] == 1"><a href="javascript:void(0);" ng-click="setDrawingMode('texture')">{{(langs['TEXTURE']) ? langs['TEXTURE'] : "Texture"}}</a></li>                    
                </ul>
            </div> 
            <span class="toggle-popup-option fa fa-chevron-down hover-shadow e-shadow c-option" style="display: none;" id="show_popover_option_draw"></span>
        </div>
        <div class="nb-col-2">
            <p class="label-config">{{(langs['COLOR']) ? langs['COLOR'] : "Color"}}</p>
            <?php  if($enableColor == 'yes'): ?>
            <spectrum-colorpicker
                ng-model="colorBrush" 
                ng-change="setDrawingLineColor(colorBrush)" 
                options="{
                    showPaletteOnly: false, 
                    togglePaletteOnly: false, 
                    showPalette: false, 
                    showInput: true}">
            </spectrum-colorpicker> 
            <?php else: ?>
            <spectrum-colorpicker
                ng-model="colorBrush" 
                ng-change="setDrawingLineColor(colorBrush)" 
                options="{
                    showPaletteOnly: true, 
                    togglePaletteOnly: false, 
                    hideAfterPaletteSelect:true,
                    palette: colorPalette}">
            </spectrum-colorpicker>       
            <?php endif; ?>      
        </div> 
        <div class="nb-col-30">
            <p class="label-config">{{(langs['BRUSH_WIDTH']) ? langs['BRUSH_WIDTH'] : "Brush width"}}</p>
            <div class="container-dg-slider"><div class="dg-slider" id="brush_width"></div></div>					
        </div>
        <div class="nb-col-30">
            <p class="label-config">{{(langs['SHADOW_WIDTH']) ? langs['SHADOW_WIDTH'] : "Shadow width"}}</p>
            <div class="container-dg-slider"><div class="dg-slider" id="brush_shadow_width"></div></div>					
        </div>        
    </div>  
</div>
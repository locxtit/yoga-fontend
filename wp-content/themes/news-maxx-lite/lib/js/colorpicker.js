/*
 * Color Picker
 * http://kopatheme.com
 * Copyright (c) 2014 Kopatheme
 *
 * Licensed under the GPL license:
 *  http://www.gnu.org/licenses/gpl.html
 */
jQuery(document).ready(function(){
    var kopa_colorpicker_options = {      
        defaultColor: false,        
        change: function(event, ui){},        
        clear: function() {},        
        hide: true,        
        palettes: true
    };
    jQuery('.kopa_colorpicker').wpColorPicker(kopa_colorpicker_options);
});
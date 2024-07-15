(function($){  
    "use strict";
    $('.regular-text-color').wpColorPicker();
    $( "#fpg-setting-tabs" ).tabs();

    /**
     *
     */
    jQuery(document).ready(function($) {
        $('#fancy_post_grid_slider_column').select2({
            placeholder: 'Select Column',
            allowClear: true
        });
        $('#fancy_post_grid_column').select2({
            placeholder: 'Select Column',
            allowClear: true
        });
    });

})(jQuery);

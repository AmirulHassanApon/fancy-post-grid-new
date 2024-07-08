jQuery(document).ready(function($) {
    // Hide all tab content except the first one initially
    $('#fpg_metabox_tabs div').not(':first').hide();

    // Handle tab switching
    $('#fpg_metabox_tabs ul li a').click(function(){
        var tab_id = $(this).attr('href');

        // Hide all tabs
        $('#fpg_metabox_tabs div').hide();

        // Show the selected tab
        $(tab_id).show();

        // Add active class to the current tab
        $('#fpg_metabox_tabs ul li').removeClass('active');
        $(this).parent('li').addClass('active');

        // Prevent default anchor click behavior
        return false;
    });

    // Trigger click on the first tab link to activate it initially
    $('#fpg_metabox_tabs ul li:first-child a').click();
});
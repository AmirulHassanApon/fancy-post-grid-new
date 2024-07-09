jQuery(document).ready(function($) {
    $('#fpg_metabox_tabs').tabs();

    // Make the first tab active by default
    $('#fpg_metabox_tabs ul li:first-child a').addClass('active');
    $('#fpg_metabox_tabs div:first-child').addClass('active');
    
    // Handle tab switching
    $('#fpg_metabox_tabs ul li a').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');

        // Remove active class from all tabs and contents
        $('#fpg_metabox_tabs ul li a').removeClass('active');
        $('#fpg_metabox_tabs > div').removeClass('active');

        // Add active class to the clicked tab and corresponding content
        $(this).addClass('active');
        $(target).addClass('active');
    });
});

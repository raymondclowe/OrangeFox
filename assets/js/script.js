// OrangeFox AdBlock Detector Scripts
(function($) {
    'use strict';

    // Function to update AdBlock usage statistics on the admin page and dashboard widget
    function updateAdBlockStats() {
        // Make an AJAX call to fetch and display AdBlock usage statistics
        $.ajax({
            // URL to send the AJAX request to
            url: ajaxurl,
            // HTTP method for the request
            method: 'POST',
            // Data to send with the request
            data: {
                // Action to be performed on the server
                action: 'orangefox_get_adblock_stats'
            },
            // Function to run if the AJAX call is successful
            success: function(response) {
                // Update the content of the stats containers with the response
                $('#orangefox-stats-container, #orangefox-dashboard-stats').html(response);
            }
        });
    }

    // When the document is fully loaded and ready
    $(document).ready(function() {
        // Call the function to update AdBlock stats
        updateAdBlockStats();
    });

})(jQuery);

// OrangeFox AdBlock Detection Script
(function($) {
    'use strict';

    // Function to detect if an ad blocker is active
    function detectAdBlock() {
        // Create a test ad element
        var testAd = document.createElement('div');
        // Set the content of the test ad (a non-breaking space)
        testAd.innerHTML = ' ';
        // Add a class to the test ad
        testAd.className = 'adsbox';
        // Add the test ad to the page
        document.body.appendChild(testAd);

        // Check the test ad after a short delay
        window.setTimeout(function() {
            // If the ad has no height, an ad blocker is likely active
            if (testAd.offsetHeight === 0) {
                sendAdBlockStatus(true);
            } else {
                sendAdBlockStatus(false);
            }
            // Remove the test ad from the page
            testAd.remove();
        }, 100);
    }

    // Function to send the ad block status to the server
    function sendAdBlockStatus(isBlocking) {
        // Send an AJAX request to the server
        $.ajax({
            url: orangefox_params.ajax_url,
            method: 'POST',
            data: {
                action: 'orangefox_record_adblock',
                is_blocking: isBlocking,
                nonce: orangefox_params.nonce
            }
        });
    }

    // Run the ad block detection when the document is ready
    $(document).ready(function() {
        detectAdBlock();
    });

})(jQuery);

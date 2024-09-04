// OrangeFox AdBlock Detection Script
(function($) {
    'use strict';

    function detectAdBlock() {
        var testAd = document.createElement('div');
        testAd.innerHTML = ' ';
        testAd.className = 'adsbox';
        document.body.appendChild(testAd);
        window.setTimeout(function() {
            if (testAd.offsetHeight === 0) {
                sendAdBlockStatus(true);
            } else {
                sendAdBlockStatus(false);
            }
            testAd.remove();
        }, 100);
    }

    function sendAdBlockStatus(isBlocking) {
        $.ajax({
            url: orangefox_params.ajax_url,
            method: 'POST',
            data: {
                action: 'orangefox_record_adblock',
                is_blocking: isBlocking
            }
        });
    }

    $(document).ready(function() {
        detectAdBlock();
    });

})(jQuery);

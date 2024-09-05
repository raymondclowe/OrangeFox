// Version: 1.3
// This function checks for ad elements and updates metrics if any are hidden
(function($) {
    $(document).ready(function() {
        // Wait for 1 second before checking
        setTimeout(function() {
            // Check if any of the ad elements are hidden
            // Check if the ad div is hidden
            var isDivHidden = $('#ad').is(':hidden');
            var isLinkHidden = $('a.ad').is(':hidden');
            var isImgHidden = $('img.ad').is(':hidden');
            
            // If any of the ad elements are hidden, set isHidden to true
            var isHidden = isDivHidden || isLinkHidden || isImgHidden;
            
            // Send an AJAX request to update metrics
            $.post(orangeFox.ajaxurl, {
                action: 'update_metrics',
                is_hidden: isHidden
            });
        }, 1000);
    });
})(jQuery);
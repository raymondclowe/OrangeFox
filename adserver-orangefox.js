// This function inserts the adsense or other advertising block to the page
(function($) {
    $(document).ready(function() {
        setTimeout(function() {
            var isA = $('#advertising-div-ads-go-here').is(':hidden');
            $.post(orangeFox.ajaxurl, {
                action: 'update_metrics',
                is_a: isA
            });
        }, 1000);
    });
})(jQuery);
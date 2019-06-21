jQuery(function($) {
    // is init datepicker
    if(typeof $.fn.datepicker !== 'undefined') {
        $('.datepicker').datepicker({ dateFormat: 'mm/dd/yy' });
    }
    // retireConfirmation
    retireConfirmation = function(e,t) {
        e.preventDefault();
        e.stopPropagation();
        var $t = $(t);
        var rpop = $( '#popup-retire' );
        $( document ).on('click touchend', function() {
            rpop.hide();
        });
        rpop.css('display', 'flex');
        rpop.find('a.retire').click(function(e) {
            e.preventDefault();
            window.location = $t.data('retireurl');
        });
        rpop.find('a.close').click(function(e) {
            e.preventDefault();
            rpop.hide();
        });
    };
    // delete Photo
    /*$('#deleteImage').on('click', function(e) {
        e.preventDefault();
        $(this).prev('img').attr('src', '');
        $(this).prev('img').attr('srcset', '');
        $('input[name="Photo"]').val('remove');
    });*/
});
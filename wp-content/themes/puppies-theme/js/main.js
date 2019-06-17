jQuery(function($) {
    if(typeof $.fn.datepicker !== 'undefined') {
        $('.datepicker').datepicker({ dateFormat: 'mm/dd/yy' });
    }
});
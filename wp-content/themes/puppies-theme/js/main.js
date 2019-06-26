jQuery(function($) {
    // is init datepicker
    if(typeof $.fn.datepicker !== 'undefined') {
        $('.datepicker').datepicker({
            dateFormat: 'mm/dd/yy'
        }).on('keypress', function () {
            event.preventDefault();
        });
    }
    // hide popups
    $( document ).on('click touchend', function() {
        $('.modal-popup .close').trigger('click');
    });
    // close popups
    $('.modal-popup .close').click(function(e) {
        e.preventDefault();
        $('.modal-popup').hide();
        $('body').css('overflow', 'auto');
    });
    // open popup
    $('.modal-popup-link').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $t = $(this);
        var pop = $( $t.attr('href') );
        pop.show();
        $('body').css('overflow', 'hidden');

        // retireConfirmation
        if($t.hasClass('btn-retire')) {
            pop.find('.retire').click(function(e) {
                e.preventDefault();
                window.location = $t.data('retireurl');
            });
        }
    });
    // delete Photo
    /*$('#deleteImage').on('click', function(e) {
        e.preventDefault();
        $(this).prev('img').attr('src', '');
        $(this).prev('img').attr('srcset', '');
        $('input[name="Photo"]').val('remove');
    });*/
    // tooltip
    $('input, select, textarea').on('focus', function(e) {
        $('.tooltip-content').hide();
        $(this).next('.tooltip-content').show();
    });
    // close tooltip
    $('.tooltip-content .close').click(function(e) {
        e.preventDefault();
        $('.tooltip-content').hide();
    });
    // puppy_discount
    $('input:radio[name="puppy_discount"]').on('change', function() {
        if($('input:radio[name="puppy_discount"]:checked').val() === 'Yes') {
            $(this).parent().siblings('.hidden-fields').show();
            $('#puppy_discount_reason, #puppy_discount_amount').prop('required',true);
        } else {
            $(this).parent().siblings('.hidden-fields').hide();
            $('#puppy_discount_reason, #puppy_discount_amount').val('').prop('required',false);
        }
    });
    // microchip
    $('input:radio[name="microchip"]').on('change', function() {
        if($('input:radio[name="microchip"]:checked').val() === 'Yes') {
            $(this).parent().siblings('.hidden-fields').show();
            $('#form_microchip_id').prop('required',true);
        } else {
            $(this).parent().siblings('.hidden-fields').hide();
            $('#form_microchip_id').val('').prop('required',false);
        }
    });
});
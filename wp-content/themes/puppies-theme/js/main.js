jQuery(function($) {
    // is init datepicker
    if(typeof $.fn.datepicker !== 'undefined') {
        $('.datepicker').datepicker({
            dateFormat: 'mm/dd/yy',
            //minDate: -365,
            maxDate: new Date()
        }).on('keypress', function () {
            event.preventDefault();
        });
    }
    // hide popups
    $( document ).on('click touchend', function(e) {
        if($(e.target).hasClass('modal-popup')) {
            $('.modal-popup .close').trigger('click');
        }
    });
    // close popups
    $('.modal-popup .close').on('click', function(e) {
        e.preventDefault();
        $('.modal-popup').hide();
        $('body').css('overflow', 'auto');
    });
    // open popup
    $('.modal-popup-link').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $t = $(this);
        var pop = $( $t.attr('href') || $t.data('href') );
        pop.show();
        $('body').css('overflow', 'hidden');
        // media Delete
        if($t.hasClass('dropDelete')) {
            pop.find('.accept').on('click', function(e) {
                var parent = $t.parents('.col-parent');
                var frm = $('.dropzone');
                $.post(puppy_vars.ajaxurl, {
                    action: 'puppy_media',
                    type: 'delete',
                    mime: frm.data('mime'),
                    pid: frm.data('pid'),
                    aid: parent.data('aid'),
                    is_thumb: parent.data('is_thumb')
                }, function (r) {
                    //parent.remove();
                    $('.media-previews').html('<strong>Reloading...</strong>');
                    window.location.reload(true);
                });
                $t.prop('disabled', true).text('Deleting...');
                $('.modal-popup .close').trigger('click');
            });
        } else {
            // retireConfirmation
            if($t.hasClass('btn-retire') || $t.hasClass('btn-delete')) {
                pop.find('.accept').on('click', function(e) {
                    e.preventDefault();
                    window.location = $t.data('url');
                });
            }
        }
    });
    // tooltip
    $('input, select, textarea').on('focus', function(e) {
        $('.tooltip-content').hide();
        $(this).next('.tooltip-content').show();
    });
    // close tooltip
    $('.tooltip-content .close').on('click', function(e) {
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
    // Dropzone
    if(typeof Dropzone !== 'undefined') {
        // Photo
        //var pd_frm = $('.pd-form');
        var drop_frm = $('#frmDropzone');
        var previewNode = document.querySelector('#template_photo');
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);
        Dropzone.options.frmDropzone = {
            url: puppy_vars.ajaxurl,
            autoProcessQueue: false,
            paramName: 'puppy_media',
            maxFilesize: 5, // MB
            maxFiles: 1,
            acceptedFiles: '.jpg, .jpeg, .png, .gif',
            clickable: '.drop-photos .dropSelect',
            previewTemplate: previewTemplate,
            previewsContainer: '#previews_photo',
            dictDefaultMessage: 'or drop file here',
            init: function () {
                var myDropzone = this;
                this.on('addedfile', function() {
                    $('.active .dropChange, .active .dropDelete').hide();
                    $('#previews_photo .dropUpload, #previews_photo .dropCancel, .active .dropUpload, .active .dropCancel').show();
                    $('.drop-photos .dropUpload').on('click', function () {
                        $('#previews_video').hide();
                        myDropzone.processQueue();
                    });
                    $('.drop-photos .dropCancel').on('click', function () {
                        myDropzone.removeAllFiles();
                        $('.dropChange, .dropDelete').show();
                        $('.dropUpload, .dropCancel').hide();
                        $('input[name^="media_file"]').val('');
                    });
                    /*if(pd_frm.length) {
                        pd_frm.data('media_processing', 1);
                    }*/
                });
                this.on('uploadprogress', function(file, progress, bytesSent) {
                    if (file.previewElement) {
                        var progressElement = file.previewElement.querySelector('.drop-photos .progress-bar');
                        progressElement.style.width = progress + "%";
                    }
                });
                this.on('sending', function(file) {
                    document.querySelector('.drop-photos .progress').style.opacity = '1';
                    file.previewElement.querySelector('.dropUpload').setAttribute('disabled', 'disabled');
                });
                /*this.on('queuecomplete', function(progress) {
                    document.querySelector('.progress').style.opacity = '0';
                });*/
                /*this.on('success', function(file, data) {
                    data = JSON.parse(data);
                });*/
                //Submit form
                /*pd_frm.on('submit', function(e) {
                    if($('input[name="media_id"]').val()) {
                        e.preventDefault();
                        e.stopPropagation();
                        pd_frm.submit();
                    }
                });*/
            },
            sending: function (file, xhr, formData) {
                formData.append('action', 'puppy_media');
                /*if( pd_frm.length && pd_frm.data('media_processing') ) {
                    formData.append('type', 'add_media');
                } else {*/
                formData.append('pid', drop_frm.data('pid'));
                formData.append('aid', drop_frm.data('aid'));
                formData.append('is_thumb', drop_frm.data('is_thumb'));
                formData.append('order', $('#template_photo .dropOrder').val());
                $('#previews_photo .dropUpload, .col-media[data-aid="' + drop_frm.data('aid') + '"] .dropUpload').text('Uploading...');
            },
            complete: function (file) {
                var myDropzone = this;
                if(file.accepted) {
                    //if(pd_frm.length && pd_frm.data('media_processing')) {
                    setTimeout(function() {
                        myDropzone.removeFile(file);
                        $('#previews_photo').html('<strong>Reloading...</strong>');
                        //$('.col-media[data-aid="'+drop_frm.data('aid')+'"]').html('<strong>Reloading...</strong>');
                        window.location.reload(true);
                    }, 500);
                } else {
                    setTimeout(function() {
                        myDropzone.removeFile(file);
                    }, 3000);
                }
            },
            thumbnail: function(file, dataUrl) {
                if(file.accepted) {
                    $('input[name="media_file[name]"]').val(file.name);
                    $('input[name="media_file[type]"]').val(file.type);
                    $('input[name="media_file[size]"]').val(file.size);
                    $('input[name="media_file[dataURL]"]').val(file.dataURL);
                }
                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    for (var _iterator6 = file.previewElement.querySelectorAll("[data-dz-thumbnail]"), _isArray6 = true, _i6 = 0, _iterator6 = _isArray6 ? _iterator6 : _iterator6[Symbol.iterator]();;) {
                        var _ref5;

                        if (_isArray6) {
                            if (_i6 >= _iterator6.length) break;
                            _ref5 = _iterator6[_i6++];
                        } else {
                            _i6 = _iterator6.next();
                            if (_i6.done) break;
                            _ref5 = _i6.value;
                        }

                        var thumbnailElement = _ref5;

                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                    }

                    return setTimeout(function () {
                        return file.previewElement.classList.add("dz-image-preview");
                    }, 1);
                }
            },
        };
        // change Photo
        $('.dropChange').on('click', function(e) {
            e.preventDefault();
            var $t = $(this);
            var parent = $t.parents('.col-media');
            $('.col-media').removeClass('active');
            parent.addClass('active');
            drop_frm.data({
                'aid': parent.data('aid'),
                'is_thumb': parent.data('is_thumb')
            });
            $('#previews_photo').addClass('changing');
        });
        // change Order
        $('.media-actions .dropOrder').on('change', function(e) {
            var $t = $(this);
            var parent = $t.parents('.col-media');
            $t.parents('.media-actions').html('<strong>Updating...</strong>');
            $.post(puppy_vars.ajaxurl, {
                action: 'puppy_media',
                type: 'order',
                pid: drop_frm.data('pid'),
                aid: parent.data('aid'),
                is_thumb: parent.data('is_thumb'),
                order: $t.val()
            }, function (r) {
                $('#previews_photo').html('<strong>Reloading...</strong>');
                window.location.reload(true);
            });
        });
        // Video
        var previewNode = document.querySelector('#template_video');
        if(previewNode) {
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
            Dropzone.options.frmDropzoneVideo = {
                url: puppy_vars.ajaxurl,
                autoProcessQueue: false,
                paramName: 'puppy_media',
                maxFilesize: 50, // MB
                maxFiles: 1,
                acceptedFiles: 'video/*',
                clickable: '.drop-video .dropSelect',
                previewTemplate: previewTemplate,
                previewsContainer: '#previews_video',
                dictDefaultMessage: 'or drop file here',
                init: function () {
                    var myDropzone = this;
                    this.on('addedfile', function () {
                        $('.active .dropChange, .active .dropDelete').hide();
                        $('#previews_video .dropUpload, #previews_video .dropCancel, .active .dropUpload, .active .dropCancel').show();
                        $('.drop-video .dropUpload').on('click', function () {
                            $('#previews_photo').hide();
                            myDropzone.processQueue();
                        });
                        $('.drop-video .dropCancel').on('click', function () {
                            myDropzone.removeAllFiles();
                            $('.dropChange, .dropDelete').show();
                            $('.dropUpload, .dropCancel').hide();
                        });
                    });
                    this.on('uploadprogress', function (file, progress, bytesSent) {
                        if (file.previewElement) {
                            var progressElement = file.previewElement.querySelector('.drop-video .progress-bar');
                            progressElement.style.width = progress + "%";
                        }
                    });
                    this.on('sending', function (file) {
                        document.querySelector('.drop-video .progress').style.opacity = '1';
                        file.previewElement.querySelector('.dropUpload').setAttribute('disabled', 'disabled');
                    });
                },
                sending: function (file, xhr, formData) {
                    var frm = $('#frmDropzoneVideo');
                    formData.append('action', 'puppy_media');
                    formData.append('pid', drop_frm.data('pid'));
                    //formData.append('aid', drop_frm.data('aid'));
                    formData.append('type', 'video');
                    $('#previews_video .dropUpload').text('Uploading...');
                },
                complete: function (file, response) {
                    var myDropzone = this;
                    if (file.accepted) {
                        setTimeout(function () {
                            myDropzone.removeFile(file);
                            $('#previews_video').html('<strong>Reloading...</strong>');
                            window.location.reload(true);
                        }, 500);
                    } else {
                        setTimeout(function () {
                            myDropzone.removeFile(file);
                        }, 3000);
                    }
                },
                /*success: function (file, response) {

                },*/
            };
        }
    }
    // mark puppy Sold
    $('.btn-mark-sold').on('click', function(e) {
        e.preventDefault();
        var $t = $(this);
        $t.text('Updating...');
        $.post(puppy_vars.ajaxurl, {
            action: 'puppy_sold',
            pid: $t.data('pid'),
            tostatus: $t.data('tostatus'),
        }, function (r) {
            window.location.reload(true);
        });
    });
    // sorting
    $('.select-sort select').on('change', function () {
        window.location = $(this).val();
    });
    // mobile menu
    $('select.mobile-menu').select2({
        minimumResultsForSearch: -1,
    }).on('change', function (e) {
        window.location = $(this).val();
    });
    // select search
    $('select.select-search').select2();
});
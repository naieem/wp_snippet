/**
 copyRight by Nsstheme
 */

(function ($) {
    'use strict';
    /*documentation js*/
    $('#pippin_registration_form1').on('submit', function (e) {
        e.preventDefault();
        //alert("df");
//        var formdata = $("#pippin_registration_form").serialize();
//        var data = {
//            action: 'login_response',
//            //security: '<?php echo wp_create_nonce( "epicwebs-security" ); ?>',
//            data: new FormData(this)
//        };
        var ajaxurl = admin_ajax.ajax_url;
        //alert(formdata);
//        $.post(ajaxurl, data, function (response) {
//            console.log(response);
//        });
//        var dataf = new FormData($(this)[0]);
//        alert(dataf);
//        $.ajax({
//            url: ajaxurl,
//            type: 'POST',
//            data: {
//                action: 'login_response',
//                data: dataf
//            },
//            async: false,
//            success: function (data) {
//                alert(data)
//            },
//            cache: false,
//            contentType: false,
//            processData: false
//        });

//        var fd = new FormData();
//        var file = $(document).find('input[type="file"]');
//        console.log(file[0].files[0]);
//        var individual_file = file[0].files[0];
//        fd.append("file", individual_file);
        var dataf = new FormData($(this)[0]);
        dataf.append('action', 'login_response');
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: dataf,
            contentType: false,
            processData: false,
            success: function (response) {

                console.log(response);
            }
        });
//        $.ajax({
//            url: ajaxurl,
//            type: 'post',
//            cache: false,
//            //dataType: "JSON",
//            data: {
//                action: 'login_response',
//                data: new FormData(this)
//            },
//            processData: false,
//            contentType: false,
//            success: function (data, status)
//            {
//                console.log(data);
//            },
//            error: function (xhr, desc, err)
//            {
//                console.log(desc);
//            }
//        });
    });

    /*mixitUP*/
//    $(function () {
//        $('#Container').mixItUp();
//    });

})(jQuery);
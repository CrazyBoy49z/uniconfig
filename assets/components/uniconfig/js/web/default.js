$(document).ready(function($) {
    $('.uniform').submit((function (event) {
        var form = $(this);
        var data = form.serialize();
        form.find('input,textarea,select,button').attr('disabled', true);
        $.ajax({
            url: '/uniConfig/assets/components/uniconfig/webconnector.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                form.find('input,textarea,select,button').attr('disabled', false);
                if (response.success) {
                    form[0].reset();
                    modPNotify.Message.success('',response.message)
                } else {
                    modPNotify.Message.error('',response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText + '|\n' + status + '|\n' +error);
            },
        })

        return false;

    }));
});
$(document).ready(function($) {
    $('.uniform').submit((function (event) {
        var form = $(this);
        var data = form.serialize();
        form.find('input,textarea,select,button').attr('disabled', true);
        $.ajax({
            url: '/assets/components/uniconfig/webconnector.php',
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
            }
        })

        return false;

    }));
});
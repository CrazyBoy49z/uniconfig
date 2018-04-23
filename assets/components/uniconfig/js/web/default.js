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
  var uploaders = $('.uploader');
  var Dropzones = [];
  if (uploaders.length > 0) {
    for (var i = 0; i < uploaders.length; i++) {
      uploaders[i].classList.add('dropzone_' + (i+1));
      Dropzones[i] = new Dropzone('.dropzone_' + (i+1), {
        url: '/uniConfig/assets/components/uniconfig/dropzone.php',
        paramName: uploaders[i].dataset.name,
        parallelUploads: 10,
        maxFiles: 4,
      });
      Dropzones[i].on('success', function(e, response) {
        response = JSON.parse(response);
        $('#files').append('<input name="files[]" id="files" type="hidden" value="'+response.url+'">');
      });
      Dropzones[i].on("error", function(e, response) {
        response = JSON.parse(response);
        console.log(response.message);
      });
    }
  }
});
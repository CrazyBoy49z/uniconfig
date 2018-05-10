$(document).ready(function($) {
    $('.uniform').submit((function (event) {
        var form = $(this);
        var data = form.serialize();
        form.find('input,textarea,select,button').attr('disabled', true);
        NProgress.start();
        $.ajax({
            url: '/uniConfig/assets/components/uniconfig/webconnector.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                form.find('input,textarea,select,button').attr('disabled', false);
                NProgress.done();
                if (response.success) {
                    form[0].reset();
                    modPNotify.Message.success('',response.message);
                    var dzPreview = $('.dz-preview');
                    if(dzPreview.length > 0){
                      dzPreview.remove();
                      $('.uploader').removeClass('dz-started');
                    }
                  //setTimeout('window.location.reload()', 600)
                } else {
                    modPNotify.Message.error('',response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText + '|\n' + status + '|\n' +error);
            },
        });

        return false;

    }));
  $('.uniformcomment').submit((function (event) {
    var form = $(this);
    var data = form.serialize();
    form.find('input,textarea,select,button').attr('disabled', true);
    NProgress.start();
    $.ajax({
      url: '/uniConfig/assets/components/uniconfig/webconnector.php',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function(response) {
        form.find('input,textarea,select,button').attr('disabled', false);
        NProgress.done();
        if (response.success) {
          form[0].reset();
          var dzPreview = $('.dz-preview');
          if(dzPreview.length > 0){
            dzPreview.remove();
            $('.uploader').removeClass('dz-started');
          }
          $('#comments').append(response.comment);
        } else {
          modPNotify.Message.error('',response.message);
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText + '|\n' + status + '|\n' +error);
      },
    });

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
        maxFilesize: 2,
        acceptedFiles: 'image/png,image/jpeg',
        dictFileTooBig: 'Файл слишком большой ({{filesize}}) МБ. Максимальный размер файла: {{maxFilesize}} МБ.',
        dictInvalidFileType: 'Файл имеет неверный формат. Поддерживаются изображения только JPEG и PNG.',
      });
      Dropzones[i].on('success', function(e, response) {
        response = JSON.parse(response);
        $('#files').append('<input name="files[]" type="hidden" value="'+response.url+'">');
      });
      Dropzones[i].on("error", function(e, response) {
        modPNotify.Message.error('', response);
      });
    }
  }

  //MODx pdoResources Ajax Filter
  //Filter Settings
  var fadeSpeed             = 200, // Fade Animation Speed
    ajaxCountSelector     = '.ajax-count', // CSS Selector of Items Counter
    ajaxContainerSelector = '.ajax-container', // CSS Selector of Ajax Container
    ajaxItemSelector      = '.ajax-item', // CSS Selector of Ajax Item
    ajaxFormSelector      = '.ajax-form', // CSS Selector of Ajax Filter Form
    ajaxFormButtonStart   = '.ajax-start', // CSS Selector of Button Start Filtering
    ajaxFormButtonReset   = '.ajax-reset', // CSS Selector of Button Reset Ajax Form
    sortDownText          = 'По убыванию',
    sortUpText            = 'По возрастанию';

  function ajaxCount() {
    if($('.ajax-filter-count').length) {
      var count = $('.ajax-filter-count').data('count');
      $(ajaxCountSelector).text(count);
    } else {
      $(ajaxCountSelector).text($(ajaxItemSelector).length);
    }
  }ajaxCount();

  function ajaxMainFunction() {
    $.ajax({
      data: $(ajaxFormSelector).serialize()
    }).done(function(response) {
      var $response = $(response);
      $(ajaxContainerSelector).fadeOut(fadeSpeed);
      setTimeout(function() {
        $(ajaxContainerSelector).html($response.find(ajaxContainerSelector).html()).fadeIn(fadeSpeed);
        ajaxCount();
      }, fadeSpeed);
    });
  }

  $(ajaxContainerSelector).on('click', '.ajax-more', function(e) {
    e.preventDefault();
    var offset = $(ajaxItemSelector).length;
    $.ajax({
      data: $(ajaxFormSelector).serialize()+'&offset='+offset
    }).done(function(response) {
      $('.ajax-more, .ajax-filter-count').remove();
      var $response = $(response);
      $response.find(ajaxItemSelector).hide();
      $(ajaxContainerSelector).append($response.find(ajaxContainerSelector).html());
      $(ajaxItemSelector).fadeIn();
    });
  })

  $(ajaxFormButtonStart).click(function(e) {
    e.preventDefault();
    ajaxMainFunction();
  })

  $(ajaxFormButtonReset).click(function(e) {
    e.preventDefault();
    $(ajaxFormSelector).trigger('reset');
    $('input[name=sortby]').val('id');
    $('input[name=sortdir]').val('desc');
    setTimeout(function() {
      $('[data-sort-by]').data('sort-dir', 'asc').toggleClass('button-sort-asc').text(sortUpText);
    }, fadeSpeed);
    ajaxMainFunction();
    ajaxCount();
  })

  $(''+ajaxFormSelector+' input').change(function() {
    ajaxMainFunction();
  })
  $(''+ajaxFormSelector+' select').change(function() {
    ajaxMainFunction();
  })
  $('[data-sort-by]').data('sort-dir', 'asc').click(function() {
    var ths = $(this);
    $('input[name=sortby]').val($(this).data('sort-by'));
    $('input[name=sortdir]').val($(this).data('sort-dir'));
    setTimeout(function() {
      $('[data-sort-by]').not(this).toggleClass('button-sort-asc').text(sortUpText);
      ths.data('sort-dir') == 'asc' ? ths.data('sort-dir', 'desc').text(sortDownText) : ths.data('sort-dir', 'asc').text(sortUpText);
      $(this).toggleClass('button-sort-asc');
    }, fadeSpeed);
    ajaxMainFunction();
  });
  ajaxMainFunction();
});
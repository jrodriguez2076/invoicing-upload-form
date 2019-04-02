$(document).ready(function() {
  var attachmentsBlockShow = false;

  $('#reasons').on('change', function() {
    var selectedReason = $(this).val();

    if (!selectedReason) {
      $('#submitButton').attr('disabled', 'disabled');
      $('#additionalInfoBlock').hide('fade', 1000);
      $('#attachmentsBlock').hide('fade', 1000);
      return;
    }

    $('#additionalInfoBlock').hide();
    $('#additionalInfoBlock').show('fade', 1000);

    $('.additionalField').each(function() {
      for (var i = 0; i < reasonFields[selectedReason].length; i++) {
        if ($(this).hasClass(reasonFields[selectedReason][i])) {
          if ($(this).hasClass('file')) {
            filesMustShow = true;
          }

          $(this)
            .parent()
            .show();
          $(this).show();
          $(this).required = true;
          $(this).removeAttr('disabled');

          if ($(this).hasClass('files')) {
            $(this).fileinput('enable');
            attachmentsBlockShow = true;
          }

          break;
        } else {
          $(this)
            .parent()
            .hide();
          $(this).hide();
          $(this).required = false;
          $(this).attr('disabled', 'disabled');
          $(this).val('');

          if ($(this).hasClass('files')) {
            $(this)
              .fileinput('clear')
              .fileinput('disable');
          }
        }
      }
    });

    if (attachmentsBlockShow) {
      $('#attachmentsBlock').hide();
      $('#attachmentsBlock').show('fade', 1000);
    } else {
      $('#attachmentsBlock').hide();
    }

    $('#submitButton').prop('disabled', false);
    attachmentsBlockShow = false;
  });
});

$(document).ready(function() {
  var selectedReason = $('#reasons').val();
  var attachmentsBlockShow = false;

  if (selectedReason) {
    $('#additionalInfoBlock').show();
    $('#attachmentsBlock').show();
    $('.additionalField').each(function() {
      for (var i = 0; i < reasonFields[selectedReason].length; i++) {
        if ($(this).hasClass(reasonFields[selectedReason][i])) {
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
          if ($(this).hasClass('files')) {
              $(this).fileinput('clear').fileinput('disable');
          }
        }
      }
    });

    if (attachmentsBlockShow) {
      $('#attachmentsBlock').show();
    }

    $('#submitButton').prop('disabled', false);
  }
});

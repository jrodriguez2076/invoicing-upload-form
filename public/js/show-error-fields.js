$(document).ready(function() {
  var selectedReason = $('#reasons').val();
  var attachmentsBlockShow = false;

  if (selectedReason) {
    $('#additionalInfoBlock').show();
    if (reasonFields[selectedReason].length > 0) {
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
              $(this)
                .fileinput('clear')
                .fileinput('disable');
            }
          }
        }
      });
      $('.reason')
        .parent()
        .show();
      $('.reason').show();
      if (jQuery.inArray('reason', reasonFields[selectedReason]) === -1) {
        $('.reason').addClass('required');
        $('.reason').prop('required', true);
      }
      $('.reason').removeAttr('disabled');
    } else {
      $('.additionalField').each(function() {
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
      });
      $('.reason')
        .parent()
        .show();
      $('.reason').show();
      $('.reason').prop('required', true);
      $('.reason').addClass('required');
      $('.reason').removeAttr('disabled');
    }

    if (attachmentsBlockShow) {
      $('#attachmentsBlock').show();
    }

    $('#submitButton').prop('disabled', false);
  }
});

$(document).ready(function() {
  var attachmentsBlockShow = false;

  $('#reasons').on('change', function() {
    var selectedReason = $(this).val();

    if (!selectedReason) {
      $('#submitButton').attr('disabled', 'disabled');
      $('#additionalInfoBlock').hide();
      $('#attachmentsBlock').hide();
      return;
    }

    $('#additionalInfoBlock').show();

    if (reasonFields[selectedReason].length > 0) {
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

      $('.reason')
        .parent()
        .show();
      $('.reason').show();
      $('.reason').removeAttr('disabled');
      if (jQuery.inArray('reason', reasonFields[selectedReason]) === -1) {
        $('.reason').removeAttr('required');
        $('.reason').removeClass('required');
      } else {
        $('.reason').addClass('required');
        $('.reason').prop('required', true);
      }
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
      $('.reason').addClass('required');
      $('.reason').prop('required', true);
      $('.reason').removeAttr('disabled');
    }

    if (attachmentsBlockShow) {
      $('#attachmentsBlock').hide();
      $('#attachmentsBlock').show();
    } else {
      $('#attachmentsBlock').hide();
    }

    $('#submitButton').prop('disabled', false);
    attachmentsBlockShow = false;
  });
});

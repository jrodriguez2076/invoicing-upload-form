$(document).ready(function() {
  var selectedReason = $('#reasons').val();

  if (selectedReason) {
    $('#additionalInfoBlock').show();
    $('.additionalField').each(function() {
      for (var i = 0; i < reasonFields[selectedReason].length; i++) {
        if ($(this).hasClass(reasonFields[selectedReason][i])) {
          $(this)
            .parent()
            .show();
          $(this).show();
          $(this).required = true;
          $(this).removeAttr('disabled');
          break;
        } else {
          $(this)
            .parent()
            .hide();
          $(this).hide();
          $(this).required = false;
          $(this).attr('disabled', 'disabled');
        }
      }
    });

    $('#submitButton').prop('disabled', false);
  }
});

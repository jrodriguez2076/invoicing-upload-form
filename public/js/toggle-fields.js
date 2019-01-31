$(document).ready(function() {
  $('#reasons').on('change', function() {
    var selectedReason = $(this).val();

    if (!selectedReason) {
      $('#submitButton').attr('disabled', 'disabled');
      $('#additionalInfoBlock').hide('slow');
      return;
    }

    $('#additionalInfoBlock').hide();
    $('#additionalInfoBlock').show('slow');

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
          $(this).val('');
        }
      }
    });

    $('#submitButton').prop('disabled', false);
  });
});

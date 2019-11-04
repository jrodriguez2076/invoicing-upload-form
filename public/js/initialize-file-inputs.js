$(document).ready(function() {
  $('.custom-file-label').hide();
  $('#paymentDetails').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['xlsx', 'xls', 'csv', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#taxDocument').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#idDocument').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#companyDocument').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#accountBalance').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#invoices').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['xml', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#accountReceivable').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['xlsx', 'xls', 'csv'],
    allowedFileExtensions: ['xlsx'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#interfacturaEvidence').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#evidence').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#fblSkuList').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['xlsx', 'xls', 'csv'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#skuList').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['xlsx', 'xls', 'csv'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#shoppingError').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#eventsForm').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['xlsx', 'xls', 'csv'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#orderShipmentDocument').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#cbuDocument').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'pdf', 'png', 'txt', 'xls', 'xlsx'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#requestedSupplies').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['xlsx', 'xls', 'csv'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#invoiceProof').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'pdf', 'png', 'txt', 'xls', 'xlsx'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#alternateImage').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#technicalReport').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['doc', 'docx', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#ccciDocument').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['doc', 'docx', 'pdf'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });

  $('#shippingLabel').fileinput({
    showUpload: false,
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'pdf', 'doc', 'docx'],
    theme: 'explorer-fas',
    language: locale,
    removeFromPreviewOnError: true
  });
});

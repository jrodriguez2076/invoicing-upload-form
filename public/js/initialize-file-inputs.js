$(document).ready(function() {
    $('.custom-file-label').remove();
    $('#files').fileinput({
        showUpload: false,
        allowedPreviewTypes: ['image'],
        allowedFileExtensions: ['xlsx', 'xls', 'csv', 'pdf'],
        theme: 'explorer-fas',
        language: locale,
        removeFromPreviewOnError: true
    });
});

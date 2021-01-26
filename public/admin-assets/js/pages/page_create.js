$(document).ready(function () {
    let editor = CKEDITOR.replace('body' );

    CKFinder.setupCKEditor(editor);

    $('#pageType').selectpicker();
});

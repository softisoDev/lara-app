$(document).ready(function () {
    let editor = CKEDITOR.replace('body', {
        // extraPlugins: 'section'
    });
    CKFinder.setupCKEditor(editor);
});

$('#languages').on('change', function () {
    let pageId = $('#pageId').val();

    window.location.href = route('admin.page.translation.add', {id: pageId, lang: $(this).val()});
});

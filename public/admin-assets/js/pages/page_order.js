$(document).ready(function () {
    $('#nestable2').nestable();
});

function updateTree(url) {
    let nestData = $('#nestable2').nestable('serialize');

    $.ajax({
        url: addSlash2Url(url),
        type: "POST",
        dataType: "JSON",
        data:{"_token":CSRF_TOKEN, "data":nestData},
        success:function (response) {
            if (response.success){
                location.reload();
            }
        },
        error:function (response) {
            alert('Something went wrong');
        }
    });
}

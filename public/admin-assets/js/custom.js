function addSlash2Url(url) {

    if (url.match('\/$') === null) {
        return url + '/';
    }
    return url;

}

function removeData(url, id) {

    let confirmDelete = confirm("Are you sure to delete?");

    if (confirmDelete) {
        $.ajax({
            url: addSlash2Url(url),
            type: "DELETE",
            dataType: "JSON",
            data: {"id": id, "_token": CSRF_TOKEN},
            success: function (data) {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Something went wrong');
                }
            },
            error: function (response) {
                alert('Something went wrong');
            }
        });
    }
}

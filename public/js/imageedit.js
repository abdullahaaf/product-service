$(document).ready(function(){
    detailImage();

    $('#form-edit-image').on('submit', function (event) {
        $.ajax({
            url: "http://localhost:8000/api/images/"+imageId,
            method: "PUT",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                alert(response.message);
                location.reload();
            },
            error: function () {
                alert("failed add new image");
            }
        });
        event.preventDefault();
    });
});

function detailImage() {
    $.ajax({
        url: 'http://localhost:8000/api/images/' + imageId,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Populate form fields with response data
            $('#name').val(response.data.name);
            $('#enable').val(response.data.enable);
            if (response.data.file) {
                let imageUrl = "/storage/" + response.data.file;
                $('#image-preview').attr('src', imageUrl);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

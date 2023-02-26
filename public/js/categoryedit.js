$(document).ready(function () {
    detailCategory();

    $('#form-edit-category').on('submit', function (event) {
        $.ajax({
            url: "http://localhost:8000/api/categories/" + categoryId,
            method: "PUT",
            data: JSON.stringify(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                alert(response.message);
                location.reload();
            },
            error: function () {
                alert("failed add new category");
            }
        });
        event.preventDefault();
    });
});

function detailCategory() {
    $.ajax({
        url: 'http://localhost:8000/api/categories/' + categoryId,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Populate form fields with response data
            $('#name').val(response.data.name);
            $('#enable').val(response.data.enable);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

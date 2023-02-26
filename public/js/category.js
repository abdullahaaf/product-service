$(document).ready(function () {
    listCategories();

    $('#form-add-category').on('submit', function (event) {
        $.ajax({
            url: "http://localhost:8000/api/categories",
            method: "POST",
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

function listCategories() {
    $.ajax({
        url: "http://localhost:8000/api/categories",
        method: "GET",
        dataType: 'json',
        success: function (response) {
            $('#table-list-categories tbody').empty();
            $.each(response.data, function (index, item) {
                let row = $('<tr>');
                $('<td>').text(item.name).appendTo(row);
                $('<td>').html('<button class="btn btn-primary">Edit</button><button class="btn btn-danger" onclick="deleteCategory(\'' + item.id + '\')">Delete</button>').appendTo(row);
                $('#table-list-categories tbody').append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function deleteCategory(categoryId) {
    $.ajax({
        url: "http://localhost:8000/api/categories/" + categoryId,
        method: "DELETE",
        success: function (response) {
            alert("success delete category");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

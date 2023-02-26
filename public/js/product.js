$(document).ready(function () {
    listProducts();
    populateCategory();
    populateImage();

    $('#form-add-product').on('submit', function (event) {
        $.ajax({
            url: "http://localhost:8000/api/products",
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

function populateCategory()
{
    $.ajax({
        url: "http://localhost:8000/api/categories",
        method: "GET",
        dataType: 'json',
        success: function (response) {
            $('#category').empty();
            $.each(response.data, function (index, item) {
                $('#category').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function populateImage() {
    $.ajax({
        url: "http://localhost:8000/api/images",
        method: "GET",
        dataType: 'json',
        success: function (response) {
            $('#image').empty();
            $.each(response.data, function (index, item) {
                $('#image').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function listProducts() {
    $.ajax({
        url: "http://localhost:8000/api/products",
        method: "GET",
        dataType: 'json',
        success: function (response) {
            $('#table-list-products tbody').empty();
            $.each(response.data, function (index, item) {
                let imageUrl = "/storage/" + item.product_image.image_file;

                let row = $('<tr>');
                $('<td>').text(item.product_name).appendTo(row);
                $('<td>').text(item.product_description).appendTo(row);
                $('<td>').text(item.product_category).appendTo(row);
                $('<td>').html('<img src="' + imageUrl + '">').appendTo(row);
                $('<td>').html('<button class="btn btn-primary">Edit</button><button class="btn btn-danger" onclick="deleteProduct(\'' + item.id + '\')">Delete</button>').appendTo(row);
                $('#table-list-products tbody').append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function deleteProduct(productId) {
    $.ajax({
        url: "http://localhost:8000/api/products/" + productId,
        method: "DELETE",
        success: function (response) {
            alert("success delete product");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

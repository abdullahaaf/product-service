$(document).ready(function () {
    populateCategory();
    populateImage();
    detailProduct();

    $('#form-edit-product').on('submit', function (event) {
        $.ajax({
            url: "http://localhost:8000/api/products/" + productId,
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
                alert("failed add new product");
            }
        });
        event.preventDefault();
    });
});

function populateCategory() {
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

function detailProduct() {
    $.ajax({
        url: 'http://localhost:8000/api/products/' + productId,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            // Populate form fields with response data
            $('#name').val(response.data.product_name);
            $('#description').val(response.data.product_description);
            $('#category').val(response.data.product_category_id);
            $('#image').val(response.data.product_image.image_id);
            $('#enable').val(response.data.enable);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

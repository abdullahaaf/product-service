$(document).ready(function(){
    listImages();

    $('#form-add-image').on('submit', function(event){
        $.ajax({
            url : "http://localhost:8000/api/images",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function() {
                alert("failed add new image");
            }
        });
        event.preventDefault();
    });
});

function listImages()
{
    $.ajax({
        url: "http://localhost:8000/api/images",
        method: "GET",
        dataType: 'json',
        success: function(response) {
            $('#table-list-images tbody').empty();
            $.each(response.data, function(index,item){
                let imageUrl = "/storage/" + item.file;

                let row = $('<tr>');
                $('<td>').text(item.name).appendTo(row);
                $('<td>').html('<img src="' + imageUrl + '">').appendTo(row);
                $('<td>').html('<button class="btn btn-primary">Edit</button><button class="btn btn-danger" onclick="deleteImage(\'' + item.id + '\')">Delete</button>').appendTo(row);
                $('#table-list-images tbody').append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function deleteImage(imageId)
{
    $.ajax({
        url: "http://localhost:8000/api/images/"+imageId,
        method: "DELETE",
        success: function (response) {
            alert("success delete image");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

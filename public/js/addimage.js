var i = 0;

$("#add").click(function(){

    ++i;

    $("#dynamicTable").append('<tr>\
        <td>\
            <input type="text" name="addmore['+i+'][name]" id="addmore_'+i+'_name" placeholder="Enter Image Name checkName" class="form-control checkName" />\
            <span class="text-dan"></span>\
            <span class="text-danger" id="addmore_'+i+'_name_error"></span>\
        </td>\
        <td>\
            <input type="text" name="addmore['+i+'][description]" id="addmore_'+i+'_description" placeholder="Enter Image Description" class="form-control checkDescription" />\
            <span class="text-dan"></span>\
            <span class="text-danger" id="addmore_'+i+'_description_error"></span>\
        </td>\
        <td>\
            <input type="text" name="addmore['+i+'][coin]" id="addmore_'+i+'_coin" placeholder="Enter your Coin" class="form-control checkPrice" />\
            <span class="text-dan"></span>\
            <span class="text-danger" id="addmore_'+i+'_coin_error"></span>\
        </td>\
        <td>\
            <input type="file" name="addmore['+i+'][image]" id="addmore_'+i+'_image" class="form-control checkImage" accept="image/*" >\
            <span class="text-dan"></span>\
            <span class="text-danger" id="addmore_'+i+'_image_error"></span>\
        </td>\
        <td>\
            <button type="button" class="btn btn-danger remove-tr">Remove</button>\
        </td>\
        </tr>');
});

$(document).on('click', '.remove-tr', function(){
     $(this).parents('tr').remove();
});

$(document).ready(function () {


    function validateFormFields() {
        var name = true;
        var description = true;
        var coin = true;
        var image = true;

        $('.checkName').each(function() {
                if ($(this).val().trim() == '') {
                    name = false;
                    $(this).addClass('border-danger');
                    $(this).siblings('.text-danger').text('Please enter a valid name without spaces');
                } else {
                    $(this).removeClass('border-danger');
                    $(this).siblings('.text-danger').text('');
                }
        });

        $('.checkDescription').each(function() {
                if ($(this).val().trim() == '') {
                    description = false;
                    $(this).addClass('border-danger');
                    $(this).siblings('.text-danger').text('Please enter a valid description without spaces');
                } else {
                    $(this).removeClass('border-danger');
                    $(this).siblings('.text-danger').text('');
                }
        });

        $('.checkPrice').each(function() {
                if ($(this).val().trim() == '') {
                    coin = false;
                    $(this).addClass('border-danger');
                    $(this).siblings('.text-danger').text('Please enter a valid coin amount');
                } else if (!$.isNumeric($(this).val().trim())) {
                    coin = false;
                    $(this).addClass('border-danger');
                    $(this).siblings('.text-danger').text('Please enter a valid coin amount (numeric only)');
                } else {
                    $(this).removeClass('border-danger');
                    $(this).siblings('.text-danger').text('');
                }
        });

        $('.checkImage').each(function() {
            var file = $(this).val();
            if (file != '') {
                var ext = file.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
                    image = false;
                    $(this).addClass('border-danger');
                    $(this).siblings('.text-danger').text('Please upload an image file in JPG, JPEG, or PNG format only');
                } else {
                    $(this).removeClass('border-danger');
                    $(this).siblings('.text-danger').text('');
                }
            } else {
                image = false;
                $(this).addClass('border-danger');
                $(this).siblings('.text-danger').text('Please select an image file');
            }
        });

        return name && description && coin && image;
    }

    $('#image-upload-form').on('submit', function (e) {

        e.preventDefault();

        if (validateFormFields()) {

            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '/addmore',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Good job!',
                            text: 'Image Uploaded Successfully!',
                            timer: 4000
                        })

                    $('#image-upload-form')[0].reset();
                },
                error: function (xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var id = key.replace(/\./g, "_");
                        $("#" + id + "_error").text(value[0]);
                        $("#" + id).addClass("is-invalid");
                    });

                }
            });
        }

    });
});

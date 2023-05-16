// var i = 0;

// $("#add").click(function(){

//     ++i;

//     $("#dynamicTable").append('<tr>\
//         <td>\
//             <input type="text" name="addmore['+i+'][name]" id="addmore_'+i+'_name" placeholder="Enter Image Name checkName" class="form-control checkName" />\
//             <span class="text-dan"></span>\
//             <span class="text-danger" id="addmore_'+i+'_name_error"></span>\
//         </td>\
//         <td>\
//             <input type="text" name="addmore['+i+'][description]" id="addmore_'+i+'_description" placeholder="Enter Image Description" class="form-control checkDescription" />\
//             <span class="text-dan"></span>\
//             <span class="text-danger" id="addmore_'+i+'_description_error"></span>\
//         </td>\
//         <td>\
//             <input type="text" name="addmore['+i+'][coin]" id="addmore_'+i+'_coin" placeholder="Enter your Coin" class="form-control checkPrice" />\
//             <span class="text-dan"></span>\
//             <span class="text-danger" id="addmore_'+i+'_coin_error"></span>\
//         </td>\
//         <td>\
//             <input type="file" name="addmore['+i+'][image]" id="addmore_'+i+'_image" class="form-control checkImage" accept="image/*" >\
//             <span class="text-dan"></span>\
//             <span class="text-danger" id="addmore_'+i+'_image_error"></span>\
//         </td>\
//         <td>\
//             <button type="button" class="btn btn-danger remove-tr">Remove</button>\
//         </td>\
//         </tr>');
// });

// $(document).on('click', '.remove-tr', function(){
//      $(this).parents('tr').remove();
// });

// $(document).ready(function () {


//     function validateFormFields() {
//         var name = true;
//         var description = true;
//         var coin = true;
//         var image = true;

//         $('.checkName').each(function() {
//                 if ($(this).val().trim() == '') {
//                     name = false;
//                     $(this).addClass('border-danger');
//                     $(this).siblings('.text-danger').text('Please enter a valid name without spaces');
//                 } else {
//                     $(this).removeClass('border-danger');
//                     $(this).siblings('.text-danger').text('');
//                 }
//         });

//         $('.checkDescription').each(function() {
//                 if ($(this).val().trim() == '') {
//                     description = false;
//                     $(this).addClass('border-danger');
//                     $(this).siblings('.text-danger').text('Please enter a valid description without spaces');
//                 } else {
//                     $(this).removeClass('border-danger');
//                     $(this).siblings('.text-danger').text('');
//                 }
//         });

//         $('.checkPrice').each(function() {
//                 if ($(this).val().trim() == '') {
//                     coin = false;
//                     $(this).addClass('border-danger');
//                     $(this).siblings('.text-danger').text('Please enter a valid coin amount');
//                 } else if (!$.isNumeric($(this).val().trim())) {
//                     coin = false;
//                     $(this).addClass('border-danger');
//                     $(this).siblings('.text-danger').text('Please enter a valid coin amount (numeric only)');
//                 } else {
//                     $(this).removeClass('border-danger');
//                     $(this).siblings('.text-danger').text('');
//                 }
//         });

//         $('.checkImage').each(function() {
//             var file = $(this).val();
//             if (file != '') {
//                 var ext = file.split('.').pop().toLowerCase();
//                 if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
//                     image = false;
//                     $(this).addClass('border-danger');
//                     $(this).siblings('.text-danger').text('Please upload an image file in JPG, JPEG, or PNG format only');
//                 } else {
//                     $(this).removeClass('border-danger');
//                     $(this).siblings('.text-danger').text('');
//                 }
//             } else {
//                 image = false;
//                 $(this).addClass('border-danger');
//                 $(this).siblings('.text-danger').text('Please select an image file');
//             }
//         });

//         return name && description && coin && image;
//     }

//     $('#image-upload-form').on('submit', function (e) {

//         e.preventDefault();

//         if (validateFormFields()) {

//             var formData = new FormData(this);
//             $.ajax({
//                 type: 'POST',
//                 url: '/addmore',
//                 data: formData,
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 success: function (response) {
//                     Swal.fire({
//                             icon: 'success',
//                             title: 'Good job!',
//                             text: 'Image Uploaded Successfully!',
//                             timer: 4000
//                         })

//                     $('#image-upload-form')[0].reset();
//                 },
//                 error: function (xhr, status, error) {
//                     var errors = xhr.responseJSON.errors;
//                     $.each(errors, function (key, value) {
//                         var id = key.replace(/\./g, "_");
//                         $("#" + id + "_error").text(value[0]);
//                         $("#" + id).addClass("is-invalid");
//                     });

//                 }
//             });
//         }

//     });
// });
    $(document).ready(function() {

        var count = 0;
        $('input[type=file]').change(function(e) {
            $('#image-table').html('');
            var files = e.target.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var filename = file.name;
                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = `
                        <tr id="row-${count}" data-rowid="">
                            <td>
                                <img src="${e.target.result}" width="100">
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="title-${count}">Title:</label>
                                    <input type="text" class="form-control checkName" name="titles[]" id="titles-${count}" >
                                    <span class="text-danger" id="titles_${count}_error"></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="description-${count}">Description:</label>
                                    <input type="text" class="form-control checkDescription" name="descriptions[]" id="descriptions-${count}" >
                                    <span class="text-danger" id="descriptions_${count}_error"></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="coin-${count}">Coin:</label>
                                    <input type="number" class="form-control checkCoin" name="coins[]" id="coins-${count}" >
                                    <span class="text-danger" id="coins_${count}_error"></span>
                                </div>
                            </td>
                        </tr>
                    `;
                    $('#image-table').append(html);
                    count++;
                };
                reader.readAsDataURL(file);
            }

        });

        // $('#myForm').submit(function(e) {
        $('#myForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('data-route'),
                type:'POST',
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // handle success
                    Swal.fire(
                        'Good job!',
                        'You Have Uploaded the Images!',
                        'success'
                    )
                    $('#myForm')[0].reset();
                    $('#image-table').html('');

                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var id = key.replace(/\./g, "_");
                        var newvar = id.replace(/\_/g, "-");
                        // console.log(id)
                        console.log(newvar)
                        $("#" + id + "_error").text(value[0]);
                        $("#" + newvar).addClass("is-invalid");
                    });
                }
            });
        });
});
